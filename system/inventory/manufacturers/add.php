<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Manufacturer';

// form button name change
$btn_name = "Insert";

// form button value change
$btn_value = "insert";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';

// create error variable to store error messages
$error =  array();

// insert manufactures
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // call data clean function
    $man_name =  data_clean($man_name);

    if (empty($man_name)) {
        $error['man_name'] = "Manufacture Name Should Not Be Empty";
    }

    // Advance Validation
    if (!empty($man_name)) {

        $sql = "SELECT * FROM `manufacturers` WHERE man_name = '$man_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['man_name'] = "Manufacturer <b> $man_name </b> Already Exists";
        }
    }

    if (empty($error)) {
        $sql = "INSERT INTO `manufacturers` (`man_id`, `man_name`) VALUES (NULL, '$man_name');";
    }

    // run database query
    $query = $db->query($sql);
}

// edit manufacturers
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Manufacturer";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM manufacturers WHERE man_id = '$man_id'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $man_id = $row['man_id'];
        $man_name = $row['man_name'];

    }

}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

     // Advance Validation
     if (!empty($man_name)) {

        $sql = "SELECT * FROM `manufacturers` WHERE man_name = '$man_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['man_name'] = "Manufacturer <b> $man_name </b> Already Exists";
        }
    }

    $sql = "UPDATE `manufacturers` SET `man_name` = '$man_name' WHERE `man_id` = '$man_id';";
    $query = $db->query($sql);

}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "DELETE FROM `manufacturers` WHERE `man_id` = '$man_id'";
    $db->query($sql);

}

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manufacturers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Manufacturers</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Alerts -->
    <div class="container-fluid">
        <!-- Blank Submit  and Already Exist-->
        <?php
        if (!empty($error)) {
        ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <?php echo $error['man_name']; ?>
            </div>
        <?php
        }
        ?>
        <!-- Successfully Insert -->
        <?php
        if ((@$query == true && @$error == null) && @$action == 'insert') {
            $error['insert_msg'] = "<b>$man_name</b> Successfully Insert";
        ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <?php echo $error['insert_msg']; ?>
            </div>
        <?php
        }
        ?>
        <!-- Update -->
        <?php
        if ((@$query == true && @$error == null) && @$action == 'update') {
            $error['insert_msg'] = "<b>$man_name</b> Successfully Update";
        ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <?php echo $error['insert_msg']; ?>
            </div>
        <?php
        }
        ?>

        <!-- Delete -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
            $sql = "SELECT * FROM manufacturers WHERE man_id = '$man_id'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $man_id = $row['man_id'];
                $man_name = $row['man_name'];
        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $man_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="man_id" value="<?php echo $man_id ?>"><br>
                            <button type="submit" name="action" value="confirm_delete" class="btn btn-danger btn-s">Yes</button>
                            <button type="submit" name="action" value="cancel_delete" class="btn btn-primary btn-s">No</button>
                        </form>

                    </div>
                </div>

        <?php
            }
        }
        ?>

        <?php
        if (@$action == 'confirm_delete') {
            $error['delete_msg'] = "Recode Delete";
        ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="fas fa-trash-alt"></i> Alert!</h5>
                <?php echo $error['delete_msg']; ?>
            </div>

        <?php
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
                                <label for="exampleInputEmail1">Manufacturer Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Manufacturer Name" name="man_name" value="<?php echo @$man_name ?>">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="man_id" value="<?php echo @$man_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo $btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col">
                <!-- Table Data Fletch -->
                <?php

                // sql query
                $sql = "SELECT * FROM `manufacturers`";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manufacture List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="man_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Manufacturer Name</th>
                                    <th style="width: 85px !important;">Edit</th>
                                    <th style="width: 85px !important;">Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Table Data
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['man_name'] ?> </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="man_id" value="<?php echo $row['man_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="man_id" value="<?php echo $row['man_id'] ?>">
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
        $('#man_list').DataTable({
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