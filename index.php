<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="http://localhost/bit/assets/css/bootstrap.min.css" rel="stylesheet">

    <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));  ?></title>

    <link href="http://localhost/bit/assets/css/style.css" rel="stylesheet" type="text/css" />

    <!--fontawesome icons-->
    <link href="http://localhost/bit/assets/icons/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" type="text/css" />
</head>

<body style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(http://localhost/bit/assets/images/oveclock.jpg);">

    <h1 style="text-align: center; color:aliceblue; font-size: 60px; margin-top: 30px">U-Star Digital</h1>
    <h1 style="text-align: center; color:aliceblue; font-size: 24px; font-weight: 200">Web-Based Computer Hardware Purchasing and Troubleshooting Assistant management system</h1>
    <hr style="margin-left: 5%; margin-right: 5%; color:aliceblue; border: 1px solid aliceblue">
    <div class="row" style="margin-left: 5%; margin-right: 5%;">
        <div class="col" style="display: flex; flex-direction: column; align-content: center; align-items: flex-end;">
            <div class="card" style="width: 350px;">
                <img class="card-img-top" src="assets/images/960x0.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="home.php">
                        <button class="btn btn-secondary">Start</button>

                    </a>
                </div>
            </div>
        </div>
        <div class="col" style="display: flex; flex-direction: column; align-content: center; align-items: flex-start;">
            <div class="card" style="width: 350px;">
                <img class="card-img-top" src="assets/images/960x0.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <button class="btn btn-secondary">Start</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="assets/js/bootstrap.min.js" type="text/javascript"></script> -->


</body>

</html>