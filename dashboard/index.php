<?php
include "site_nav.php";

extract($_POST);

// db connection
$db = db_con();

// create error variable to store error messages
$error =  array();

// login form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'login') {

    // call data clean function
    $username = data_clean($username);

    //check user name is empty
    if (empty($username)) {
        $error['username'] = "User Name Should not be empty";
    }

    // check password is empty
    if (empty($password)) {
        $error['password'] = "Password should not be empty";
    }

    // advance validation
    if (empty($error)) {

        $sql = "SELECT * FROM users WHERE user_name = '$username' AND password = '" . sha1($password) . "'";

        // run database query
        $result = $db->query($sql);

        // check the data in database
        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['profile_image'] = $row['profile_image'];
            $_SESSION['created_date'] = $row['created_date'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['email'] = $row['email'];
        } else {

            $error['password'] = "invalided username or password";
        }
    }

    @$user_id =  $_SESSION['user_id'];

    if (empty($error)) {

        $sql =  "SELECT * FROM `customers` WHERE customers.user_id = $user_id;";

        // run database query
        $result = $db->query($sql);

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $_SESSION['cus_id'] = $row['cus_id'];
            $_SESSION['contact_nmuber'] = $row['contact_nmuber'];
            $_SESSION['address_l1'] = $row['address_l1'];
            $_SESSION['address_l2'] = $row['address_l2'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['postal_code'] = $row['postal_code'];
            $_SESSION['province_id'] = $row['province_id'];
        }
    }

    // redirect to dashboard
    if (empty($error)) {

        header('Location:dashboard.php');
    }
}

// register form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'register') {

    $reg_username = data_clean($reg_username);
    $reg_first_name = data_clean($reg_first_name);
    $reg_last_name = data_clean($reg_last_name);
    $reg_username = data_clean($reg_username);
    $reg_email = data_clean($reg_email);
    $reg_password = data_clean($reg_password);
    $reg_con_password = data_clean($reg_con_password);

    // basic validation Billing Details
    if (empty($reg_first_name)) {
        $error['reg_first_name'] = "First Name Should Not Be Empty";
    }

    if (empty($reg_last_name)) {
        $error['reg_last_name'] = "Last Name Should Not Be Empty";
    }

    if (empty($reg_username)) {
        $error['reg_username'] = "User Name Should not be empty";
    }

    if (empty($reg_email)) {
        $error['reg_email'] = "email Should Not Be Empty";
    }

    if (empty($reg_password)) {
        $error['reg_password'] = "Password not empty";
    }

    if (empty($reg_con_password)) {
        $error['reg_con_password'] = "Password not empty";
    }

    //password typo check
    if (!empty($reg_password and $reg_con_password)) {

        if ($reg_password != $reg_con_password) {
            $error['reg_con_password'] = "Password not match";
        }
    }

    // Advance validation
    if (!preg_match("/^[a-zA-Z ]*$/", $reg_first_name)) {
        $error['reg_first_name'] = "Only Letters allowed for First Name";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $reg_last_name)) {
        $error['reg_last_name'] = "Only Letters allowed for Last Name";
    }

    if (!empty($reg_email) && @$reg_previous_email != $reg_email) {

        if (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {

            $error['reg_email'] = "Email Address is not valid";
        } else {

            $sql_e = "SELECT * FROM users WHERE email = '$reg_email'";
            $result_e = $db->query($sql_e);
            if ($result_e->num_rows > 0) {
                $error['reg_email'] = "Email Already Exists";
            }
        }
    }

    if (!empty($reg_username)) {

        $sql = "SELECT * FROM users WHERE user_name = '$reg_username'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['reg_username'] = "<b> $reg_username </b> User Already Exists";
        }
    }

    if (!empty($reg_password)) {
        if (strlen($reg_password) < 8) {
            $error['reg_password'] = "Password Should be at least 8 characters";
        }
    }

    if (empty($error)) {

        $sql = "INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `first_name`, `last_name`, `profile_image`, `created_date`, `status`) VALUES (NULL, '$reg_username', '$reg_email', SHA1('$reg_password'), '$reg_first_name', '$reg_last_name', '', '$date', '1');";

        //run database query
        $db->query($sql);

        //capture last insert ID
        echo $user_id = $db->insert_id;
       echo $_SESSION['req_user_id'] = $user_id;
    }

     // redirect to dashboard
     if (empty($error)) {

        header('Location: profile_wizard.php');
    }
}

?>
<div class="container">
    <div class="row" style="margin-top: 80px; margin-bottom: 80px">
        <div class="col">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <h1>Login</h1>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="username">
                            </div>
                            <div style="color: red; margin-bottom: 5px">
                                <?php echo  @$error['username'] ?>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                            <div style="color: red; margin-bottom: 5px">
                                <?php echo  @$error['password'] ?>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <p class="mb-1">
                                        <a href="forgot-password.html">I forgot my password</a>
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-4" style="display: flex; flex-direction: row; justify-content: flex-end;">
                                    <button type="submit" name="action" value="login" class="btn btn-secondary btn-block">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <!-- /.social-auth-links -->



                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="col">
                    <div class="register-box">
                        <div class="card card-outline card-primary">
                            <div class="card-header text-center">
                                <h1>Register</h1>
                            </div>
                            <div class="card-body">
                                <p class="login-box-msg">Register a new membership</p>

                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="First Name" name="reg_first_name" value="<?php echo @$reg_first_name ?>">
                                    </div>
                                    <div>
                                        <p style="color: red;"> <?php echo @$error['reg_first_name'] ?> </p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Last Name" name="reg_last_name" value="<?php echo @$reg_last_name ?>">
                                    </div>
                                    <div>
                                        <p style="color: red;"> <?php echo @$error['reg_last_name'] ?> </p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Username" name="reg_username" value="<?php echo @$reg_username ?>">
                                    </div>
                                    <div>
                                        <p style="color: red;"> <?php echo @$error['reg_username'] ?> </p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="Email" name="reg_email" value="<?php echo @$reg_email ?>">
                                    </div>
                                    <div>
                                        <p style="color: red;"> <?php echo @$error['reg_email'] ?> </p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Password" name="reg_password">
                                    </div>
                                    <div>
                                        <p style="color: red;"> <?php echo @$error['reg_password'] ?> </p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Retype password" name="reg_con_password">
                                    </div>
                                    <div>
                                        <p style="color: red;"> <?php echo @$error['reg_con_password'] ?> </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">

                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4" style="display: flex; flex-direction: row; justify-content: flex-end;">
                                            <button type="submit" class="btn btn-secondary btn-block" name="action" value="register">Register</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.form-box -->
                        </div><!-- /.card -->
                    </div>
                </div>
    </div>

</div>

<?php

include "site_footer.php";

?>