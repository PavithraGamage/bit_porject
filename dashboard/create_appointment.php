<?php

include "site_nav.php";
include "dashboard_nav.php";

?>

<!-- Dashboard Content Area Start -->
<div class="col-10 dash_content">

    <form>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Appointment Type</label>
            <div class="col-sm-10">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>- Select - </option>
                    <option>No Power</option>
                    <option>No Display</option>
                    <option>Beeps and Alarms</option>
                    <option>Instant Shutdown</option>
                </select>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Appointment Date & Time</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-6">
                        <input type="date" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                    <div class="col-6">
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>_ _ : _ _</option>
                            <option>8.30 AM</option>
                            <option>9.30 AM</option>
                            <option>10.30 AM</option>
                            <option>11.30 AM</option>
                            <option>12.30 PM</option>
                        </select>
                    </div>
                </div>
            </div>
        </div><br>
      
        <a href="appointments.php">
            <button type="button" class="btn btn-secondary float-right" style="margin-top: 10px;"><i class="fas fa-calendar-check"></i> Appointment</button>
        </a>
    </form>

    <!-- Dashboard Content Area End -->
</div>
</div>


<!--dashboard end-->
</div>
</div>


<?php

include "site_footer.php";

?>