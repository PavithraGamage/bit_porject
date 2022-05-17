<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);
extract($_GET);

// update notification
if (!empty($notification_user_id)) {

    $sql = "UPDATE `users` SET `u_notification` = '1' WHERE `users`.`user_id` = $notification_user_id;";
    $db->query($sql);
}


// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Customer';

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
        $sql_staff = "INSERT INTO `customers` (`cus_id`, `contact_nmuber`, `address_l1`, `address_l2`, `city`, `postal_code`, `user_id`) VALUES (NULL, '$contact_number', '$address_line_1', '$address_line_2', '$city', '$postal_code', '$user_id');";

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

    $sql = "SELECT * FROM `customers` WHERE user_id = $user_id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $contact_number = $row['contact_nmuber'];
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

        $sql = "UPDATE `customers` SET contact_nmuber = '$contact_number', address_l1 = '$address_line_1', address_l2 = '$address_line_2', city = '$city', postal_code = '$postal_code' WHERE `user_id` = $user_id;";

        // run database query
        $query = $db->query($sql);

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$username</b> Successfully Updated";
    }
}

// update user status to inactive
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `users` SET `status` = '1' WHERE `users`.`user_id` = '$user_id;'";
    $db->query($sql);


    $error['delete_msg'] = "Recode Delete";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}

// change status active
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {

    $sql = "UPDATE `users` SET `status` = '0' WHERE `users`.`user_id` = '$user_id;'";
    $db->query($sql);


    $error['delete_msg'] = "Recode Active";

    // error styles
    $error_style['success'] = "alert-success";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User Reports</a></li>
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
                $sql = "SELECT u.user_name, u.first_name, u.last_name, u.user_id, s.status_name, u.profile_image FROM users u INNER JOIN status s ON s.status_id = u.status INNER JOIN customers c ON c.user_id = u.user_id;";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All User List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Profile Image</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Status</th>
                                    <!-- <th>View</th>
                                    <th>Inactive</th>
                                    <th>Active</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><img src="../../../assets/images/<?php echo $row['profile_image'] ?>" class="img-fluid" width="100"></td>
                                            <td><?php echo $row['user_name'] ?> </td>
                                            <td><?php echo $row['first_name'] ?> </td>
                                            <td><?php echo $row['last_name'] ?> </td>
                                            <td><?php echo $row['status_name'] ?> </td>
                                            <!-- <td>
                                                <form action="view.php" method="post">
                                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
                                                    <a href="view.php">
                                                        <button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button>
                                                    </a>
                                                </form>
                                            </td>
                                            
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-ban"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
                                                    <button type="submit" name="action" value="active" class="btn btn-block btn-warning btn-xs"><i class="fas fa-check"></i></button>
                                                </form>
                                            </td> -->

                                        </tr>

                                <?php
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {
        $('#user_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>