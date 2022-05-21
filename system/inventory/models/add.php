<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Models';

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

// insert models
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $model_name =  data_clean($model_name);

    // basic validation
    if (empty($model_name)) {
        $error['model_name'] = "Model Name Should not be empty";
    }

    // advance validation
    if (!empty($model_name)) {

        $sql = "SELECT * FROM `models` WHERE model_name = '$model_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['model_name'] = "Manufacturer <b> $model_name </b> Already Exists";
        }
    }

    if (empty($error)) {
        $sql = "INSERT INTO `models` (`model_id`, `model_name`, `category_id`) VALUES (NULL, '$model_name', '$category');";

        // run database query
        $query = $db->query($sql);

        // success message style
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$model_name</b> Successfully Insert";
    }
}

// edit models
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Models";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM models WHERE model_id = '$model_id'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $model_id = $row['model_id'];
        $model_name = $row['model_name'];
        $category = $row['category_id'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // basic validation
    if (empty($model_name)) {
        $error['model_name'] = "Model Name Should not be empty";
    }

   

    if (empty($error)) {
        $sql = "UPDATE `models` SET `model_name` = '$model_name', `category_id` = '$category' WHERE `model_id` = '$model_id';";

        // run database query
        $query = $db->query($sql);

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$model_name</b> Successfully Updated";
    }
}

// change status to inactive
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `models` SET `status` = '1' WHERE `models`.`model_id` = $model_id;";
    $db->query($sql);

    $error['delete_msg'] = "Recode Inactive";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}

// change status to active
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {

    $sql = "UPDATE `models` SET `status` = '0' WHERE `models`.`model_id` = $model_id;";
    $db->query($sql);

    $error['delete_msg'] = "Recode Active";

    // error styles
    $error_style['success'] = "alert-success";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Models</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Models</a></li>
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

        <!-- Delete -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
            $sql = "SELECT * FROM models WHERE model_id = '$model_id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $model_id = $row['model_id'];
                $model_name = $row['model_name'];
        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to Inactive <b> <?php echo $model_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="model_id" value="<?php echo $model_id ?>"><br>
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
                        <h3 class="card-title"><?php echo @$form_name ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category <span style="color: red;">*</span></label>
                                <select class="form-control select2" style="width: 100%;" name="category" id="category">
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
                                <label for="exampleInputEmail1">Model Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Model Name" name="model_name" value="<?php echo @$model_name ?>">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="model_id" value="<?php echo @$model_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo $btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col">
                <?php

                // sql query
                $sql = "SELECT * FROM models m INNER JOIN status s ON s.status_id = m.status;";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Available Models</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Model Name</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Inactive</th>
                                    <th>Active</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['model_name'] ?> </td>
                                            <td><?php echo $row['status_name'] ?> </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="model_id" value="<?php echo $row['model_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="model_id" value="<?php echo $row['model_id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-ban"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="model_id" value="<?php echo $row['model_id'] ?>">
                                                    <button type="submit" name="action" value="active" class="btn btn-block btn-warning btn-xs"><i class="fas fa-check"></i></button>
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
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>