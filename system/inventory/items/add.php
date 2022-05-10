<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Item';

// form button name change
$btn_name = "Insert";

// form button value change
$btn_value = "insert";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';

// create error variable to store error messages
$error =  array();

// create error variable to store error message styles
$error_style =  array();
$error_style_icon = array();

// date
$date = date('Y-m-d');

// photo 
$photo = null;

// spec array
$spec = array();

//insert item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {


    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $category =  data_clean($category);
    $brand = data_clean($brand);
    $model = data_clean($model);
    $item_name = data_clean($item_name);
    $sku = data_clean($sku);
    $reorder_level = data_clean($reorder_level);
    $unit_price = data_clean($unit_price);
    $sale_price = data_clean($sale_price);
    $stock = data_clean($stock);

    // specification data clean
    foreach ($specs as $key => $value) {
        $spec[$key] = data_clean($value);
    }

    // basic validation
    if (empty($_FILES['item_image']['name'])) {
        $error['error_tem_image'] = "Item Image Should not be empty";
    }

    if (empty($item_name)) {
        $error['error_item_name'] = "Item Name Should not be empty";
    }

    if (empty($category)) {
        $error['error_category'] = "Select a Category";
    }

    if (empty($brand)) {
        $error['error_brand'] = "Select a Brand";
    }

    if (empty($model)) {
        $error['error_model'] = "Select a Model ";
    }

    if (empty($sku)) {
        $error['error_sku'] = "SKU Should not be empty";
    }

    if (empty($stock)) {
        $error['error_reorder_level'] = "Stock Should not be empty";
    }

    if (empty($reorder_level)) {
        $error['error_reorder_level'] = "Reorder Level Should not be empty";
    }

    if (empty($grn_price)) {
        $error['error_reorder_level'] = "GRN price Should not be empty";
    }

    if (empty($unit_price)) {
        $error['error_unit_price'] = "Unit Price Should not be empty";
    }


    foreach ($specs as $key => $value) {

        if (empty($spec[$key])) {

            $error['spec_empty'] = "$value Spec Items not be blank";
        }
    }


    // Advance validation
    if (!empty($item_name)) {

        $sql = "SELECT * FROM items WHERE item_name = '$item_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_category'] = "This <b> $item_name </b> Item Already Exists";
        }
    }

    if (!empty($sku)) {

        $sql = "SELECT * FROM items WHERE sku = '$sku'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_sku'] = "This <b> $sku </b> SKU Already Exists";
        }
    }

    // image upload function
    if (!empty($_FILES['item_image']['name']) && empty($error)) {

        $photo =  image_upload("item_image", "../../../assets/images/");

        if (array_key_exists("photo", $photo)) {

            $photo = $photo['photo'];
        } else {

            $error['item_image'] = $photo['item_image'];
        }
    } else {
        $photo = @$previous_item_image;
    }



    //discount rate calculation function
    $discount = discount($unit_price, $sale_price);

    //insert data to db
    if (empty($error)) {

        $sql = "INSERT INTO `items` (`item_image`, `item_name`, `sku`, `recorder_level`, `unit_price`, `sale_price`, `discount_rate`, `item_description`, `date`, `stock`, `warranty_period`, `category_id`, `brand_id`, `model_id`) 
                VALUES ('$photo', '$item_name', '$sku', '$reorder_level', '$unit_price', '$sale_price', '$discount', '$additional_info', '$date', '$stock', '$warranty_period', '$category', '$brand', '$model');";

        //run database query
        $db->query($sql);

        //capture last insert ID
        $item_id = $db->insert_id;

        // inset the item specifications
        foreach ($specs as $key => $value) {

            $sql = "INSERT INTO spec_items (spec_id, item_id, value) VALUES ('$key' , '$item_id', '$value')";

            $db->query($sql);
        }

        // success message style
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$item_name</b> Successfully Insert";
    }
}


