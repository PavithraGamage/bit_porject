<?php include 'ui/system_page_header.php';?>

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
                    <input type="text" class="form-control" id="formGroupExampleInput" >
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
                    <img src="images/1919-20210908081112-add.png" alt="" class="cart_item_image"/>
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
                    <input type="text" class="form-control" id="formGroupExampleInput" >
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
                    
                    <img src="images/1959-20210603122835-ROG-STRIX-RTX3060-12G-GAMING_box+vga+logo 2000.png" alt="" class="cart_item_image"/>
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
                    <input type="text" class="form-control" id="formGroupExampleInput" >
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
<?php include 'ui/site_footer.php'; ?>
<!-- footer end -->