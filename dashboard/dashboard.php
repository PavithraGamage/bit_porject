<?php

include "site_nav.php";
include "dashboard_nav.php";
$db = db_con();

$user_id =  $_SESSION['user_id'];
?>

<div class="col-10 dash_content">
    <!-- <h4> <i class="fas fa-tachometer-alt"></i> Dashboard</h4> -->
    <div class="row dash_info_box_row">
        <div class="col-3 dash_info_box">
            <div class="row">
                <div class="col-9">
                    <h6> <i class="fas fa-shopping-cart"></i> Orders</h6>
                </div>
                <div class="col-3">
                    <h6 class="dash_info_box_number">
                        <?php

                        $sql = "SELECT COUNT(*) FROM orders o WHERE o.user_id = $user_id;";

                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo $row['COUNT(*)'];
                            }
                        }

                        ?>
                    </h6>
                </div>
            </div>
        </div>
        <!-- <div class="col-3 dash_info_box">
            <div class="row">
                <div class="col-9">
                    <h6> <i class="fas fa-charging-station"></i> Warranty</h6>
                </div>
                <div class="col-3">
                    <h6 class="dash_info_box_number">25</h6>
                </div>
            </div>
        </div> -->
        <div class="col-3 dash_info_box">
            <div class="row">
                <div class="col-9">
                    <h6> <i class="fas fa-truck"></i> Delivery</h6>
                </div>
                <div class="col-3">
                  
                    <h6 class="dash_info_box_number">
                        <?php

                        $sql = "SELECT COUNT(*) FROM orders o WHERE o.user_id = $user_id AND o.courier_status = 8;";

                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo $row['COUNT(*)'];
                            }
                        }

                        ?>
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row dash_info_box_row">

        <!-- <div class="col-3 dash_info_box">
            <div class="row">
                <div class="col-9">
                    <h6> <i class="fas fa-calendar-check"></i> Appointments</h6>
                </div>
                <div class="col-3">
                    <h6 class="dash_info_box_number">12</h6>
                </div>
            </div>
        </div> -->
        <div class="col-3 dash_info_box">
            <div class="row">
                <div class="col-9">
                    <h6> <i class="fas fa-tools"></i> Troubleshoots</h6>
                </div>
                <div class="col-3">
                    <h6 class="dash_info_box_number">16</h6>
                </div>
            </div>
        </div>
    </div>


</div>
</div>


<!--dashboard end-->
</div>
</div>

<?php

include "site_footer.php";

?>