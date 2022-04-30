<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Company';

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
    $company_name =  data_clean($company_name);
    $contact_number =  data_clean($contact_number);
    $contact_number_opp =  data_clean($contact_number_opp);
    $email =  data_clean($email);
    $address_line_1 =  data_clean($address_line_1);
    $address_line_2 =  data_clean($address_line_2);

    // basic validation
    if (empty($company_name)) {
        $error['company_name'] = "Company Name Should Not Be Empty";
    }
    if (empty($contact_number)) {
        $error['contact_number'] = "Contact Number Should Not Be Empty";
    }

    if (empty($email)) {
        $error['email'] = "Email Should Not Be Empty";
    }

    if (empty($address_line_1)) {
        $error['address_line_1'] = "Address Line 1 Should Not Be Empty";
    }


    // Advance Validation
    if (!empty($company_name)) {

        $sql = "SELECT * FROM `courier_companies` WHERE company_name = '$company_name'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['company_name'] = "Courier Company Name <b> $company_name </b> Already Exists";
        }
    }

    if (!empty($email)) {

        $sql = "SELECT * FROM `courier_companies` WHERE email = '$email'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['email'] = "Email <b> $email </b> Already Exists";
        }
    }

    // email validate
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error['email'] = "Email Address is not valid";
    }

    // contact number validate

    if (!preg_match("/^[0-9]*$/", $contact_number)) {
        $error['contact_number'] = "Phone number not valid";
    }

    if (!preg_match("/^[0-9]*$/", $contact_number_opp)) {
        $error['contact_number_opp'] = "Optional phone number not valid";
    }

    if (!empty($contact_number)) {
        if (strlen($contact_number) != 10) {
            $error['contact_number'] = "Contact Number Should be at least 10 characters";
        }
    }

    if (!empty($contact_number_opp)) {
        if (strlen($contact_number_opp) != 10) {
            $error['contact_number_opp'] = "Contact Number (Optional) Should be at least 10 characters";
        }
    }

    // url validation
    if (!filter_var($tracking_url, FILTER_VALIDATE_URL)) {

        $error['tracking_url'] = "URL is not valid format";
    }

    if (empty($error)) {

        $sql = "INSERT INTO `courier_companies` (`company_id`, `company_name`, `contact_number`, `contact_number_opp`, `email`, `address_line_1`, `address_line_2`, `tracking_url`) VALUES (NULL, '$company_name', '$contact_number', '$contact_number_opp', '$email', '$address_line_1', '$address_line_2', '$tracking_url');";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "<b>$company_name</b> Successfully Insert";
    }
}


// edit manufacturers
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Edit Company";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check recodes in DB
    $sql = "SELECT * FROM `courier_companies` WHERE company_id = '$company_id'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $company_id = $row['company_id'];
        $company_name = $row['company_name'];
        $contact_number = $row['contact_number'];
        $contact_number_opp = $row['contact_number_opp'];
        $email = $row['email'];
        $address_line_1 = $row['address_line_1'];
        $address_line_2 = $row['address_line_2'];
        $tracking_url = $row['tracking_url'];
    }
}



// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $company_name =  data_clean($company_name);
    $contact_number =  data_clean($contact_number);
    $contact_number_opp =  data_clean($contact_number_opp);
    $email =  data_clean($email);
    $address_line_1 =  data_clean($address_line_1);
    $address_line_2 =  data_clean($address_line_2);

     // basic validation
     if (empty($company_name)) {
        $error['company_name'] = "Company Name Should Not Be Empty";
    }
    if (empty($contact_number)) {
        $error['contact_number'] = "Contact Number Should Not Be Empty";
    }

    if (empty($email)) {
        $error['email'] = "Email Should Not Be Empty";
    }

    if (empty($address_line_1)) {
        $error['address_line_1'] = "Address Line 1 Should Not Be Empty";
    }

    // Advance Validation

    // email validate
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error['email'] = "Email Address is not valid";
    }

    // contact number validate

    if (!preg_match("/^[0-9]*$/", $contact_number)) {
        $error['contact_number'] = "Phone number not valid";
    }

    if (!preg_match("/^[0-9]*$/", $contact_number_opp)) {
        $error['contact_number_opp'] = "Optional phone number not valid";
    }

    // url validation
    if (!filter_var($tracking_url, FILTER_VALIDATE_URL)) {

        $error['tracking_url'] = "URL is not valid format";
    }

    // update query
    if (empty($error)) {
        $sql = "UPDATE `courier_companies` SET  `company_name` = '$company_name', `contact_number` = '$contact_number',  `contact_number_opp` = '$contact_number_opp', `email` = '$email', `address_line_1` ='$address_line_1', `address_line_2` ='$address_line_2', `tracking_url` = '$tracking_url' WHERE `courier_companies`.`company_id` = $company_id;";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "<b>$company_name</b> Successfully Updated";
    }
}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `courier_companies` SET `status` = '1' WHERE `courier_companies`.`company_id` = $company_id;";
    
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
                    <h1 class="m-0">Courier Company</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Courier Company</a></li>
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

            $sql = "SELECT * FROM `courier_companies` WHERE company_id = '$company_id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $brand_id = $row['company_id'];
                $company_name = $row['company_name'];

        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE <b> <?php echo $company_name ?> ?</b> </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="company_id" value="<?php echo $company_id ?>"><br>
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Company Name" name="company_name" value="<?php echo @$company_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Number</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Contact Number" name="contact_number" value="<?php echo @$contact_number ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Number (Optional)</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Contact Number" name="contact_number_opp" value="<?php echo @$contact_number_opp ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Address</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Email Address" name="email" value="<?php echo @$email ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address Line 1</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 1" name="address_line_1" value="<?php echo @$address_line_1 ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address Line 2</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 12" name="address_line_2" value="<?php echo @$address_line_2 ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tracking URL</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Tracking URL" name="tracking_url" value="<?php echo @$tracking_url ?>">
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="company_id" value="<?php echo @$company_id ?>">
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
                $sql = "SELECT * FROM `courier_companies` WHERE status = 0;";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registered Companies</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Contact Number</th>

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
                                            <td><?php echo $row['company_name'] ?> </td>
                                            <td><?php echo $row['contact_number'] ?> </td>

                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="company_id" value="<?php echo $row['company_id'] ?>">
                                                    <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="company_id" value="<?php echo $row['company_id'] ?>">
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
        // $("#user_list").DataTable({
        //     "responsive": true,
        //     "lengthChange": false,
        //     "autoWidth": false,
        //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#user_list_wrapper .col-md-6:eq(0)');
        $('#brand_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>