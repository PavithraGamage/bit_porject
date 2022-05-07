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
                <div class="card" id="pdf">
                    <div class="card-header">
                        <h3 class="card-title">Items</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <!-- <label style="margin-right:8px; margin-bottom:8px">Search Item:</label>
                            <input type="text"> -->
                            <label style="margin-right:8px; margin-bottom:8px">Start Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">End Date:</label>
                            <input type="date">

                            <b style="margin-left: 15px;">Item Sold: 20</b>
                            <b style="margin-left: 15px;">Net Sales: LKR 3,024,000</b>
                            <!-- <button>Daily</button> -->


                        </form>
                        <table id="report_1" class="table table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Item ID </th>
                                    <th>Item Name </th>
                                    <th>Item Sold </th>
                                    <th>Total Sales LKR </th>
                                    <th>Orders </th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> ASUS TUF GAMING GEFORCE RTX 3080TI 12GBX</td>
                                    <td>5 </td>
                                    <td>800,000</td>
                                    <td>3</td>
                                    <td>Graphic Cards</td>
                                    <td>13</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 2</td>
                                    <td> INTEL CORE I9-12900K</td>
                                    <td>3 </td>
                                    <td> 685,000</td>
                                    <td>2</td>
                                    <td> Processors</td>
                                    <td> 10</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 3</td>
                                    <td> G.SKILL TRIDENTZ5 RGB 32GB</td>
                                    <td>2 </td>
                                    <td> 758,000</td>
                                    <td>3</td>
                                    <td> MEMORY (RAM)</td>
                                    <td> 8</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 4</td>
                                    <td> MSI RTX 3080TI GAMING TRIO 12GB</td>
                                    <td>4 </td>
                                    <td> 425,000</td>
                                    <td>3</td>
                                    <td> Graphic Cards</td>
                                    <td> 6</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 5</td>
                                    <td> CORSAIR DOMINATOR PLATINUM RGB WHITE 32GB</td>
                                    <td>6 </td>
                                    <td> 356,000</td>
                                    <td>5</td>
                                    <td> MEMORY (RAM)</td>
                                    <td> 16</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>




                            </tbody>

                        </table><br>
                        <button onclick="exportTableToExcel('report_1', 'item_details')">Export Table Data To Excel File</button>
                        <button onclick="Convert_HTML_To_PDF();">Convert HTML to PDF</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Revenue</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <label style="margin-right:8px; margin-bottom:8px">Start Date:</label>
                            <input type="date"><br>
                            <label style=" margin-right:8px">End Date:</label>
                            <input type="date"><br>
                            <b>Orders: 18</b>
                            <b style="margin-left: 15px;">Po Price: LKR 2,284,000</b>
                            <b style="margin-left: 15px;">Sale Price: LKR 2,974,000</b>
                            <b style="margin-left: 15px;">Discount Price: LKR 447,000</b>
                            <b style="margin-left: 15px;">Total Revenue: LKR 690,000</b>
                        </form><br>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date </th>
                                    <th>Orders </th>
                                    <th>Po Price LKR</th>
                                    <th>Sale Price LKR</th>
                                    <th>Discount Price LKR</th>
                                    <th>Revenue LKR </th>

                                    <!-- <th style="width: 85px !important;">View</th> -->
                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> 2022-02-15</td>
                                    <td> 5</td>
                                    <td> 589,000</td>
                                    <td> 674,000</td>
                                    <td> 125,000</td>
                                    <td> 325,000</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>

                                <tr>
                                    <td> 2</td>
                                    <td> 2022-02-17</td>
                                    <td> 6</td>
                                    <td> 385,000</td>
                                    <td> 420,000</td>
                                    <td> 35,000</td>
                                    <td> 32,000</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>

                                <tr>
                                    <td> 3</td>
                                    <td> 2022-02-19</td>
                                    <td> 7</td>
                                    <td> 620,000</td>
                                    <td> 780,000</td>
                                    <td> 125,000</td>
                                    <td> 325,000</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>

                                <tr>
                                    <td> 4</td>
                                    <td> 2022-02-19</td>
                                    <td> 9</td>
                                    <td> 450,000</td>
                                    <td> 480,000</td>
                                    <td> 12,000</td>
                                    <td> 325,000</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>

                                <tr>
                                    <td> 5</td>
                                    <td> 2022-02-20</td>
                                    <td> 5</td>
                                    <td> 590,000</td>
                                    <td> 620,000</td>
                                    <td> 150,000</td>
                                    <td> 180,000</td>
                                    <!-- <td><button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button></td> -->
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
                        <h3 class="card-title">Orders</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <label style="margin-right:8px; margin-bottom:8px">Start Date:</label>
                            <input type="date"><br>
                            <label>End Date:</label>
                            <input type="date"><br>
                            <label>Status:</label>
                            <select name="cars" id="cars">
                                <option value="volvo">Completed</option>
                                <option value="saab">Western</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                            <label style="margin-left: 15px; margin-right:8px">Province:</label>
                            <select name="cars" id="cars">

                                <option value="saab">Western</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                            <b style="margin-left: 15px;">Total Orders: 5</b>
                            <b style="margin-left: 15px;">Total Items: 25</b>
                            <b style="margin-left: 15px;">Total Sale: LKR 690,000</b>
                        </form><br>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date </th>
                                    <th>Order Id </th>
                                    <th>Status </th>
                                    <th>Customer </th>
                                    <th>Province </th>
                                    <th>Items Sold</th>
                                    <th>Total Sale LKR</th>

                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td>2022-02-20</td>
                                    <td>122</td>
                                    <td> Completed</td>
                                    <td> amal_S</td>
                                    <td> Western</td>
                                    <td> 4</td>
                                    <td> 58,900.00</td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> 2022-02-22</td>
                                    <td>123</td>
                                    <td> Completed</td>
                                    <td> Amal Samanatha</td>
                                    <td> Western</td>
                                    <td> 3</td>
                                    <td> 158,900.00</td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> 2022-02-20</td>
                                    <td>124</td>
                                    <td> Completed</td>
                                    <td> Nishan Amarabandu</td>
                                    <td> Western</td>
                                    <td> 5</td>
                                    <td> 528,900.00</td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> 2022-02-20</td>
                                    <td>125</td>
                                    <td> Completed</td>
                                    <td> Sashi Aberathne</td>
                                    <td> Western</td>
                                    <td> 2</td>
                                    <td> 258,900.00</td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> 2022-02-20</td>
                                    <td>126</td>
                                    <td> Completed</td>
                                    <td> Gamunu Galahitiyawa</td>
                                    <td> Western</td>
                                    <td> 8</td>
                                    <td> 358,900.00</td>
                                    <!-- <td><button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                            <td><button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> 2022-02-20</td>
                                    <td>127</td>
                                    <td> Completed</td>
                                    <td> Priyankara Perera</td>
                                    <td> Western</td>
                                    <td> 5</td>
                                    <td> 658,900.00</td>
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
                        <h3 class="card-title">Categories</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <label style="margin-right:8px; margin-bottom:8px">Start Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">End Date:</label>
                            <input type="date">
                            <label style="margin-left: 15px; margin-right:8px">Category:</label>
                            <select name="cars" id="cars">

                                <option value="saab">All</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                        </form>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name </th>
                                    <th>Items Sold </th>
                                    <th>Total Sales LKR </th>
                                    <th>Product </th>
                                    <th>Orders </th>



                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> Processors</td>
                                    <td> 2</td>
                                    <td> 18,700.00</td>
                                    <td> 5</td>
                                    <td> 3</td>


                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> Motherboards</td>
                                    <td> 3</td>
                                    <td> 58,700.00</td>
                                    <td> 5</td>
                                    <td> 3</td>


                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> Graphics Cards</td>
                                    <td> 6</td>
                                    <td> 158,000.00</td>
                                    <td> 5</td>
                                    <td> 3</td>


                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> Memory (RAM)</td>
                                    <td> 5</td>
                                    <td> 58,700.00</td>
                                    <td> 5</td>
                                    <td> 3</td>


                                </tr>
                                <tr>
                                    <td> 1</td>
                                    <td> Power Supply</td>
                                    <td> 8</td>
                                    <td> 358,700.00</td>
                                    <td> 5</td>
                                    <td> 3</td>


                                </tr>




                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Stock</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>

                            <label style="margin-right:8px">Show:</label>
                            <select name="cars" id="cars">

                                <option value="saab">All</option>
                                <option value="mercedes">Out of Stock </option>
                                <option value="audi">Low Stock</option>
                                <option value="audi">In Stock</option>
                            </select>
                        </form>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name </th>
                                    <th>SKU </th>
                                    <th>Status</th>
                                    <th>In Stock</th>
                                    <th>Re Order Level</th>




                                    <!-- <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1</td>
                                    <td> ASUS TUF GAMING GEFORCE RTX 3080TI 12GBX</td>
                                    <td> 24587842</td>
                                    <td> In Stock</td>
                                    <td> 5</td>
                                    <td> 3</td>


                                </tr>
                                <tr>
                                    <td> 2</td>
                                    <td> INTEL CORE I9-12900K</td>
                                    <td> 24585959</td>
                                    <td> Low Stock</td>
                                    <td> 2</td>
                                    <td> 6</td>


                                </tr>
                                <tr>
                                    <td> 3</td>
                                    <td> G.SKILL TRIDENTZ5 RGB 32GB</td>
                                    <td> 24587445</td>
                                    <td> Out of Stock</td>
                                    <td> 0</td>
                                    <td> 3</td>


                                </tr>
                                <tr>
                                    <td> 4</td>
                                    <td> MSI RTX 3080TI GAMING TRIO 12GB</td>
                                    <td> 2452484</td>
                                    <td> In Stock</td>
                                    <td> 8</td>
                                    <td> 4</td>


                                </tr>
                                <tr>
                                    <td> 5</td>
                                    <td> CORSAIR DOMINATOR PLATINUM RGB WHITE 32GB</td>
                                    <td> 24581484</td>
                                    <td> Out of Stock</td>
                                    <td> 0</td>
                                    <td> 5</td>


                                </tr>





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


