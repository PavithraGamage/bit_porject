<?php


session_start();

// redirect
if(empty($_SESSION['cart'])) {
    header('Location: http://localhost/bit/cart.php');
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
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/dashboard.php"> <i class="fas fa-user"></i> My Account</a>
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
        <div class="row item_row_main">
            <div class="row">
                <div class="col">
                    <h3> <i class="fas fa-map-marker-alt"></i> Invoice for your Order</h3>
                </div>
                <hr style="margin-top:10px">
            </div>
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12" style="margin-bottom: 15px;">
                        <h4>
                            <i class="fas fa-globe"></i> U-Star Digital
                            <small class="float-right" style="float: right;">Date: <?php echo date("d-m-Y") ?></small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info" style="padding-bottom: 20px;">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>U-Star Digital</strong><br>
                            Kaluthra Road<br>
                            Bandaragama, 12530<br>
                            Phone: (804) 123-5432<br>
                            Email: info@ustardigital.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong><?php echo $_SESSION['first_name'] ." " .$_SESSION['last_name'];  ?></strong><br>
                            <?php echo $_SESSION['address_l1']?><br>
                            <?php echo $_SESSION['address_l2']?><br>
                            Phone: <?php echo $_SESSION['contact_nmuber']?><br>
                            Email: <?php echo $_SESSION['email']?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #007612</b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <?php
                        if (!empty($_SESSION['cart'])) {
                        ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Warranty</th>
                                        <th>Discount</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grand_total = 0;
                                    foreach ($_SESSION['cart'] as $product) {
                                    ?>
                                        <tr>
                                            <td><?php echo $product['item_qty'] ?></td>
                                            <td><?php echo $product['item_name'] ?></td>
                                            <td>3 Years</td>
                                            <td><?php echo $product['item_discount'] ?>%</td>
                                            <td>
                                                <?php
                                                $amount = $product['item_price'] * $product['item_qty'];
                                                echo "LKR: " . number_format($amount, 2);
                                                $grand_total += $amount;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row" style="margin-top: 25px">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Payment Method: Cash On Delivery</p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                            plugg
                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <p class="lead">Amount Due 2/22/2014</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>LKR: <?php echo number_format($grand_total, 2); ?></td>
                                </tr>
                                <tr>
                                    <th>Discount:</th>
                                    <td>(-$10.34)</td>
                                </tr>
                                <tr>
                                    <th>Delivery:</th>
                                    <td>$5.80</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>$265.24</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <a href="dashboard.php">
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Dashboard</button>
                        </a>

                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
                    </div>
                </div>
            </div>

        </div>
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
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>


</body>

</html>
<!-- footer end -->