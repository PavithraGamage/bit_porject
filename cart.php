<?php

include "system/functions.php";

session_start();


extract($_POST);

$db = db_con();
// change the product item quantity
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_qty") {
    foreach ($_SESSION['cart'] as &$value) {
        if ($value['item_id'] == $item_id) {
            $value['item_qty'] = $qty;
            break;
        }
    }
}

// remove items form cart
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "delete_product") {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['item_id'] == $item_id) {
            unset($_SESSION['cart'][$key]);
        }
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
    <!-- main style -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- fontawesome icons-->
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
            <!--cart content start-->
            <div class="row">


                <?php
                if (!empty($_SESSION['cart'])) {
                ?>
                    <div class="row">
                        <div class="col">
                            <h3>Items in Your Cart</h3>
                        </div>
                        <div class="col cart_remove_all">
                            <a href="shop.php">
                                <button type="button" class="btn btn-secondary card_button" style="border-width: 2px;font-weight: 500"><i class="fas fa-cart-arrow-down"></i> Continue Shopping</button>
                            </a>
                        </div>
                    </div>
                    <!--cart item start-->
                    <?php
                    $grand_total = 0;
                    $grand_total_sale = 0;
                    $amount_sale = 0;
                    foreach ($_SESSION['cart'] as $product) {

                        $item_id = $product['item_id'];

                        $sql = "SELECT * FROM `items` WHERE item_id = $item_id;";

                        $result = $db->query($sql);

                        $row = $result->fetch_assoc();

                    ?>


                        <div class="row cart_items">
                            <div class="col-2">
                                <img src="assets/images/<?php echo $product['item_image']; ?>" alt="" class="cart_item_image" />
                            </div>
                            <div class="col-5" style="display: flex; flex-direction: column; justify-content: center;">
                                <div>
                                    <h6><?php echo $product['item_name']; ?></h6>
        
                                </div>

                            </div>
                            <div class="col-1" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                                <h6 style="margin-right: 10px;">Qty</h6>

                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <input type="hidden" name="item_id" value="<?php echo $product['item_id']; ?>">
                                    <input type="hidden" name="action" value="update_qty">
                                    <input type="number" min="1" max="<?php echo $row['stock'] ?>" value="<?php echo $product['item_qty'] ?>" onchange="this.form.submit();" name="qty" id="qty">
                                </form>
                            </div>
                            <div class="col-2" style="display: flex; flex-direction: column; justify-content: center;">
                                <div class="cart_price">
                                    <?php
                                    if (!$product['sales_price'] == 0) {


                                        $amount = $product['sales_price'] * $product['item_qty'];
                                        echo "<h6> Sale LKR: " . number_format($amount, 2) . "</h6>";
                                        $grand_total += $amount;

                                        // discount price calculation
                                        $amount_sale = ($product['item_price'] * $product['item_qty']) - $amount;
                                        $grand_total_sale += $amount_sale;
                                    } else {

                                        $amount = $product['item_price'] * $product['item_qty'];
                                        echo "<h6> LKR: " . number_format($amount, 2) . "</h6>";
                                        $grand_total += $amount;
                                    }



                                    ?>
                                </div>
                            </div>
                            <div class="col-2" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; align-items: center;">
                                <div class="col empry_cart_btn_col">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <input type="hidden" name="item_id" value="<?php echo $product['item_id']; ?>">
                                        <button type="submit" name="action" value="delete_product" class="btn btn-secondary card_button"> <i class="fa fa-trash" aria-hidden="true"></i> Remove Item</button>
                                    </form>
                                </div>
                            </div>
                        </div>



                    <?php
                    }
                    ?>
                    <!--cart item end-->
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 cart_total">
                            <h4 class="cart_summary">Cart Summary</h4>
                            <div class="row">
                                <div class="col-5">
                                    <div>
                                        <h6>Item(s):</h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6>Discount:</h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h4>Est. Total:</h4>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div>
                                        <h6>
                                            LKR: <?php echo number_format($grand_total, 2);
                                                    $_SESSION['grand_total'] = $grand_total; ?>
                                        </h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6>
                                            <?php
                                            echo "LKR: (-" . number_format($grand_total_sale, 2) . ")";
                                            $_SESSION['grand_total_sale'] = $grand_total_sale

                                            ?>
                                        </h6>
                                    </div>
                                    <hr>


                                    <div>
                                        <h4>LKR: <?php


                                                    $est_total = $grand_total - $grand_total_sale;

                                                    // session for est total

                                                    $_SESSION['est_total'] = $est_total;

                                                    echo number_format($est_total, 2);

                                                    ?></h4>
                                    </div>
                                    <a href="checkout.php">
                                        <button type="button" class="btn btn-secondary cart_checkout_button"> CHECKOUT ORDER </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else { ?>
                    <!--empty cart warnning start-->
                    <div class="row empty_cart">
                        <div class="col">
                            <div> Your Cart Empty !</div>
                        </div>
                        <div class="col empry_cart_btn_col">
                            <a href="shop.php">
                                <button type="button" class="btn btn-secondary card_button">Shop Now</button>
                            </a>
                        </div>
                    </div>
                    <!--empty cart warnning end-->
                <?php
                }
                ?>
            </div>
            <!--cart content end-->
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