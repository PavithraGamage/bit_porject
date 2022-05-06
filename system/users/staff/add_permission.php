<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert Main Module';
$form_name_1 = 'Insert Sub Module';

// form button name change
$btn_name = "Insert";

// form button value change
$btn_value = "insert";
$btn_value_1 = "insert_1";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';

// create error variable to store error messages
$error =  array();

// create error variable to store error message styles
$error_style =  array();
$error_style_icon = array();

// date
$date = date('Y-m-d');


//insert main modules
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function

    $username = data_clean($username);
    $main_module =  data_clean($main_module);


    // basic validation
    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }

    if (empty($main_module)) {
        $error['last_main_modulename'] = "Main Module Should not be empty";
    }


    // Advance validation

    if (!preg_match("/^[0-9]*$/", $username)) {
        $error['match'] = "Invalid Date Type";
    }

    if (!preg_match("/^[0-9]*$/", $main_module)) {
        $error['match'] = "Invalid Date Type";
    }

    if (!empty($main_module)) {

        $sql = "SELECT * FROM users_modules WHERE module_id = '$main_module' AND user_id = $username";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['main_module'] = "This module already assign  to the selected user";
        }
    }




    //insert data to db
    if (empty($error)) {

        $sql = "INSERT INTO `users_modules` (`id`, `user_id`, `module_id`, `status`) VALUES (NULL, '$username', '$main_module', '0');";

        //run database query
        $db->query($sql);

        // success message style
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "Successfully Insert";
    }
}

//insert sub modules
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert_1') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $username = data_clean($username);
    $sub_module = data_clean($sub_module);


    // basic validation
    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }

    if (empty($sub_module)) {
        $error['sub_module'] = "Sub Module Should not be empty";
    }

    // Advance validation
    if (!preg_match("/^[0-9]*$/", $username)) {
        $error['match'] = "Invalid Date Type";
    }

    if (!preg_match("/^[0-9]*$/", $sub_module)) {
        $error['match'] = "Invalid Date Type";
    }

    if (!empty($sub_module)) {

        $sql = "SELECT * FROM users_modules WHERE module_id = '$sub_module' AND user_id = $username";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['sub_module'] = "This module already assign  to the selected user";
        }
    }


    //insert data to db
    if (empty($error)) {

        $sql = "INSERT INTO `users_modules` (`id`, `user_id`, `module_id`, `status`) VALUES (NULL, '$username', '$sub_module', '0');";

        //run database query
        $db->query($sql);

        // success message style
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$username</b> Successfully Insert";
    }
}

// edit items
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // form Name
    $form_name = 'Insert Main Module';
    $form_name_1 = 'Insert Sub Module';

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";
    $btn_value_1 = "update_1";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM users_modules WHERE id = $id;";
    $result = $db->query($sql);

    $row = $result->fetch_assoc();

    $username = $row['user_id'];
    $main_module = $row['module_id'];
    $sub_module = $row['module_id'];
}

// update the main module
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $username = data_clean($username);
    $main_module = data_clean($main_module);

    // basic validation
    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }

    if (empty($main_module)) {
        $error['main_module'] = "Sub Module Should not be empty";
    }

    // Advance validation
    if (!preg_match("/^[0-9]*$/", $username)) {
        $error['match'] = "Invalid Date Type";
    }

    if (!preg_match("/^[0-9]*$/", $main_module)) {
        $error['match'] = "Invalid Date Type";
    }

    // update query
    if (empty($error)) {
         $sql = "UPDATE `users_modules` SET `module_id` = '$main_module' WHERE id = $id;";

        // run database query
        $query = $db->query($sql);

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$username</b> Successfully Updated";
    }
}

// update the sub module
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update_1') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $username = data_clean($username);
    $sub_module = data_clean($sub_module);

    // basic validation
    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }

    if (empty($sub_module)) {
        $error['sub_module'] = "Sub Module Should not be empty";
    }

    // Advance validation
    if (!preg_match("/^[0-9]*$/", $username)) {
        $error['match'] = "Invalid Date Type";
    }

    if (!preg_match("/^[0-9]*$/", $sub_module)) {
        $error['match'] = "Invalid Date Type";
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE `users_modules` SET `module_id` = '$sub_module' WHERE id = $id;";

        // run database query
        $query = $db->query($sql);

        // success message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$username</b> Successfully Updated";
    }
}

// delete the recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `users_modules` SET `status` = '1' WHERE id = $id;";

    $db->query($sql);

    $error['delete_msg'] = "Recode Delete";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}

