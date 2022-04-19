<?php
include "site_nav.php";

extract($_POST);

print_r($_POST);

// db connection
$db = db_con();

// create error variable to store error messages
$error =  array();

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
        } else {

            $error['password'] = "invalided password";
        }
    }

    // redirect to dashboard
    if (empty($error)) {

        header('Location:dashboard.php');
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
                                    <button type="submit" name="action" value="login" class="btn btn-primary btn-block">Sign In</button>
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

                        <form action="../../index.html" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Last name">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Retype password">
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <label for="agreeTerms">
                                             <a href="#">Terms and Conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4" style="display: flex; flex-direction: row; justify-content: flex-end;">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
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