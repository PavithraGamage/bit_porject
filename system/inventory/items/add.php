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

// categories drop down data fletch 
$sql_cat = "SELECT * FROM `categories`";
$cat_result = $db->query($sql_cat);

// manufactures drop down data fletch 
$sql_man = "SELECT * FROM `manufacturers`";
$man_result = $db->query($sql_man);

// brand drop down data fletch 
$sql_brand = "SELECT * FROM `brands`";
$brand_result = $db->query($sql_brand);

// model drop down data fletch 
$sql_model = "SELECT * FROM `models`";
$model_result = $db->query($sql_model);

// create error variable to store error message styles
$error_style =  array();
$error_style_icon = array();

//insert item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $category =  data_clean($category);
    $manufacture = data_clean($manufacture);
    $brand = data_clean($brand);
    $model = data_clean($model);
    $item_name = data_clean($item_name);
    $serial_number = data_clean($serial_number);
    $sku = data_clean($sku);
    $stock = data_clean($stock);
    $reorder_level = data_clean($reorder_level);
    $unit_price = data_clean($unit_price);
    $sale_price = data_clean($sale_price);

    // basic validation
    if (empty($category)) {
        $error['error_category'] = "Select a Category";
    }
    if (empty($manufacture)) {
        $error['error_manufacture'] = "Select a Manufacture";
    }
    if (empty($brand)) {
        $error['error_brand'] = "Select a Brand";
    }
    if (empty($model)) {
        $error['error_model'] = "Select a Model ";
    }
    if (empty($item_name)) {
        $error['error_item_name'] = "Item Name Should not be empty";
    }
    if (empty($serial_number)) {
        $error['error_serial_number'] = "Serial Number Should not be empty";
    }
    if (empty($sku)) {
        $error['error_sku'] = "SKU Should not be empty";
    }
    if (empty($stock)) {
        $error['error_stock'] = "Stock Should not be empty";
    }
    if (empty($reorder_level)) {
        $error['error_reorder_level'] = "Reorder Level Should not be empty";
    }
    if (empty($unit_price)) {
        $error['error_unit_price'] = "Unit Price Should not be empty";
    }
    if (empty($sale_price)) {
        $error['error_sale_price'] = "Sale Price Should not be empty";
    }

    // Advance validation
    if (!empty($item_name)) {

        $sql = "SELECT * FROM items WHERE item_name = '$item_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_category'] = "This <b> $item_name </b> Item Already Exists";
        }
    }

    if (!empty($serial_number)) {

        $sql = "SELECT * FROM items WHERE serial_number = '$serial_number'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_serial_number'] = "This <b> $serial_number </b> Serial Number Already Exists";
        }
    }

    if (!empty($sku)) {

        $sql = "SELECT * FROM items WHERE sku = '$sku'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_sku'] = "This <b> $sku </b> SKU Already Exists";
        }
    }

    //discount rate calculation
    if (!empty($sale_price) && !empty($unit_price)) {
        $discount = (($unit_price - $sale_price) * 100) / $unit_price;
    }

    //insert data to db
    if (empty($error)) {

        $sql = "INSERT INTO `items` (`item_id`, `item_image`, `item_name`, `sku`, `serial_number`, `recorder_level`, `quantity`, `unit_price`, `sale_price`, `discount_rate`, `date`, `stock`, `category_id`, `man_id`, `brand_id`, `model_id`) 
                VALUES (NULL, '', '$item_name', '$sku', '$serial_number', '$reorder_level', '0', '$unit_price', '$sale_price', '$discount', '2022-02-09', '$stock', '$category', '$manufacture', '$brand', '$model');";

        // run database query
        $query = $db->query($sql);

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
        $manufacture = $row['man_id'];
        $brand = $row['brand_id'];
        $model = $row['model_id'];
        $item_name = $row['item_name'];
        $serial_number = $row['serial_number'];
        $sku = $row['sku'];
        $stock = $row['stock'];
        $reorder_level = $row['recorder_level'];
        $unit_price = $row['unit_price'];
        $sale_price = $row['sale_price'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // Advance validation
    if (!empty($item_name)) {

        $sql = "SELECT * FROM items WHERE item_name = '$item_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_category'] = "This <b> $item_name </b> Item Already Exists";
        }
    }

    if (!empty($serial_number)) {

        $sql = "SELECT * FROM items WHERE serial_number = '$serial_number'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_serial_number'] = "This <b> $serial_number </b> Serial Number Already Exists";
        }
    }

    if (!empty($sku)) {

        $sql = "SELECT * FROM items WHERE sku = '$sku'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['error_sku'] = "This <b> $sku </b> SKU Already Exists";
        }
    }

    //discount rate calculation
    if (!empty($sale_price) && !empty($unit_price)) {
        $discount = (($unit_price - $sale_price) * 100) / $unit_price;
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE `items` 
            SET `item_name`= '$item_name', `sku` = '$sku', `serial_number` = '$serial_number', `recorder_level`= $reorder_level, `unit_price` = $unit_price, `sale_price` = $sale_price , `discount_rate` = $discount, `stock` = $stock,  `category_id` = $category, `man_id` = $manufacture, `brand_id` = $brand, `model_id` = $model 
            WHERE `item_id` = $item_id;";

        // run database query
        $query = $db->query($sql);

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
                    <h1 class="m-0">Items</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Items</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Alerts -->
    <div class="container-fluid">

        <!-- Insert / update / delete / blank / already exist alerts-->
        <?php show_error($error, $error_style, $error_style_icon); ?>

        <!-- Delete confirmation -->
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Item Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select class="form-control select2" style="width: 100%;" name="category">
                                    <option value="">- Select Category -</option>
                                    <?php

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
                                <label for="exampleInputEmail1">Manufacture</label>
                                <select class="form-control select2" style="width: 100%;" name="manufacture">
                                    <option value="">- Select Manufacture -</option>
                                    <?php

                                    // fletch data
                                    if ($man_result->num_rows > 0) {
                                        while ($man_row = $man_result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $man_row['man_id'] ?>" <?php if ($man_row['man_id'] == @$manufacture) { ?> selected <?php } ?>><?php echo $man_row['man_name']; ?></option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand</label>
                                <select class="form-control select2" style="width: 100%;" name="brand">
                                    <option value="">- Select Brand -</option>
                                    <?php

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
                                <label for="exampleInputEmail1">Model</label>
                                <select class="form-control select2" style="width: 100%;" name="model">
                                    <option value="">- Select Model -</option>
                                    <?php

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
                                <label for="exampleInputEmail1">Item Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="item_name" value="<?php echo @$item_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Serial Number</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="serial_number" value="<?php echo @$serial_number ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">SKU</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="sku" value="<?php echo @$sku ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="stock" value="<?php echo @$stock ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reorder Level</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="reorder_level" value="<?php echo @$reorder_level ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Unit Price</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="unit_price" value="<?php echo @$unit_price ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sale Price</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="sale_price" value="<?php echo @$sale_price ?>">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="item_id" value="<?php echo @$item_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Insert Item Specifications</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Name</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">ASUS TUF GAMING GEFORCE RTX 3080TI 12GB</option>
                                    <option>AMD RYZEN THREADRIPPER 3990X</option>
                                    <option>INTEL CORE I9-12900K PROCESSOR</option>
                                    <option>INTEL CORE I9-12900KF PROCESSOR</option>
                                    <option>ASUS ROG MAXIMUS Z690 EXTREME GLACIAL</option>
                                    <option>ASUS ROG MAXIMUS Z690 EXTREME</option>
                                    <option>ASUS ROG STRIX TRX40-XE GAMING WIFI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 1</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 2</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 3</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 4</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 5</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>





                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Insert</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- item table -->
        <div class="row">
            <div class="col">
                <?php

                // db connect
                $db = db_con();

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
                                    <th>Item Name</th>
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
                                            <td><?php echo $row['item_name'] ?> </td>
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

<!-- Page specific script -->
<script>
    $(function() {
        // $("#user_list").DataTable({
        //     "responsive": true,
        //     "lengthChange": false,
        //     "autoWidth": false,
        //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#user_list_wrapper .col-md-6:eq(0)');
        $('#brand_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>