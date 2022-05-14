<?php


session_start();

$order_id = $_SESSION['order_id'];

include "system/functions.php";

$db = db_con();
// redirect
if (empty($_SESSION['cart'])) {
    header('Location: http://localhost/bit/cart.php');
}

unset($_SESSION['cart']);


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
                <a class="navbar-brand" style="color: white;" href="http://localhost/bit/">
                    <i class="fas fa-globe"></i> U-Star Digital
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
        <div class="row item_row_main">
            <div class="row" id="invoice">

                <?php

                //individual order data fletch
                $sql = "SELECT o.order_date, u.first_name, u.last_name, c.address_l1, c.address_l2, c.contact_nmuber, u.email, o.order_number, c.city FROM orders o INNER JOIN users u ON o.user_id = u.user_id INNER JOIN customers c ON u.user_id = c.user_id WHERE o.order_id = $order_id;";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>

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
                            <small class="float-right" style="float: right;">Date: <?php echo $row['order_date'] ?></small>
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
                            <strong><?php echo $row['first_name'] . " " . $row['last_name']; ?></strong><br>
                            <?php echo $row['address_l1'] ?><br>
                            <?php echo $row['address_l2'] ?>
                            <?php echo $row['city'] ?><br>
                            Phone: <?php echo $row['contact_nmuber'] ?><br>
                            Email: <?php echo $row['email'] ?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice No: <?php echo $row['order_number'] ?></b><br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        <?php
                    }
                }
        ?>
        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Warranty (Days)</th>
                            <th>Discount</th>
                            <th>Sale Price (LKR)</th>
                            <th>Unit Price (LKR)</th>
                            <th>Subtotal (LKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT oi.item_qty, i.item_name, i.warranty_period, i.discount_rate, i.sale_price, i.unit_price FROM orders_items oi INNER JOIN orders o ON o.order_id = oi.order_id INNER JOIN users u ON o.user_id = u.user_id INNER JOIN province p ON o.delivery_charge = p.id INNER JOIN customers c ON u.user_id = c.user_id INNER JOIN items i ON oi.item_id = i.item_id WHERE o.order_id = $order_id;";

                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>

                                <tr>
                                    <td><?php echo $row['item_qty']; ?></td>
                                    <td><?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['warranty_period']; ?></td>
                                    <td><?php echo $row['discount_rate']; ?>%</td>
                                    <td><?php echo number_format($row['sale_price'], 2); ?></td>
                                    <td><?php echo number_format($row['unit_price'], 2); ?></td>

                                    <?php

                                    if ($row['sale_price'] == 0) {
                                        $total =  $row['unit_price'] * $row['item_qty'];
                                        echo "<td>" . number_format($total, 2)  . "</td>";
                                    } else {
                                        $sale_total = $row['sale_price'] * $row['item_qty'];
                                        echo "<td>" . number_format($sale_total, 2)  . "</td>";
                                    }
                                    ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row" style="margin-top: 25px">
            <!-- accepted payments column -->
            <div class="col-6">

                <?php

                $sql = "SELECT pm.name, pm.description, o.order_total, o.total_discount, p.price, o.grand_total FROM orders o INNER JOIN payment_methord pm ON o.payment_id = pm.id INNER JOIN province p ON o.delivery_charge = p.id WHERE o.order_id = $order_id;";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {


                ?>
                        <p class="lead">Payment Method: <?php echo $row['name'] ?></p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            <?php echo $row['description'] ?>
                        </p>
            </div>
            <!-- /.col -->
            <div class="col-6">


                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Item(s):</th>
                            <td>LKR: <?php echo number_format($row['order_total'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td>LKR: (-<?php echo number_format($row['total_discount'], 2); ?>)</td>
                        </tr>
                        <tr>
                            <th>Est Total:</th>
                            <td>LKR: <?php echo number_format($row['order_total'] - $row['total_discount'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Delivery:</th>
                            <td>LKR: <?php echo number_format($row['price'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <td><b>
                                    <h5><?php echo number_format($row['grand_total'], 2); ?></h5>
                                </b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>

<?php
                    }
                }
?>
<!-- /.row -->

<!-- this row will not appear when printing -->
<div class="row no-print">
    <div class="col-12">
        <a href="dashboard/dashboard.php">
            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Dashboard</button>
        </a>

        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default" onclick="window.print(invoice);"><i class="fas fa-print"></i> Print</a>
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
    <?php

    include "footer.php";

    ?>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>


</body>

</html>
<!-- footer end -->