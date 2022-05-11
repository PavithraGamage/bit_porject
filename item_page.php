<?php
session_start();

include "system/functions.php";

// extract form data
extract($_POST);

// db connect
$db = db_con();

// empty check
if (empty($category_id)) {

    header('location:home.php');
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
    <!-- jquery -->
    <script src="system/plugins/jquery/jquery.min.js"></script>

    <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));  ?></title>

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

    <!-- content start -->
    <div class="container">
        <div class="row shop_row">
            <div class="col-2 wig_bar">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                    <div class="row wig">
                        <h6 class="wig_title">Brands</h6>
                        <div>
                            <hr class="wig_hr">
                        </div>
                        <?php

                        // sql query
                        $sql_brands = "SELECT b.brand_name, b.brand_id
                        FROM items i 
                        INNER JOIN brands b ON b.brand_id = i.brand_id 
                        WHERE i.category_id = $category_id AND b.status = 0
                        GROUP BY (b.brand_id);";

                        // fletch data
                        $result_brands = $db->query($sql_brands);

                        if ($result_brands->num_rows > 0) {
                            while ($row_brands = $result_brands->fetch_assoc()) {

                        ?>
                                <div class="wig_items">
                                    <input type="radio" class="form-check-input wig_input" id="brand_id_<?php echo $row_brands['brand_id']; ?>" onclick="filter_brands<?php echo $row_brands['brand_id']; ?>();" name="fitter_brand" value="<?php echo $row_brands['brand_id']; ?>">
                                    <label class="form-check-label wig_lable" for="brand_id_<?php echo $row_brands['brand_id']; ?>"><?php echo $row_brands['brand_name']; ?></label>
                                    <input type="hidden" name="category" id="category" value="<?php echo $category_id ?>">
                                </div>

                                <script>
                                    // ajax function for filer brands
                                    function filter_brands<?php echo $row_brands['brand_id']; ?>() {

                                        var brands = $("#brand_id_<?php echo $row_brands['brand_id']; ?>").val();
                                        var category = $("#category").val();
                                        var dt = "fitter_brand=" + brands + "&";
                                        dt += "category=" + category + "&";

                                        $.ajax({
                                            type: 'POST',
                                            data: dt,
                                            url: 'ajax/filter_brands.php',
                                            success: function(response) {
                                                $("#products").html(response)
                                            },
                                            error: function(request, status, error) {
                                                alert(error);
                                            }
                                        });
                                    }
                                </script>

                        <?php
                            }
                        }
                        ?>

                    </div>


                </form>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                    <div class="row wig">
                        <h6 class="wig_title">Models</h6>
                        <div>
                            <hr class="wig_hr">
                        </div>
                        <?php

                        // sql query
                        $sql_models = "SELECT m.model_name, m.model_id FROM items i INNER JOIN models m ON m.model_id = i.model_id WHERE i.category_id = 27 AND status = 0 GROUP BY (m.model_id);";

                        // fletch data
                        $result_models = $db->query($sql_models);

                        if ($result_models->num_rows > 0) {
                            while ($row_models = $result_models->fetch_assoc()) {

                        ?>
                                <div class="wig_items">
                                    <input type="radio" class="form-check-input wig_input" id="model_id_<?php echo $row_models['model_id']; ?>" onclick="filter_models<?php echo $row_models['model_id']; ?>();" name="filter_model" value="<?php echo $row_models['model_id']; ?>">
                                    <label class="form-check-label wig_lable" for="model_id<?php echo $row_models['model_id']; ?>"><?php echo $row_models['model_name']; ?></label>
                                    <input type="hidden" name="category" id="category" value="<?php echo $category_id ?>">
                                </div>

                                <script>
                                    // ajax function for filer models
                                    function filter_models<?php echo $row_models['model_id']; ?>() {

                                        var models = $("#model_id_<?php echo $row_models['model_id']; ?>").val();
                                        var category = $("#category").val();
                                        var dt = "filter_model=" + models + "&";
                                        dt += "category=" + category + "&";

                                        $.ajax({
                                            type: 'POST',
                                            data: dt,
                                            url: 'ajax/filter_brands.php',
                                            success: function(response) {
                                                $("#products").html(response)
                                            },
                                            error: function(request, status, error) {
                                                alert(error);
                                            }
                                        });
                                    }
                                </script>
                        <?php
                            }
                        }
                        ?>

                    </div>


                </form>




            </div>
            <div class="col-10" id="products">
                <div class="row shop_main_row">
                    <!-- items -->
                    <?php

                    // sql query
                    $sql = "SELECT * FROM `items` WHERE category_id = $category_id AND stock_status = 0;";
                    // fletch data
                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-4">
                                <div class="card card_styles" style="margin-top: 70px;">
                                    <img src="assets/images/<?php echo $row['item_image'] ?>" class="card-img-top" style="background-color: #E9EAEF; padding: 25px;" alt="...">
                                    <div class="card-body">
                                        <h1 class="catagory_card_title"><?php echo strtoupper($row['item_name'])  ?></h1>
                                        <p class="card_discription"><?php echo $row['item_description']  ?></p>
                                        <form action="single_item_page.php" method="post">
                                            <input type="hidden" name="item_id" value=" <?php echo $row['item_id'] ?>">
                                            <div class="row">
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-secondary card_button">View Item</button>
                                                </div>
                                                <div class="col-8">
                                                    <h6 style="text-align: right;"><?php echo "LKR " . number_format($row['unit_price'], 2); ?></h6>
                                                    <h6 style="text-align: right;">
                                                        <?php
                                                        if (!$row['sale_price'] == 0) {
                                                            echo "Sale LKR " . number_format($row['sale_price'], 2);
                                                        }
                                                        ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </form>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<h3 style = 'color:red'>Currently All Items are Out of Stock</h3>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- content end -->

    <!-- footer start -->
    <?php

    include "footer.php";

    ?>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- ajax function for filter brand in items -->



</body>

</html>