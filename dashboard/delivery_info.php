<?php
include "site_nav.php";

extract($_POST);

$db = db_con();

if (empty($order_id)) {
    header('Location: http://localhost/bit/dashboard/delivery.php');
}
?>

<!-- Dashboard Content Area Start -->
<div class="container" style="margin-top:100px; margin-bottom:100px">
<div class="col-10 dash_content">
    <?php

    $sql = "SELECT o.order_number, cs.courier_status, pm.name, oc.dispatch_date, oc.tracking_number, cp.tracking_url, cp.company_name, cp.email, cp.contact_number, cp.contact_number_opp, cp.address_line_1, cp.address_line_2
    FROM orders_company oc
    INNER JOIN orders o ON o.order_id = oc.order_id
    INNER JOIN courier_companies cp ON cp.company_id = oc.company_id
    INNER JOIN courier_status cs ON cs.id = o.courier_status
    INNER JOIN payment_methord pm ON pm.id = o.payment_id
    WHERE o.order_id = $order_id;";

    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <hr>
            <h5>Delivery Details</h5>
            <hr>
            <p>Order Number : <?php echo $row['order_number']; ?></p>
            <p>Delivery Status : <?php echo $row['courier_status']; ?></p>
            <p>Payment Method : <?php echo $row['name']; ?></p>
            <p>Dispatch Date at Warehouse : <?php echo $row['dispatch_date']; ?></p>
            <p>Tracking Number : <?php echo $row['tracking_number']; ?></p>
            <p>Track URL : <a href="<?php echo $row['tracking_url'] . $row['tracking_number'] ?>" target="_blank"><?php echo $row['tracking_url'] . $row['tracking_number']?></a>

            <hr>
            <h5>Courier Company Details</h5>
            <hr>
            <p>Company Name: <?php echo $row['company_name']; ?></p>
            <p>Company Email: <?php echo $row['email']; ?></p>
            <p>Company Phone: <?php echo $row['contact_number']; ?></p>
            <p>Company Phone (Optional): <?php echo $row['contact_number_opp']; ?></p>
            <p>Company Address: <?php echo $row['address_line_1'] . $row['address_line_2'] ; ?></p>
           

    <?php
           
        }
    }else{
        echo "<h3 style = 'color:red'>Please Wait..! Delivery details update when the order dispatched!</h3>";
    }
    ?>
</div> 
<a href="delivery.php" style="margin-left: 15px;">
            <button type="button" class="btn btn-success float-right"><i class="fas fa-truck"></i></i> Deliveries</button>
        </a>
</div>






<?php

include "site_footer.php";

?>