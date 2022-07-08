<?php

# notifications for order table -------------------------------------

# notification id 0 = new order received
# notification id 1 = order viewed by shop manager
# notification id 2 = order viewed by delivery manager
# notification id 3 = order viewed by technician

// db connection
$db = db_con();

// orders count
$sql = "SELECT COUNT(*) FROM orders WHERE notifications = 0";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notification_count =  $row['COUNT(*)'];
    }
}

// user count
$sql = "SELECT COUNT(*) FROM users WHERE user_role = 5 AND u_notification = 0";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_notification_count =   $row['COUNT(*)'];
    }
}


// out of stock count
$sql = "SELECT COUNT(*) FROM `items` WHERE stock_status = 1";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $out_stock_notification_count =   $row['COUNT(*)'];
    }
}


// low stock count
$sql = "SELECT COUNT(*) FROM `items` WHERE item_notification = 1";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $low_stock_notification_count =   $row['COUNT(*)'];
    }
}

//pending delivery count for delivery manager
$sql = "SELECT COUNT(*) FROM orders WHERE courier_status in (6)  AND notifications = 1";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pending_count =  $row['COUNT(*)'];
    }
}

// pending order count for technician
$sql = "SELECT COUNT(*) FROM orders WHERE courier_status in (3) AND notifications = 1";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pending_count =  $row['COUNT(*)'];
    }
}

?>
<style>
    .dropdown-menu-lg {
        max-width: none !important;
    }
</style>


<?php

// shop manager navigation
if ($_SESSION['user_role'] == 1) {

?>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">
                        <?php echo $notification_count  + $user_notification_count + $out_stock_notification_count + $low_stock_notification_count ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 450px;">
                    <span class="dropdown-item dropdown-header"><?php echo $notification_count  + $user_notification_count + $out_stock_notification_count + $low_stock_notification_count ?> Notifications</span>
                    <?php

                    // order notification
                    $sql = "SELECT o.order_id, o.order_number, o.order_date, o.order_time, u.first_name
                FROM orders o
                INNER JOIN users u ON u.user_id = o.user_id
                WHERE o.notifications = 0  
                ORDER BY `o`.`order_date` DESC , o.order_time DESC;";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/orders/received/view.php" method="get" id="notification_form<?php echo $row['order_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_order_id" value="<?php echo $row['order_id'] ?>">

                                <a onclick="submit_form<?php echo $row['order_id'] ?>();" class="dropdown-item">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> New Order from <?php echo  $row['first_name'] ?>
                                    <span class="float-right text-muted text-sm"><?php echo  $row['order_date'] . " at " . $row['order_time'] ?> </span>
                                </a>

                            </form>
                            <script>
                                function submit_form<?php echo $row['order_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['order_id'] ?>").submit();
                                }
                            </script>


                    <?php
                        }
                    }
                    ?>

                    <?php

                    // customer notification

                    $sql = "SELECT user_id, user_name, created_date FROM users WHERE user_role = 5 AND u_notification = 0";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/reports/users/view_cus.php" method="get" id="notification_form<?php echo $row['user_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_user_id" value="<?php echo $row['user_id'] ?>">

                                <a onclick="submit_form<?php echo $row['user_id'] ?>();" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i> New Customer Registered as <?php echo ucfirst($row['user_name'])  ?>
                                    <span class="float-right text-muted text-sm"><?php echo $row['created_date'] ?></span>
                                </a>
                            </form>
                            <script>
                                function submit_form<?php echo $row['user_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['user_id'] ?>").submit();
                                }
                            </script>
                    <?php

                        }
                    }

                    ?>

                    <?php

                    // out of stock notification
                    $sql = "SELECT * FROM `items` WHERE stock_status = 1";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/reports/inventory/add.php" method="get" id="notification_form<?php echo $row['item_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_item_id" value="<?php echo $row['item_id'] ?>">

                                <a onclick="submit_form<?php echo $row['item_id'] ?>();" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i><?php echo ucfirst($row['item_name'])  ?> Out of Stock

                                </a>
                            </form>
                            <script>
                                function submit_form<?php echo $row['item_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['item_id'] ?>").submit();
                                }
                            </script>
                    <?php

                        }
                    }

                    ?>

                    <?php

                    // low stock notification
                    $sql = "SELECT * FROM `items` WHERE item_notification = 1";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/reports/inventory/add.php" method="get" id="notification_form<?php echo $row['item_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_item_id_low_stock" value="<?php echo $row['item_id'] ?>">

                                <a onclick="submit_form<?php echo $row['item_id'] ?>();" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i><?php echo ucfirst($row['item_name'])  ?> Low in Stock

                                </a>
                            </form>
                            <script>
                                function submit_form<?php echo $row['item_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['item_id'] ?>").submit();
                                }
                            </script>
                    <?php

                        }
                    }

                    ?>

                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL; ?>logout.php">
                    Log Out
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

<?php
}

?>


<?php

// delivery manager navigation
if ($_SESSION['user_role'] == 2) {

?>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">
                        <?php echo $pending_count  ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 450px;">
                    <span class="dropdown-item dropdown-header"><?php echo $pending_count ?> Notifications</span>
                    <?php

                    // order notification
                    $sql = "SELECT * 
                    FROM orders o
                    INNER JOIN delivery_details dd ON dd.order_id = o.order_id
                    WHERE o.courier_status = 6 AND o.notifications = 1";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/delivery/orders/view.php" method="get" id="notification_form<?php echo $row['order_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_order_id" value="<?php echo $row['order_id'] ?>">

                                <a onclick="submit_form<?php echo $row['order_id'] ?>();" class="dropdown-item">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> New Order to <?php echo  $row['city'] ?>
                                    <span class="float-right text-muted text-sm"><?php echo  $row['order_date'] . " at " . $row['order_time'] ?> </span>
                                </a>

                            </form>
                            <script>
                                function submit_form<?php echo $row['order_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['order_id'] ?>").submit();
                                }
                            </script>
                    <?php
                        }
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL; ?>logout.php">
                    Log Out
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

