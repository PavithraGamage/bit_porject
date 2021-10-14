<?php include 'ui/site_header.php'; ?>
<!--Hero Section Start-->
<div class="hero">
    <div class="container">
        <h2 class="hero_headding">Checkout</h2>
        <hr class="hero_hr">
        <p class="hero_para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
    </div>
</div>
<!--Hero Section End-->
<!-- content start-->
<div class="container">


    <div class="row item_row_main">


        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            
          
            <div class="row">
                <div class="col">
                    <h3> <i class="fas fa-map-marker-alt"></i> Your Delivery Details</h3>
                </div>
                <div class="col cart_remove_all">
                   
                    <button type="reset" class="btn btn-secondary card_button">Delivery to different address</button>
                    
                </div>
            </div>
            <hr>
               <div class="row">
                <div class="col-4">
                    <label for="inputCity">Frist Name</label>
                    <input type="text" class="form-control" id="frist_name" name="frist_name">
                </div>
                <div class="col-4">
                    <label for="inputState">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                 
                </div>
                <div class="col-4">
                   <label for="inputState">Phone</label>
                   <input type="tel" class="form-control" id="phone" name="phone">
                </div>

            </div>
            <div class="form-group">
                <label for="inputAddress">Address Line 1</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address_line_1">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address Line 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address_line_2">
            </div>
            <div class="row">
                <div class="col-4">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city">
                </div>
                <div class="col-4">
                    <label for="inputState">Province</label>
                    <select id="inputState" class="form-control" name="province">
                        <option selected>Choose...</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                        <option>Western</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="zip">
                </div>

            </div>
             <div class="row">
                <div class="col-5"></div>
                <div class="col-7 cart_total">
                    <h4 class="cart_summary">Summary</h4>
                    <div class="row">
                        <div class="col-4">
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
                        <div class="col-8">
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
                            
                                <button type="submit" class="btn btn-secondary cart_checkout_button"> PAY YOUR ORDER </button>

                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

<?php 
 
var_dump($_POST);

?>
</div>
<!-- content end-->
<!-- footer start -->
<?php include 'ui/site_footer.php'; ?>
<!-- footer end -->