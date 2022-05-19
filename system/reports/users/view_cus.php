<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);
extract($_GET);

// update notification
if (!empty($notification_user_id)) {

    $sql = "UPDATE `users` SET `u_notification` = '1' WHERE `users`.`user_id` = $notification_user_id;";
    $db->query($sql);
}


// DB Connection
$db = db_con();


// create error variable to store error messages
$error =  array();

// date
$date = date('Y-m-d');

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Customer Report</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Right Section Start -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title">All User List</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <!-- date rang row -->
                            <div class="row">
                                <div class="col-3">
                                    <label>Start Date: </label>
                                    <input type="date" name="start_date" value="<?php echo @$start_date ?>"><br>
                                </div>
                                <div class="col-2">
                                    <label>End Date: </label>
                                    <input type="date" name="end_date" value="<?php echo @$end_date ?>"><br>
                                </div>
                                <div class="col">
                                    <button name="action" class="btn btn-primary" value="today" type="submit">Today</button>

                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" onclick="exportTableToExcel('user_list', 'user_details')">Export to Excel</button>
                                </div>
                            </div>
                            <hr>
                            <!-- dropdown row -->
                            <div class="row">
                                <div class="col-2">
                                    <label>User Status</label>
                                    <select class="form-control select2" style="width: 100%;" name="status">
                                        <option value="">- Select User Status -</option>
                                        <?php

                                        // model drop down data fletch 
                                        $sql = "SELECT * FROM `status`";
                                        $result = $db->query($sql);

                                        // fletch data
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $row['status_id'] ?>" <?php if ($row['status_id'] == @$status) { ?> selected <?php } ?>><?php echo $row['status_name']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>City</label>
                                    <select class="form-control select2" style="width: 100%;" name="city">
                                        <option value="">- Select City -</option>
                                        <?php

                                        // model drop down data fletch 
                                        $sql = "SELECT city FROM `staff` WHERE status = 0 GROUP BY (city) ORDER BY `staff`.`city` ASC";
                                        $result = $db->query($sql);

                                        // fletch data
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $row['city'] ?>" <?php if ($row['city'] == @$city) { ?> selected <?php } ?>><?php echo $row['city']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label>User Role</label>
                                    <select class="form-control select2" style="width: 100%;" name="user_roles">
                                        <option value="">- Select User Role -</option>
                                        <?php

                                        // model drop down data fletch 
                                        $sql = "SELECT ur.user_role_id, ur.role_name
                                        FROM user_roles ur
                                        INNER JOIN status s ON s.status_id = ur.status
                                        WHERE ur.user_role_id in (1,2,3,4,6) AND ur.status = 0 ORDER BY `ur`.`role_name` ASC";
                                        $result = $db->query($sql);

                                        // fletch data
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $row['user_role_id'] ?>" <?php if ($row['user_role_id'] == @$user_roles) { ?> selected <?php } ?>><?php echo $row['role_name']; ?></option>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Search Table Data</label>
                                    <input type="text" class="form-control" id="sku" placeholder="Search Data" name="cus_search" value="<?php echo @$cus_search ?>">
                                </div>
                                <div class="col-2" style="display: flex;align-content: center;flex-direction: row;flex-wrap: nowrap;align-items: center;">
                                    <button type="submit" class="btn btn-primary" style="display: flex; margin-left: 10px; margin-top: 30px; " name="action" value="search">Search</button>
                                </div>
                            </div>
                        </form><br>
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Profile Image</th>
                                    <th>Register Date</th>
                                    <th>Username</th>
                                    <th>User Role</th>
                                    <th>Name</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Profile Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $recode_cont = 1;
                                $where = null;
                                $date = null;

                                // filters by search button
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search') {

                                    // table wide search
                                    if (!empty($cus_search)) {

                                        $where .= "CONCAT(u.user_id, s.staff_id, s.contact_number, s.address_l1, s.address_l2, s.city, u.user_name, u.first_name, u.last_name, u.profile_image, u.created_date, st.status_name, ur.role_name, u.email) LIKE '%$cus_search%' AND ";
                                    }

                                    // filter by status
                                    if ($status != null) {

                                        $where .= "st.status_id = $status AND ";
                                    }

                                    // filter by city
                                    if (!empty($city)) {

                                        $where .= "s.city LIKE '%$city%' AND ";
                                    }

                                    // filter by user role
                                    if (!empty($user_roles)) {

                                        $where .= "ur.user_role_id = $user_roles AND ";
                                    }

                                    if (!empty($start_date) and !empty($end_date)) {

                                        $where .= "(u.created_date BETWEEN '$start_date' AND '$end_date') AND ";
                                    }

                                    // remove the last 4 digits of the $where part "AND "
                                    if (!empty($where)) {

                                        $where = substr($where, 0, -4);

                                        // take Mysql WHERE and take $where query parts 
                                        $where = "WHERE $where";
                                    }
                                }


                                // filters by today
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'today') {

                                    // get today date
                                    $date = date("Y-m-d");

                                    $where = "WHERE u.created_date = '$date'";
                                }

                                // sql query
                                $sql = "SELECT u.user_id, s.staff_id, s.contact_number, s.address_l1, s.address_l2, s.city, u.user_name, u.first_name, u.last_name, u.profile_image, u.created_date, st.status_name, ur.role_name, u.email
                                FROM staff s
                                INNER JOIN users u ON u.user_id = s.user_id
                                INNER JOIN status st on st.status_id = u.status
                                INNER JOIN user_roles ur ON ur.user_role_id = u.user_role $where";

                                // fletch data
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                ?>
                                        <tr>
                                            <td><img src="../../../assets/images/<?php echo $row['profile_image'] ?>" class="img-fluid" width="100"></td>
                                            <td><?php echo $row['created_date'] ?> </td>
                                            <td><?php echo $row['user_name'] ?> </td>
                                            <td><?php echo $row['role_name'] ?> </td>
                                            <td><?php echo $row['first_name'] . " " . $row['last_name']  ?> </td>
                                            <td><?php echo $row['contact_number'] ?> </td>
                                            <td><?php echo $row['email'] ?> </td>
                                            <td><?php echo $row['address_l1'] . ", " . $row['address_l2'] . ", " . $row['city'] ?> </td>
                                            <td><?php echo $row['city'] ?> </td>
                                            <td><?php echo $row['status_name'] ?> </td>

                                        </tr>

                                <?php

                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <h3 class="card-title">Total User Count: <b> <?php echo $user_count = $result->num_rows ?></b></h3>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<script>
    // excel export
    function exportTableToExcel(tableID, filename = '') {

        var downloadLink;

        //ms office file type
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name (short if)
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        // for netscape navigator browsers
        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>