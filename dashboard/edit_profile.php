<?php

include "site_nav.php";
include "dashboard_nav.php";

extract($_POST);

$db = db_con();

// form Name
$form_name = 'Update Profile';

// form button name change
$btn_name = "Update";

// form button value change
$btn_value = "update";

// form button icon
$btn_icon = '<i class="far fa-save"></i>';

// create error variable to store error messages
$error =  array();

// create error variable to store error message styles
$error_style =  array();
$error_style_icon = array();

// date
$date = date('Y-m-d');

// user id session to variable
$user_id = $_SESSION['user_id'];


// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function

    $first_name = data_clean($first_name);
    $last_name =  data_clean($last_name);
    $username = data_clean($username);
    $email = data_clean($email);
    $contact_number = data_clean($contact_number);
    $address_line_1 = data_clean($address_line_1);
    $address_line_2 = data_clean($address_line_2);
    $city = data_clean($city);
    $postal_code = data_clean($postal_code);
    $province = data_clean($province);

    // basic validation
    if (empty($first_name)) {
        $error['first_name'] = "First Name Should not be empty";
    }

    if (empty($last_name)) {
        $error['last_name'] = "Last Name Should not be empty";
    }

    if (empty($username)) {
        $error['username'] = "Username Should not be empty";
    }

    if (empty($email)) {
        $error['email'] = "Email Should not be empty";
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

    if (empty($postal_code)) {
        $error['postal_code'] = "Postal Code Should not be empty";
    }

    if (empty($province)) {
        $error['province'] = "Province Should not be empty";
    }


    // Advance validation

    if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $error['first_name'] = "Only Letters allowed for First Name";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $error['last_name'] = "Only Letters allowed for Last Name";
    }

    if (!preg_match("/^[0-9]*$/", $contact_number)) {
        $error['phone'] = "Phone number not valid";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
        $error['city'] = "Only Letters allowed for city";
    }

    if (!preg_match("/^[0-9]*$/", $postal_code)) {
        $error['city'] = "Postal Code not valid";
    }

    if (!empty($username) && @$previous_username != $username) {

        $sql = "SELECT * FROM users WHERE user_name = '$username'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['user_name'] = "<b> $username </b> User Already Exists";
        }
    }

    if (!empty($email) && @$previous_email != $email) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $error['email'] = "Email Address is not valid";
        } else {

            $sql_e = "SELECT * FROM users WHERE email = '$email'";
            $result_e = $db->query($sql_e);
            if ($result_e->num_rows > 0) {
                $error['email'] = "Email Already Exists";
            }
        }
    }

    if (!empty($_FILES['profile_image']['name']) && empty($error)) {

        // image upload function
        $photo =  image_upload("profile_image", "../assets/images/");

        if (array_key_exists("photo", $photo)) {

            $photo = $photo['photo'];
        } else {

            $error['profile_image'] = $photo['profile_image'];
        }
    } else {
        $photo = @$previous_profile_image;
    }

    // update query
    if (empty($error)) {

        $sql = "UPDATE `users` SET `user_name` = '$username', `email` = '$email', `first_name` = '$first_name', `last_name` = '$last_name', `profile_image` = '$photo'    WHERE `user_id` = $user_id";
        // run database query
        $query = $db->query($sql);


        $sql = "UPDATE `customers` SET contact_nmuber = '$contact_number', address_l1 = '$address_line_1', address_l2 = '$address_line_2', city = '$city', postal_code = '$postal_code', province_id = '$province' WHERE `user_id` = $user_id;";
        // run database query
        $query = $db->query($sql);

        // success message styles

        $error['update'] = "Successfully updated. Please log out to apply changes";
    }
}

// update the password
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update_password') {

    // basic validation

    if (empty($ex_password) && empty($previous_password)) {
        $error['ex_password'] = "Exsiting Password not be empty";
    }

    if (empty($new_password_verify) && empty($previous_password)) {
        $error['new_password_verify'] = "New password should not be empty";
    }

    if (empty($previous_password_verify) && empty($previous_password_verify)) {
        $error['previous_password_verify'] = "Verify Password Should not be empty";
    }

    // Advance validation

    // check existing password
    if (!empty($ex_password) and !empty($new_password_verify)) {

        $sql = "SELECT password FROM users WHERE password = '" . sha1($ex_password) . "' AND user_id = $user_id ";

        $result = $db->query($sql);

        if ($result->num_rows == 0) {

            $error['ex_password'] = "Existing password not match";
        }
    }

    if (!empty($new_password_verify)) {
        if (strlen($new_password_verify) < 8) {
            $error['new_password_verify'] = "Password Should be at least 8 characters";
        }
    }

    if (!empty($new_password_verify) && !empty($previous_password_verify)) {

        if ($new_password_verify != $previous_password_verify) {
            $error['password_verify'] = "Password not match";
        }
    }


    // update query
    if (empty($error)) {

        $sql = "UPDATE `users` SET `password` = '" . sha1($new_password_verify) . "' WHERE `user_id` = $user_id";
        // run database query
        $query = $db->query($sql);



        // success message styles

        $error['update'] = "Successfully updated. Please log out to apply changes";
    }
}

