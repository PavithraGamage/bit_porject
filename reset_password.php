<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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

        <!-- Custom Styles -->
        <link href="styles/reset_password.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <div class="container main">
            <div class="row">
                <div class="col-5 login_col_1">
                    <h1 class="company_name">Encryption IT Solutions</h1>
                    <h5 class="tag_line">Online Orders</h5>
                    <hr class="hr1">
                    <div>
                        <img class="login_image" src="images/login_image.png" alt=""/>
                    </div>
                    <h6 class="support">Help</h6>
                    <h6 class="support">Report Issus</h6>
                    <div class="support_details">Phone : +94 75 700 3662</div>
                    <div class="support_details">Email : tech@encryptionit.lk</div>
                    <div class="support_details">Address : 58/E, Kamburugoda, Bandaragama</div>
                </div>
                <div class="col-7 login_col_2">
                    <h1 class="title">Reset Password</h1>
                    <p class="login_instuctions">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>
                    <hr class="hr2">
                    <form action="">
                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">User Name</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Please enter your contact number to send OTP code.</div>
                        </div>
                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">New Password</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Rest Password</button>
                    </form>
                    <div class="errors">
                        <!--                        Java Script Validations
                                                <span>Email address not found please <a class="links">Create Account</a></span>-->
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
