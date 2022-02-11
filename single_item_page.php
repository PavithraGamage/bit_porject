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

<!-- content start-->
<div class="container">
    <div class="row item_row_main">
        <div class="row">
            <!--product image-->
            <div class="col-6">
                <div class="image_box">
                    <img src="images/amd_ryzen_r9_3900x.png" alt="" class="item_image"/>
                </div>
                             
            </div>

            <!--second content box-->
            <div class="col-6">

                <h2>AMD Ryzen - 9 3900X </h2>
                <hr>    
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <h4 class="price_hedding" >RS: 155,000</h4>
                <div class="col cart_button">
                    <a href="cart.php">
                        <button type="button" class="btn btn-secondary item_btn">Add to Cart <i class="fas fa-cart-arrow-down"></i></button>
                    </a>
                </div>

            </div>

        </div>
        <div class="row">

            <div class="item_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="item_table_col">Item Features</th>
                            <th scope="col">Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Brand</th>
                            <td>AMD</td>

                        </tr>
                        <tr>
                            <th scope="row">Product Family</th>
                            <td>AMD Ryzen™ Processors</td>

                        </tr>
                        <tr>
                            <th scope="row">Product Line</th>
                            <td>AMD Ryzen™ 9 Desktop Processors</td>

                        </tr>
                        <tr>
                            <th scope="row">CPU Cores</th>
                            <td>12</td>

                        </tr>
                        <tr>
                            <th scope="row">CPU Threads</th>
                            <td>24</td>

                        </tr>
                        <tr>
                            <th scope="row">Max Boost Clock</th>
                            <td>Up to 4.6GHz</td>

                        </tr>
                        <tr>
                            <th scope="row">Base Clock</th>
                            <td>3.8GHz</td>

                        </tr>
                        <tr>
                            <th scope="row">Total L1 Cache</th>
                            <td>768KB</td>

                        </tr>
                        <tr>
                            <th scope="row">Total L2 Cache</th>
                            <td>6MB</td>

                        </tr>
                        <tr>
                            <th scope="row">Total L3 Cache</th>
                            <td>64MB</td>

                        </tr>
                        <tr>
                            <th scope="row">Default TDP</th>
                            <td>105W</td>

                        </tr>
                        <tr>
                            <th scope="row">CMOS</th>
                            <td>TSMC 7nm FinFET</td>

                        </tr>
                        <tr>
                            <th scope="row">Unlock for Overclocking</th>
                            <td>Yes</td>

                        </tr>
                        <tr>
                            <th scope="row">CPU Socket</th>
                            <td>AM4</td>

                        </tr>


                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>
<!-- content end-->

<!-- footer start -->
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