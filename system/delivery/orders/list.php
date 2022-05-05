<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

$error = array();

// insert brands
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

    if (empty($start_date)) {
        $error['start_date'] = "Select Start Date";
    }

    if (empty($end_date)) {
        $error['end_date'] = "Select End Date";
    }
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Delivery Charges</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Delivery Charges</a></li>
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
                <?php

                // sql query
                $sql = "SELECT * FROM `province` WHERE status = 0;";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Courier Status</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <label>Start Date: </label>
                                    <input type="date" name="start_date" value="<?php echo @$start_date ?>">
                                    <p style="color: red;"><?php echo @$error['start_date'] ?></p>

                                    <label>End Date: </label>
                                    <input type="date" name="end_date" value="<?php echo @$end_date ?>">
                                    <p style="color: red;"><?php echo @$error['end_date'] ?></p>
                                    <button name="action" value="search" type="submit">View</button>
                                </form>
                            </div>

                            <div class="col">
                                <?php
                                
                                // create null variable for dynamic query
                                $q_where_part = null;

                                if (!empty($start_date) and !empty($end_date)) {

                                    $q_where_part = "WHERE (order_date BETWEEN '$start_date' AND '$end_date')";
                                }

                                $sql = "SELECT SUM(p.price) 
                                FROM orders o 
                                INNER JOIN delivery_details dd ON dd.order_id = o.order_id 
                                INNER JOIN payment_methord pm ON pm.id = o.payment_id 
                                INNER JOIN province p ON p.id = o.delivery_charge 
                                INNER JOIN courier_status cs ON cs.id = o.courier_status $q_where_part;";


                                $result = $db->query($sql);


                                if ($row = $result->fetch_assoc()) {
                                    $price = $row['SUM(p.price)'];
                                ?>

                                    <p>Total Delivery Charges LKR: <b><?php echo number_format($price, 2); ?> </b></p>


                                <?php
                                }


                                ?>

                            </div>

                        </div>



                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>

                                <tr>
                                    <th>Order Number</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th>Payment Method</th>
                                    <th>Delivery Charges</th>
                                    <th>City</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q_select_part = "SELECT o.order_number, o.order_date, dd.frist_name, dd.last_name, pm.name, p.price, dd.city, o.order_id, cs.courier_status";
                                $q_from_part = "FROM orders o";
                                $q_join_part = "INNER JOIN delivery_details dd ON dd.order_id = o.order_id
                                INNER JOIN payment_methord pm ON pm.id = o.payment_id
                                INNER JOIN province p ON p.id = o.delivery_charge 
                                INNER JOIN courier_status cs ON cs.id = o.courier_status";
                                $order_by_part = "ORDER BY `o`.`order_date` DESC;";

                                $q_where_part = null;

                                if (!empty($start_date) and !empty($end_date)) {

                                    $q_where_part = "WHERE (order_date BETWEEN '$start_date' AND '$end_date')";
                                }

                                $sql = $q_select_part . " " . $q_from_part . " " . $q_join_part . " " . $q_where_part . " " . $order_by_part;

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {


                                ?>
                                        <tr>
                                            <td><?php echo  $row['order_number']; ?> </td>
                                            <td><?php echo  $row['order_date']; ?></td>
                                            <td><?php echo  $row['frist_name'] . " " . $row['last_name']; ?></td>
                                            <td><?php echo  $row['name']; ?> </td>
                                            <td><?php echo  $row['price']; ?></td>
                                            <td><?php echo  $row['city']; ?></td>
                                            <td><?php echo  $row['courier_status']; ?></td>




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
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>