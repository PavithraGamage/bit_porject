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
                    <h1 class="m-0">Delivery Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Delivery Report</a></li>
                        <li class="breadcrumb-item active">Delivery</li>
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
                                <h3 class="card-title">All Delivery List</h3>
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
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary" name="action" value="today">Today</button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" onclick="exportTableToExcel('item_list', 'item_list')">Export to Excel</button>
                                </div>
                            </div>
                            <hr>
                            <!-- dropdown row -->
                            <div class="row">

                                <div class="col-2">
                                    <label>City</label>
                                    <select class="form-control select2" style="width: 100%;" name="city">
                                        <option value="">- Select City -</option>
                                        <?php

                                        // categories drop down data fletch 
                                        $sql_city = "SELECT city FROM `delivery_details` GROUP BY (city) ORDER BY `delivery_details`.`city` ASC;";
                                        $city_result = $db->query($sql_city);

                                        // fletch data
                                        if ($city_result->num_rows > 0) {
                                            while ($city_row = $city_result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $city_row['city'] ?>" <?php if ($city_row['city'] == @$city_row) { ?> selected <?php } ?>><?php echo $city_row['city']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>Company</label>
                                    <select class="form-control select2" style="width: 100%;" name="company">
                                        <option value="">- Select Company -</option>
                                        <?php

                                        // brand drop down data fletch 
                                        $sql_brand = "SELECT * FROM `courier_companies` WHERE status = 0";
                                        $brand_result = $db->query($sql_brand);

                                        // fletch data
                                        if ($brand_result->num_rows > 0) {
                                            while ($brand_row = $brand_result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $brand_row['company_id'] ?>" <?php if ($brand_row['company_id'] == @$brand) { ?> selected <?php } ?>><?php echo $brand_row['company_name']; ?></option>
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
                                    <th>Order Number</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>City</th>
                                    <th>Company Name</th>
                                    <th>Price LKR</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $where = null;
                                $item_count = null;
                                $price = null;

                                // filters by search button
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search
                                    if (!empty($item_search)) {

                                        $where .= "CONCAT(o.order_number, oc.dispatch_date, dd.frist_name, dd.last_name, dd.city, cc.company_name, p.price) LIKE '%$item_search%' AND ";
                                    }


                                    // filter by category
                                    if (!empty($city)) {

                                        $where .= "dd.city LIKE '%$city%' AND ";
                                    }

                                    // filter by brand
                                    if (!empty($company)) {

                                        $where .= "oc.company_id = $company AND ";
                                    }

                                    // filter by date range
                                    if (!empty($start_date) and !empty($end_date)) {

                                        $where .= "(oc.dispatch_date BETWEEN '$start_date' AND '$end_date') AND ";
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

                                    $where = "WHERE oc.dispatch_date = '$date'";
                                }

                                // sql query
                                $sql = "SELECT o.order_number, oc.dispatch_date, dd.frist_name, dd.last_name, dd.city, cc.company_name, p.price
                              FROM orders_company oc
                              INNER JOIN orders o ON o.order_id = oc.order_id
                              INNER JOIN courier_companies cc ON cc.company_id = oc.company_id
                              INNER JOIN delivery_details dd ON dd.order_id = o.order_id
                              INNER JOIN province p ON p.id = o.payment_id
                              $where;";

                                // fletch data
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                ?>
                                        <tr>

                                            <td><?php echo $row['order_number'] ?> </td>
                                            <td><?php echo $row['dispatch_date'] ?> </td>
                                            <td><?php echo $row['frist_name'] . " " . $row['last_name'] ?> </td>
                                            <td><?php echo $row['city'] ?> </td>
                                            <td><?php echo $row['company_name'] ?> </td>
                                            <td><?php echo number_format($row['price'], 2);
                                                $price += $row['price'] ?> </td>

                                        </tr>

                                <?php

                                    }
                                }


                                ?>

                                <b>Total Price: LKR <?php echo number_format($price, 2)  ?></b>
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