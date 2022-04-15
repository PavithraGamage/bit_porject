<?php

include "site_nav.php";
include "dashboard_nav.php";

?>


<!-- Dashbaord Content Area Start -->
<div class="col-10 dash_content">

    <form>
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">
                        <h5>1. Current Status</h5>
                    </label>
                    <div class="col-sm-4">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>- Select - </option>
                            <option>No Power</option>
                            <option>No Display</option>
                            <option>3 Shote Beeps</option>
                            <option>Continues Beeps</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h5>2. Troubleshooting Questions</h5>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">Q1: Do you have the right memory part for your computer</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>- Select - </option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div><br>
                <p>A1: At the manufacturer's Web site you can look up the part number. Many memory manufacturers
                    have configurators, which indicate the compatibilities of your module.</p>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">Q2: Confirm that you configured the memory correctly.</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>- Select - </option>
                            <option>Yes configured correctly</option>
                            <option>No</option>
                        </select>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">Q3: Do you re-install the module/s</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>- Select - </option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">Q4: Do you swap modules for different slots ?</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>- Select - </option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">Q5: Do you clean the socket and pins on the memory module?</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>- Select - </option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-8 col-form-label">Q6: Do you update the BIOS?</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>- Select - </option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div><br>

            </div>
        </div>
        <hr>
        <p>If you can not recovery by the questioner please make an appointment to contact with technician</p>
        <a href="appointments.php">
            <button type="button" class="btn btn-secondary float-right" style="margin-top: 10px;"><i class="fas fa-calendar-check"></i> Appointment</button>
        </a>
    </form>



    <!-- Dashbaord Content Area End -->
</div>
</div>


<!--dashboard end-->
</div>
</div>




<?php

include "site_footer.php";

?>