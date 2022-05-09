<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Category';

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

//insert category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $category_name =  data_clean($category_name);
    $category_description = data_clean($category_description);

    // basic validation
    if (empty($category_name)) {
        $error['category_name'] = "Category Name Should not be empty";
    }

    // if (empty($category_image)) {
    //     $error['category_image'] = "Category Image Should not be empty";
    // }

    // Advance validation
    if (!empty($category_name)) {

        $sql = "SELECT * FROM `categories` WHERE category_name = '$category_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['category_name'] = "<b> $category_name </b> Already Exists";
        }
    }

    // image upload
    if (empty($error)) {
        $target_dri = "../../../assets/images/";
        $target_file = $target_dri . basename($_FILES["category_image"]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['category_image']['tmp_name']);
        if ($check !== false) {
            //Multi-purpose Internet Mail Extensions          
            $upload_ok = 1;
        } else {
            $error['category_image'] = "File is not an image.";
            $upload_ok = 0;
        }

        if (file_exists($target_file)) {
            $error['category_image'] = "Sorry, file already exists.";
            $upload_ok = 0;
        }

        if ($_FILES["category_image"]["size"] > 5000000) {
            $error['category_image'] = "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
            $error['category_image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["category_image"]["tmp_name"], $target_file)) {
                $photo = htmlspecialchars(basename($_FILES["category_image"]["name"]));
            } else {
                $error['category_image'] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (empty($error)) {
        $sql = "INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `cat_image`) VALUES (NULL, '$category_name', '$category_description','$photo');";

        // run database query
        $query = $db->query($sql);

        // error message styles
        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$category_name</b> Successfully Insert";
    }
}

// edit category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Category";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM categories WHERE category_id = '$category_id'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
        $category_description = $row['category_description'];
        $category_image = $row['cat_image'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // basic validation
    if (empty($category_name)) {
        $error['category_name'] = "Category Name Should not be empty";
    }

    // Advance Validation
    if (!empty($category_name) && $previous_category_name != $category_name) {

        $sql = "SELECT * FROM `categories` WHERE category_name = '$category_name'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['category_name'] = "<b> $category_name </b> Already Exists";
        }
    }

    // image upload
    if (empty($error) && !empty($_FILES['category_image']['name'])) {
        $target_dri = "../../../assets/images/";
        $target_file = $target_dri . basename($_FILES["category_image"]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['category_image']['tmp_name']);
        if ($check !== false) {
            //Multi-purpose Internet Mail Extensions          
            $upload_ok = 1;
        } else {
            $error['category_image'] = "File is not an image.";
            $upload_ok = 0;
        }

        if (file_exists($target_file)) {
            $error['category_image'] = "Sorry, file already exists.";
            $upload_ok = 0;
        }

        if ($_FILES["category_image"]["size"] > 5000000) {
            $error['category_image'] = "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
            $error['category_image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["category_image"]["tmp_name"], $target_file)) {
                $photo = htmlspecialchars(basename($_FILES["category_image"]["name"]));
            } else {
                $error['category_image'] = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $photo = $previous_category_image;
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE categories SET category_name = '$category_name', category_description = '$category_description' , cat_image = '$photo' WHERE `category_id` = '$category_id';";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$category_name</b> Successfully Updated";
    }
}

// inactive category  recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `categories` SET `status` = '1' WHERE `categories`.`category_id` = $category_id;";
    $db->query($sql);

    $error['delete_msg'] = "Recode Inactive";

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';
}


// change status active
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {

    $sql = "UPDATE `categories` SET `status` = '0' WHERE `categories`.`category_id` = $category_id;";
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
                    <h1 class="m-0">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Categories</a></li>
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
            $sql = "SELECT * FROM categories WHERE category_id = '$category_id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $category_id = $row['category_id'];
                $category_name = $row['category_name'];
        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to Inactive <b> <?php echo $category_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="category_id" value="<?php echo $category_id ?>"><br>
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
                        <h3 class="card-title"><?php echo @$form_name ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label" for="category_image">Category Image</label>
                                <input type="file" class="form-control" id="category_image" style="height: auto;" name="category_image">

                                <input type="hidden" name="previous_category_image" value="<?php echo @$category_image; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" name="category_name" value="<?php echo @$category_name ?>">
                                <input type="hidden" class="form-control" id="previous_category_name" placeholder="Enter Category Name" name="previous_category_name" value="<?php echo @$category_name ?>">
                            </div>
                            <div class="form-group">
                                <label>Category Short Description</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="category_description"><?php echo @$category_description ?></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="category_id" value="<?php echo @$category_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"> <?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col-7">
                <?php

                // sql query
                $sql = "SELECT * 
                FROM categories c
                INNER JOIN status s ON s.status_id =  c.status;";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories Models</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Category Image</th>
                                    <th>Category Name</th>
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
                                            <td><img src="../../../assets/images/<?php echo $row['cat_image'] ?>" class="img-fluid" width="100"></td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['status_name'] ?> </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="category_id" value="<?php echo $row['category_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="category_id" value="<?php echo $row['category_id'] ?>">
                                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-xs"><i class="fas fa-ban"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="category_id" value="<?php echo $row['category_id'] ?>">
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