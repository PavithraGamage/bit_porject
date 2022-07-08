<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Status';

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
    $courier_status =  data_clean($courier_status);


    // basic validation
    if (empty($courier_status)) {
        $error['courier_status'] = "Status Name Should Not Be Empty";
    }

    if (empty($role)) {
        $error['status'] = "Role Name Should Not Be Empty";
    }


    // Advance Validation
    if (!empty($courier_status)) {

        $sql = "SELECT * FROM `courier_status` WHERE courier_status = '$courier_status'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['courier_status'] = "Status Name <b> $courier_status </b> Already Exists";
        }
    }

    if (empty($error)) {

        $sql = "INSERT INTO `courier_status` (`id`, `courier_status`, `user_role_id`) VALUES (NULL, '$courier_status', '$role');";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$courier_status</b> Successfully Insert";
    }
}


// edit manufacturers
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Status";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM courier_status cs WHERE id = $id;";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $id = $row['id'];
        $courier_status = $row['courier_status'];
        $role = $row['user_role_id'];
    }
}



// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $courier_status =  data_clean($courier_status);


    // basic validation
    if (empty($courier_status)) {
        $error['courier_status'] = "Status Name Should Not Be Empty";
    }

    if (empty($role)) {
        $error['status'] = "Role Name Should Not Be Empty";
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE `courier_status` SET `courier_status` = '$courier_status' , `user_role_id` = '$role' WHERE id = $id;";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "Successfully Updated";
    }
}

// inactive  recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `courier_status` SET `status` = '1' WHERE id = $id;";

    $db->query($sql);

    $error['delete_msg'] = "Recode Inactive";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}

// inactive  active
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {

    $sql = "UPDATE `courier_status` SET `status` = '0' WHERE id = $id;";

    $db->query($sql);

    $error['delete_msg'] = "Recode active";

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
                    <h1 class="m-0">Courier Status</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Status</a></li>
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

            $sql = "SELECT * FROM `courier_status` WHERE id = '$id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $status_id = $row['id'];
                $courier_status = $row['courier_status'];

        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to Inactive <b> <?php echo $courier_status ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $id ?>"><br>
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
                                <label for="exampleInputEmail1">Role Name</label>
                                <select class="form-control select2" style="width: 100%;" name="role">
                                    <option value="">- Select User Role -</option>
                                    <?php

                                    // model drop down data fletch 
                                    $sql = "SELECT * FROM `user_roles` WHERE status = 0";
                                    $result = $db->query($sql);

                                    // fletch data
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $row['user_role_id'] ?>" <?php if ($row['user_role_id'] == @$role) { ?> selected <?php } ?>><?php echo $row['role_name']; ?></option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Status Name" name="courier_status" value="<?php echo @$courier_status ?>">
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?php echo @$id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo $btn_value ?>"><?php echo $btn_icon ?> <?php echo $btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col-8">
                <!-- Table Data Fletch -->
                <?php

                // crate variable for store dynamic query
                $where = null;

                // date range check
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                    // table wide search 
                    if (!empty($cus_search)) {

                        $where .= "CONCAT(cs.id, cs.courier_status, ur.role_name, s.status_name) LIKE '%$cus_search%' AND ";
                    }
                    
                    // remove the last 4 digits of the $where part "AND "
                    if (!empty($where)) {

                        $where = substr($where, 0, -4);

                        // take Mysql WHERE and take $where query parts 
                        $where = "WHERE $where";
                    }
                }
                // sql query
                $sql = "SELECT cs.id, cs.courier_status, ur.role_name, s.status_name FROM courier_status cs INNER JOIN user_roles ur ON ur.user_role_id = cs.user_role_id INNER JOIN status s ON s.status_id = cs.status $where;";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Courier Status</h3>
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
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Courier Status</th>
                                    <th>User Role</th>
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
                                            <td><?php echo $row['id'] ?> </td>
                                            <td><?php echo $row['courier_status'] ?> </td>
                                            <td><?php echo $row['role_name'] ?> </td>
                                            <td><?php echo $row['status_name'] ?> </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-ban"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
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
        $('#brand_list').DataTable({
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