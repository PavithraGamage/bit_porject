<?php
session_start();

include '../system/functions.php';

extract($_POST);

$db = db_con();

?>


<div class="col" id="specs">
    <h5>Item Specifications</h5>
    <hr>
    <!-- second colum -->

    <?php
    if (!empty($item_id) and !empty($category)) {

        // Specification data fletch 
        $sql_specs = "SELECT * 
        FROM spec_items si
        INNER JOIN specifications s ON s.spec_id = si.spec_id
        WHERE s.status = 0 AND si.item_id = $item_id";

        $item_specs = $db->query($sql_specs);

        if ($item_specs->num_rows > 0) {
            while ($specs_row = $item_specs->fetch_assoc()) {


    ?>
                <div class="form-group">
                    <label><?php echo $specs_row['spec'] ?> <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="specs<?php echo $specs_row['spec_id']; ?>" placeholder="Enter <?php echo $specs_row['spec'] ?> " name="specs[<?php echo $specs_row['spec_id']; ?>]" value="<?php echo @$specs_row['value'] ?>">
                </div>
            <?php
            }
        }
    } elseif (!empty($category) and empty($item_id)) {
        // Specification data fletch 
        $sql_spec = "SELECT * FROM `specifications` WHERE status = 0 AND category_id = $category;";

        $item_spec = $db->query($sql_spec);
        if ($item_spec->num_rows > 0) {
            while ($spec_row = $item_spec->fetch_assoc()) {

            ?>

                <div class="form-group">
                    <label><?php echo $spec_row['spec'] ?> <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="specs<?php echo $spec_row['spec_id']; ?>" placeholder="Enter <?php echo $spec_row['spec'] ?> " name="specs[<?php echo $spec_row['spec_id']; ?>]">
                </div>

    <?php
            }
        }
    } else {
        echo "<p style = 'color:red'>Please select the category</p>";
    }
    ?>
</div>
</div>