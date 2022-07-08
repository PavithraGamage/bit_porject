<?php
session_start();
include "system/functions.php";

// db connect
$db = db_con();

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

   <!-- nav -->
   <?php include "nav.php"; ?>

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

            // sql query
            $sql = "SELECT * FROM `categories` WHERE status = 0";

            // fletch data
            $result = $db->query($sql);

            // category name
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // count of items
                    $cat_id = $row['category_id'];
                    $count_sql = "SELECT COUNT(items.item_id) AS total FROM items WHERE items.category_id = '$cat_id' AND items.stock_status = 0;";
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