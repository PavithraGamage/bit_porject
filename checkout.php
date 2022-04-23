<?php

session_start();

// default time zoon
date_default_timezone_set("Asia/Colombo");

$order_number = date("Y") . date("m") . date("d");


include "system/functions.php";

extract($_POST);

// DB Connection
$db = db_con();

// create error variable to store error messages
$error =  array();

// redirect
if (empty($_SESSION['cart'])) {
    header('Location: http://localhost/bit/cart.php');
}

// session cart extract
foreach ($_SESSION['cart'] as $product) {

    $item_id =  $product['item_id'];
    $item_qty = $product['item_qty'];
    //item quantity missing
}


foreach($_SESSION['cart'] as $key => $values){

    print_r($values);

}

echo $item_id. $item_qty; 

// date
$date = date('Y-m-d');

// provinces drop down data fletch 
$sql_pay = "SELECT * FROM `payment_methord`";
$pay_result = $db->query($sql_pay);

// login form

if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'login') {

    // call data clean function
    $user_name = data_clean($username);

    //check user name is empty
    if (empty($username)) {
        $error['username'] = "User Name Should not be empty";
    }

    // check password is empty
    if (empty($password)) {
        $error['password'] = "Password not empty";
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
            $_SESSION['email'] = $row['email'];
        } else {

            $error['password'] = "invalided password";
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
        }
    }
}

// insert billing details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // call data clean function
    $frist_name =  data_clean($frist_name);
    $last_name =  data_clean($last_name);
    $phone =  data_clean($phone);
    $email =  data_clean($email);
    $address_line_1 =  data_clean($address_line_1);
    $address_line_2 =  data_clean($address_line_2);
    $city =  data_clean($city);
    $province =  data_clean($province);
    $zip =  data_clean($zip);

    $d_frist_name = data_clean($d_frist_name);
    $d_last_name = data_clean($d_last_name);
    $d_phone =  data_clean($d_phone);
    $d_address_line_1 =  data_clean($d_address_line_1);
    $d_address_line_2 =  data_clean($d_address_line_2);
    $d_city =  data_clean($d_city);
    $d_province =  data_clean($d_province);
    $d_zip =  data_clean($d_zip);

    $payment_method = data_clean($payment_method);

    // basic validation Billing Details
    if (empty($frist_name)) {
        $error['frist_name'] = "First Name Should Not Be Empty";
    }

    if (empty($last_name)) {
        $error['last_name'] = "Last Name Should Not Be Empty";
    }
    if (empty($phone)) {
        $error['phone'] = "phone Should Not Be Empty";
    }
    if (empty($email)) {
        $error['email'] = "email Should Not Be Empty";
    }
    if (empty($address_line_1)) {
        $error['address_line_1'] = "Address line 1 Should Not Be Empty";
    }
    if (empty($address_line_2)) {
        $error['address_line_2'] = "Address line 2 Should Not Be Empty";
    }
    if (empty($city)) {
        $error['city'] = "city Should Not Be Empty";
    }
    if (empty($province)) {
        $error['province'] = "Province Should Not Be Empty";
    }
    if (empty($zip)) {
        $error['zip'] = "zip Should Not Be Empty";
    }

    // basic validation Delivery Details
    if (empty($d_frist_name)) {
        $error['d_frist_name'] = "First Name Should Not Be Empty";
    }

    if (empty($d_last_name)) {
        $error['d_last_name'] = "Last Name Should Not Be Empty";
    }
    if (empty($d_phone)) {
        $error['d_phone'] = "phone Should Not Be Empty";
    }
    if (empty($d_email)) {
        $error['d_email'] = "email Should Not Be Empty";
    }
    if (empty($d_address_line_1)) {
        $error['d_address_line_1'] = "Address line 1 Should Not Be Empty";
    }
    if (empty($d_address_line_2)) {
        $error['d_address_line_2'] = "Address line 2 Should Not Be Empty";
    }
    if (empty($d_city)) {
        $error['d_city'] = "city Should Not Be Empty";
    }
    if (empty($d_province)) {
        $error['d_province'] = "Province Should Not Be Empty";
    }
    if (empty($d_zip)) {
        $error['d_zip'] = "zip Should Not Be Empty";
    }

    // Advance Validations Billing Details

    if (!preg_match("/^[a-zA-Z ]*$/", $frist_name)) {
        $error['frist_name'] = "Only Letters allowed for First Name";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $error['last_name'] = "Only Letters allowed for Last Name";
    }

    if (!preg_match("/^[0-9]*$/", $phone)) {
        $error['phone'] = "Phone number not valid";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
        $error['city'] = "Only Letters allowed for city";
    }

    if (!preg_match("/^[0-9]*$/", $zip)) {
        $error['zip'] = "Postal Code not valid";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Postal Code not valid";
    }

    // Advance Validations Billing Details

    if (!preg_match("/^[a-zA-Z ]*$/", $d_frist_name)) {
        $error['frist_name'] = "Only Letters allowed for First Name";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $d_last_name)) {
        $error['last_name'] = "Only Letters allowed for Last Name";
    }

    if (!preg_match("/^[0-9]*$/", $d_phone)) {
        $error['phone'] = "Phone number not valid";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $d_city)) {
        $error['city'] = "Only Letters allowed for city";
    }

    if (!preg_match("/^[0-9]*$/", $d_zip)) {
        $error['zip'] = "Postal Code not valid";
    }

    if (!filter_var($d_email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Postal Code not valid";
    }

    if (empty($error)) {

        $discount = $_SESSION['grand_total_sale'];
        $user_id = $_SESSION['user_id'];
        $order_total = $_SESSION['grand_total'];
        $time = date("H:i:s");
        $grand_total =  $_SESSION['order_grand_total'];

        // insert order
        $sql_order = "INSERT INTO `orders` (`order_id`, `order_number`, `order_total`, `total_discount`, `delivery_charge`, `order_date`, `order_time`, `user_id`, `payment_id`, `grand_total`) VALUES (NULL, '$order_number', '$order_total', '$discount', '$d_province', '$date', '$time','$user_id', '$payment_method', '$grand_total');";
        // run database query
        $query = $db->query($sql_order);

        // capture last insert ID
        $order_id = $db->insert_id;

        // change order number
        $order_number = $order_number . sprintf('%04d', $order_id);
        // order number update
        $sql = "UPDATE orders SET order_number = '$order_number' WHERE order_id = '$order_id'";
        // run database query
        $query = $db->query($sql);

        // insert billing
        $sql_billing = "INSERT INTO `billing_details` (`id`, `first_name`, `last_name`, `phone`, `email`, `address_line_1`, `address_line_2`, `provinces`, `city`, `zip`, `order_id`) VALUES (NULL, '$frist_name', '$last_name', '$phone', '$email', '$address_line_1', '$address_line_2', '$province', '$city', '$zip', '$order_id');";
        // run database query
        $query = $db->query($sql_billing);

        // insert delivery 
        $sql_delivery = "INSERT INTO `delivery_details` (`id`, `frist_name`, `last_name`, `phone`, `email`, `address_line_1`, `address_line_2`, `city`, `province_id`, `zip`, `order_id`) VALUES (NULL, '$d_frist_name', '$d_last_name', '$d_phone', '$d_email', '$d_address_line_1', '$d_address_line_2', '$d_city', '$d_province', '$d_zip', '$order_id');";
        // run database query
        $query = $db->query($sql_delivery);



    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));  ?></title>

    <!--main style -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />


    <!--fontawesome icons-->
    <link href="assets/icons/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" type="text/css" />