// edit items
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Items";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM `items` WHERE item_id = $item_id";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $item_id =  $row['item_id'];
        $category =  $row['category_id'];
        $brand = $row['brand_id'];
        $model = $row['model_id'];
        $sku = $row['sku'];
        $item_name = $row['item_name'];
        $reorder_level = $row['recorder_level'];
        $unit_price = $row['unit_price'];
        $sale_price = $row['sale_price'];
        $additional_info = $row['item_description'];
        $item_image = $row['item_image'];
        $stock = $row['stock'];
        $warranty_period = $row['warranty_period'];
        $grn_price = $row['grn_price'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {


    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // basic validation
    if (empty($item_name)) {
        $error['error_item_name'] = "Item Name Should not be empty";
    }

    if (empty($category)) {
        $error['error_category'] = "Select a Category";
    }

    if (empty($brand)) {
        $error['error_brand'] = "Select a Brand";
    }

    if (empty($model)) {
        $error['error_model'] = "Select a Model ";
    }

    if (empty($sku)) {
        $error['error_sku'] = "SKU Should not be empty";
    }

    if (empty($stock)) {
        $error['error_reorder_level'] = "Stock Should not be empty";
    }

    if (empty($reorder_level)) {
        $error['error_reorder_level'] = "Reorder Level Should not be empty";
    }

    if (empty($grn_price)) {
        $error['error_reorder_level'] = "GRN Price Should not be empty";
    }

    if (empty($unit_price)) {
        $error['error_unit_price'] = "Unit Price Should not be empty";
    }

    foreach ($specs as $key => $value) {

        if (empty($specs[$key])) {

            $error['spec_empty'] = "$value Spec Items not be blank";
        }
    }

    // Advance validation


    if (!empty($sku) && $previous_sku != $sku) {

        $sql = "SELECT * FROM items WHERE sku = '$sku'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_sku'] = "This <b> $sku </b> SKU Already Exists";
        }
    }

    if (!empty($_FILES['item_image']['name']) && empty($error)) {

        // image upload function
        $photo =  image_upload("item_image", "../../../assets/images/");

        if (array_key_exists("photo", $photo)) {

            $photo = $photo['photo'];
        } else {

            $error['item_image'] = $photo['item_image'];
        }
    } else {
        $photo = @$previous_item_image;
    }

    //discount rate calculation
    if (!empty($sale_price)) {

        $discount = discount($unit_price, $sale_price);
    } else {
        $discount = 0;
    }


    // update query
    if (empty($error)) {
        $sql = "UPDATE `items` 
                SET item_image = '$photo',  item_name = '$item_name', sku = '$sku', recorder_level = $reorder_level, unit_price = $unit_price, sale_price = $sale_price, discount_rate = $discount, item_description = $additional_info, date = $date, category_id = $category, brand_id = $brand, model_id = $model, stock = $stock, warranty_period = $warranty_period, grn_price = $grn_price 
                WHERE `item_id` = $item_id";

        // run database query
        $query = $db->query($sql);

        foreach ($specs as $key => $value) {

            $sql = "UPDATE spec_items SET value = '$value' WHERE spec_id = '$key' AND item_id = '$item_id';";

            $db->query($sql);
        }

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$item_name</b> Successfully Updated";
    }
}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "DELETE FROM `items` WHERE `item_id` = '$item_id'";
    $db->query($sql);

    $error['delete_msg'] = "Recode Delete";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Items</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Items</a></li>
                        <li class="breadcrumb-item active">Add Items</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Alerts -->
    <div class="container-fluid">

        <!-- Insert / update / delete / blank / already exist alerts-->
        <?php show_error($error, $error_style, $error_style_icon); ?>

        <!-- Delete Confirmation -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
            $sql = "SELECT * FROM items WHERE item_id = '$item_id'";

            $result = $db->query($sql);


            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $item_id = $row['item_id'];
                $item_name = $row['item_name'];
        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $item_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="item_id" value="<?php echo $item_id ?>"><br>
                            <button type="submit" name="action" value="confirm_delete" class="btn btn-danger btn-s">Yes</button>
                            <button type="submit" name="action" value="cancel_delete" class="btn btn-primary btn-s">No</button>
                        </form>

                    </div>
                </div>

        <?php
            }
        }
        ?>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $form_name ?></h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="card card-primary card-outline card-tabs">

                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="row">
                                            <div class="col">
                                                <h5>Item Details</h5>
                                                <hr>
                                                <div class="form-group">
                                                    <label class="form-label" for="image">Item Image <span style="color: red;">*</span></label>
                                                    <input type="file" class="form-control" id="item_image" style="height: auto;" name="item_image" />
                                                    <input type="hidden" class="form-control" id="previous_item_image" name="previous_item_image" value="<?php echo @$item_image ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Item Name <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="item_name" placeholder="ASUS STRIX GAMING RADEON RX6700XT 12GB" name="item_name" value="<?php echo @$item_name ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Category <span style="color: red;">*</span></label>
                                                    <select class="form-control select2" style="width: 100%;" name="category" onchange="show_spec()" id="category">
                                                        <option value="">- Select Category -</option>
                                                        <?php

                                                        // categories drop down data fletch 
                                                        $sql_cat = "SELECT * FROM `categories` WHERE status = 0";
                                                        $cat_result = $db->query($sql_cat);

                                                        // fletch data
                                                        if ($cat_result->num_rows > 0) {
                                                            while ($cat_row = $cat_result->fetch_assoc()) {
                                                        ?>
                                                                <option value="<?php echo $cat_row['category_id'] ?>" <?php if ($cat_row['category_id'] == @$category) { ?> selected <?php } ?>><?php echo $cat_row['category_name']; ?></option>
                                                        <?php

                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Brand <span style="color: red;">*</span></label>
                                                    <select class="form-control select2" style="width: 100%;" name="brand">
                                                        <option value="">- Select Brand -</option>
                                                        <?php

                                                        // brand drop down data fletch 
                                                        $sql_brand = "SELECT * FROM `brands` WHERE status = 0";
                                                        $brand_result = $db->query($sql_brand);

                                                        // fletch data
                                                        if ($brand_result->num_rows > 0) {
                                                            while ($brand_row = $brand_result->fetch_assoc()) {
                                                        ?>
                                                                <option value="<?php echo $brand_row['brand_id'] ?>" <?php if ($brand_row['brand_id'] == @$brand) { ?> selected <?php } ?>><?php echo $brand_row['brand_name']; ?></option>
                                                        <?php

                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Model <span style="color: red;">*</span></label>
                                                    <select class="form-control select2" style="width: 100%;" name="model">
                                                        <option value="">- Select Model -</option>
                                                        <?php

                                                        // model drop down data fletch 
                                                        $sql_model = "SELECT * FROM `models` WHERE status = 0";
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
                                                </div>
                                                <div class="form-group">
                                                    <label>SKU <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="sku" placeholder="Unique Code" name="sku" value="<?php echo @$sku ?>">
                                                    <input type="hidden" class="form-control" id="previous_sku" placeholder="Unique Number 1288898KF" name="previous_sku" value="<?php echo @$sku ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Stock <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Stock Count" name="stock" value="<?php echo @$stock ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Reorder Level <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Reorder Level" name="reorder_level" value="<?php echo @$reorder_level ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>GRN Price <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="158500" name="grn_price" value="<?php echo @$grn_price ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Unit Price <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="165800" name="unit_price" value="<?php echo @$unit_price ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Sale Price</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="163000" name="sale_price" value="<?php echo @$sale_price ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Warranty Period in Days<span style="color: red;">*</span> </label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="365" name="warranty_period" value="<?php echo @$warranty_period ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Product Description</label>
                                                    <textarea class="form-control" rows="3" placeholder="Additional info of the product" name="additional_info"><?php echo @$additional_info ?></textarea>
                                                </div>

                                            </div>
                                            <div class="col" id="specs">
                                                <h5>Item Specifications</h5>
                                                <hr>
                                                <!-- second colum -->
                                                <p>Item specification load after selecting the category</p>

                                            </div>
                                        </div>




                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="item_id" id="item_id" value="<?php echo @$item_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col-12">
                <?php

                // sql query
                $sql = "SELECT * FROM `items`";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Available Items</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 125px !important;">Item Image</th>
                                    <th>Item Name</th>
                                    <th style="width: 85px !important;">View</th>
                                    <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><img src="../../../assets/images/<?php echo $row['item_image'] ?>" class="img-fluid" width="100"></td>
                                            <td><?php echo $row['item_name'] ?> </td>
                                            <td>
                                                <form action="view.php" method="post">
                                                    <input type="hidden" name="item_id" value="<?php echo $row['item_id'] ?>">
                                                    <a href="view.php">
                                                        <button type="submit" name="action" value="view" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button>
                                                    </a>
                                                </form>
                                            </td>

                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="item_id" value="<?php echo $row['item_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="item_id" value="<?php echo $row['item_id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>
<script src="system/plugins/jquery/jquery.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        $('#brand_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>

<script>
    function show_spec() {

        var spec = $("#category").val();
        var item = $("#item_id").val();
        var dt = "category=" + spec + "&";
        dt += "item_id=" + item + "&";

        //alert(item);

        $.ajax({
            type: 'POST',
            data: dt,
            url: '../../../ajax/spec.php',
            success: function(response) {
                $("#specs").html(response)
            },
            error: function(request, status, error) {
                alert(error);
            }
        });

    }
</script>