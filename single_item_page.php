<?php

//session start
session_start();


include 'system/functions.php';


// extract variables
extract($_POST);

// DB Connection
$db = db_con();

if(!empty($item_id)){
    // Items data fletch 
$sql = "SELECT * FROM `items`  WHERE `item_id` = '$item_id'";
}else{

    header('location:index.php');
}

// Items data fletch 
$sql = "SELECT * FROM `items`  WHERE `item_id` = '$item_id'";
$result = $db->query($sql);

// Items specification data fletch 
$spec_sql = "SELECT si.value, s.spec FROM spec_items si INNER JOIN specifications s ON s.spec_id = si.spec_id WHERE si.item_id = $item_id";
$spec_result = $db->query($spec_sql);

//stock count
$stock_count = "SELECT COUNT(item_id) AS item_stock FROM stock WHERE item_id = $item_id GROUP BY item_id;";
$stock_count_result = $db->query($stock_count);
$row = $stock_count_result->fetch_assoc();
//$in_stock = $row['item_stock'];



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

    <!-- main style -->
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
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/cart.php"> <i class="fas fa-cart-arrow-down"></i> Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--Navigation End-->

    <!-- content start-->
    <div class="container">
        <div class="row item_row_main">
            <div class="row">
                <!--product image-->
                <div class="col-6">
                    <?php
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        // sessions
                        $_SESSION['item_image'] = $row['item_image'];
                        $_SESSION['item_name'] = $row['item_name'];
                        $_SESSION['price'] = $row['unit_price'];

                    ?>
                        <div class="image_box">
                            <img src="assets/images/<?php echo $row['item_image'] ?>" alt="" class="item_image" />
                        </div>

                </div>

                <!--second content box-->
                <div class="col-6">
                    <h2><?php echo $row['item_name']; ?></h2>
                    <hr>
                    <p>
                        <?php echo $row['item_description']  ?>
                    </p>
                    <h4 class="price_hedding">LKR <?php echo $row['unit_price']; ?></h4>

                <?php
                    }
                ?>
                <div class="col cart_button">
                    <form action="cart.php" method="post">
                        <button type="submit" class="btn btn-secondary item_btn">Add to Cart <i class="fas fa-cart-arrow-down"></i></button>
                    </form>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="item_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="item_table_col">Item Features</th>
                                <th scope="col">Details</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($spec_result->num_rows > 0) {
                                while ($spec_row = $spec_result->fetch_assoc()) {

                            ?>

                                    <tr>
                                        <th scope="row"><?php echo $spec_row['spec']; ?></th>
                                        <td><?php echo $spec_row['value']; ?></td>

                                    </tr>
                            <?php
                                }
                            }

                            ?>

                        </tbody>
                    </table>
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