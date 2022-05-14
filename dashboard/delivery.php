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
                    <th scope="col" class="table_head">Delivery Company Name</th>
                    <th scope="col" class="table_head">Status</th>
                    <th scope="col" class="table_head">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $user_id =  $_SESSION['user_id'];


                $sql = "SELECT o.order_number, o.order_date, cp.company_name, oc.dispatch_date, cs.courier_status, o.order_id FROM orders_company oc INNER JOIN orders o ON o.order_id = oc.order_id INNER JOIN courier_companies cp ON cp.company_id = oc.company_id INNER JOIN courier_status cs ON cs.id = o.courier_status WHERE o.user_id = $user_id ORDER BY `o`.`order_date` DESC";

                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {


                ?>
                        <tr>

                            <td class="table_body"><?php echo $row['order_number']; ?></td>
                            <td class="table_body"><?php echo $row['order_date']; ?></td>
                            <td class="table_body"><?php echo $row['company_name']; ?></td>
                            <td class="table_body"><?php echo $row['courier_status']; ?></td>
                            <td>
                                <form action="delivery_info.php" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                    <a href="view.php">
                                        <button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i> View</button>
                                    </a>
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