<?php

include "system/functions.php";


// extract form data
extract($_POST);

// db connect
$db = db_con();

// empty check
if (!empty($search)) {

    // sql query
    $sql = "SELECT * FROM `items` WHERE item_name LIKE'%$search%'";
} else {

    header('location:home.php');
}


// fletch data
$result = $db->query($sql);

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

    <!-- content start -->
    <div class="container">
        <div class="row shop_row" style="padding-bottom: 80px;">
            <h4><i class="fas fa-search"></i> Search Resault for: <?php echo $search ?></h4>
            <div class="col">
                <div class="row shop_main_row">
                    <!-- items -->
                    <?php

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-3">
                                <div class="card card_styles" style="margin-top: 70px;">
                                    <img src="assets/images/<?php echo $row['item_image'] ?>" class="card-img-top" style="background-color: #E9EAEF; padding: 25px;" alt="...">
                                    <div class="card-body">
                                        <h1 class="catagory_card_title"><?php echo strtoupper($row['item_name'])  ?></h1>
                                        <p class="card_discription"><?php echo $row['item_description']  ?></p>
                                        <form action="single_item_page.php" method="post">
                                            <input type="hidden" name="item_id" value=" <?php echo $row['item_id'] ?>">
                                            <div class="row">
                                                <div class="col"><button type="submit" class="btn btn-secondary card_button">View Item</button></div>
                                                <div class="col">
                                                    <h6 style="text-align: right;">LKR: <?php echo number_format($row['unit_price'] ,2) ?></h6>
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
                        echo "No Items Found";
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


</body>

</html>