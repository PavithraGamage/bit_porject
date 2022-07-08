<?php
ob_start(); // multiple headers

include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert Courier Details';

// form button name change
$btn_name = "Insert";

// form button value change
$btn_value = "insert";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';


// create error variable to store error messages
$error =  array();

// create error variable to store error message styles
$error_style =  array();
$error_style_icon = array();

if (empty($order_id)) {
    header('Location: http://localhost/bit/system/orders/received/view.php');
}


// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $status =  data_clean($status);
    

    // basic validation
    if (empty($status)) {
        $error['status'] = "Status not be blank";
    }


    // update query
    if (empty($error)) {

        $sql = "UPDATE `orders` SET `courier_status` = '$status' WHERE `orders`.`order_id` = $order_id;";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "Successfully Updated";

       
    }
}


?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="row">
                            <div class="col-4">
                                <h4 class="m-0">Order Status</h4>
                            </div>
                            <div class="col-6">
                                <select class="form-control select2" style="width: 100%;" name="status">
                                    <option value="">- Select Status -</option>
                                    <?php

                                    // model drop down data fletch 
                                    $sql = "SELECT * FROM `courier_status` WHERE status = 0 AND user_role_id = 1";
                                    $result = $db->query($sql);

                                    // fletch data
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == @$status) { ?> selected <?php } ?>><?php echo $row['courier_status']; ?></option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-2">

                                <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                                <button type="submit" class="btn btn-primary" name="action" value="update">Change</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="http://localhost/bit/system/orders/received/view.php">Received Orders</a></li>
                        <li class="breadcrumb-item active">Order Status</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Alerts -->
    <div class="container-fluid">

        <!-- Insert / update / delete / blank / already exist alerts-->
        <?php show_error($error, $error_style, $error_style_icon); ?>

        <!-- Delete -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {

            $sql = "SELECT * FROM `orders_company` WHERE order_id = '$order_id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $order_id = $row['order_id'];


        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE ? </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $order_id ?>"><br>
                            <button type="submit" name="action" value="confirm_delete" class="btn btn-danger btn-s">Yes</button>
                            <button type="submit" name="action" value="cancel_delete" class="btn btn-primary btn-s">No</button>
                        </form>

                    </div>
                </div>

        <?php
            }
        }
        ?>

    </div>
    <div class="container">
        <div class="row item_row_main">
            <div class="row" id="invoice">

                <?php

                //individual order data fletch
                $sql = "SELECT o.order_date, u.first_name, u.last_name, c.address_l1, c.address_l2, c.contact_nmuber, u.email, o.order_number, c.city FROM orders o INNER JOIN users u ON o.user_id = u.user_id INNER JOIN customers c ON u.user_id = c.user_id WHERE o.order_id = $order_id;";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>


            </div>
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12" style="margin-bottom: 15px;">
                        <h4>
                            <i class="fas fa-globe"></i> U-Star Digital
                            <small class="float-right" style="float: right;">Date: <?php echo $row['order_date'] ?></small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info" style="padding-bottom: 20px;">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>U-Star Digital</strong><br>
                            Kaluthra Road<br>
                            Bandaragama, 12530<br>
                            Phone: (804) 123-5432<br>
                            Email: info@ustardigital.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong><?php echo $row['first_name'] . " " . $row['last_name']; ?></strong><br>
                            <?php echo $row['address_l1'] ?><br>
                            <?php echo $row['address_l2'] ?>
                            <?php echo $row['city'] ?><br>
                            Phone: <?php echo $row['contact_nmuber'] ?><br>
                            Email: <?php echo $row['email'] ?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice No: <?php echo $row['order_number'] ?></b><br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        <?php
                    }
                }
        ?>
        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Warranty (Days)</th>
                            <th>Discount</th>
                            <th>Sale Price (LKR)</th>
                            <th>Unit Price (LKR)</th>
                            <th>Subtotal (LKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT oi.item_qty, i.item_name, i.warranty_period, i.discount_rate, i.sale_price, i.unit_price FROM orders_items oi INNER JOIN orders o ON o.order_id = oi.order_id INNER JOIN users u ON o.user_id = u.user_id INNER JOIN province p ON o.delivery_charge = p.id INNER JOIN customers c ON u.user_id = c.user_id INNER JOIN items i ON oi.item_id = i.item_id WHERE o.order_id = $order_id;";

                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>

                                <tr>
                                    <td><?php echo $row['item_qty']; ?></td>
                                    <td><?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['warranty_period']; ?></td>
                                    <td><?php echo $row['discount_rate']; ?>%</td>
                                    <td><?php echo number_format($row['sale_price'], 2); ?></td>
                                    <td><?php echo number_format($row['unit_price'], 2); ?></td>

                                    <?php

                                    if ($row['sale_price'] == 0) {
                                        $total =  $row['unit_price'] * $row['item_qty'];
                                        echo "<td>" . number_format($total, 2)  . "</td>";
                                    } else {
                                        $sale_total = $row['sale_price'] * $row['item_qty'];
                                        echo "<td>" . number_format($sale_total, 2)  . "</td>";
                                    }
                                    ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row" style="margin-top: 25px">
            <!-- accepted payments column -->
            <div class="col-6">

                <?php

                $sql = "SELECT pm.name, pm.description, o.order_total, o.total_discount, p.price, o.grand_total FROM orders o INNER JOIN payment_methord pm ON o.payment_id = pm.id INNER JOIN province p ON o.delivery_charge = p.id WHERE o.order_id = $order_id;";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {


                ?>
                        <p class="lead">Payment Method: <?php echo $row['name'] ?></p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            <?php echo $row['description'] ?>
                        </p>
            </div>
            <!-- /.col -->
            <div class="col-6">


                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Item(s):</th>
                            <td>LKR: <?php echo number_format($row['order_total'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td>LKR: (-<?php echo number_format($row['total_discount'], 2); ?>)</td>
                        </tr>
                        <tr>
                            <th>Est Total:</th>
                            <td>LKR: <?php echo number_format($row['order_total'] - $row['total_discount'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Delivery:</th>
                            <td>LKR: <?php echo number_format($row['price'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>
                                <h5>Total:</h5>
                            </th>
                            <td><b>
                                    <h5>LKR: <?php echo number_format($row['grand_total'], 2); ?></h5>
                                </b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>

<?php
                    }
                }
?>
            </div>
        </div>
    </div>


</div>
<?php include '../../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {
       
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
<?php ob_end_flush(); ?>