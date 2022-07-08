<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);
extract($_GET);

// DB Connection
$db = db_con();

// error array for error messages
$error = array();

// update notification
if (!empty($notification_order_id)) {

    $sql = "UPDATE `orders` SET `notifications` = '1' WHERE `orders`.`order_id` = $notification_order_id;";
    $db->query($sql);
}

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Received Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="http://localhost/bit/system/orders/received/view.php">Order Management</a></li>
                        <li class="breadcrumb-item active">Received Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Alerts -->
    <div class="container-fluid">
    </div>
    <div class="container-fluid">
        <div class="row">

            <!-- Right Section Start -->
            <div class="col">
                <!-- Table Data Fletch -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Received Orders</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="row">
                                <div class="col-3">
                                    <label>Start Date: </label>
                                    <input type="date" name="start_date" value="<?php echo @$start_date ?>">
                                </div>
                                <div class="col-3">
                                    <label>End Date: </label>
                                    <input type="date" name="end_date" value="<?php echo @$end_date ?>">
                                </div>
                                <div class="col-1">
                                    <button name="action" class="btn btn-primary" value="today" type="submit">Today</button>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Search Data" name="cus_search" value="<?php echo @$cus_search ?>">
                                </div>
                                <div class="col-1" style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;align-items: center;">
                                    <button type="submit" class="btn btn-primary" name="action" value="search">Search</button>
                                </div>
                            </div>
                        </form>
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Order Date</th>
                                    <th>Order Time</th>
                                    <th>Username</th>
                                    <th>Payment Method</th>
                                    <th>Order Total LKR</th>
                                    <th>Order Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // crate variable for store dynamic query
                                $where = null;

                                // date range check
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search 
                                    if (!empty($cus_search)) {

                                        $where .= "CONCAT(o.order_id, o.order_number, o.order_date, u.user_name, o.grand_total, pm.name, o.order_time, cs.courier_status) LIKE '%$cus_search%' AND ";
                                    }
                                    // dynamic query
                                    if (!empty($start_date) and !empty($end_date)) {

                                        $where .= "(o.order_date BETWEEN '$start_date' AND '$end_date') AND ";
                                    }

                                    // remove the last 4 digits of the $where part "AND "
                                    if (!empty($where)) {

                                        $where = substr($where, 0, -4);

                                        // take Mysql WHERE and take $where query parts 
                                        $where = "WHERE $where";
                                    }
                                }

                                // today orders check
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'today') {

                                    $date = date("Y-m-d");
                                    // dynamic query
                                    $where = "WHERE o.order_date = '$date'";
                                }

                                $sql = "SELECT o.order_id, o.order_number, o.order_date, u.user_name, o.grand_total, pm.name, o.order_time, cs.courier_status FROM orders o 
                               INNER JOIN users u ON u.user_id = o.user_id 
                               INNER JOIN customers c ON c.user_id = u.user_id 
                               INNER JOIN payment_methord pm ON pm.id = o.payment_id 
                               INNER JOIN courier_status cs ON cs.id = o.courier_status
                               $where  
                               ORDER BY `o`.`order_number`  DESC";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                ?>
                                        <tr>
                                            <td><?php echo  $row['order_number']; ?> </td>
                                            <td><?php echo  $row['order_date']; ?></td>
                                            <td><?php echo  $row['order_time']; ?></td>
                                            <td><?php echo  $row['user_name'] ?></td>
                                            <td><?php echo  $row['name']; ?> </td>
                                            <td><?php echo number_format($row['grand_total'], 2); ?></td>
                                            <td><?php echo  $row['courier_status']; ?> </td>

                                            <td>
                                                <form action="view_invoice.php" method="post">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                                    <button type="submit" name="action" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {

        $('#brand_list').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>