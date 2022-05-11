<?php

session_start();

include 'system/functions.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// error message container
$error = array();

// mange item id
if (!empty($item_id)) {

    $_SESSION['item_id'] = $item_id;
} else {

    $item_id = $_SESSION['item_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'add_to_cart') {

    $sql = "SELECT * FROM `items`  WHERE `item_id` = '$item_id'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $item_id = $row['item_id'];
        $item_name = $row['item_name'];
        $item_sku = $row['sku'];
        $grn_price = $row['grn_price'];
        $item_price = $row['unit_price'];
        $sale_price = $row['sale_price'];
        $item_qty = 1;
        $item_image = $row['item_image'];
        $discount_rate = $row['discount_rate'];
        $stock = $row['stock'];

        $cart = array($item_id => array("item_id" => $item_id, "item_name" => $item_name, "item_sku" => $item_sku, "item_price" => $item_price, "sales_price" => $sale_price, "item_qty" => $item_qty, "item_image" => $item_image, "item_discount" => $discount_rate, "grn_price" => $grn_price, "stock" => $stock));

        if (empty($_SESSION['cart'])) {

            $_SESSION['cart'] = $cart;
        } else {

            $array_key = array_keys($_SESSION['cart']);
            if (in_array($item_id, $array_key)) {

                $error['already'] = "This product already in the cart";
            } else {
                $_SESSION['cart'] += $cart;
            }
        }
    }
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

    <!-- content start-->
    <div class="container">
        <?php
        if (!empty($error)) {
        ?>
            <div class="row empty_cart" style="margin-top: 80px; background-color: #f8f9fa; border: 2px solid red; color: red">
                <div class="col">
                    <div> <?php echo @$error['already']; ?></div>
                </div>
                <div class="col empry_cart_btn_col">
                    <a href="cart.php">
                        <button type="button" class="btn btn-secondary card_button"><b>View Cart</b></button>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="row item_row_main">

            <div class="row">
                <!--product image-->
                <div class="col-6">
                    <?php
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
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
                    <h4 class="price_hedding">LKR <?php echo number_format($row['unit_price'], 2); ?></h4>
                    <h4 class="price_hedding">
                        <?php
                        if (!$row['sale_price'] == 0) {
                            echo "Sale LKR " . number_format($row['sale_price'], 2);
                        }
                        ?>
                    </h4>

                <?php
                    }
                ?>
                <div class="col cart_button">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $row['item_id'] ?>">
                        <button type="submit" name="action" value="add_to_cart" class="btn btn-secondary item_btn">Add to Cart <i class="fas fa-cart-arrow-down"></i></button>
                    </form>
                </div> <br>
                <a href="shop.php">
                    <button type="button" class="btn btn-secondary card_button" style="border-width: 2px;font-weight: 500"><i class="fas fa-cart-arrow-down"></i> Continue Shopping</button>
                </a>
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
    <?php 
   
   include "footer.php";
   
   ?>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>


</body>

</html>