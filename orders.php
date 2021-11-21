<?php include 'ui/system_page_header.php'; ?>


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
            <div class="col-10 dash_content">

                <div class="page_tables">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="table_head">#</th>
                                <th scope="col" class="table_head">Date</th>
                                <th scope="col" class="table_head">Discription</th>
                                <th scope="col" class="table_head">Total</th>
                                <th scope="col" class="table_head">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="table_body">1</th>
                                <td class="table_body">12/10/2021</td>
                                <td class="table_body">AMD R9 3600X, ASUS B450 TUF Plus Gamming AMD R9 3600X,... </td>
                                <td class="table_body">RS: 585,000</td>
                                <td>
                                    <button>VIEW</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="table_body">2</th>
                                <td class="table_body">12/10/2021</td>
                                <td class="table_body">AMD R9 3600X, ASUS B450 TUF Plus Gamming AMD R9 3600X,... </td>
                                <td class="table_body">RS: 585,000</td>
                                <td>
                                    <button>VIEW</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="table_body">3</th>
                                <td class="table_body">12/10/2021</td>
                                <td class="table_body">AMD R9 3600X, ASUS B450 TUF Plus Gamming AMD R9 3600X,...</td>
                                <td class="table_body">RS: 585,000</td>
                                <td>
                                    <button>VIEW</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>


                </div>




            </div>
        </div>


        <!--dashboard end-->
    </div>
</div>


<?php include 'ui/site_footer.php'; ?>