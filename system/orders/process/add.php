<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// error array for error messages
$error = array();

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
                        <li class="breadcrumb-item"><a href="#">Received Orders</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                                <div class="col-3">
                                    <button name="action" class="btn btn-primary" value="search" type="submit">Filter by Date</button>
                                    <button name="action" class="btn btn-primary" value="today" type="submit">Today</button>
                                </div>
                            </div>
                        </form>
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Order Date</th>
                                    <th>Order Time</th>
                                    <th>Customer First Name</th>
                                    <th>Customer Last Name</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // crate variable for store dynamic query
                                $where = null;

                                // date range check
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // date validations
                                    if (empty($start_date)) {

                                        $error['start_date'] = "Select Start Date";
                                        echo  "<div style = 'color:red;'>" . @$error['start_date'] . "</div>";
                                    }

                                    if (empty($end_date)) {

                                        $error['end_date'] = "Select End Date";
                                        echo  "<div style = 'color:red;'>" . @$error['end_date'] . "</div>";
                                    }

                                    // dynamic query
                                    if (!empty($start_date) and !empty($end_date)) {

                                        $where = "WHERE (o.order_date BETWEEN '$start_date' AND '$end_date')";
                                    }
                                }

                                // today orders check
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'today') {

                                    $date = date("Y-m-d");
                                    // dynamic query
                                    $where = "WHERE o.order_date = '$date'";
                                }

                                $sql = "SELECT o.order_id, o.order_number, o.order_date, o.order_time, u.first_name, u.last_name
                                FROM orders o 
                                INNER JOIN users u ON u.user_id = o.user_id 
                                INNER JOIN customers c ON c.user_id = u.user_id 
                                INNER JOIN payment_methord pm ON pm.id = o.payment_id  $where AND o.courier_status = 3";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                ?>
                                        <tr>
                                            <td><?php echo  $row['order_number']; ?> </td>
                                            <td><?php echo  $row['order_date']; ?></td>
                                            <td><?php echo  $row['order_time']; ?></td>
                                            <td><?php echo  $row['first_name'];?></td>
                                           
                                            <td><?php echo  $row['last_name']; ?> </td>

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
        // $("#user_list").DataTable({
        //     "responsive": true,
        //     "lengthChange": false,
        //     "autoWidth": false,
        //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#user_list_wrapper .col-md-6:eq(0)');
        $('#brand_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>