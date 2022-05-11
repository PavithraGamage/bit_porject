<?php
include "site_nav.php";

extract($_POST);

$db = db_con();


if (empty($order_id)) {
    header('Location: http://localhost/bit/dashboard/orders.php');
}
?>
<!-- content start-->
<div class="container">
    <div class="row item_row_main">
        <div class="row">

            <?php

            $order_id;

            //individual order data fletch
            $sql = "SELECT o.order_date, u.first_name, u.last_name, c.address_l1, c.address_l2, c.contact_nmuber, u.email, o.order_number, c.city FROM orders o INNER JOIN users u ON o.user_id = u.user_id INNER JOIN customers c ON u.user_id = c.user_id WHERE o.order_id = $order_id;";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

            ?>
                    <div class="col">
                        <h3> <i class="fas fa-map-marker-alt"></i> Invoice for your Order</h3>
                    </div>
                    <hr style="margin-top:10px">
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
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?php echo $row['first_name'] . " " . $row['last_name']; ?></strong><br>
                        <?php echo $row['address_l1']?>
                        <?php echo $row['address_l2']?><br>
                        <?php echo $row['city'] ?><br>
                        Phone: <?php echo $row['contact_nmuber'] ?><br>
                        Email: <?php echo $row['email'] ?>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Invoice No: <?php echo $row['order_number'] ?></b><br>
                    <b>Account:</b> 968-34567
                </div>
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
                        <th style="width:50%">Subtotal:</th>
                        <td>LKR: <?php echo number_format($row['order_total'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Discount:</th>
                        <td>LKR: (-<?php echo number_format($row['total_discount'], 2); ?>)</td>
                    </tr>
                    <tr>
                        <th>Delivery:</th>
                        <td>LKR: <?php echo number_format($row['price'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>LKR: <?php echo number_format($row['grand_total'], 2); ?></td>
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
<!-- /.row -->

<!-- this row will not appear when printing -->
<div class="row no-print">
    <div class="col-12">
        <a href="orders.php">
            <button type="button" class="btn btn-success float-right"><i class="fas fa-shopping-cart"></i> Orders</button>
        </a>
    </div>
</div>
        </div>

    </div>
</div>
<!-- content end-->
<?php

include "site_footer.php";

?>