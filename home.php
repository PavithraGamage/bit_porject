<?php
session_start();
include "system/functions.php";

// db connect
$db = db_con();

// sql query
$sql = "SELECT * FROM `categories`";

// fletch data
$result = $db->query($sql);

// categories drop down data fletch 
$cat_result = $db->query($sql);

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
    <! -- main style -->
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




    <!--card start-->
    <div class="container-fluid" style="width:90vw; margin-bottom:150px">
        <div class="row" style="padding: 40px;">
            <div class="col">

                <h2 class="text-center display-4" style="margin-bottom: 30px; font-weight:400">Search Item</h2>
                <form action="search_result.php" method="post">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">

                                <div class="col">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="search" aria-describedby="emailHelp" placeholder="Search by Item Name" name="search">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-secondary float-right"><i class="fas fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="row catagory_row">

            <?php
            // category name
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // count of items
                    $cat_id = $row['category_id'];
                    $count_sql = "SELECT COUNT(items.item_id) AS total FROM items WHERE items.category_id = '$cat_id';";
                    $count_result = $db->query($count_sql);
                    if ($count_result->num_rows > 0) {
                        while ($row_count = $count_result->fetch_assoc()) {
            ?>
                            <div class="col-3">
                                <div class="card card_styles" style="width: auto;">
                                    <img src="assets/images/<?php echo $row['cat_image'] ?>" class="card-img-top" alt="..." style="height: 250px; object-fit: cover;">
                                    <div class="card-body">
                                        <h1 class="card_title"><?php echo strtoupper($row['category_name']); ?> (<?php echo strtoupper($row_count['total']); ?>)</h1>
                                        <p class="card_discription"><?php echo $row['category_description'] ?></p>
                                        <form action="item_page.php" method="post">
                                            <input type="hidden" name="category_id" value="<?php echo $row['category_id'] ?>">
                                            <button type="submit" class="btn btn-secondary card_button">View Category</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
            <?php
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
    <!--card end-->

    <!-- footer start -->
    <?php

    include "footer.php";

    ?>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>


</body>

</html>