?>
<!-- Dashbaord Content Area Start -->
<div class="col-10 dash_content">
    <div class="page_tables">

        <h6 style="color:green ;"><?php echo @$error['update'] ?></h6><br>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?php echo $form_name ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <?php

                $sql = "SELECT u.user_id, u.first_name, u.last_name, u.user_name, u.email, u.profile_image, c.contact_nmuber, c.address_l1, c.address_l2, c.city, c.postal_code, p.id
                        FROM customers c
                        INNER JOIN users u ON u.user_id = c.user_id
                        INNER JOIN province p ON p.id = c.province_id
                        WHERE u.user_id = $user_id;";

                $result = $db->query($sql);

                // fletch data
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $profile_image = $row['profile_image'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $username = $row['user_name'];
                        $email = $row['email'];
                        $contact_number = $row['contact_nmuber'];
                        $address_line_1 = $row['address_l1'];
                        $address_line_2 = $row['address_l2'];
                        $city = $row['city'];
                        $postal_code = $row['postal_code'];
                        $province = $row['id'];
                    }
                }
                
                ?>
                <div class="card-body">
                    <div class="card card-primary card-outline card-tabs">

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="image">Profile Image <span style="color: red;">*</span></label>
                                            <input type="file" class="form-control" id="profile_image" style="height: auto;" name="profile_image" />
                                            <input type="hidden" class="form-control" id="previous_profile_image" name="previous_profile_image" value="<?php echo @$profile_image ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name" name="first_name" value="<?php echo @$first_name ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['first_name'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name" name="last_name" value="<?php echo @$last_name ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['last_name'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" name="username" value="<?php echo @$username ?>">
                                            <input type="hidden" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" name="previous_username" value="<?php echo @$username ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['username'] ?> <?php echo @$error['user_name'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Email" name="email" value="<?php echo @$email ?>">
                                            <input type="hidden" class="form-control" id="exampleInputPassword1" placeholder="Enter Email" name="previous_email" value="<?php echo @$email ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['email'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contact Number</label>
                                            <input type="tel" class="form-control" id="exampleInputEmail1" placeholder="Enter Contact Number" name="contact_number" value="<?php echo @$contact_number ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['contact_number'] ?></p>
                                        </div>


                                    </div>
                                    <div class="col-6">

                                        <!-- second colum -->


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address Line 1</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 1" name="address_line_1" value="<?php echo @$address_line_1 ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['address_line_1'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address Line 2</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 2" name="address_line_2" value="<?php echo @$address_line_2 ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter City" name="city" value="<?php echo @$city ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['city'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Postal Code</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Postal Code" name="postal_code" value="<?php echo @$postal_code ?>">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['postal_code'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Province</label>
                                            <select class="form-control select2" style="width: 100%;" name="province" id="province">
                                                <option value="">- Select Province -</option>
                                                <?php

                                                // provinces drop down data fletch 
                                                $sql_pro = "SELECT * FROM `province` WHERE status = 0";
                                                $pro_result = $db->query($sql_pro);

                                                // fletch data
                                                if ($pro_result->num_rows > 0) {
                                                    while ($pro_row = $pro_result->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $pro_row['id'] ?>" <?php if ($pro_row['id'] == @$province) { ?> selected <?php } ?>><?php echo $pro_row['name']; ?></option>
                                                <?php

                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['province'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="user_id" value="<?php echo @$user_id ?>">
                    <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$btn_value ?>"><?php echo @$btn_icon ?> <?php echo @$btn_name ?></button>
                </div>
            </form>
        </div>
    </div><br>
    <div class="page_tables">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Password Change</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="card card-primary card-outline card-tabs">

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Existing Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="ex_password">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['ex_password'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <!-- second colum -->
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">New Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password" name="new_password_verify">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['new_password_verify'] ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Verify Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Verify Password" name="previous_password_verify">
                                        </div>
                                        <div>
                                            <p style="color:red;"> <?php echo @$error['previous_password_verify'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="user_id" value="<?php echo @$user_id ?>">
                    <button type="submit" class="btn btn-primary" name="action" value="update_password"><?php echo @$btn_icon ?> Change</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Dashbaord Content Area End -->
</div>
</div>


<!--dashboard end-->
</div>
</div>

<?php

include "site_footer.php";

?>