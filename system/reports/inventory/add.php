<?php

include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);
extract($_GET);

// DB Connection
$db = db_con();

// update notification
if (!empty($notification_item_id)) {

    $sql = "UPDATE `items` SET `item_notification` = '2' WHERE `items`.`item_id` = $notification_item_id;";
    $db->query($sql);
}

// update notification
if (!empty($notification_item_id_low_stock)) {

    $sql = "UPDATE `items` SET `item_notification` = '0' WHERE `items`.`item_id` = $notification_item_id_low_stock;";
    $db->query($sql);
}

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Customer Report</a></li>
                        <li class="breadcrumb-item active">Customer</li>
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
                                <h3 class="card-title">All User List</h3>
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
                                <div class="col-2">
                                    <label>End Date: </label>
                                    <input type="date" name="end_date" value="<?php echo @$end_date ?>"><br>
                                </div>
                                <div class="col">
                                    <button name="action" class="btn btn-primary" value="today" type="submit">Today</button>

                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" onclick="exportTableToExcel('user_list', 'user_details')">Export to Excel</button>
                                </div>
                            </div>
                            <hr>
                            <!-- dropdown row -->
                            <div class="row">
                                <div class="col-2">
                                    <label>Item Status</label>
                                    <select class="form-control select2" style="width: 100%;" name="status">
                                        <option value="">- Select Status -</option>
                                        <?php

                                        // model drop down data fletch 
                                        $sql = "SELECT * FROM `status`";
                                        $result = $db->query($sql);

                                        // fletch data
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $row['status_id'] ?>" <?php if ($row['status_id'] == @$status) { ?> selected <?php } ?>><?php echo $row['status_name']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>Category</label>
                                    <select class="form-control select2" style="width: 100%;" name="category" onchange="show_spec()" onselect="filter_model()" id="category">
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
                                    <label>Model <span style="color: red;">*</span></label>
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

                                <div class="col-3">
                                    <label>Search Table Data</label>
                                    <input type="text" class="form-control" id="sku" placeholder="Search Data" name="cus_search" value="<?php echo @$cus_search ?>">
                                </div>
                                <div class="col-1" style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;align-items: center;">
                                    <button type="submit" class="btn btn-primary" style="display: flex; margin-top: 30px; " name="action" value="search">Search</button>
                                </div>
                            </div>
                        </form><br>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Item Id</th>
                                    <th>Stock Date</th>
                                    <th>Item Name</th>
                                    <th>Stock</th>
                                    <th>Reorder Level</th>
                                    <th>SKU</th>
                                    <th>GRN Price LKR</th>
                                    <th>Total Purchased Cost LKR</th>
                                    <th>Mark Price LKR</th>
                                    <th>Discount Price LKR</th>
                                    <th>Discount Rate</th>
                                    <th>Warranty (Days)</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $where = null;
                                $item_count = null;
                                $stock = null;

                                // filters by search button
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search
                                    if (!empty($cus_search)) {

                                        $where .= "CONCAT(c.cus_id, u.user_id, c.contact_nmuber, c.address_l1, c.address_l2, c.city, c.postal_code,u.user_name, u.email, u.first_name, u.last_name, u.profile_image, u.created_date, st.status_name, p.name) LIKE '%$cus_search%' AND ";
                                    }

                                    // filter by status
                                    if ($status != null) {

                                        $where .= "s.status_id = $status AND ";
                                    }

                                    // filter by city
                                    if (!empty($city)) {

                                        $where .= "c.city LIKE '%$city%' AND ";
                                    }

                                    // filter by user role
                                    if (!empty($user_roles)) {

                                        $where .= "ur.user_role_id = $user_roles AND ";
                                    }

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

                                    $where = "WHERE u.created_date = '$date'";
                                }

                                // sql query
                                $sql = "SELECT i.item_id, i.item_name, i.sku, i.recorder_level, i.date, i.grn_price, i.unit_price, i.sale_price, i.discount_rate, i.date, i.stock, i.warranty_period, c.category_name, b.brand_name, m.model_name, s.status_name
                                FROM items i
                                INNER JOIN categories c ON c.category_id = i.category_id
                                INNER JOIN brands b ON b.brand_id = i.brand_id
                                INNER JOIN models m ON m.model_id = i.model_id
                                INNER JOIN status s ON s.status_id = i.status $where ORDER BY i.item_id ASC;";

                                // fletch data
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                ?>
                                        <tr>

                                            <td><?php echo $row['item_id'] ?> </td>
                                            <td><?php echo $row['date'] ?> </td>
                                            <td><?php echo $row['item_name'] ?> </td>
                                            <td><?php echo $row['stock']; $stock +=  $row['stock'] ?> </td>
                                            <td><?php echo $row['recorder_level'] ?> </td>
                                            <td><?php echo $row['sku'] ?> </td>
                                            <td><?php echo number_format($row['grn_price'], 2) ?> </td>
                                            <td><?php echo number_format($row['grn_price'] *  $row['stock'], 2) ?> </td>
                                            <td><?php echo number_format($row['unit_price'], 2) ?> </td>
                                            <td><?php echo number_format($row['sale_price'], 2) ?> </td>
                                            <td><?php echo $row['discount_rate'] ?>% </td>
                                            <td><?php echo $row['warranty_period'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['brand_name'] ?> </td>
                                            <td><?php echo $row['model_name'] ?> </td>
                                            <td><?php echo $row['status_name'] ?> </td>

                                        </tr>

                                <?php

                                    }
                                }


                                ?>

                                <b>Total Stock Count: <?php echo $stock ?></b>
                            </tbody>
                        </table>
                        <h3 class="card-title">Total Result Count: <b> <?php echo $user_count = $result->num_rows ?></b></h3>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
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
        $('#user_list').DataTable({
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