<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Module';

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

//insert item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function

    $m_m_id = data_clean($m_m_id);
    $m_m_name =  data_clean($m_m_name);
    $m_m_folder_path = data_clean($m_m_folder_path);
    $m_m_icon = data_clean($m_m_icon);

    // basic validation
    if (empty($m_m_id)) {
        $error['m_m_id'] = "Module ID Should not be empty";
    }

    if (empty($m_m_name)) {
        $error['m_m_name'] = "Module Name Should not be empty";
    }

    if (empty($m_m_folder_path)) {
        $error['m_m_folder_path'] = "Folder Path Should not be empty";
    }

    // Advance validation

    if (!preg_match("/^[0-9]*$/", $m_m_id)) {
        $error['m_m_id'] = "Only Numbers allowed for Module ID";
    }

    if (!empty($m_m_id)) {
        if (strlen($m_m_id) > 2) {
            $error['m_m_id'] = "Maximum length should be 2 number";
        }
    }

    if (!empty($m_m_id)) {

        $sql = "SELECT * FROM modules WHERE module_id = '$m_m_id'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['m_m_id'] = "<b> $m_m_id </b>  Already Exists";
        }
    }

    if (!empty($m_m_name)) {

        $sql = "SELECT * FROM modules WHERE description = '$m_m_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['m_m_name'] = "<b> $m_m_name </b>  Already Exists";
        }
    }

    if (!empty($m_m_folder_path)) {

        $sql = "SELECT * FROM modules WHERE path = '$m_m_folder_path'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['m_m_folder_path'] = "<b> $m_m_folder_path </b>  Already Exists";
        }
    }


    //insert data to db
    if (empty($error)) {

        $sql = "INSERT INTO `modules` (`module_id`, `description`, `path`, `icon`, `status`) VALUES ('$m_m_id', '$m_m_name', '$m_m_folder_path', '$m_m_icon', '0');";

        //run database query
        $db->query($sql);

        // success message style
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['description'] = "<b>$m_m_name</b> Successfully Insert";
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
    $sql = "SELECT * FROM `modules` WHERE module_id = $module_id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $m_m_id = $row['module_id'];
        $m_m_name =  $row['description'];
        $m_m_folder_path = $row['path'];
        $m_m_icon = $row['icon'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function

    $m_m_id = data_clean($m_m_id);
    $m_m_name =  data_clean($m_m_name);
    $m_m_folder_path = data_clean($m_m_folder_path);
    $m_m_icon = data_clean($m_m_icon);

    // basic validation
    if (empty($m_m_id)) {
        $error['m_m_id'] = "Module ID Should not be empty";
    }

    if (empty($m_m_name)) {
        $error['m_m_name'] = "Module Name Should not be empty";
    }

    if (empty($m_m_folder_path)) {
        $error['m_m_folder_path'] = "Folder Path Should not be empty";
    }

    // Advance validation

    if (!preg_match("/^[0-9]*$/", $m_m_id)) {
        $error['m_m_id'] = "Only Numbers allowed for Module ID";
    }

    if (!empty($m_m_id)) {
        if (strlen($m_m_id) > 2) {
            $error['m_m_id'] = "Maximum length should be 2 number";
        }
    }

    if (!empty($m_m_id) && @$m_m_id_previous != $m_m_id) {

        $sql = "SELECT * FROM modules WHERE module_id = '$m_m_id'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['m_m_id'] = "<b> $m_m_id </b>  Already Exists";
        }
    }

    if (!empty($m_m_name)  && @$m_m_name_previous != $m_m_name) {

        $sql = "SELECT * FROM modules WHERE description = '$m_m_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['m_m_name'] = "<b> $m_m_name </b>  Already Exists";
        }
    }

    if (!empty($m_m_folder_path)  && @$m_m_folder_path_previous != $m_m_folder_path) {

        $sql = "SELECT * FROM modules WHERE path = '$m_m_folder_path'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['m_m_folder_path'] = "<b> $m_m_folder_path </b>  Already Exists";
        }
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE `modules` SET `module_id` = '$m_m_id', `description` = '$m_m_name', `path` = '$m_m_folder_path', `icon` = '$m_m_icon' WHERE `module_id` = '$m_m_id';";

        // run database query
        $query = $db->query($sql);

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$m_m_name</b> Successfully Updated";
    }
}

