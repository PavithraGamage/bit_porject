
<!--
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */-->

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap css -->
        <link href="bootstrap/css/bootstrap-grid.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap-reboot.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap-utilities.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>

        <!-- Bootstrap js -->
        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.esm.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>

        <!--font ausuome icons-->
        <link href="icons/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" type="text/css"/>

        <!-- Custom Styles -->
        <link href="styles/dashboard.css" rel="stylesheet" type="text/css"/>

        <title></title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <!--left contents-->
                <div class="col-12 main_col_1"">
                    <div class="row">
                        <!--logo-->
                        <div class="col company_name_box">
                            
                            <img src="images/logo.png" alt="" class="company_image">
                        </div>
                        <!--clock-->
                        <div class="col clock_box">
                            <div class="clock_time">10:58 PM</div>
                            <div class="clock_date">12/10/2021</div>
                        </div>
                        <!--search-->
                        <div class="col search_box">
                            <form>
                                <div class="row">
                                    <div class="col input_col">
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="col search_btn">
                                        <button type="submit" class="btn btn-primary submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--notification-->
                        <div class="col notification_box">
                            <i class="fas fa-bell bell"></i>
                        </div>
                        <!--help-->
                        <div class="col help_box">
                            <i class="far fa-life-ring ring"></i>
                        </div>
                        <!--profile-->
                        <div class="col profile_box">
                            <div class="row ">
                                <div class="col profle_name">
                                    <div class="profile_grreting">Good Morning</div>
                                    <div class="profile_name">P.Samaranayake</div>
                                </div>
                                <div class="col dropdown">
                                    <img  class="profile_pic" src="images/blank-profile-picture-973460_640.png" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Edit Profile</a>
                                        <a class="dropdown-item" href="#">Log Out</a>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <!--main content-->
                    <div class="row">
                        <!-- left menu-->
                        <div class="col menu_col">
                            <a href="dashboard.php" class="nav_items">
                                <div class="row menu_row">

                                    <div class="col">
                                        <div>
                                            <i class="fas fa-tachometer-alt"></i> Dashboard
                                        </div>
                                    </div>

                                </div>
                            </a>
                            <a href="orders.php" class="nav_items">
                                <div class="row menu_row">

                                    <div class="col">
                                        <div><i class="fas fa-cart-arrow-down"></i> Orders</div>
                                    </div>

                                </div>
                            </a>
                            <a href="warranty.php" class="nav_items">
                                <div class="row menu_row">

                                    <div class="col">
                                        <div><i class="fas fa-charging-station"></i> Warranty</div>
                                    </div>

                                </div>
                            </a>
                            <a href="delivery.php" class="nav_items">
                                <div class="row menu_row">

                                    <div class="col">
                                        <div><i class="fas fa-shipping-fast"></i> Deliveries</div>
                                    </div>

                                </div>
                            </a>
                            <a href="repairs.php" class="nav_items">
                                <div class="row menu_row">

                                    <div class="col">
                                        <div><i class="fas fa-cogs"></i> Repairs</div>
                                    </div>

                                </div>
                            </a>
                        </div>
                        <!--dashboard content area-->
                        <div class="col conent_col">

                            <h1 class="title"><i class="fas fa-shipping-fast"></i> Deliveries</h1>


                        </div>
                    </div>
                </div>
                <!--right contents-->

            </div>
        </div>
    </body>
</html>