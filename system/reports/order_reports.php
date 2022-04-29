<?php
include '../header.php';
include '../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Staff Member';

// form button name change
$btn_name = "Insert";

// form button value change
$btn_value = "insert";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';

// create error variable to store error messages
$error =  array();

// create error variable to store error message styles
$error_style =  array();
$error_style_icon = array();

// date
$date = date('Y-m-d');

//insert item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function

    $first_name = data_clean($first_name);
    $last_name =  data_clean($last_name);
    $nic = data_clean($nic);
    $dob = data_clean($dob);
    $username = data_clean($username);
    $email = data_clean($email);
    $contact_number = data_clean($contact_number);
    $address_line_1 = data_clean($address_line_1);
    $address_line_2 = data_clean($address_line_2);
    $city = data_clean($city);
    $postal_code = data_clean($postal_code);

    // basic validation
    if (empty($first_name)) {
        $error['first_name'] = "First Name Should not be empty";
    }

    if (empty($last_name)) {
        $error['last_name'] = "Last Name Should not be empty";
    }

    if (empty($nic)) {
        $error['nic'] = "NIC Should not be empty";
    }

    if (empty($dob)) {
        $error['dob'] = "Date of Birth Should not be empty";
    }

    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }

    if (empty($email)) {
        $error['email'] = "Email Should not be empty";
    }

    if (empty($password)) {
        $error['password'] = "Password Should not be empty";
    }

    if (empty($verify_password)) {
        $error['error_item_name'] = "Verify Password Should not be empty";
    }

    if (empty($contact_number)) {
        $error['contact_number'] = "Contact Number Should not be empty";
    }

    if (empty($address_line_1)) {
        $error['address_line_1'] = "Address line 1 Should not be empty";
    }

    if (empty($city)) {
        $error['city'] = "City Should not be empty";
    }

    if (empty($postal_code)) {
        $error['postal_code'] = "Postal Code Should not be empty";
    }

    // Advance validation

    if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $error['first_name'] = "Only Letters allowed for First Name";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $error['last_name'] = "Only Letters allowed for Last Name";
    }

    if (!preg_match("/^[0-9]*$/", $contact_number)) {
        $error['phone'] = "Phone number not valid";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
        $error['city'] = "Only Letters allowed for city";
    }

    if (!preg_match("/^[0-9]*$/", $postal_code)) {
        $error['city'] = "Postal Code not valid";
    }

    if (!empty($username)) {

        $sql = "SELECT * FROM users WHERE user_name = '$username'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['user_name'] = "<b> $username </b> User Already Exists";
        }
    }

    if (!empty($email)) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $error['email'] = "Email Address is not valid";
        } else {

            $sql_e = "SELECT * FROM users WHERE email = '$email'";
            $result_e = $db->query($sql_e);
            if ($result_e->num_rows > 0) {
                $error['email'] = "Email Already Exists";
            }
        }
    }

    if (!empty($password)) {
        if (strlen($password) < 8) {
            $error['password'] = "Password Should be at least 8 characters";
        }
    }

    if (!empty($password) && !empty($verify_password)) {

        if ($password != $verify_password) {
            $error['password_verify'] = "Password not match";
        }
    }

    // image upload function
    if (!empty($_FILES['profile_image']['name']) && empty($error)) {

        $photo =  image_upload("profile_image", "../../../assets/images/");

        if (array_key_exists("photo", $photo)) {

            $photo = $photo['photo'];
        } else {

            $error['profile_image'] = $photo['profile_image'];
        }
    } else {
        $photo = @$previous_item_image;
    }

    //insert data to db
    if (empty($error)) {

        $sql = "INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `first_name`, `last_name`, `profile_image`, `created_date`, `status`) VALUES (NULL, '$username', '$email', SHA1('$password'), '$first_name', '$last_name', '$photo', '$date', '1');";

        //run database query
        $db->query($sql);

        //capture last insert ID
        $user_id = $db->insert_id;
        $sql_staff = "INSERT INTO `staff` (`staff_id`, `nic`, `dob`, `contact_number`, `address_l1`, `address_l2`, `city`, `postal_code`, `user_id`) VALUES (NULL, '$nic', '$dob', '$contact_number', '$address_line_1', '$address_line_2', '$city', '$postal_code', '$user_id');";

        //run database query
        $db->query($sql_staff);

        // success message style
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$username</b> Successfully Insert";
    }
}

