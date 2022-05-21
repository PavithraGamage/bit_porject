<?php
session_start();

include '../system/functions.php';

extract($_POST);

$db = db_con();

print_r($_POST);

?>


<select class="form-control select2" style="width: 100%;" name="model" id="model">
    <option value="">- Select Model -</option>
    <?php

    // model drop down data fletch 
    $sql_model = "SELECT * FROM `models` WHERE status = 0 AND category_id = $category";
    $model_result = $db->query($sql_model);

    // fletch data
    if ($model_result->num_rows > 0) {
        while ($model_row = $model_result->fetch_assoc()) {
    ?>
            <option value="<?php echo $model_row['model_id'] ?>" <?php if ($model_row['model_id'] == @$model) { ?> selected <?php } ?>><?php echo $model_row['model_name']; ?></option>
    <?php

        }
    }
    ?>
</select>