<!-- pdf support links -->
<script src="http://localhost/bit/system/dist/js/html2canvas.min.js" type="text/javascript"></script>
<script src="http://localhost/bit/system/dist/js/jspdf.min.js" type="text/javascript"></script>

<script>

    // excel export
    function exportTableToExcel(tableID, filename = '') {

        var downloadLink;

        //ms office file type
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name (short if)
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        // for netscape navigator browsers
        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }

//  export pdf
    function Convert_HTML_To_PDF() {
                var elementHTML = document.getElementById('pdf');

                html2canvas(elementHTML, {
                    useCORS: true,
                    onrendered: function (canvas) {
                        var pdf = new jsPDF('L', 'pt', '[1000,1500]');

                        var pageHeight = 2160;
                        var pageWidth = 3840;
                        for (var i = 0; i <= elementHTML.clientHeight / pageHeight; i++) {
                            var srcImg = canvas;
                            var sX = 0;
                            var sY = pageHeight * i; // start 1 pageHeight down for every new page
                            var sWidth = pageWidth;
                            var sHeight = pageHeight;
                            var dX = 0;
                            var dY = 0;
                            var dWidth = pageWidth;
                            var dHeight = pageHeight;

                            window.onePageCanvas = document.createElement("canvas");
                            onePageCanvas.setAttribute('width', pageWidth);
                            onePageCanvas.setAttribute('height', pageHeight);
                            var ctx = onePageCanvas.getContext('2d');
                            ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                            var canvasDataURL = onePageCanvas.toDataURL("image/SVG", 1.0);
                            var width = onePageCanvas.width;
                            var height = onePageCanvas.clientHeight;

                            if (i > 0) // if we're on anything other than the first page, add another page
                                pdf.addPage(612, 864); // 8.5" x 12" in pts (inches*72)

                            pdf.setPage(i + 1); // now we declare that we're working on that page
                            pdf.addImage(canvasDataURL, 'SVG', 20, 40, (width * .62), (height * .62)); // add content to the page
                        }

                        // Save the PDF
                        pdf.save('document-html.pdf');
                    }
                });
            }

</script>