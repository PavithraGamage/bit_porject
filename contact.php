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
                            <a class="nav-link sys_nav_link" href="http://localhost/bit/dashboard/dashboard.php"> <i class="fas fa-user"></i> My Account</a>
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
<!--Hero Section Start-->
<div class="hero">
    <div class="container">
        <h2 class="hero_headding">Contact</h2>
        <hr class="hero_hr">
        <p class="hero_para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
    </div>
</div>
<!--Hero Section End-->
<!-- content start -->
<div class="container">
    <div class="row contact_row">
        <div class="col contact_col">
            <h2>GET IN TOUCH</h2>
            <hr>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'save') {

                    extract($_POST);

                    $name = clean_data($name);
                    $email = clean_data($email);
                    $phone = clean_data($phone);
                    $message = clean_data($message);

                    echo $name;
                }

                function clean_data($data = null) {

                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);

                    return $data;
                }

                $error = array('name' => 'frist name blank', 'phone' => 'phone not correct');

                if (empty($name)) {

                    $error_msg = 'frist name should not be blank';
                }
                ?>

                <div class="form-group">
                    <label for="exampleInputEmail1">Your Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sam Smith" name="name">
                    <small><?php echo @$error_msg; ?></small>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="sam@gmail.com" name="email">

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="+947070035844" name="phone">

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                </div>

                <button type="submit" class="btn btn-primary form_btn" name="action" value="save">Submit</button>
            </form>
        </div>
        <div class="col map_col">
            <h2>VISIT OUR LOCATION</h2>
            <hr>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15849.994883904928!2d79.97867634997198!3d6.70882337239642!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2496ac4ce5535%3A0xd2ed928760ec3c50!2sBandaragama!5e0!3m2!1sen!2slk!4v1631946658447!5m2!1sen!2slk" width="600" height="450" style="border-radius: 15px;" allowfullscreen="" loading="lazy"></iframe>
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
<!-- footer end -->