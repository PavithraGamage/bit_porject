<?php 

// dashboard icon with name
$dash = array();

if(empty( $_SESSION['user_id'])){
    header('Location:index.php');

}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "dashboard") {

    $dash['dash_icon'] = '<i class="fas fa-tachometer-alt"></i>';
    $dash['path'] = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "orders") {

    $dash['dash_icon'] = '<i class="fas fa-shopping-cart"></i>';
    $dash['path'] = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "delivery") {

    $dash['dash_icon'] = '<i class="fas fa-truck"></i>';
    $dash['path'] = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "delivery_info") {

    $dash['dash_icon'] = '<i class="fas fa-truck"></i>';
    $dash['path'] = 'Delivary Info';
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "warranty") {

    $dash['dash_icon'] = '<i class="fas fa-charging-station"></i>';
    $dash['path'] = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "warranty_details") {

    $dash['dash_icon'] = '<i class="fas fa-charging-station"></i>';
    $dash['path'] = 'Warranty Details';
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "appointments") {

    $dash['dash_icon'] = '<i class="fas fa-calendar-check"></i>';
    $dash['path'] = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "create_appointment") {

    $dash['dash_icon'] = '<i class="fas fa-calendar-check"></i>';
    $dash['path'] = 'Create Appointment';
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "view_appointment") {

    $dash['dash_icon'] = '<i class="fas fa-calendar-check"></i>';
    $dash['path'] = 'View Appointment';
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "app_single_item") {

    $dash['dash_icon'] = '<i class="fas fa-calendar-check"></i>';
    $dash['path'] = 'Appointment for Item';
}

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == "troubleshoots") {

    $dash['dash_icon'] = '<i class="fas fa-tools"></i>';
    $dash['path'] = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
}
?>

<div class="container">
    <div class="row item_row_main">
        <!--headder row start-->
        <div class="row dash_hedding_row">
            <div class="col-6">
                <h4> <?php echo $dash['dash_icon']?> <?php echo ucfirst($dash['path']) ;  ?></h4>
            </div>
            <!-- header section nav -->
            <div class="col-6">
                <div class="row">
                    <!-- image and name -->
                    <div class="col-8">
                        <div class="row">
                            <div class="col-6 dash_image_box">
                                <img src="http://localhost/bit/assets/images/sulitha_w-1.jpg" class="dash_image" alt="" />
                            </div>
                            <div class="col-6 dash_name_box">
                                <h6><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 dash_notifcation_box">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="col-2 dash_notifcation_box">
                         <a href="logout.php">
                         <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--headder row end-->

        <!--dashboard start-->

        <div class="row">
            <div class="col-2 dash_content_nav">
                <div class="dash_left_nav_first">
                    <a href="dashboard.php" style="text-decoration:none; color:black">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </div>
                <div class="dash_left_nav">
                    <a href="orders.php" style="text-decoration:none; color:black">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                </div>
                <div class="dash_left_nav">
                    <a href="delivery.php" style="text-decoration:none; color:black">
                        <i class="fas fa-truck"></i> Delivery
                    </a>
                </div>
                <div class="dash_left_nav">
                    <a href="warranty.php" style="text-decoration:none; color:black">
                        <i class="fas fa-charging-station"></i> Warranty
                    </a>
                </div>
                <div class="dash_left_nav">
                    <a href="appointments.php" style="text-decoration:none; color:black">
                        <i class="fas fa-calendar-check"></i> Appointments
                    </a>
                </div>
                <div class="dash_left_nav">
                <a href="troubleshoots.php" style="text-decoration:none; color:black">
                    <i class="fas fa-tools"></i> Troubleshoots
                </a>
                </div>
                <div class="dash_left_nav_last">
                    <i class="fas fa-life-ring"></i> Help
                </div>
            </div>