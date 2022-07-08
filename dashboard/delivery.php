<?php

include "site_nav.php";
include "dashboard_nav.php";

extract($_POST);

$db = db_con();
?>
<!-- Dashbaord Content Area Start -->
<div class="col-10 dash_content">
    <div class="page_tables">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table_head">Order Number</th>
                    <th scope="col" class="table_head">Order Date</th>
                    <th scope="col" class="table_head">Delivery Charges</th>
                    <th scope="col" class="table_head">Payment Method</th>
                    <th scope="col" class="table_head">Status</th>
                    <th scope="col" class="table_head">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                // create session for the user id
                $user_id =  $_SESSION['user_id'];

                // query for fletch data 
                $sql = "SELECT o.order_id, o.order_number, o.order_date, p.price, pm.name, cs.courier_status
                FROM orders o
                INNER JOIN province p ON p.id = o.delivery_charge
                INNER JOIN payment_methord pm ON pm.id = o.payment_id
                INNER JOIN courier_status cs ON cs.id = o.courier_status
                WHERE o.user_id = $user_id ORDER BY `o`.`order_number` DESC";

                // run query
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <tr>
                            <td class="table_body"><?php echo $row['order_number']; ?></td>
                            <td class="table_body"><?php echo $row['order_date']; ?></td>
                            <td class="table_body"><?php echo "LKR " . number_format($row['price'], 2); ?></td>
                            <td class="table_body"><?php echo $row['name']; ?></td>
                            <td class="table_body"><?php echo $row['courier_status']; ?></td>
                            <td>
                                <form action="delivery_info.php" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                    <button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"> <i class="fas fa-eye"></i> View</button>
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
    <!-- Dashboard Content Area End -->
</div>
</div>


<!--dashboard end-->
</div>
</div>

<?php

include "site_footer.php";

?>