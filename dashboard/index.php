<?php
include "site_nav.php";

?>
<div class="container">
    <div class="row" style="margin-top: 80px; margin-bottom: 80px">
        <div class="col">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <h1>Login</h1>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                        <form action="dashboard.php" method="post">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                                
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password">
                               
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4" style="display: flex; flex-direction: row; justify-content: flex-end;">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <!-- /.social-auth-links -->

                        <p class="mb-1">
                            <a href="forgot-password.html">I forgot my password</a>
                        </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="col">
            <div class="register-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <h1>Register</h1>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Register a new membership</p>

                        <form action="../../index.html" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Full name">
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Retype password">
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                        <label for="agreeTerms">
                                            I agree to the <a href="#">terms</a>
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4" style="display: flex; flex-direction: row; justify-content: flex-end;">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>



                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
            </div>
        </div>
    </div>

</div>

<?php

include "site_footer.php";

?>