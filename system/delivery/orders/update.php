<?php
ob_start(); // multiple headers

include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// form Name
$form_name = 'Insert Courier Details';

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

if (empty($order_id)) {
    header('Location: http://localhost/bit/system/delivery/orders/view.php');
}


// insert courier
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'insert') {

    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $company =  data_clean($company);
    $status =  data_clean($status);
    $tracking_number =  data_clean($tracking_number);
    $dispatch_date =  data_clean($dispatch_date);

    // basic validation
    if (empty($company)) {
        $error['company'] = "Company Name Should Not Be Empty";
    }

    if (empty($status)) {
        $error['status'] = "Status Should Not Be Empty";
    }

    if (empty($dispatch_date)) {
        $error['dispatch_date'] = "Dispatch Date Should Not Be Empty";
    }

    // advance validations

    if(!$status == 16){
        if (empty($tracking_number)) {
            $error['tracking_number'] = "Tracking Number Should Not Be Empty";
        }
    }

    if (!empty($order_id)) {

        $sql = "SELECT * FROM `orders_company` WHERE order_id = '$order_id'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $error['order_id'] = "Already assign couriers service please update";
        }
    }

    if (!preg_match("/^[0-9]*$/", $tracking_number)) {
        $error['tracking_number'] = "Tracking Number not valid";
    }

    if (empty($error)) {

        $sql = "INSERT INTO `orders_company` (`id`, `order_id`, `company_id`, `dispatch_date`, `tracking_number`) VALUES (NULL, '$order_id', '$company', '$dispatch_date', '$tracking_number');";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['insert_msg'] = "Delivery Details Successfully Insert";

        $sql_update = "UPDATE `orders` SET `courier_status` = '$status' WHERE `orders`.`order_id` = $order_id;";

        // run database query
        $query = $db->query($sql_update);
    }
}

// edit courier
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    // from name change
    $form_name = "Update Courier";

    // form button name change
    $btn_name = "Update";

    // form button value change
    $btn_value = "update";

    // form button icon
    $btn_icon = '<i class="far fa-edit"></i>';

    // check records

    $sql = "SELECT cc.company_id, oc.tracking_number, oc.dispatch_date, cs.id
    FROM orders o 
    INNER JOIN courier_status cs ON cs.id = o.courier_status
    INNER JOIN orders_company oc ON oc.order_id = o.order_id
    INNER JOIN courier_companies cc ON cc.company_id = oc.company_id
    WHERE o.order_id = $order_id;";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $company = $row['company_id'];
        $tracking_number = $row['tracking_number'];
        $dispatch_date = $row['dispatch_date'];
        $status = $row['id'];
    }
}

// update the edit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update') {


    // error styles
    $error_style['success'] = "alert-danger";
    $error_style_icon['fa-check'] = '<i class="icon fas fa-ban"></i>';

    // call data clean function
    $company =  data_clean($company);
    $status =  data_clean($status);
    $tracking_number =  data_clean($tracking_number);
    $dispatch_date =  data_clean($dispatch_date);

    // basic validation
    if (empty($company)) {
        $error['company'] = "Company Name Should Not Be Empty";
    }

  
    if (empty($tracking_number)) {
        $error['tracking_number'] = "Tracking Number Should Not Be Empty";
    }

    if (empty($dispatch_date)) {
        $error['dispatch_date'] = "Dispatch Date Should Not Be Empty";
    }

    // advance validations
    if (!preg_match("/^[0-9]*$/", $tracking_number)) {
        $error['tracking_number'] = "Tracking Number not valid";
    }

    if(!$status == 16){
        if (empty($status)) {
            $error['status'] = "Status Should Not Be Empty";
        }
    
    }

    // update query
    if (empty($error)) {

        $sql = "UPDATE orders_company SET company_id = '$company', dispatch_date = '$dispatch_date',  tracking_number = '$tracking_number' WHERE order_id = $order_id;";

        // run database query
        $query = $db->query($sql);

        $error_style['success'] = "alert-success";
        $error_style_icon['fa-check'] = '<i class="icon fas fa-check"></i>';
        $error['update'] = "Successfully Updated";

        $sql_update = "UPDATE `orders` SET `courier_status` = '$status' WHERE `orders`.`order_id` = $order_id;";
        // run database query
        $query = $db->query($sql_update);
    }
}

