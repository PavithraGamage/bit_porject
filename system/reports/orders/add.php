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
                    <h1 class="m-0">Order Details Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Details Report</a></li>
                        <li class="breadcrumb-item active">Details</li>
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
                                <h3 class="card-title">All Orders List</h3>
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
                                    <button name="action" class="btn btn-primary" value="today" type="submit">Today</button>

                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" onclick="exportTableToExcel('item_list', 'item_list')">Export to Excel</button>
                                </div>
                            </div>
                            <hr>
                            <!-- dropdown row -->
                            <div class="row">

                                <div class="col-2">
                                    <label>Status</label>
                                    <select class="form-control select2" style="width: 100%;" name="status">
                                        <option value="">- Select Status -</option>
                                        <?php

                                        // categories drop down data fletch 
                                        $sql_status = "SELECT * FROM `courier_status` WHERE status = 0";
                                        $status_result = $db->query($sql_status);

                                        // fletch data
                                        if ($status_result->num_rows > 0) {
                                            while ($status_row = $status_result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $status_row['id'] ?>" <?php if ($status_row['id'] == @$status) { ?> selected <?php } ?>><?php echo $status_row['courier_status']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>Province</label>
                                    <select class="form-control select2" style="width: 100%;" name="province">
                                        <option value="">- Select Province -</option>
                                        <?php

                                        // brand drop down data fletch 
                                        $sql_pro = "SELECT * FROM `province` WHERE status = 0";
                                        $result_pro = $db->query($sql_pro);

                                        // fletch data
                                        if ($result_pro->num_rows > 0) {
                                            while ($pro_row = $result_pro->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $pro_row['id'] ?>" <?php if ($pro_row['id'] == @$province) { ?> selected <?php } ?>><?php echo $pro_row['name']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>Customer</label>
                                    <select class="form-control select2" style="width: 100%;" name="customer" id="customer">
                                        <option value="">- Select Model -</option>
                                        <?php

                                        // model drop down data fletch 
                                        $sql_cus = "SELECT user_id, user_name FROM users WHERE status = 0 AND user_role = 5 ORDER BY `users`.`user_name` ASC;";
                                        $cus_result = $db->query($sql_cus);

                                        // fletch data
                                        if ($cus_result->num_rows > 0) {
                                            while ($cus_row = $cus_result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $cus_row['user_id'] ?>" <?php if ($cus_row['user_id'] == @$customer) { ?> selected <?php } ?>><?php echo $cus_row['user_name']; ?></option>
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
                                    <th>Time</th>
                                    <th>Username</th>
                                    <th>Customer</th>
                                    <th>Total Sale LKR</th>
                                    <th>Province</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $where = null;
                                $group_by = null;
                                $item_count = null;
                                $total_sales = null;
                                $sub_total = null;

                                // default query
                                $group_by = "GROUP BY DAY(o.order_date);";

                                // filters by search button
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search
                                    if (!empty($item_search)) {

                                        $where .= "CONCAT(o.order_number, o.order_total, o.total_discount, o.order_date, o.order_time, u.user_name, u.first_name, u.last_name, p.name, cs.courier_status) LIKE '%$item_search%' AND ";
                                    }

                                    // filter by status
                                    if (!empty($status)) {

                                        $where .= "o.courier_status = '$status' AND ";
                                    }

                                    // filter by province
                                    if (!empty($province)) {

                                        $where .= "o.delivery_charge = '$province' AND ";
                                    }

                                    // filter by customers
                                    if (!empty($customer)) {

                                        $where .= "o.user_id = '$customer' AND ";
                                    }

                                    // filter by date range
                                    if (!empty($start_date) and !empty($end_date)) {

                                        $where = "(o.order_date BETWEEN '$start_date' AND '$end_date') AND ";
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
                                    echo  $date = date("Y-m-d");

                                    $where = "WHERE o.order_date = '$date'";
                                }

                                // sql query
                                $sql = "SELECT o.order_number, o.order_total, o.total_discount, o.order_date, o.order_time, u.user_name, u.first_name, u.last_name, p.name, cs.courier_status
                                FROM orders o
                                INNER JOIN users u ON u.user_id = o.user_id
                                INNER JOIN courier_status cs ON cs.id = o.courier_status
                                INNER JOIN delivery_details dd ON dd.id = o.order_id
                                INNER JOIN province p ON p.id = dd.province_id
                                $where";

                                // fletch data
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        $total_sales = $row['order_total'] - $row['total_discount']
                                ?>
                                        <tr>
                                            <td><?php echo $row['order_number'] ?> </td>
                                            <td><?php echo $row['order_date'] ?> </td>
                                            <td><?php echo $row['order_time'] ?> </td>
                                            <td><?php echo $row['user_name'] ?> </td>
                                            <td><?php echo $row['first_name'] . " " . $row['last_name'] ?> </td>
                                            <td><?php echo number_format($total_sales, 2);
                                                $sub_total += $total_sales  ?> </td>
                                            <td><?php echo $row['name'] ?> </td>
                                            <td><?php echo $row['courier_status'] ?> </td>
                                        </tr>

                                <?php

                                    }
                                }
                                ?>
                                <b>Sub Total of Sales: LKR <?php echo number_format($sub_total, 2) ?></b>

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