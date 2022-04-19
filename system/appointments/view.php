<?php
include '../header.php';
include '../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Create Appointment Status';

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

// insert brands
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $brand_name =  data_clean($brand_name);

    // basic validation
    if (empty($brand_name)) {
        $error['brand_name'] = "Brand Name Should Not Be Empty";
    }

    // Advance Validation
    if (!empty($brand_name)) {

        $sql = "SELECT * FROM `brands` WHERE brand_name = '$brand_name'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['brand_name'] = "Manufacturer <b> $brand_name </b> Already Exists";
        }
    }

    if (empty($error)) {

        $sql = "INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES (NULL, '$brand_name');";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$brand_name</b> Successfully Insert";
    }
}

// edit manufacturers
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Brand";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM `brands` WHERE brand_id = '$brand_id'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $brand_id = $row['brand_id'];
        $brand_name = $row['brand_name'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // basic validation
    if (empty($brand_name)) {
        $error['brand_name'] = "Brand Name Should Not Be Empty";
    }

    // Advance Validation
    if (!empty($brand_name)) {

        $sql = "SELECT * FROM `brands` WHERE brand_name = '$brand_name'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['brand_name'] = "Manufacturer <b> $brand_name </b> Already Exists";
        }
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE `brands` SET `brand_name` = '$brand_name' WHERE `brand_id` = '$brand_id';";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$brand_name</b> Successfully Updated";
    }
}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "DELETE FROM `brands` WHERE `brand_id` = '$brand_id'";
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
                    <h1 class="m-0">View Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">View Appointments</a></li>
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

            $sql = "SELECT * FROM `brands` WHERE brand_id = '$brand_id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $brand_id = $row['brand_id'];
                $brand_name = $row['brand_name'];

        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $brand_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="brand_id" value="<?php echo $brand_id ?>"><br>
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
            <div class="col-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $form_name ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Customer Username :</label>
                                <input type="text" class="form-control" id="item_name" placeholder="Item Name" name="item_name" value="<?php echo @$item_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Appointment Type</label>
                                <select class="form-control select2" style="width: 100%;" name="item">
                                    <option value="">- Select Item -</option>
                                    <?php

                                    // fletch data
                                    if ($item_result->num_rows > 0) {
                                        while ($item_row = $item_result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $item_row['item_id'] ?>" <?php if ($item_row['item_id'] == @$item) { ?> selected <?php } ?>><?php echo $item_row['item_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Appointment Date :</label>
                                <input type="text" class="form-control" id="item_name" placeholder="Item Name" name="item_name" value="<?php echo @$item_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Time :</label>
                                <input type="text" class="form-control" id="item_name" placeholder="Item Name" name="item_name" value="<?php echo @$item_name ?>">
                            </div>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="stock_id" value="<?php echo @$stock_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Section Start -->
            <div class="col">
                <!-- Table Data Fletch -->
                <?php

                // sql query
                $sql = "SELECT * FROM `brands`";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Available Brands</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>App ID</th>
                                    <th>Customers Name</th>

                                    <th>App Date</th>

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
                                            <td><?php echo $row['brand_name'] ?> </td>
                                            <td>
                                                APK Samaranayake
                                            </td>

                                            <td>
                                                2022/12/18
                                            </td>

                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="brand_id" value="<?php echo $row['brand_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-success btn-xs"><i class="fas fa-eye"></i></button>
                                                </form>
                                            </td>

                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="brand_id" value="<?php echo $row['brand_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="brand_id" value="<?php echo $row['brand_id'] ?>">
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

<?php include '../footer.php'; ?>

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