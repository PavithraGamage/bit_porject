<?php

include "site_nav.php";
include "dashboard_nav.php";

$db = db_con();
?>
<!-- Dashbaord Content Area Start -->
<div class="col-10 dash_content">
    <div class="page_tables">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table_head">#</th>
                    <th scope="col" class="table_head">Order Number</th>
                    <th scope="col" class="table_head">Order Date</th>
                    <th scope="col" class="table_head">Total LKR</th>
                    <th scope="col" class="table_head">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php


                $user_id =  $_SESSION['user_id'];

                $sql = "SELECT * FROM orders o WHERE o.user_id = $user_id;";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <tr>
                            <th scope="row" class="table_body"> <?php echo $row['order_id'] ?></th>
                            <td class="table_body"><?php echo $row['order_number'] ?></td>
                            <td class="table_body"><?php echo $row['order_date'] ?></td>
                            <td class="table_body"><?php echo number_format($row['grand_total'], 2)  ?></td>
                            <td>
                                <form action="invoice.php" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                    <a href="view.php">
                                        <button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i> View</button>
                                    </a>
                                </form>

                            </td>
                        </tr>
            </tbody>
    <?php

                    }
                }

    ?>
        </table>
    </div>
    <!-- Dashbaord Content Area End -->
</div>
</div>


<!--dashboard end-->
</div>
</div>

<?php

include "site_footer.php";

?>