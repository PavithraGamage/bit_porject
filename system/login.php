<?php

//session start
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>U-Star Digital System Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="dist/img/logo.jpeg" alt="U Star Logo" style="padding-bottom: 25px">
                <a href="index.php" class="h1"> Login</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>


                <?php

                // include function file
                include 'functions.php';

                // extract variables
                extract($_POST);

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'login') {

                    // call data clean function
                    $user_name = data_clean($user_name);

                    // create error variable to store error messages
                    $error =  array();

                    //check user name is empty
                    if (empty($user_name)) {
                        $error['user_name'] = "User Name Should not be empty";
                    }

                    // check password is empty
                    if (empty($password)) {
                        $error['password'] = "Password not Valid";
                    }

                    // advance validation
                    if (empty($error)) {

                        $sql = "SELECT * FROM users WHERE user_name = '$user_name' AND password = '" . sha1($password) . "'";

                        // call db con function
                        $db = db_con();

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

                        header('Location:index.php');
                    }
                }

                ?>


                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="User Name" name="user_name" id="user_name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger">
                        <!-- User Name Error Message -->
                        <?php echo @$error['user_name']; ?>
                    </div>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-danger">
                        <!-- Password Error Message -->
                        <?php echo @$error['password']; ?>
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" name="action" value="login">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>