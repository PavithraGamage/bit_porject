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
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!--fontawesome icons-->
        <link href="assets/icons/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!--Navigation Start-->
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/bit/">
                    <!--<img src="images/logo.png" alt="" class="nav_logo">-->
                    <img src="images/logo_new.png" alt="" class="nav_logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="http://localhost/bit/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/bit/shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/bit/about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/bit/services.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/bit/contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/dashboard.php"> <i class="fas fa-user"></i> My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/bit/cart.php"> <i class="fas fa-cart-arrow-down"></i> Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--Navigation End-->

<!--Carousel Start-->
<div class="carousel_cus">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://wallpaperaccess.com/full/654946.jpg"  class="d-block w-100"..."  alt="..." style="height: 590px; object-fit: cover;" >
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="d-block w-100" alt="..." style="height: 590px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="d-block w-100" alt="..." style="height: 590px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!--Carousel End-->

<!--card start-->
<div class="container">
    <div class="row catagory_row">
        <div class="col-3">
            <div class="card card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">PROCESSORS</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <a href="item_page.php">
                        <button type="button" class="btn btn-secondary card_button">View Category</button>
                    </a>                            
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">MOTHERBOARDS</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">MEMORY (RAM)</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">GRAPHIC CARDS</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
    </div>    
    <div class="row catagory_row">
        <div class="col-3">
            <div class="card card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">POWER SUPPLY</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">UPS</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">COOLING & LIGHTING</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">STORAGE</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
    </div> 
    <div class="row catagory_row">
        <div class="col-3">
            <div class="card card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">CASINGS</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">OPTICAL DRIVES</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">MONITORS</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">AUDIO</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
    </div> 
    <div class="row catagory_row">
        <div class="col-3">
            <div class="card card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">KEYBOARDS & MICE</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">CABLES</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">EXTERNAL STORAGE</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card  card_styles" style="width: 18rem;">
                <img src="https://wallpaperaccess.com/full/654946.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h1 class="card_title">SOFTWARE</h1>
                    <p class="card_discription">We can print a range of full colour, quality printed products, which you can order online or ask us for a special price.</p>
                    <button type="button" class="btn btn-secondary card_button">View Category</button>
                </div>
            </div>
        </div>
    </div> 
</div>
<!--card end-->

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