</head>

<body>
    <!--Navigation Start-->
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light nav_sys">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/bit/">
                    <!--                        <img src="images/logo.png" alt="" class="nav_logo">-->
                    <img src="images/logo_new.png" alt="" class="nav_logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" aria-current="page" href="http://localhost/bit/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/services.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/dashboard/dashboard.php"> <i class="fas fa-user"></i> My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/cart.php">
                                <i class="fas fa-cart-arrow-down"></i> Cart
                                <?php

                                if (!empty($_SESSION['cart'])) {

                                    echo count(array_keys($_SESSION['cart']));
                                }

                                ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--Navigation End-->

    <!--Hero Section End-->
    <!-- content start-->
    <div class="container">
        <?php

        if (empty($_SESSION['user_id'])) {
        ?>
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
                                        <br>
                                        <p style="color: red;"> <?php echo @$error['username'] ?> </p>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        <br>
                                        <p style="color: red;"> <?php echo @$error['password'] ?> </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="icheck-primary">
                                                <p class="mb-1">
                                                    <a href="forgot-password.html">I forgot my password</a>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4" style="display: flex; flex-direction: row; justify-content: flex-end;">
                                            <button type="submit" class="btn btn-primary btn-block" name="action" value="login">Sign In</button>
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
                                        <input type="text" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Full name">
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
        <?php
        } else {

        ?>
            <div class="row item_row_main">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="checkout_form">
                    <div class="row">
                        <div class="col">
                            <h3> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Enter Your Billing Details</h3>
                            <hr>
                            <label for="inputCity">Frist Name</label>
                            <input type="text" class="form-control" id="frist_name" name="frist_name" value="<?php echo @$_SESSION['user_name'] ?>">
                            <?php echo @$error['frist_name'] ?><br>

                            <label for="inputState">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo @$_SESSION['last_name'] ?>">
                            <?php echo @$error['last_name'] ?><br>

                            <label for="inputState">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo @$_SESSION['contact_nmuber'] ?>">
                            <?php echo @$error['phone'] ?><br>

                            <label for="inputState">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo @$_SESSION['email'] ?>">
                            <?php echo @$error['email'] ?><br>

                            <label for="inputAddress">Address Line 1</label>
                            <input type="text" class="form-control" id="address_line_1" placeholder="Street Name" name="address_line_1" value="<?php echo @$_SESSION['address_l1'] ?>">
                            <?php echo @$error['address_line_1'] ?><br>

                            <label for="inputAddress2">Address Line 2</label>
                            <input type="text" class="form-control" id="address_line_2" placeholder="Apartment, Studio, or Floor" name="address_line_2" value="<?php echo @$_SESSION['address_l2'] ?>">
                            <?php echo @$error['address_line_2'] ?><br>

                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo @$_SESSION['city'] ?>">
                            <?php echo @$error['city'] ?><br>

                            <label for="inputState">Province</label>
                            <select class="form-control select2" style="width: 100%;" name="province" id="province">
                                <option value="">- Select Province -</option>
                                <?php

                                // provinces drop down data fletch 
                                $sql_pro = "SELECT * FROM `province`";
                                $pro_result = $db->query($sql_pro);

                                // fletch data
                                if ($pro_result->num_rows > 0) {
                                    while ($pro_row = $pro_result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $pro_row['id'] ?>" <?php if ($pro_row['id'] == @$province) { ?> selected <?php } ?>><?php echo $pro_row['name']; ?></option>
                                <?php

                                    }
                                }
                                ?>
                            </select>
                            <?php echo @$error['province'] ?><br>

                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" value="<?php echo @$_SESSION['postal_code'] ?>">
                            <?php echo @$error['zip'] ?><br>

                            <br>
                            <input type="checkbox" class="form-check-input" id="check_box" style="margin-right: 10px;" onchange="fill_delivery_details()">
                            <label class="form-check-label" for="exampleCheck1">Use same address as a delivery address</label>
                        </div>
                        <div class="col">
                            <h3> <i class="fa fa-map-marker" aria-hidden="true"></i> Enter Your Delivery Details</h3>
                            <hr>
                            <label for="inputCity">Frist Name</label>
                            <input type="text" class="form-control" id="d_frist_name" name="d_frist_name" value="<?php echo @$d_frist_name ?>">
                            <?php echo @$error['d_frist_name'] ?><br>

                            <label for="inputState">Last Name</label>
                            <input type="text" class="form-control" id="d_last_name" name="d_last_name" value="<?php echo @$d_last_name ?>">
                            <?php echo @$error['d_last_name'] ?><br>

                            <label for="inputState">Phone</label>
                            <input type="tel" class="form-control" id="d_phone" name="d_phone" value="<?php echo @$d_phone ?>">
                            <?php echo @$error['d_phone'] ?><br>

                            <label for="inputState">Email Address</label>
                            <input type="email" class="form-control" id="d_email" name="d_email" value="<?php echo @$d_email ?>">
                            <?php echo @$error['d_email'] ?><br>

                            <label for="inputAddress">Address Line 1</label>
                            <input type="text" class="form-control" id="d_address_line_1" placeholder="Street Name" name="d_address_line_1" value="<?php echo @$d_address_line_1 ?>">
                            <?php echo @$error['d_address_line_1'] ?><br>

                            <label for="inputAddress2">Address Line 2</label>
                            <input type="text" class="form-control" id="d_address_line_2" placeholder="Apartment, Studio, or Floor" name="d_address_line_2" value="<?php echo @$d_address_line_2 ?>">
                            <?php echo @$error['d_address_line_2'] ?><br>

                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="d_city" name="d_city" value="<?php echo @$d_city ?>">
                            <?php echo @$error['d_city'] ?><br>

                            <label for="inputState">Province</label>
                            <select class="form-control select2" style="width: 100%;" name="d_province" id="d_province" onchange="delivery_price()">
                                <option value="">- Select Province -</option>
                                <?php

                                // provinces drop down data fletch 
                                $sql_pro = "SELECT * FROM `province`";
                                $pro_result = $db->query($sql_pro);
                                // fletch data
                                if ($pro_result->num_rows > 0) {
                                    while ($pro_row = $pro_result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $pro_row['id'] ?>" <?php if ($pro_row['id'] == @$d_province) { ?> selected <?php } ?>><?php echo $pro_row['name']; ?></option>

                                <?php

                                    }
                                }
                                ?>
                            </select>
                            <?php echo @$error['province'] ?><br>

                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="d_zip" name="d_zip" value="<?php echo @$d_zip ?>">
                            <?php echo @$error['d_zip'] ?><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 cart_total">
                            <h4 class="cart_summary">Payment Method</h4>
                            <div class="r_button">

                                <?php

                                if ($pay_result->num_rows > 0) {
                                    while ($pay_row = $pay_result->fetch_assoc()) {
                                ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="<?php echo $pay_row['id']; ?>" value="<?php echo $pay_row['id']; ?>">
                                            <label class="form-check-label r_label" for="<?php echo $pay_row['id']; ?>">
                                                <?php echo $pay_row['name']; ?>
                                            </label>
                                        </div>
                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-6 cart_total" id="order_summary">
                            <h4 class="cart_summary">Order Summary</h4>
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <h6>Item(s):</h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6>Discount:</h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6>Delivery Charges:</h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h4>Total:</h4>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div>
                                        <h6> LKR: <?php echo  number_format($_SESSION['grand_total'], 2); ?></h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6>LKR: <?php echo  number_format($_SESSION['grand_total_sale']);  ?></h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6 id="delivery_price">LKR: 0</h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h4>LKR: <?php echo number_format($_SESSION['grand_total'] - $_SESSION['grand_total_sale'], 2); ?></h4>
                                    </div>
                                    <button type="submit" name="action" value="insert" class="btn btn-secondary cart_checkout_button"> PAY YOUR ORDER </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        <?php

            var_dump($_POST);
        }
        ?>





    </div>
    <!-- content end-->
    <!-- footer start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <!--<img src="images/cmaplus-logo-blue-big copy._w.png" alt="" class="footer_logo"/>-->
                    <img src="images/logo_new.png" alt="" class="footer_logo" />
                    <hr class="footer_hr">
                    <p class="footer_company">

                        We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                        We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                        We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                        We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                    </p>
                </div>
                <div class="col-2">
                    <h2 class="footer_title">Company</h2>
                    <hr class="footer_hr_2">
                    <p class="footer_items">About</p>
                    <p class="footer_items">Contact</p>
                    <p class="footer_items">Service</p>
                    <p class="footer_items">Company</p>
                </div>
                <div class="col-2">
                    <h2 class="footer_title">Quick Links</h2>
                    <hr class="footer_hr_2">
                    <p class="footer_items">FAQ</p>
                    <p class="footer_items">Privacy Policy</p>
                    <p class="footer_items">Return Policy</p>
                    <p class="footer_items">Company</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="system/plugins/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        // move values form billing details to delivery details
        function fill_delivery_details() {


            var copy = $('#check_box').is(":checked");

            if (copy === true) {
                $("#d_frist_name").val($("#frist_name").val());
                $("#d_last_name").val($("#last_name").val());
                $("#d_phone").val($("#phone").val());
                $("#d_email").val($("#email").val());
                $("#d_address_line_1").val($("#address_line_1").val());
                $("#d_address_line_2").val($("#address_line_2").val());
                $("#d_city").val($("#city").val());
                $("#d_province").val($("#province").val());
                $("#d_zip").val($("#zip").val());
                delivery_price();

            } else {
                $("#d_frist_name").val("");
                $("#d_last_name").val("");
                $("#d_phone").val("");
                $("#d_email").val("");
                $("#d_address_line_1").val("");
                $("#d_address_line_2").val("");
                $("#d_city").val("");
                $("#d_province").val("");
                $("#d_zip").val("");

            }
        }

        // change the delivery price
        function delivery_price() {

            var d_province = $("#d_province").val();
            var dt = "d_province=" + d_province + "&";

            $.ajax({
                type: 'POST',
                data: dt,
                url: 'ajax/province_price.php',
                success: function(response) {
                    $("#order_summary").html(response)
                },
                error: function(request, status, error) {
                    alert(error);
                }
            });
        }
    </script>


</body>

</html>
<!-- footer end -->