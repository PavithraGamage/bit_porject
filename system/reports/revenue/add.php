<?php

include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);
extract($_GET);

// DB Connection
$db = db_con();

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Revenue Detail Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Detail Report</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Right Section Start -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title">All Sales Item List</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <!-- date rang row -->
                            <div class="row">
                                <div class="col-3">
                                    <label>Start Date: </label>
                                    <input type="date" name="start_date" value="<?php echo @$start_date ?>"><br>
                                </div>
                                <div class="col-3">
                                    <label>End Date: </label>
                                    <input type="date" name="end_date" value="<?php echo @$end_date ?>"><br>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" onclick="exportTableToExcel('item_list', 'item_list')">Export to Excel</button>
                                </div>
                            </div>
                            <hr>
                            <!-- dropdown row -->
                            <div class="row">

                                <div class="col-2">
                                    <label>Category</label>
                                    <select class="form-control select2" style="width: 100%;" name="category" onchange="filter_model()" id="category">
                                        <option value="">- Select Category -</option>
                                        <?php

                                        // categories drop down data fletch 
                                        $sql_cat = "SELECT * FROM `categories` WHERE status = 0";
                                        $cat_result = $db->query($sql_cat);

                                        // fletch data
                                        if ($cat_result->num_rows > 0) {
                                            while ($cat_row = $cat_result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $cat_row['category_id'] ?>" <?php if ($cat_row['category_id'] == @$category) { ?> selected <?php } ?>><?php echo $cat_row['category_name']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>Brand</label>
                                    <select class="form-control select2" style="width: 100%;" name="brand">
                                        <option value="">- Select Brand -</option>
                                        <?php

                                        // brand drop down data fletch 
                                        $sql_brand = "SELECT * FROM `brands` WHERE status = 0";
                                        $brand_result = $db->query($sql_brand);

                                        // fletch data
                                        if ($brand_result->num_rows > 0) {
                                            while ($brand_row = $brand_result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $brand_row['brand_id'] ?>" <?php if ($brand_row['brand_id'] == @$brand) { ?> selected <?php } ?>><?php echo $brand_row['brand_name']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>Model</label>
                                    <select class="form-control select2" style="width: 100%;" name="model" id="model">
                                        <option value="">- Select Model -</option>
                                        <?php

                                        // model drop down data fletch 
                                        $sql_model = "SELECT * FROM `models` WHERE status = 0";
                                        $model_result = $db->query($sql_model);

                                        // fletch data
                                        if ($model_result->num_rows > 0) {
                                            while ($model_row = $model_result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $model_row['model_id'] ?>" <?php if ($model_row['model_id'] == @$model) { ?> selected <?php } ?>><?php echo $model_row['model_name']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="col-4">
                                    <label>Search Table Data</label>
                                    <input type="text" class="form-control" id="sku" placeholder="Search Data" name="item_search" value="<?php echo @$item_search ?>">
                                </div>
                                <div class="col-1" style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;align-items: center;">
                                    <button type="submit" class="btn btn-primary" style="display: flex; margin-top: 30px; " name="action" value="search">Search</button>
                                </div>
                            </div>
                        </form><br>

                        <table id="item_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Item Qty</th>
                                    <th>Item Name</th>
                                    <th>Purchased Price LKR</th>
                                    <th>Net Price LKR</th>
                                    <th>Revenue LKR</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Stock Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $where = null;
                                $item_count = null;
                                $item_revenue = null;
                                $total_purchased_price = null;
                                $total_net_price = null;
                                $total_revenue = null;

                                // filters by search button
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search
                                    if (!empty($item_search)) {

                                        $where .= "CONCAT(i.item_name, c.category_name, b.brand_name, m.model_name) LIKE '%$item_search%' AND ";
                                    }


                                    // filter by category
                                    if (!empty($category)) {

                                        $where .= "c.category_id = $category AND ";
                                    }

                                    // filter by brand
                                    if (!empty($brand)) {

                                        $where .= "b.brand_id = $brand AND ";
                                    }

                                    // filter by model
                                    if (!empty($model)) {

                                        $where .= "m.model_id = $model AND ";
                                    }

                                    // filter by date range
                                    if (!empty($start_date) and !empty($end_date)) {

                                        $where .= "(i.date BETWEEN '$start_date' AND '$end_date') AND ";
                                    }

                                    // remove the last 4 digits of the $where part "AND "
                                    if (!empty($where)) {

                                        $where = substr($where, 0, -4);

                                        // take Mysql WHERE and take $where query parts 
                                        $where = "WHERE $where";
                                    }
                                }


                                // filters by today
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'today') {

                                    // get today date
                                    $date = date("Y-m-d");

                                    $where = "WHERE i.date = '$date'";
                                }



                                // sql query
                                $sql = "SELECT SUM(oi.grn_price) AS grn_price, SUM(oi.net_price) AS net_price, i.item_name, SUM(oi.item_qty) AS item_qty, c.category_name, b.brand_name, m.model_name, i.date FROM orders_items oi 
                              INNER JOIN items i ON i.item_id = oi.item_id 
                              INNER JOIN categories c ON c.category_id = i.category_id 
                              INNER JOIN brands b ON b.brand_id = i.brand_id 
                              INNER JOIN models m ON m.model_id = i.model_id
                              $where
                              GROUP BY i.item_name;";

                                // fletch data
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $item_revenue = $row['net_price'] - $row['grn_price'];

                                ?>
                                        <tr>

                                            <td><?php echo $row['item_qty'] ?> </td>
                                            <td><?php echo $row['item_name'] ?> </td>
                                            <td><?php echo number_format($row['grn_price'], 2);
                                                $total_purchased_price += $row['grn_price'];  ?> </td>
                                            <td><?php echo number_format($row['net_price'], 2);
                                                $total_net_price += $row['net_price'] ?> </td>
                                            <td><?php echo number_format($item_revenue, 2);
                                                $total_revenue += $item_revenue ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['brand_name'] ?> </td>
                                            <td><?php echo $row['model_name'] ?> </td>
                                            <td><?php echo $row['date'] ?> </td>
                                        </tr>

                                <?php

                                    }
                                }


                                ?>

                                <b>Total Purchased Price: LKR <?php echo number_format($total_purchased_price, 2) ?></b>
                                <b style="margin-left: 15px;">Total Net Price: LKR <?php echo number_format($total_net_price, 2) ?></b>
                                <b style="margin-left: 15px;">Total Revenue: LKR <?php echo number_format($total_revenue, 2) ?></b>
                            </tbody>
                        </table>
                        <h3 class="card-title">Total Result Count: <b> <?php echo $user_count = $result->num_rows ?></b></h3>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <label>Price</label>
        <select class="form-control select2" style="width: 100%;" name="price">
            <option value="">- Select Price -</option>


            <option value="less">Less Than LKR 70,000</option>
            <option value="grater">Grater Than LKR 70,000</option>

        </select>
        <button type="submit" class="btn btn-primary" style="display: flex; margin-top: 30px; " name="action" value="filter">Search</button>
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'filter') {

         

        $sql_filter = "SELECT (oi.net_price > 70000) AS grater_70 , i.item_name, oi.net_price
    FROM orders_items oi 
    INNER JOIN items i ON i.item_id = oi.item_id 
    INNER JOIN categories c ON c.category_id = i.category_id 
    INNER JOIN brands b ON b.brand_id = i.brand_id 
    INNER JOIN models m ON m.model_id = i.model_id GROUP BY i.item_name;";

        $filter_result = $db->query($sql_filter);

        // fletch data
        if ($filter_result->num_rows > 0) {
            while ($filter_row = $filter_result->fetch_assoc()) {
                if ($filter_row['grater_70'] == 0 and $price == 'less') {
                    //echo "70";

    ?>

                    <table>
                        <thead>
                            <tr>
                              
                                <td>Item Name</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td><?php echo $filter_row['item_name'] ?></td>
                                <td> | LKR: <?php echo $filter_row['net_price'] ?></td>
                            </tr>
                        </tbody>
                    </table>


                <?php
                }
                if ($filter_row['grater_70'] == 1 and $price == 'grater') {

                ?>

                    <table>
                        <thead>
                            <tr>
                               
                                <td>Item Name</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                                <td><?php echo $filter_row['item_name'] ?></td>
                                <td> | LKR: <?php echo $filter_row['net_price'] ?></td>
                            </tr>
                        </tbody>
                    </table>

    <?php
                }
            }
        }
    }
    ?>
</div>



<?php include '../../footer.php'; ?>

<script>
    // excel export
    function exportTableToExcel(tableID, filename = '') {

        var downloadLink;

        //ms office file type
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name (short if)
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        // for netscape navigator browsers
        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>

<script>
    // data table for responsive
    $(function() {
        $('#item_list').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>

<script>
    // show category related models 
    function filter_model() {

        var spec = $("#category").val();
        var dt = "category=" + spec + "&";

        $.ajax({
            type: 'POST',
            data: dt,
            url: '../../../ajax/filter_item_models.php',
            success: function(response) {
                $("#model").html(response)
            },
            error: function(request, status, error) {
                alert(error);
            }
        });

    }
</script>