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
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- fontawesome icons-->
    <link href="assets/icons/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!--Navigation Start-->
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light nav_sys">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/bit/">
                    <!--                        <img src="images/logo.png" alt="" class="nav_logo">-->
                    <img src="images/logo_new.png" alt="" class="nav_logo" />
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
    <!--Hero Section End-->
    <!-- content start-->
    <div class="container">
        <div class="row item_row_main">
            <!--empty cart warnning start-->
            <!--        <div class="row empty_cart">
                    <div class="col">
                        <div> Your Cart Empty !</div>
                    </div>
                    <div class="col empry_cart_btn_col">
                        <a href="processors.php">
                            <button type="button" class="btn btn-secondary card_button">Shop Now</button>
                        </a>    
                    </div>
                </div>-->
            <!--empty cart warnning end-->
            <!--cart content start-->
            <div class="row">
                <div class="row">
                    <div class="col">
                        <h3>10 Items in Your Cart</h3>
                    </div>
                    <div class="col cart_remove_all">
                        <a href="">
                            <button type="button" class="btn btn-secondary card_button"> <i class="fa fa-trash" aria-hidden="true"></i> Remove All</button>
                        </a>
                    </div>
                </div>

                <!--cart item start-->
                <div class="row cart_items">
                    <div class="col-2">
                        <img src="images/amd_ryzen_r9_3900x.png" alt="" class="cart_item_image" />
                    </div>
                    <div class="col-5">
                        <div>
                            <h6>AMD Ryzen 9 3rd Gen - RYZEN 9 3900X</h6>
                        </div>
                        <div>
                            5 Items in Stock
                        </div>
                    </div>
                    <div class="col-1">
                        <h6>No Items</h6>
                        <input type="text" class="form-control" id="formGroupExampleInput">
                    </div>
                    <div class="col-2 ">

                        <div class="cart_price">
                            <h6>156,000 LKR</h6>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="col empry_cart_btn_col">
                            <a href="">
                                <button type="button" class="btn btn-secondary card_button"> <i class="fa fa-trash" aria-hidden="true"></i> Remove Item</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!--cart item end-->
                <div class="row cart_items">
                    <div class="col-2">
                        <img src="images/1919-20210908081112-add.png" alt="" class="cart_item_image" />
                    </div>
                    <div class="col-5">
                        <div>
                            <h6>Addlink Spider 4 32GB (16X2) DDR4 3200Mhz Gaming Memory</h6>
                        </div>
                        <div>
                            5 Items in Stock
                        </div>
                    </div>
                    <div class="col-1">
                        <h6>No Items</h6>
                        <input type="text" class="form-control" id="formGroupExampleInput">
                    </div>
                    <div class="col-2 ">
                        <div class="cart_price">
                            <h6>156,000 LKR</h6>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="col empry_cart_btn_col">
                            <a href="">
                                <button type="button" class="btn btn-secondary card_button"> <i class="fa fa-trash" aria-hidden="true"></i> Remove Item</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row cart_items">
                    <div class="col-2">

                        <img src="images/1959-20210603122835-ROG-STRIX-RTX3060-12G-GAMING_box+vga+logo 2000.png" alt="" class="cart_item_image" />
                    </div>
                    <div class="col-5">
                        <div>
                            <h6>AMD Ryzen 9 3rd Gen - RYZEN 9 3900X</h6>
                        </div>
                        <div>
                            5 Items in Stock
                        </div>
                    </div>
                    <div class="col-1">
                        <h6>No Items</h6>
                        <input type="text" class="form-control" id="formGroupExampleInput">
                    </div>
                    <div class="col-2 ">

                        <div class="cart_price">
                            <h6>156,000 LKR</h6>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="col empry_cart_btn_col">
                            <a href="">
                                <button type="button" class="btn btn-secondary card_button"> <i class="fa fa-trash" aria-hidden="true"></i> Remove Item</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6 cart_total">
                        <h4 class="cart_summary">Cart Summary</h4>
                        <div class="row">
                            <div class="col-5">
                                <div>
                                    <h6>Item(s):</h6>
                                </div>
                                <hr>
                                <div>
                                    <h6>Warranty & Service:</h6>
                                </div>
                                <hr>
                                <div>
                                    <h4>Est. Total:</h4>
                                </div>
                            </div>
                            <div class="col-7">
                                <div>
                                    <h6>156,000 LKR</h6>
                                </div>
                                <hr>
                                <div>
                                    <h6>8,000 LKR</h6>
                                </div>
                                <hr>


                                <div>
                                    <h4>267,500 LKR</h4>
                                </div>
                                <a href="checkout.php">
                                    <button type="button" class="btn btn-secondary cart_checkout_button"> CHECKOUT ORDER </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--cart content end-->
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
<!-- footer end -->