// change status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {

    $sql = "UPDATE `users_modules` SET `status` = '0' WHERE id = $id;";

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
                    <h1 class="m-0">Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Staff Permissions</a></li>
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
            $sql = "SELECT * FROM `users_modules` WHERE id = '$id'";

            $result = $db->query($sql);


            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $username = $row['id'];

        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $username ?>"><br>
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


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username <span style="color: red;">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="username">
                                            <option value="">- Select Username -</option>
                                            <?php

                                            // user drop down data fletch 
                                            $sql = "SELECT u.user_id, u.user_name
                                            FROM users u
                                            INNER JOIN staff s ON s.user_id = u.user_id
                                            WHERE u.status = 0  
                                            ORDER BY `u`.`user_name` ASC;";
                                            $result = $db->query($sql);

                                            // fletch data
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $row['user_id'] ?>" <?php if ($row['user_id'] == @$username) { ?> selected <?php } ?>>
                                                        <?php echo $row['user_name']; ?>
                                                    </option>
                                            <?php

                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Main Module Name <span style="color: red;">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="main_module">
                                            <option value="">- Select Main Module -</option>
                                            <?php

                                            // modules drop down data fletch 
                                            $sql_modules = "SELECT * FROM `modules` WHERE length(module_id) = '2'";
                                            $modules_result = $db->query($sql_modules);

                                            // fletch data
                                            if ($modules_result->num_rows > 0) {
                                                while ($modules_row = $modules_result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $modules_row['module_id'] ?>" <?php if ($modules_row['module_id'] == @$main_module) { ?> selected <?php } ?>>
                                                        <?php echo $modules_row['module_id'] . " - " . $modules_row['description']; ?>
                                                    </option>
                                            <?php

                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>


                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?php echo @$id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- Right Section Start -->
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $form_name_1 ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="card card-primary card-outline card-tabs">

                                <div class="card-body">


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username <span style="color: red;">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="username">
                                            <option value="">- Select Username -</option>
                                            <?php

                                            // user drop down data fletch 
                                            $sql = "SELECT u.user_id, u.user_name
                                            FROM users u
                                            INNER JOIN staff s ON s.user_id = u.user_id
                                            WHERE u.status = 0  
                                            ORDER BY `u`.`user_name` ASC;";
                                            
                                            $result = $db->query($sql);

                                            // fletch data
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $row['user_id'] ?>" <?php if ($row['user_id'] == @$username) { ?> selected <?php } ?>>
                                                        <?php echo $row['user_name']; ?>
                                                    </option>
                                            <?php

                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sub Module Name <span style="color: red;">*</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="sub_module">
                                            <option value="">- Select Sub Module -</option>
                                            <?php

                                            // modules drop down data fletch 
                                            $sql_modules = "SELECT * FROM `modules` WHERE length(module_id) = '4'";
                                            $modules_result = $db->query($sql_modules);

                                            // fletch data
                                            if ($modules_result->num_rows > 0) {
                                                while ($modules_row = $modules_result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $modules_row['module_id'] ?>" <?php if ($modules_row['module_id'] == @$main_module) { ?> selected <?php } ?>>
                                                        <?php echo $modules_row['module_id'] . " - " . $modules_row['description']; ?>
                                                    </option>
                                            <?php

                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?php echo @$id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value_1 ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Staff Permissions List</h3><br><br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label>Filter by:</label>
                    <select class="form-control select2" style="width: 40%;" name="modules">
                        <option value="">- Select Module -</option>
                        <option value="2" <?php if (@$modules == 2) {
                                                echo "selected";
                                            }; ?>>Main Module</option>
                        <option value="4" <?php if (@$modules == 4) {
                                                echo "selected";
                                            }; ?>>Sub Module</option>
                    </select><br>
                    <button class="btn btn-block btn-primary btn-xs" style="width: 20%;">Filter</button>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="user_list" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Profile Image</th>
                            <th>Username</th>
                            <th>Module</th>
                            <th>Module ID</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Inactive</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // null variable for query where part
                        $q_where_part = null;

                        // check the filter is set
                        if (!empty($modules)) {

                            $q_where_part = " WHERE LENGTH(um.module_id) = $modules;";
                        }

                        // sql query
                        $sql = "SELECT u.user_id, u.profile_image, u.user_name, m.description, um.module_id, um.id, s.status_name
                      FROM users_modules um 
                      INNER JOIN users u ON u.user_id = um.user_id 
                      INNER JOIN modules m ON m.module_id = um.module_id
                      INNER JOIN status s ON s.status_id = um.status $q_where_part";

                        // fletch data
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><img src="../../../assets/images/<?php echo $row['profile_image'] ?>" class="img-fluid" width="100"></td>
                                    <td><?php echo $row['user_name'] ?> </td>
                                    <td><?php echo $row['description'] ?> </td>
                                    <td><?php echo $row['module_id'] ?> </td>
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

<?php include '../../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {
        $('#user_list').DataTable({
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