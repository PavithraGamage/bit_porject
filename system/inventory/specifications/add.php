<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Specification';

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

// categories drop down data fletch 
$sql_cat = "SELECT * FROM `categories`";
$cat_result = $db->query($sql_cat);

// date
$date = date('Y-m-d');

//insert specification
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $spc_name =  data_clean($spc_name);
    $category = data_clean($category);

    //basic validations
    if (empty($category)) {
        $error['category'] = "Category Should Not Be Empty";
    }

    if (empty($spc_name)) {
        $error['spc_name'] = "Specification Name Should Not Be Empty";
    }

    // Advance Validation
    if (!empty($spc_name)) {

        $sql = "SELECT * FROM `specifications` WHERE spec = '$spc_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['spc_name'] = "Specification <b> $spc_name </b> Already Exists";
        }
    }

    if (empty($error)) {
        $sql = "INSERT INTO `specifications` (`spec_id`, `spec`,`category_id`) VALUES (NULL, '$spc_name', '$category');";

        // run database query
        $query = $db->query($sql);

        // success message style
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$spc_name</b> Successfully Insert";
    }
}

// edit specifications
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Specification";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM specifications WHERE spec_id = '$spec_id'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $spec_id = $row['spec_id'];
        $spc_name = $row['spec'];
        $category = $row['category_id'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // basic validation
    if (empty($spc_name)) {
        $error['spc_name'] = "Specification Name Should Not Be Empty";
    }

    // Advance Validation
    if (!empty($spc_name) && $previous_spc_name != $spc_name) {

        $sql = "SELECT * FROM `specifications` WHERE spec = '$spc_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['spc_name'] = "Specification <b> $spc_name </b> Already Exists";
        }
    }

    if (empty($error)) {
        //fletch query
        $sql = "UPDATE `specifications` SET `spec` = '$spc_name', `category_id` = '$category' WHERE `spec_id` = '$spec_id';";

        // run database query
        $query = $db->query($sql);

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$spc_name</b> Successfully Updated";
    }
}

// inactive recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `specifications` SET `status` = '1' WHERE `specifications`.`spec_id` = $spec_id;";
    $db->query($sql);

    $error['delete_msg'] = "Recode Inactive";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}

// active recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {

    $sql = "UPDATE `specifications` SET `status` = '0' WHERE `specifications`.`spec_id` = $spec_id;";
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
                    <h1 class="m-0">Specifications</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Specifications</a></li>
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
            $sql = "SELECT * FROM specifications WHERE spec_id = '$spec_id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $spec_id = $row['spec_id'];
                $spc_name = $row['spec'];
        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to Inactive <b> <?php echo $spc_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="spec_id" value="<?php echo $spec_id ?>"><br>
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
            <div class="col-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $form_name ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category <span style="color: red;">*</span></label>
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
                                <label for="exampleInputEmail1">Specification Name</label>
                                <input type="text" class="form-control" id="spc_name" placeholder="Enter Brand Name" name="spc_name" value="<?php echo @$spc_name ?>">
                                <input type="hidden" class="form-control" id="previous_spc_name" placeholder="Enter Brand Name" name="previous_spc_name" value="<?php echo @$spc_name ?>">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="spec_id" value="<?php echo @$spec_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>


                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col-7">
                <?php

                // sql query
                $sql = "SELECT * 
                FROM specifications s
                INNER JOIN categories c ON c.category_id = s.category_id
                INNER JOIN status st ON st.status_id = s.status;";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Specifications </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                              
                                    <th>Specification Name</th>
                                    <th>Category</th>
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
                                            <td><?php echo $row['spec'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['status_name'] ?> </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="spec_id" value="<?php echo $row['spec_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="spec_id" value="<?php echo $row['spec_id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-ban"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                            <input type="hidden" name="spec_id" value="<?php echo $row['spec_id'] ?>">
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