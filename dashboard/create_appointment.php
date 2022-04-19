<?php

include "site_nav.php";
include "dashboard_nav.php";


$db = db_con();

extract($_POST);

// create error variable to store error messages
$error =  array();

$user_id =  $_SESSION['user_id'];

//insert item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    $status =  data_clean($status);
    $time = data_clean($time);

    // basic validation
    if (empty($status)) {
        $error['status'] = "Please select the status";
    }

    if (empty($time)) {
        $error['time'] = "Please select the time";
    }

    if (empty($date)) {
        $error['date'] = "Please select the date";
    }

    // advance validations

    if (!preg_match("/^[0-9]*$/", $status)) {
        $error['status'] = "Input data not valid";
    }

    if (empty($error)) {
        $sql = "INSERT INTO `appoiments` (`id`, `status_id`, `date`, `time_id`, `user_id`) VALUES (NULL, '$status', '$date', '$time', '$user_id');";
        $db->query($sql);

        $error['app'] = "Appointment Recoded";
    }
}

?>

<!-- Dashboard Content Area Start -->
<div class="col-10 dash_content">
    <?php
    if (!empty($error)) {
    ?>
        <div style="color: green;">
            <h5>
                <?php echo @$error['app']; ?><br><br>
            </h5>
        </div>
    <?php
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Appointment Status</label>
            <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" name="status">
                    <option value="">- Select -</option>
                    <?php

                    // query
                    $sql = "SELECT * FROM `app_status`";
                    $result = $db->query($sql);

                    // fletch data
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == @$status) { ?> selected <?php } ?>><?php echo $row['status']; ?></option>
                    <?php

                        }
                    }
                    ?>
                </select>
                <div style="color: red;">
                    <?php echo @$error['status'] ?>
                </div>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Appointment Date & Time</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-6">
                        <input type="date" class="form-control" id="inputEmail3" placeholder="date" min="<?php echo date("Y-m-d") ?>" name="date" value="<?php echo $date; ?>">
                        <div style="color: red;">
                            <?php echo @$error['date'] ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <select class="form-control select2" style="width: 100%;" name="time">
                            <option value="">- Select Time -</option>
                            <?php

                            // query
                            $sql = "SELECT * FROM `app_time`";
                            $result = $db->query($sql);

                            // fletch data
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == @$time) { ?> selected <?php } ?>><?php echo $row['time']; ?></option>
                            <?php

                                }
                            }
                            ?>
                        </select>
                        <div style="color: red;">
                            <?php echo @$error['time'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>


        <button type="submit" name="action" value="insert" class="btn btn-secondary float-right" style="margin-top: 10px;"><i class="fas fa-calendar-check"></i> Appointment</button>

    </form>

    <!-- Dashboard Content Area End -->
</div>
</div>


<!--dashboard end-->
</div>
</div>


<?php

include "site_footer.php";

?>