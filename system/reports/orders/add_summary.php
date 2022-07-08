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
                    <h1 class="m-0">Order Summary Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Summary Report</a></li>
                        <li class="breadcrumb-item active">Summary</li>
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
                                <div class="col-3">
                                    <select class="form-control select2" style="width: 100%;" name="filter" id="category">
                                        <option value="">- Select Filter -</option>
                                        <option value="DATE"> Date </option>
                                        <option value="WEEK"> Week </option>
                                        <option value="MONTH"> Month </option>
                                        <option value="YEAR"> Year </option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary" name="action" value="search">View</button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" onclick="exportTableToExcel('item_list', 'item_list')">Export to Excel</button>
                                </div>
                            </div>
                            <hr>
                        </form>
                        <table id="item_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Item Qty</th>
                                    <th>Date</th>
                                    <th>Total Sales LKR</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $where = null;
                                $group_by = null;
                                $item_count = null;
                                $item_revenue = null;
                                $total_purchased_price = null;
                                $total_net_price = null;
                                $total_revenue = null;

                                // default query
                                $group_by = "GROUP BY DAY(o.order_date);";

                                // filters by search button
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // filter by model
                                    if (!empty($filter)) {

                                        // check date
                                        if ($filter == 'DAY') {
                                            $group_by = "GROUP BY DAY(o.order_date);";
                                        }

                                        // check week
                                        if ($filter == 'WEEK') {
                                            $group_by = "GROUP BY WEEK(o.order_date);";
                                        }

                                        // check month
                                        if ($filter == 'MONTH') {
                                            $group_by = "GROUP BY MONTH(o.order_date);";
                                        }

                                        // check year
                                        if ($filter == 'YEAR') {
                                            $group_by = "GROUP BY YEAR(o.order_date);";
                                        }
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

                                // sql query
                              $sql = "SELECT SUM(oi.item_qty) AS item_qty, SUM(oi.net_price) AS net_price, o.order_date
                              FROM orders_items oi
                              INNER JOIN orders o ON o.order_id = oi.order_id
                                $where $group_by";

                                // fletch data
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                ?>
                                        <tr>

                                            <td><?php echo $row['item_qty'] ?> </td>
                                            <td><?php echo $row['order_date'] ?> </td>
                                            <td><?php echo number_format($row['net_price'], 2) ?> </td>


                                        </tr>

                                <?php

                                    }
                                }
                                ?>

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