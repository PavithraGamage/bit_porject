<?php

session_start();

include '../system/functions.php';

extract($_POST);

$db = db_con();
$sql = "SELECT * FROM `province` WHERE id = '$d_province'";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $price = $row['price'];
}
?>

<h4 class="cart_summary">Order Summary</h4>
<div class="row">
    <div class="col-4">
        <div>
            <h6>Item(s):</h6>
        </div>
        <hr>
        <div>
            <h6>Discount:</h6>
        </div>
        <hr>
        <div>
            <h6>Est Total:</h6>
        </div>
        <hr>
        <div>
            <h6>Delivery Charges:</h6>
        </div>
        <hr>
        <div>
            <h4>Total:</h4>
        </div>
    </div>
    <div class="col-8">
        <div>
            <h6>LKR: <?php echo  number_format($_SESSION['grand_total'], 2); ?> </h6>
        </div>
        <hr>
        <div>
            <h6>LKR: (-<?php echo number_format($_SESSION['grand_total_sale'], 2);  ?> )</h6>
        </div>
        <hr>
        <div>
        <h6>LKR: <?php echo number_format($_SESSION['grand_total'] - $_SESSION['grand_total_sale'], 2); ?></h6>
        </div>
        <hr>
        <div>

            <h6 id="delivery_price">LKR: <?php echo number_format($price, 2); ?></h6>
        </div>
        <hr>
        <div>
            <h4>LKR: <?php

                        $g_total = $_SESSION['grand_total'] - $_SESSION['grand_total_sale'] + $price;
                        echo number_format($g_total, 2);

                        $_SESSION['order_grand_total'] = $g_total;

                        ?></h4>
        </div>
        <button type="submit" name="action" value="insert" class="btn btn-secondary cart_checkout_button"> PAY YOUR ORDER </button>
    </div>
</div>