// delete recode
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'confirm_delete') {

    $sql = "UPDATE `orders_company` SET `status` = '1' WHERE order_id = $order_id;";

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
                    <h1 class="m-0">Delivery Charges</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Delivery Charges</a></li>
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

            $sql = "SELECT * FROM `orders_company` WHERE order_id = '$order_id'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $order_id = $row['order_id'];
               

        ?>
                <div class="card">
                    <h5 class="card-header bg-danger">Conformation</h5>
                    <div class="card-body">
                        <h5 class="card-title">Are You Want to DELETE ? </h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $order_id ?>"><br>
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
            <!-- Right Section Start -->
            <div class="col">
                <!-- Table Data Fletch -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $form_name ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">

                            <label for="exampleInputEmail1">Company <span style="color: red;">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="company">
                                <option value="">- Select Model -</option>
                                <?php

                                // sql query
                                $sql = "SELECT * FROM `courier_companies` WHERE status = 0;";

                                // fletch data
                                $result = $db->query($sql);

                                // fletch data
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row['company_id'] ?>" <?php if ($row['company_id'] == @$company) { ?> selected <?php } ?>><?php echo $row['company_name']; ?></option>
                                <?php

                                    }
                                }
                                ?>
                            </select><br>
                            <label for="exampleInputEmail1">Status <span style="color: red;">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="status">
                                <option value="">- Select Model -</option>
                                <?php

                                // sql query
                                $sql = "SELECT * FROM `courier_status` WHERE status = 0;";

                                // fletch data
                                $result = $db->query($sql);

                                // fletch data
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == @$status) { ?> selected <?php } ?>><?php echo $row['courier_status']; ?></option>
                                <?php

                                    }
                                }
                                ?>
                            </select><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tracking Number <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="tracking_number" value="<?php echo @$tracking_number ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dispatch Date at Warehouse : <span style="color: red;">*</span></label>
                                <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="dispatch_date" value="<?php echo @$dispatch_date ?>" min="<?php echo date("Y-m-d") ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="order_id" value="<?php echo @$order_id ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="<?php echo $btn_value ?>"><?php echo $btn_icon ?> <?php echo $btn_name ?></button>
                        </div>

                    </form>

                    <!-- /.card-body -->
                </div>

            </div>
            <div class="col">
                <!-- Table Data Fletch -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php

                        //  customers details fetch
                        $sql = "SELECT o.order_number, o.order_date, dd.frist_name, dd.last_name, pm.name, p.price, dd.city, o.order_id, cs.courier_status, dd.phone, dd.email, dd.address_line_1, dd.address_line_2, dd.city FROM orders o INNER JOIN delivery_details dd ON dd.order_id = o.order_id INNER JOIN payment_methord pm ON pm.id = o.payment_id INNER JOIN province p ON p.id = o.delivery_charge INNER JOIN courier_status cs ON cs.id = o.courier_status WHERE o.order_id = $order_id;";

                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                        ?>

                                <p>Order Number : <?php echo   $row['order_number']; ?></p>
                                <p>Order Date : <?php echo  $row['order_date']; ?></p>
                                <p>Delivery Charge : LKR: <?php echo  $row['price']; ?></p>
                                <p>Delivery Status : <?php echo  $row['courier_status']; ?></p>
                                <p>Payment Method : <?php echo $row['name'] ?> </p>
                                <hr>
                                <h5>Customer Details</h5>
                                <hr>
                                <p>Customer Name : <?php echo   $row['frist_name'] . " " . $row['last_name'] ?></p>
                                <p>Customer Phone : <?php echo  $row['phone']; ?></p>
                                <p>Customer Email : <?php echo  $row['email']; ?></p>
                                <p>Customer Address : <?php echo  $row['address_line_1'] . ", " . $row['address_line_2'] . ", " .  $cus_city = $row['city']  ?></p>
                                <div style="display: flex;justify-content: space-evenly;">
                                    <div style="width:auto">
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                            <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                            <button type="submit" name="action" value="edit" class="btn btn-block btn-primary btn-l"><i class="fas fa-edit"></i> Edit</button>
                                        </form>
                                    </div>

                                    <div style="width: auto;">
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                            <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                            <button type="submit" name="action" value="delete" class="btn btn-block btn-danger btn-l"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>


                        <?php

                            }
                        }

                        ?>

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
<?php ob_end_flush(); ?>