<?php

}

?>

<?php

// technician  navigation
if ($_SESSION['user_role'] == 3) {

?>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">
                        <?php echo $pending_count  ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 450px;">
                    <span class="dropdown-item dropdown-header"><?php echo $pending_count ?> Notifications</span>
                    <?php

                    // order notification
                    $sql = "SELECT * FROM orders WHERE courier_status in (3) AND notifications = 1";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/orders/process/add.php" method="get" id="notification_form<?php echo $row['order_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_order_id" value="<?php echo $row['order_id'] ?>">

                                <a onclick="submit_form<?php echo $row['order_id'] ?>();" class="dropdown-item">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo  $row['order_number'] ?> New Order Received
                                    <span class="float-right text-muted text-sm"><?php echo  $row['order_date'] . " at " . $row['order_time'] ?> </span>
                                </a>

                            </form>
                            <script>
                                function submit_form<?php echo $row['order_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['order_id'] ?>").submit();
                                }
                            </script>
                    <?php
                        }
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL; ?>logout.php">
                    Log Out
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->



<?php

}
?>


<?php

// administrator  navigation
if ($_SESSION['user_role'] == 4) {

?>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL; ?>logout.php">
                    Log Out
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->



<?php

}
?>




<?php

// inventory manager  navigation
if ($_SESSION['user_role'] == 6) {

?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">
                        <?php echo $out_stock_notification_count + $low_stock_notification_count ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 450px;">
                    <span class="dropdown-item dropdown-header"><?php echo $out_stock_notification_count + $low_stock_notification_count ?> Notifications</span>
                    <?php

                    // out of stock notification
                    $sql = "SELECT * FROM `items` WHERE stock_status = 1";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/inventory/items/add.php" method="get" id="notification_form<?php echo $row['item_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_item_id" value="<?php echo $row['item_id'] ?>">

                                <a onclick="submit_form<?php echo $row['item_id'] ?>();" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i><?php echo ucfirst($row['item_name'])  ?> Out of Stock

                                </a>
                            </form>
                            <script>
                                function submit_form<?php echo $row['item_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['item_id'] ?>").submit();
                                }
                            </script>
                    <?php

                        }
                    }

                    ?>

                    <?php

                    // low stock notification
                    $sql = "SELECT * FROM `items` WHERE item_notification = 1";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <form action="http://localhost/bit/system/inventory/items/add.php" method="get" id="notification_form<?php echo $row['item_id'] ?>">

                                <div class="dropdown-divider"></div>

                                <input type="hidden" name="notification_item_id_low_stock" value="<?php echo $row['item_id'] ?>">

                                <a onclick="submit_form<?php echo $row['item_id'] ?>();" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i><?php echo ucfirst($row['item_name'])  ?> Low in Stock

                                </a>
                            </form>
                            <script>
                                function submit_form<?php echo $row['item_id'] ?>() {
                                    document.getElementById("notification_form<?php echo $row['item_id'] ?>").submit();
                                }
                            </script>
                    <?php

                        }
                    }

                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL; ?>logout.php">
                    Log Out
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

<?php

}
?>




<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost/bit/system/index.php" class="brand-link">

        <i class="fas fa-globe" style="margin-left: 20px;"></i>
        <span class="brand-text font-weight-light">U-Star Digital</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="http://localhost/bit/assets/images/<?php echo $_SESSION['profile_image'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['first_name'] . " " .  $_SESSION['last_name']; ?></a>

            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php

                $sql = "SELECT m.module_id, m.description, m.path, m.view, m.icon, m.status, um.status
                    FROM users_modules um
                    INNER JOIN modules m ON m.module_id = um.module_id
                    WHERE length(m.module_id) = '2' AND um.user_id ='" . $_SESSION['user_id'] . "' AND m.status = '0' AND um.status = '0' ORDER BY `m`.`nav_order` ASC";

                // assign the query
                $result = $db->query($sql);

                ?>

                <?php

                // check the result grater than 1
                if ($result->num_rows > 0) {

                    // assign the result to row variable
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon <?php echo $row['icon'] ?>"></i>
                                <p>

                                    <?php
                                    //   display module name
                                    echo $row['description'];
                                    ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <?php

                                $sql_sub = "SELECT m.module_id, m.description, m.path, m.view, m.icon, m.status
                                                FROM users_modules um
                                                INNER JOIN modules m ON m.module_id = um.module_id
                                                WHERE length(m.module_id) = '4' AND um.user_id ='" . $_SESSION['user_id'] . "' AND substr(m.module_id, 1,2) = '" . $row['module_id'] . "' AND m.status = '0' AND um.status = '0'";

                                // assign the query
                                $result_sub = $db->query($sql_sub);

                                ?>

                                <?php

                                if ($result_sub->num_rows > 0) {

                                    while ($row_sub = $result_sub->fetch_assoc()) {

                                        // create file path for sub menu 
                                        $file = $row_sub['path'] . "/" . $row_sub['view'] . ".php";
                                ?>
                                        <li class="nav-item">
                                            <a href="<?php echo SITE_URL; ?><?php echo $file; ?>" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p><?php echo $row_sub['description'] ?></p>
                                            </a>
                                        </li>

                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>

                <?php
                    }
                }

                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>