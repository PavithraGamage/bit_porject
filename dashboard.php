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
                <!-- <h4> <i class="fas fa-tachometer-alt"></i> Dashboard</h4> -->
                <div class="row dash_info_box_row">
                    <div class="col-3 dash_info_box">
                        <div class="row">
                            <div class="col-9">
                                <h6> <i class="fas fa-shopping-cart"></i> Orders</h6>
                            </div>
                            <div class="col-3">
                                <h6 class="dash_info_box_number">18</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 dash_info_box">
                        <div class="row">
                            <div class="col-9">
                                <h6> <i class="fas fa-charging-station"></i> Warranty</h6>
                            </div>
                            <div class="col-3">
                                <h6 class="dash_info_box_number">25</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 dash_info_box">
                        <div class="row">
                            <div class="col-9">
                                <h6>  <i class="fas fa-truck"></i> Delivery</h6>
                            </div>
                            <div class="col-3">
                                <h6 class="dash_info_box_number">10</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row dash_info_box_row">

                    <div class="col-3 dash_info_box">
                        <div class="row">
                            <div class="col-9">
                                <h6> <i class="fas fa-calendar-check"></i> Appointments</h6>
                            </div>
                            <div class="col-3">
                                <h6 class="dash_info_box_number">12</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 dash_info_box">
                        <div class="row">
                            <div class="col-9">
                                <h6> <i class="fas fa-tools"></i> Troubleshoots</h6>
                            </div>
                            <div class="col-3">
                                <h6 class="dash_info_box_number">16</h6>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!--dashboard end-->
    </div>
</div>


<?php include 'ui/site_footer.php'; ?>