// edit items
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Items";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM `users` WHERE user_id = $user_id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $profile_image = $row['profile_image'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $username = $row['user_name'];
        $email = $row['email'];
        $password = $row['password'];
    }

    $sql = "SELECT * FROM `staff` WHERE user_id = $user_id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $nic = $row['nic'];
        $dob = $row['dob'];
        $contact_number = $row['contact_number'];
        $address_line_1 = $row['address_l1'];
        $address_line_2 = $row['address_l2'];
        $city = $row['city'];
        $postal_code = $row['postal_code'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function

    $first_name = data_clean($first_name);
    $last_name =  data_clean($last_name);
    $nic = data_clean($nic);
    $dob = data_clean($dob);
    $username = data_clean($username);
    $email = data_clean($email);
    $contact_number = data_clean($contact_number);
    $address_line_1 = data_clean($address_line_1);
    $address_line_2 = data_clean($address_line_2);
    $city = data_clean($city);
    $postal_code = data_clean($postal_code);

    // basic validation
    if (empty($first_name)) {
        $error['first_name'] = "First Name Should not be empty";
    }

    if (empty($last_name)) {
        $error['last_name'] = "Last Name Should not be empty";
    }

    if (empty($nic)) {
        $error['nic'] = "NIC Should not be empty";
    }

    if (empty($dob)) {
        $error['dob'] = "Date of Birth Should not be empty";
    }

    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }

    if (empty($email)) {
        $error['email'] = "Email Should not be empty";
    }

    if (empty($password) && empty($previous_password)) {
        $error['password'] = "Password Should not be empty";
    }

    if (empty($verify_password) && empty($previous_password_verify)) {
        $error['error_item_name'] = "Verify Password Should not be empty";
    }

    if (empty($contact_number)) {
        $error['contact_number'] = "Contact Number Should not be empty";
    }

    if (empty($address_line_1)) {
        $error['address_line_1'] = "Address line 1 Should not be empty";
    }

    if (empty($city)) {
        $error['city'] = "City Should not be empty";
    }

    if (empty($postal_code)) {
        $error['province'] = "Province Should not be empty";
    }


    // Advance validation

    if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $error['first_name'] = "Only Letters allowed for First Name";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $error['last_name'] = "Only Letters allowed for Last Name";
    }

    if (!preg_match("/^[0-9]*$/", $contact_number)) {
        $error['phone'] = "Phone number not valid";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
        $error['city'] = "Only Letters allowed for city";
    }

    if (!preg_match("/^[0-9]*$/", $postal_code)) {
        $error['city'] = "Postal Code not valid";
    }

    if (!empty($username) && @$previous_username != $username) {

        $sql = "SELECT * FROM users WHERE user_name = '$username'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['user_name'] = "<b> $username </b> User Already Exists";
        }
    }

    if (!empty($email) && @$previous_email != $email) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $error['email'] = "Email Address is not valid";
        } else {

            $sql_e = "SELECT * FROM users WHERE email = '$email'";
            $result_e = $db->query($sql_e);
            if ($result_e->num_rows > 0) {
                $error['email'] = "Email Already Exists";
            }
        }
    }

    if (!empty($password)) {
        if (strlen($password) < 8) {
            $error['password'] = "Password Should be at least 8 characters";
        }
    }

    if (!empty($password) && !empty($verify_password)) {

        if ($password != $verify_password) {
            $error['password_verify'] = "Password not match";
            echo $password;
        }
    }

    if (!empty($_FILES['profile_image']['name']) && empty($error)) {

        // image upload function
        $photo =  image_upload("profile_image", "../../../assets/images/");

        if (array_key_exists("photo", $photo)) {

            $photo = $photo['photo'];
        } else {

            $error['profile_image'] = $photo['profile_image'];
        }
    } else {
        $photo = @$previous_profile_image;
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE `users` SET `user_name` = '$username', `email` = '$email', `password` = SHA1('$password'), `first_name` = '$first_name', `last_name` = '$last_name', `profile_image` = '$photo'    WHERE `user_id` = $user_id";

        // run database query
        $query = $db->query($sql);

        $sql = "UPDATE `staff` SET nic = '$nic', dob = '$dob', contact_number = '$contact_number', address_l1 = '$address_line_1', address_l2 = '$address_line_2', city = '$city', postal_code = '$postal_code' WHERE `user_id` = $user_id;";

        // run database query
        $query = $db->query($sql);

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$username</b> Successfully Updated";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "DELETE FROM `users` WHERE `user_id` = '$user_id'";
    $db->query($sql);

    $sql = "DELETE FROM `staff` WHERE `user_id` = '$user_id'";
    $db->query($sql);

    $error['delete_msg'] = "Recode Delete";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Staff</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Alerts -->
    <div class="container-fluid">

        <!-- Insert / update / delete / blank / already exist alerts-->
        <?php show_error($error, $error_style, $error_style_icon); ?>

        <!-- Delete Confirmation -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";

            $result = $db->query($sql);


            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $user_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>"><br>
                            <button type="submit" name="action" value="confirm_delete" class="btn btn-danger btn-s">Yes</button>
                            <button type="submit" name="action" value="cancel_delete" class="btn btn-primary btn-s">No</button>
                        </form>

                    </div>
                </div>

        <?php
            }
        }
        ?>

    </div>
    <div class="container-fluid">
        <div class="row">

            <!-- Right Section Start -->
            <div class="col">
                <?php

                // db connect
                $db = db_con();

                // sql query
                $sql = "SELECT * FROM `users`";

                // fletch data
                $result = $db->query($sql);

                ?>
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Item Stock List</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <label style="margin-right:8px; margin-bottom:8px">Search Item:</label>
                            <input type="text">
                          
                        </form>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name </th>
                                    <th>Category </th>
                                    <th>In Stock </th>
                                    <th>Reorder Level </th>
                                    <th>GRN Price (LKR)</th>
                                    <th style="width: 85px !important;">View</th>
                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> AMD RYZEN 9 3950X</td>
                                    <td>Processors </td>
                                    <td> 10</td>
                                    <td> 4</td>
                                    <td> 165,000</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                
                                <tr>
                                    <td> 2</td>
                                    <td> AMD Ryzen 9 5950X</td>
                                    <td>Processors </td>
                                    <td> 15</td>
                                    <td> 5</td>
                                    <td> 65,000</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                
                                <tr>
                                    <td> 3</td>
                                    <td> Intel Core i9-12900KF</td>
                                    <td>Processors </td>
                                    <td> 8</td>
                                    <td> 2</td>
                                    <td> 145,000</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                
                                <tr>
                                    <td> 4</td>
                                    <td> Intel Core i9-12900K</td>
                                    <td>Processors </td>
                                    <td> 12</td>
                                    <td> 3</td>
                                    <td> 175,000</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                
                                <tr>
                                    <td> 5</td>
                                    <td> ASUS ROG MAXIMUS Z690 EXTREME GLACIAL</td>
                                    <td>Motherboard </td>
                                    <td> 13</td>
                                    <td> 4</td>
                                    <td> 45,000</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                
                                <tr>
                                    <td> 6</td>
                                    <td> ASUS ROG MAXIMUS Z690 EXTREME</td>
                                    <td>Motherboard </td>
                                    <td> 16</td>
                                    <td> 5</td>
                                    <td> 48,000</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>

                                
                              
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Delivers List</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <label style="margin-right:8px; margin-bottom:8px">Start Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">End Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">Courier Status:</label>
                            <select name="cars" id="cars">
                                <option value="volvo"> Delivered</option>
                                <option value="saab">Western</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                        </form>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name </th>
                                    <th>Order Number </th>
                                    <th>Order Date </th>
                                    <th>Courier Status </th>
                                    <th>Courier Company </th>
                                    

                                    <th style="width: 85px !important;">View</th>
                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> Amal Samatha</td>
                                    <td> 202204230014</td>
                                    <td> 2022-02-15</td>
                                    <td> Delivered</td>
                                    <td> Prompet Express</td>
                                    
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 2</td>
                                    <td> Amal Samatha</td>
                                    <td> 202204240028</td>
                                    <td> 2022-02-20</td>
                                    <td> Delivered</td>
                                    <td> Prompet Express</td>
                                    
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 3</td>
                                    <td> Amal Samatha</td>
                                    <td> 202204240022</td>
                                    <td> 2022-02-26</td>
                                    <td> Delivered</td>
                                    <td> domex</td>
                                    
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 4</td>
                                    <td> Amal Samatha</td>
                                    <td> 202204240015</td>
                                    <td> 2022-03-05</td>
                                    <td> Delivered</td>
                                    <td> Prompet Express</td>
                                    
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 5</td>
                                    <td> Amal Samatha</td>
                                    <td> 202204240016</td>
                                    <td> 2022-03-10</td>
                                    <td> Delivered</td>
                                    <td> domex</td>
                                    
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 6</td>
                                    <td> Amal Samatha</td>
                                    <td> 202204240018</td>
                                    <td> 2022-03-12</td>
                                    <td> Delivered</td>
                                    <td> domex</td>
                                    
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 7</td>
                                    <td> Amal Samatha</td>
                                    <td> 202204240020</td>
                                    <td> 2022-03-18</td>
                                    <td> Delivered</td>
                                    <td> Prompet Express</td>
                                    
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Customer List</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <label style="margin-right:8px; margin-bottom:8px">Start Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">End Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">Province:</label>
                            <select name="cars" id="cars">
                                <option value="volvo">- Select - </option>
                                <option value="saab">Western</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                        </form>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name </th>
                                    <th>Username </th>
                                    <th>Register Date </th>
                                    <th>City </th>
                                    <th>Province </th>
                                    <th>Total LKR </th>

                                    <th style="width: 85px !important;">View</th>
                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> Amal Samatha</td>
                                    <td> amal_S</td>
                                    <td> 2022-02-20</td>
                                    <td> Bandaragama</td>
                                    <td> Western</td>
                                    <td> 58,900.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 2</td>
                                    <td> Pavithra Gamage</td>
                                    <td> pavithra_G</td>
                                    <td> 2022-02-22</td>
                                    <td> Horana</td>
                                    <td> Western</td>
                                    <td> 8,700.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 3</td>
                                    <td> Dhanu Aberathna</td>
                                    <td> dhnu_a</td>
                                    <td> 2022-03-05</td>
                                    <td> Panadura</td>
                                    <td> Western</td>
                                    <td> 58,700.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 4</td>
                                    <td> Venuk Kaveen</td>
                                    <td> venu_k</td>
                                    <td> 2022-03-06</td>
                                    <td> Moratuwa</td>
                                    <td> Western</td>
                                    <td> 18,700.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 5</td>
                                    <td> Shahsi Abekoon</td>
                                    <td> shashi_a</td>
                                    <td> 2022-03-10</td>
                                    <td> Kaluthara</td>
                                    <td> Western</td>
                                    <td> 15,700.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 6</td>
                                    <td> Saman Kumara</td>
                                    <td> saman_k</td>
                                    <td> 2022-03-12</td>
                                    <td> Gampaha</td>
                                    <td> Western</td>
                                    <td> 8,700.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                            


                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order List</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <label style="margin-right:8px; margin-bottom:8px">Start Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">End Date:</label>
                            <input type="date">
                        </form>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 125px !important;">#</th>
                                    <th>Order Number </th>
                                    <th>Customer Name </th>
                                    <th>Order Date </th>
                                    <th>Total LKR </th>

                                    <th style="width: 85px !important;">View</th>
                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> 202204240012</td>
                                    <td> Amal Samatha</td>
                                    <td> 2022-02-19</td>
                                    <td> 158,700.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 2</td>
                                    <td> 202204240013</td>
                                    <td> Pavithra Gamage</td>
                                    <td> 2022-02-25</td>
                                    <td> 177,000.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 3</td>
                                    <td> 202204240012</td>
                                    <td> Saman Kumara</td>
                                    <td> 2022-03-01</td>
                                    <td> 16,500.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 4</td>
                                    <td> 202204240012</td>
                                    <td> Dhanu Aberathna</td>
                                    <td> 2022-03-5</td>
                                    <td> 12,000.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 5</td>
                                    <td> 202204240012</td>
                                    <td> Amal Subasinha</td>
                                    <td> 2022-03-08</td>
                                    <td> 245,000.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 6</td>
                                    <td> 202204240013</td>
                                    <td> Nimesha Perera</td>
                                    <td> 2022-03-08</td>
                                    <td> 50,000.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 7</td>
                                    <td> 202204240014</td>
                                    <td> Shahsi Abekoon</td>
                                    <td> 2022-03-12</td>
                                    <td> 50,000.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 8</td>
                                    <td> 202204240015</td>
                                    <td> Samatha Perera</td>
                                    <td> 2022-03-18</td>
                                    <td> 244,000.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 9</td>
                                    <td> 202204240015</td>
                                    <td> Kasun Kalhara</td>
                                    <td> 2022-03-20</td>
                                    <td> 50,000.00</td>
                                    <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <var>
                                    <tr>
                                        <td> 10</td>
                                        <td> 202204240016</td>
                                        <td> Sudam Edirishinha</td>
                                        <td> 2022-03-25</td>
                                        <td> 175,000.00</td>
                                        <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                        <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                    </tr>
                                    <tr>
                                        <td> 11</td>
                                        <td> 202204240017</td>
                                        <td> Venuk Kaveen</td>
                                        <td> 2022-03-28</td>
                                        <td> 150,000.00</td>
                                        <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td>
                                        <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                    </tr>
                                </var>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {
        $('#user_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>