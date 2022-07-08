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
   <!-- nav -->
    <?php include "nav.php"; ?>
    <!-- content start -->
    <div class="container">
        <div class="row shop_row">
            <div class="col-2 wig_bar">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="form_filter">

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
                                    <input type="checkbox" class="form-check-input wig_input" id="brand_id_<?php echo $row_brands['brand_id']; ?>" onclick="product_filter();" name="fitter_brand[]" value="<?php echo $row_brands['brand_id']; ?>">
                                    <label class="form-check-label wig_lable" for="brand_id_<?php echo $row_brands['brand_id']; ?>"><?php echo $row_brands['brand_name']; ?></label>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>

                    <div class="row wig">
                        <h6 class="wig_title">Models</h6>
                        <div>
                            <hr class="wig_hr">
                        </div>
                        <?php

                        // sql query
                      $sql_models = "SELECT m.model_name, m.model_id FROM items i INNER JOIN models m ON m.model_id = i.model_id WHERE i.category_id = $category_id AND m.status = 0 GROUP BY (m.model_id);";

                        // fletch data
                        $result_models = $db->query($sql_models);

                        if ($result_models->num_rows > 0) {
                            while ($row_models = $result_models->fetch_assoc()) {

                        ?>
                                <div class="wig_items">
                                    <input type="checkbox" class="form-check-input wig_input" id="model_id_<?php echo $row_models['model_id']; ?>" onclick="product_filter();" name="filter_model[]" value="<?php echo $row_models['model_id']; ?>">
                                    <label class="form-check-label wig_lable" for="model_id<?php echo $row_models['model_id']; ?>"><?php echo $row_models['model_name']; ?></label>
                                </div>

                        <?php
                            }
                        }
                        ?>

                    </div>
                    <input type="hidden" name="category" id="category" value="<?php echo $category_id ?>">

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

                                                        // check sale 
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
    <script>
        // ajax function for filer brands
        function product_filter() {

            var dt = $("#form_filter").serialize();

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



</body>

</html>