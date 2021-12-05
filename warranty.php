<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));  ?></title>
        
        <!-- main style -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>


        <!--fontawesome icons-->
        <link href="assets/icons/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" type="text/css"/>


     
    </head>
    <body>
        <!--Navigation Start-->
        <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light nav_sys">
                <div class="container-fluid">
                    <a class="navbar-brand" href="http://localhost/bit/">
<!--                        <img src="images/logo.png" alt="" class="nav_logo">-->
                        <img src="images/logo_new.png" alt=""  class="nav_logo" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link sys_nav_link" aria-current="page" href="http://localhost/bit/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sys_nav_link" href="http://localhost/bit/shop.php">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sys_nav_link" href="http://localhost/bit/about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sys_nav_link" href="http://localhost/bit/services.php">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sys_nav_link" href="http://localhost/bit/contact.php">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sys_nav_link" href="http://localhost/bit/dashboard.php"> <i class="fas fa-user"></i> My Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sys_nav_link" href="http://localhost/bit/cart.php"> <i class="fas fa-cart-arrow-down"></i> Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!--Navigation End-->


<div class="container">
    <div class="row item_row_main">
        <!--headder row start-->
        <div class="row dash_hedding_row">
            <div class="col-6">
                <h4> <i class="fas fa-tachometer-alt"></i> Dashboard</h4>
            </div>
            <!-- header section nav -->
            <div class="col-6">
                <div class="row">
                    <!-- image and name -->
                    <div class="col-8">
                        <div class="row">
                            <div class="col-6 dash_image_box">
                                <img src="images/blank-profile-picture-973460_640.png" class="dash_image" alt="" />
                            </div>
                            <div class="col-6 dash_name_box">
                                <h6>A.P.K Samaranayake</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 dash_notifcation_box">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="col-2 dash_notifcation_box">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!--headder row end-->

        <!--dashboard start-->

        <div class="row">
            <div class="col-2 dash_content_nav">
                <div class="dash_left_nav_first">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </div>
                <div class="dash_left_nav">
                    <i class="fas fa-shopping-cart"></i> Orders
                </div>
                <div class="dash_left_nav">
                    <i class="fas fa-charging-station"></i> Warranty
                </div>
                <div class="dash_left_nav">
                    <i class="fas fa-truck"></i> Delivery
                </div>
                <div class="dash_left_nav">
                    <i class="fas fa-calendar-check"></i> Appointments
                </div>
                <div class="dash_left_nav">
                    <i class="fas fa-tools"></i> Troubleshoots
                </div>
                <div class="dash_left_nav_last">
                    <i class="fas fa-life-ring"></i> Help
                </div>
            </div>
            <!-- Dashboard Content Area Start -->
            <div class="col-10 dash_content">
                <div class="page_tables">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="table_head">#</th>
                                <th scope="col" class="table_head">Invoice Number</th>
                                <th scope="col" class="table_head">Purchase Date</th>
                                <th scope="col" class="table_head">Warranty Status</th>
                                <th scope="col" class="table_head">Item</th>
                                <th scope="col" class="table_head">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="table_body">1</th>
                                <td class="table_body">1021</td>
                                <td class="table_body">12/10/2021</td>
                                <td class="table_body">156 Days Remaining</td>
                                <td class="table_body">AMD Ryzen 9 3900X </td>
                                <td>
                                    <a href="http://localhost/bit/claim_warranty.php">
                                    <button>Claim Warranty</button>
                                    </a>                                  
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="table_body">2</th>
                                <td class="table_body">1022</td>
                                <td class="table_body">12/11/2021</td>
                                <td class="table_body">No Warranty</td>
                                <td class="table_body">Havit Gaming Mouse</td>
                                <td>
                                    <button>No Action</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Dashbaord Content Area End -->
            </div>
        </div>


        <!--dashboard end-->
    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <!--<img src="images/cmaplus-logo-blue-big copy._w.png" alt="" class="footer_logo"/>-->
                <img src="images/logo_new.png" alt="" class="footer_logo" />
                <hr class="footer_hr">
                <p class="footer_company">

                    We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                    We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                    We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                    We can print a range of full color, quality printed products, which you can order online or ask us for a special price.
                </p>
            </div>
            <div class="col-2">
                <h2 class="footer_title">Company</h2>
                <hr class="footer_hr_2">
                <p class="footer_items">About</p>
                <p class="footer_items">Contact</p>
                <p class="footer_items">Service</p>
                <p class="footer_items">Company</p>
            </div>
            <div class="col-2">
                <h2 class="footer_title">Quick Links</h2>
                <hr class="footer_hr_2">
                <p class="footer_items">FAQ</p>
                <p class="footer_items">Privacy Policy</p>
                <p class="footer_items">Return Policy</p>
                <p class="footer_items">Company</p>
            </div>
        </div>
    </div>
</footer>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>


</body>
</html>