// change status to inactive
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `modules` SET `status` = '1' WHERE `modules`.`module_id` = '$module_id';";
    $db->query($sql);

    $error['delete_msg'] = "Recode Delete";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}

// change status to active
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {

    $sql = "UPDATE `modules` SET `status` = '0' WHERE `modules`.`module_id` = '$module_id';";
    $db->query($sql);

    $error['delete_msg'] = "Recode Delete";

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
                    <h1 class="m-0">Main Modules</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Module</a></li>
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

        <!-- Delete Confirmation -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
            $sql = "SELECT * FROM modules WHERE module_id = '$module_id'";

            $result = $db->query($sql);


            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $module_id = $row['module_id'];
                $module_name = $row['description'];
        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $module_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="module_id" value="<?php echo $module_id ?>"><br>
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Main Module ID</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="2 Digits" name="m_m_id" value="<?php echo @$m_m_id ?>">
                                <input type="hidden" class="form-control" id="exampleInputEmail1" placeholder="2 Digits Eg:- 01" name="m_m_id_previous" value="<?php echo @$m_m_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Main Module Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Staff Management" name="m_m_name" value="<?php echo @$m_m_name ?>">
                                <input type="hidden" class="form-control" id="exampleInputEmail1" placeholder="Staff Management" name="m_m_name_previous" value="<?php echo @$m_m_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Main Module Folder Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Main Module folder Path Eg :- users/customers" name="m_m_folder_path" value="<?php echo @$m_m_folder_path ?>">
                                <input type="hidden" class="form-control" id="exampleInputPassword1" placeholder="Main Module folder Path Eg :- users/customers" name="m_m_folder_path_previous" value="<?php echo @$m_m_folder_path ?>">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Main Module Icon</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Eg:- fa fa-id-card" name="m_m_icon" value="<?php echo @$m_m_icon ?>">
                                <a href="https://fontawesome.com/v4/icons/" target="_blank"> Browse Font Awesome icons</a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="module_id" value="<?php echo @$module_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col-8">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Main Module List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Search Data" name="cus_search" value="<?php echo @$cus_search ?>">
                                </div>
                                <div class="col-1" style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;align-items: center;">
                                    <button type="submit" class="btn btn-primary" name="action" value="search">Search</button>
                                </div>
                            </div>
                        </form>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Module ID</th>
                                    <th>Module Name</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Inactive</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // default query
                                $where = "WHERE length(module_id) = '2'";

                                // date range check
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search 
                                    if (!empty($cus_search)) {

                                        $where = "CONCAT(m.description, s.status_name) LIKE '%$cus_search%' AND length(module_id) = '2' AND ";
                                    }else{

                                        $where = "length(module_id) = '2' AND";
                                    }

                                    // remove the last 4 digits of the $where part "AND "
                                    if (!empty($where)) {

                                        $where = substr($where, 0, -4);

                                        // take Mysql WHERE and take $where query parts 
                                        $where = "WHERE $where";
                                    }
                                }

                                // sql query
                                $sql = "SELECT * FROM modules m INNER JOIN status s on s.status_id = m.status $where";

                                // fletch data
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>

                                            <td><?php echo $row['module_id'] ?> </td>
                                            <td> <?php echo $row['description'] ?></td>
                                            <td> <?php echo $row['status_name'] ?></td>

                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="module_id" value="<?php echo $row['module_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="module_id" value="<?php echo $row['module_id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-ban"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="module_id" value="<?php echo $row['module_id'] ?>">
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
        $('#user_list').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>