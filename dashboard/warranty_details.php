<?php

include "site_nav.php";
include "dashboard_nav.php";

?>
<!-- Dashboard Content Area Start -->
<div class="col-10 dash_content">
    <h5>Warranty Details</h5>
    <hr>
    <form>
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-form-label">Item Name :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="AMD Ryzen 9 3900X">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-form-label">Part Serial Number :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="458WQWDWDQWDWQ48">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-form-label">Purchase Date :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="12/10/2021">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-form-label">Purchase Invoice Number :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="5876">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-form-label">Warranty Remaining :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="156 Days">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-6 col-form-label">Warranty Type :</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="One to One Replacement">
                    </div>
                </div>
                <hr>
                <h5>Make Appointment to Claim Warranty </h5>
                <a href="appointments.php">
                    <button type="button" class="btn btn-secondary float-right" style="margin-top: 10px;"><i class="fas fa-calendar-check"></i> Appointment</button>
                </a>
            </div>

        </div>
    </form>
</div>
<!-- Dashbaord Content Area End -->
</div>


<!--dashboard end-->
</div>
</div>
<?php

include "site_footer.php";

?>