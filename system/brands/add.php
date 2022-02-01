<?php
include '../header.php';
include '../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Brand';

// form button name change
$btn_name = "Insert";

// form button value change
$btn_value = "insert";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';

// create error variable to store error messages
$error =  array();

// insert brands
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // call data clean function
    $brand_name =  data_clean($brand_name);

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
    }

    // run database query
    $query = $db->query($sql);
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

    // Advance Validation
    if (!empty($brand_name)) {

        $sql = "SELECT * FROM `brands` WHERE brand_name = '$brand_name'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['brand_name'] = "Manufacturer <b> $brand_name </b> Already Exists";
        }
    }

    $sql = "UPDATE `brands` SET `brand_name` = '$brand_name' WHERE `brand_id` = '$brand_id';";
    $query = $db->query($sql);
}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "DELETE FROM `brands` WHERE `brand_id` = '$brand_id'";
    $db->query($sql);
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Brands</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Brands</a></li>
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
                <?php echo $error['brand_name']; ?>
            </div>
        <?php
        }
        ?>
        <!-- Successfully Insert -->
        <?php
        if ((@$query == true && @$error == null) && @$action == 'insert') {
            $error['insert_msg'] = "<b>$brand_name</b> Successfully Insert";
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
            $error['insert_msg'] = "<b>$brand_name</b> Successfully Update";
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
                                <label for="exampleInputEmail1">Brand Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="brand_name" value="<?php echo @$brand_name ?>">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="brand_id" value="<?php echo @$brand_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo $btn_value ?>"><?php echo $btn_icon ?> <?php echo $btn_name ?></button>
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
                                    <th>Brand Name</th>
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