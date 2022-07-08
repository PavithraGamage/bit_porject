<?php

include "site_nav.php";
include "dashboard_nav.php";

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// create error variable to store error messages
$error =  array();

?>


<!-- Dashbaord Content Area Start -->
<div class="col-10 dash_content">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">
                        <h5>1. Current Status</h5>
                    </label>
                    <div class="col-sm-4">
                        <select class="form-control select2" style="width: 100%;" name="troubleshoot">
                            <option value="">- Select Status -</option>
                            <?php

                            // categories drop down data fletch 
                            $sql = "SELECT * FROM `troubleshoots`";
                            $result = $db->query($sql);

                            // fletch data
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['troub_id'] ?>" <?php if ($row['troub_id'] == @$troubleshoot) { ?> selected <?php } ?>><?php echo $row['trub_name']; ?></option>
                            <?php

                                }
                            }
                            ?>
                        </select>
                        <button type="submit" style="margin-top: 15px;" name="action" value="submit" class="btn btn-primary btn-s">View</button>

                    </div>
                </div>
    </form>

    <?php

    // change status to active
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'submit') {
        
        if (empty($troubleshoot)) {
            $error['empty'] = "Please Select the Status";
            echo  '<b style="color:red ;">' . @$error['empty'] . '</b>';
        }

        if (!empty($troubleshoot)) {

            $sql = "SELECT * 
            FROM troubleshoots WHERE troub_id = $troubleshoot;";
            $result = $db->query($sql);

            // fletch data
            $row = $result->fetch_assoc();

            

    ?>
            <hr>
            <h5>2. Troubleshooting Possible Solution</h5>
            <hr>
            <p><?php echo $row['trub_description']; ?></p>

            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $row['trub_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


    <?php

        }
    }


    ?>


</div>
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