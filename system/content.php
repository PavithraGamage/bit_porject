<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <?php

    // dynamic dashboard for shop manager
    if ($_SESSION['user_role'] == 1) {

    ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <?php
                                // orders count
                                $sql = "SELECT COUNT(*) FROM orders";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $order_count =  $row['COUNT(*)'];
                                    }
                                }
                                ?>
                                <h3><?php echo $order_count ?></h3>

                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/orders/add.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM items";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $items_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $items_count ?></h3>

                                <p>Total Items</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/inventory/add.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM items WHERE stock = 0";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $staff_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $staff_count ?></h3>

                                <p>Out of Stock Items</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-box-open"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/inventory/add.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM customers";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $customer_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $customer_count ?></h3>

                                <p>Registered Customers</p>
                            </div>
                            <div class="icon">

                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/users/view_cus.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM staff";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $staff_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $staff_count ?></h3>

                                <p>Staff Members</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/users/view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <?php
                                // orders count
                                $sql = "SELECT COUNT(*) FROM orders WHERE courier_status = 8";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $delivery_count =  $row['COUNT(*)'];
                                    }
                                }
                                ?>
                                <h3><?php echo $delivery_count ?></h3>

                                <p>Total Deliveries</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/deliveries/list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    <?php
    }

    ?>

    <?php

    // dynamic dashboard for delivery manager
    if ($_SESSION['user_role'] == 2) {

    ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <?php
                                // orders count
                                $sql = "SELECT COUNT(*) FROM courier_companies";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $company_count =  $row['COUNT(*)'];
                                    }
                                }
                                ?>
                                <h3><?php echo $company_count ?></h3>

                                <p>Delivery Companies</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/delivery/companies/add.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <?php
                                // orders count
                                $sql = "SELECT COUNT(*) FROM orders WHERE courier_status = 8";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $delivery_count =  $row['COUNT(*)'];
                                    }
                                }
                                ?>
                                <h3><?php echo $delivery_count ?></h3>

                                <p>Total Deliveries</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/deliveries/list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM orders WHERE courier_status in (6)";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $pending_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $pending_count ?></h3>

                                <p>Pending Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="http://localhost/bit/system/delivery/orders/view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    <?php
    }

    ?>


    <?php

    // dynamic dashboard for technician
    if ($_SESSION['user_role'] == 3) {

    ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php
                                // orders count
                                $sql = "SELECT COUNT(*) FROM orders WHERE courier_status IN (6,7,8)";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $complete_count =  $row['COUNT(*)'];
                                    }
                                }
                                ?>
                                <h3><?php echo $complete_count ?></h3>

                                <p>Complete Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="http://localhost/bit/system/orders/process/add.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM orders WHERE courier_status in (3,5)";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $pending_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $pending_count ?></h3>

                                <p>Pending Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="http://localhost/bit/system/orders/process/add.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    <?php
    }

    ?>


    <?php

    // dynamic dashboard for administrator
    if ($_SESSION['user_role'] == 4) {

    ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM customers";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $customer_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $customer_count ?></h3>

                                <p>Registered Customers</p>
                            </div>
                            <div class="icon">

                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/users/view_cus.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*) FROM staff";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $staff_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $staff_count ?></h3>

                                <p>Registered Staff Members</p>
                            </div>
                            <div class="icon">

                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/reports/users/view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*)FROM `modules` WHERE LENGTH(module_id) = '2';";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $main_mods_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $main_mods_count ?></h3>

                                <p>Main Modules</p>
                            </div>
                            <div class="icon">

                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/users/modules/add.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <?php

                                //items count
                                $sql = "SELECT COUNT(*)FROM `modules` WHERE LENGTH(module_id) = '4';";

                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $sub_mods_count =  $row['COUNT(*)'];
                                    }
                                }

                                ?>
                                <h3><?php echo $sub_mods_count ?></h3>

                                <p>Sub Modules</p>
                            </div>
                            <div class="icon">

                                <i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <a href="http://localhost/bit/system/users/modules/add_sub.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    <?php
    }

    ?>

<?php

// dynamic dashboard for inventory manager
if ($_SESSION['user_role'] == 6) {

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php

                            //items count
                            $sql = "SELECT COUNT(*) FROM brands";

                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $brands_count =  $row['COUNT(*)'];
                                }
                            }

                            ?>
                            <h3><?php echo $brands_count ?></h3>

                            <p>Total Brands</p>
                        </div>
                        <div class="icon">

                        <i class="fa fa-copyright" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php

                            //items count
                            $sql = "SELECT COUNT(*) FROM categories";

                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $categories_count =  $row['COUNT(*)'];
                                }
                            }

                            ?>
                            <h3><?php echo $categories_count ?></h3>

                            <p>Total Catagories</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php

                            //items count
                            $sql = "SELECT COUNT(*)FROM models";

                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $models_count =  $row['COUNT(*)'];
                                }
                            }

                            ?>
                            <h3><?php echo $models_count ?></h3>

                            <p>Total Models</p>
                        </div>
                        <div class="icon">

                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php

                            //items count
                            $sql = "SELECT COUNT(*)FROM items";

                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $items_count =  $row['COUNT(*)'];
                                }
                            }

                            ?>
                            <h3><?php echo $items_count ?></h3>

                            <p>Total Items</p>
                        </div>
                        <div class="icon">

                        <i class="fa fa-microchip" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
}

?>


</div>