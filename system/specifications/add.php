<?php
include '../header.php';
include '../nav.php';

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

//insert specification
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // call data clean function
    $spc_name =  data_clean($spc_name);

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
        $sql = "INSERT INTO `specifications` (`spec_id`, `spec`, `value`) VALUES (NULL, '$spc_name', '');";
    }

    // call db con function
    $db = db_con();

    // run database query
    $query = $db->query($sql);
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
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // Advance Validation
    if (!empty($spc_name)) {

        $sql = "SELECT * FROM `specifications` WHERE spec = '$spc_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['spc_name'] = "Specification <b> $spc_name </b> Already Exists";
        }
    }

    //fletch query
    $sql = "UPDATE `specifications` SET `spec` = '$spc_name' WHERE `spec_id` = '$spec_id';";
    $query = $db->query($sql);
}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "DELETE FROM `specifications` WHERE `spec_id` = '$spec_id'";
    $db->query($sql);

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
        <!-- Blank Submit  and Already Exist-->
        <?php
        if (!empty($error)) {
        ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <?php echo $error['spc_name']; ?>
            </div>
        <?php
        }
        ?>
        <!-- Successfully Insert -->
        <?php
        if ((@$query == true && @$error == null) && @$action == 'insert') {
            $error['insert_msg'] = "<b>$spc_name</b> Successfully Insert";
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
            $error['insert_msg'] = "<b>$spc_name</b> Successfully Update";
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
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $spc_name ?> ?</b> </h5>
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
                        <h3 class="card-title"><?php echo $form_name ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Specification Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="spc_name" value="<?php echo @$spc_name ?>">
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
            <div class="col">
                <?php

                // db connect
                $db = db_con();

                // sql query
                $sql = "SELECT * FROM `specifications`";

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
                                            <td><?php echo $row['spec'] ?> </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="spec_id" value="<?php echo $row['spec_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="spec_id" value="<?php echo $row['spec_id'] ?>">
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