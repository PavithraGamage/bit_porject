<?php 
include "../system/functions.php";

extract($_POST);

// DB Connection
$db = db_con();

?>


                <div class="row shop_main_row">
                    <!-- items -->
                    <?php
                    $f_brands = null;
                    $f_models = null;

                    if(!empty($fitter_brand)){
                        // filer brand by array
                        $fitter_brand = implode(',', $fitter_brand);
                        $f_brands = "AND brand_id IN ($fitter_brand)";

                    }

                    if(!empty($filter_model)){
                        // filter brand by model
                        $filter_model = implode(',', $filter_model);
                        $f_models = "AND model_id IN ($filter_model)";

                    }
                    // sql query
                    $sql = "SELECT * 
                    FROM `items` 
                    WHERE category_id = $category AND stock_status = 0 $f_brands $f_models";
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
           