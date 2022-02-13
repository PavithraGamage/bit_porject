<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert New Staff Member';

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

    $first_name = data_clean($first_name);
    $last_name =  data_clean($last_name);
    $nic = data_clean($nic);
    $dob = data_clean($dob);
    //$age = data_clean($age); derived by $dob
    $username = data_clean($username);
    $email = data_clean($email);
    $contact_number = data_clean($contact_number);
    $address_line_1 = data_clean($address_line_1);
    $address_line_2 = data_clean($address_line_2);
    $city = data_clean($city);
    $province = data_clean($province);
    $postal_code = data_clean($postal_code);

    // basic validation
    // if (empty($profile_image)) {
    //     $error['profile_image'] = "Profile Image Should not be empty";
    // }
    if (empty($first_name)) {
        $error['first_name'] = "First Name Should not be empty";
    }
    if (empty($last_name)) {
        $error['last_name'] = "Last Name Should not be empty";
    }
    if (empty($nic)) {
        $error['nic'] = "NIC Should not be empty";
    }
    if (empty($dob)) {
        $error['dob'] = "Date of Birth Should not be empty";
    }
    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }
    if (empty($password)) {
        $error['password'] = "Password Should not be empty";
    }
    if (empty($verify_password)) {
        $error['error_item_name'] = "Verify Password Should not be empty";
    }
    if (empty($contact_number)) {
        $error['contact_number'] = "Contact Number Should not be empty";
    }
    if (empty($address_line_1)) {
        $error['address_line_1'] = "Address line 1 Should not be empty";
    }
    if (empty($city)) {
        $error['city'] = "City Should not be empty";
    }
    if (empty($province)) {
        $error['province'] = "Province Should not be empty";
    }
    if (empty($province)) {
        $error['postal_code'] = "Postal Code Should not be empty";
    }

     // Advance validation
     if (!empty($username)) {

        $sql = "SELECT * FROM users WHERE user_name = '$username'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['user_name'] = "<b> $username </b> User Already Exists";
        }
    }
    
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
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
    $sql = "SELECT * FROM items WHERE item_id = '$item_id'";

    $result = $db->query($sql);


    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $item_id = $row['item_id'];
        $item_name = $row['item_name'];
?>
        <div class="card">
            <h5 class="card-header bg-danger">Conformation</h5>
            <div class="card-body">
                <h5 class="card-title">Are You Want to DELETE <b> <?php echo $item_name ?> ?</b> </h5>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item_id ?>"><br>
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
                            <div class="form-group">
                                <label class="form-label" for="item_image">Profile Image <span style="color: red;">*</span></label>
                                <input type="file" class="form-control" id="profile_image" style="height: auto;" name="profile_image" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name" name="first_name" value="<?php echo @$first_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name" name="last_name" value="<?php echo @$last_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIC</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter NIC" name="nic" value="<?php echo @$nic ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of Birth</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter Date of Birth" name="dob">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Verify Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Verify Password" name="verify_password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Number</label>
                                <input type="tel" class="form-control" id="exampleInputEmail1" placeholder="Enter Contact Number" name="contact_number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address Line 1</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 1" name="address_line_1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address Line 2</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 2" name="address_line_2">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter City" name="city">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Province</label>
                                <select class="form-control" id="exampleInputEmail1" placeholder="Enter Province" name="province">
                                    <option value="Select Province">Select Province</option>
                                    <option value="Western Province">Western Province</option>
                                    <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                                    <option value="Central Province">Central Province</option>
                                    <option value="Southern Province">Southern Province</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Postal Code</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Postal Code" name="postal_code">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="item_id" value="<?php echo @$item_id ?>">
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
                $sql = "SELECT * FROM `users`";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['user_id'] ?> </td>
                                            <td><?php echo $row['first_name'] ?> </td>
                                            <td><?php echo $row['last_name'] ?> </td>
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
        $("#user_list").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#user_list_wrapper .col-md-6:eq(0)');
        $('#user_list1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>