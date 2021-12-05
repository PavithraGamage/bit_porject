<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));  ?></title>
        
        <! -- main style -->
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

<!-- content start -->
<div class="container">
    <div class="row shop_row">
        <div class="col-2 wig_bar">
            <div class="row wig">
                <h6 class="wig_title">Price</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="range" class="range_slider" id="price_range" />
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">Brand</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="brand_id_1">
                    <label class="form-check-label wig_lable" for="brand_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="brand_id_2">
                    <label class="form-check-label wig_lable" for="brand_id_2">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">Product Family</h6> 
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="family_id_1">
                    <label class="form-check-label wig_lable" for="family_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="family_id_2">
                    <label class="form-check-label wig_lable" for="family_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="family_id_3">
                    <label class="form-check-label wig_lable" for="family_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="family_id_4">
                    <label class="form-check-label wig_lable" for="family_id_4">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="family_id_5">
                    <label class="form-check-label wig_lable" for="family_id_5">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="family_id_6">
                    <label class="form-check-label wig_lable" for="family_id_6">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="family_id_7">
                    <label class="form-check-label wig_lable" for="family_id_7">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="family_id_8">
                    <label class="form-check-label wig_lable" for="family_id_8">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">Product Line</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="product_family_id_1">
                    <label class="form-check-label wig_lable" for="product_family_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="product_family_id_2">
                    <label class="form-check-label wig_lable" for="product_family_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="product_family_id_3">
                    <label class="form-check-label wig_lable" for="product_family_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="product_family_id_4">
                    <label class="form-check-label wig_lable" for="product_family_id_4">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="product_family_id_5">
                    <label class="form-check-label wig_lable" for="product_family_id_5">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="product_family_id_6">
                    <label class="form-check-label wig_lable" for="product_family_id_6">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="product_family_id_7">
                    <label class="form-check-label wig_lable" for="product_family_id_7">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="product_family_id_8">
                    <label class="form-check-label wig_lable" for="product_family_id_8">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">CPU Cores</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="cpu_core_id_1">
                    <label class="form-check-label wig_lable" for="cpu_core_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="cpu_core_id_2">
                    <label class="form-check-label wig_lable" for="cpu_core_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="cpu_core_id_3">
                    <label class="form-check-label wig_lable" for="cpu_core_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="cpu_core_id_4">
                    <label class="form-check-label wig_lable" for="cpu_core_id_4">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">CPU Threads</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="cpu_threads_id_1">
                    <label class="form-check-label wig_lable" for="cpu_threads_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="cpu_threads_id_2">
                    <label class="form-check-label wig_lable" for="cpu_threads_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="cpu_threads_id_3">
                    <label class="form-check-label wig_lable" for="cpu_threads_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="cpu_threads_id_4">
                    <label class="form-check-label wig_lable" for="cpu_threads_id_4">INTEL</label> 
                </div>
            </div>
            <div class="row wig">

                <h6 class="wig_title">Max Boost Clock</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="range" class="range_slider" id="price_range" />
                </div>

            </div>
            <div class="row wig">


                <h6 class="wig_title">Base Clock</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="range" class="range_slider" id="price_range" />
                </div>

            </div>
            <div class="row wig">
                <h6 class="wig_title">Total L1 Cache</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="l1_cache_id_1">
                    <label class="form-check-label wig_lable" for="l1_cache_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="l1_cache_id_2">
                    <label class="form-check-label wig_lable" for="l1_cache_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="l1_cache_id_3">
                    <label class="form-check-label wig_lable" for="l1_cache_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="l1_cache_id_4">
                    <label class="form-check-label wig_lable" for="l1_cache_id_4">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">Total L2 Cache</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="l2_cache_id_1">
                    <label class="form-check-label wig_lable" for="l2_cache_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="l2_cache_id_2">
                    <label class="form-check-label wig_lable" for="l2_cache_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="l2_cache_id_3">
                    <label class="form-check-label wig_lable" for="l2_cache_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="l2_cache_id_4">
                    <label class="form-check-label wig_lable" for="l2_cache_id_4">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">Total L3 Cache</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="l3_cache_id_1">
                    <label class="form-check-label wig_lable" for="l3_cache_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="l3_cache_id_2">
                    <label class="form-check-label wig_lable" for="l3_cache_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="l3_cache_id_3">
                    <label class="form-check-label wig_lable" for="l3_cache_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="l3_cache_id_4">
                    <label class="form-check-label wig_lable" for="l3_cache_id_4">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                Default TDP
            </div>
            <div class="row wig">
                <h6 class="wig_title">CMOS</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="cmos_id_1">
                    <label class="form-check-label wig_lable" for="cmos_id_1">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="cmos_id_2">
                    <label class="form-check-label wig_lable" for="cmos_id_2">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="cmos_id_3">
                    <label class="form-check-label wig_lable" for="cmos_id_3">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="cmos_id_4">
                    <label class="form-check-label wig_lable" for="cmos_id_4">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">Unlock for Overclocking</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="over_clock_yes">
                    <label class="form-check-label wig_lable" for="over_clock_yes">INTEL</label> 
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="over_clock_no">
                    <label class="form-check-label wig_lable" for="over_clock_no">INTEL</label> 
                </div>
            </div>
            <div class="row wig">
                <h6 class="wig_title">CPU Socket</h6>
                <div>
                    <hr class="wig_hr">
                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input   wig_input" id="cpu_socket_id_1">
                    <label class="form-check-label wig_lable" for="cpu_socket_id_1">INTEL</label> 

                </div>
                <div class="wig_items">
                    <input type="checkbox" class="form-check-input wig_input" id="cpu_socket_id_2">
                    <label class="form-check-label wig_lable" for="cpu_socket_id_2">INTEL</label> 
                </div>
            </div>
        </div>
        <div class="col-10">
            <div class="row shop_main_row">
                <div class="col-3">
                    <div class="card card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">AMD RYZEN R9 3900X</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <a href="single_item_page.php">
                                <button type="button" class="btn btn-secondary card_button">View Item</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <a href="about.php">
                                <button type="button" class="btn btn-secondary card_button">View Item</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card  card_styles" >
                        <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="catagory_card_title">INTEL CORE I3 - 4590</h1>
                            <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                            <button type="button" class="btn btn-secondary card_button">View Item</button>
                        </div>
                    </div>
                </div>

            </div> 
        </div>
    </div>
</div>
<!-- content end -->

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