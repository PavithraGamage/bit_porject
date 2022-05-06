<?php
ob_start(); // multiple headers

include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

//redirect
if(empty($user_id)){
    header('Location: http://localhost/bit/system/users/staff/add.php ');
}

// DB Connection
$db = db_con();


?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php

            // user details
            $sql = "SELECT * FROM `users`  WHERE `user_id` = '$user_id'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="../../../assets/images/<?php echo $row['profile_image'] ?>" alt="User profile picture" style="width: 100px; height:100px">
                        </div>

                        <h1 class="profile-username text-center"><?php echo  strtoupper($row['user_name']); ?></h1>
                        <ul class="list-group list-group-unbordered mb-3">
                            <h4>Personal Details</h4>
                            <li class="list-group-item">
                                <b>First Name</b> <a class="float-right"><?php echo  strtoupper($row['first_name']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Last Name</b> <a class="float-right"><?php echo  strtoupper($row['last_name']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right"><?php echo  strtoupper($row['user_name']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right"><?php echo  $row['email']; ?></a>
                            </li>

                        <?php
                    }

                    // staff details
                    $staff_sql = "SELECT * FROM `staff`  WHERE `user_id` = '$user_id'";
                    $staff_result = $db->query($staff_sql);

                    if ($staff_result->num_rows > 0) {
                        $staff_row = $staff_result->fetch_assoc();

                        ?>
                            <li class="list-group-item">
                                <b>NIC</b> <a class="float-right"><?php echo  strtoupper($staff_row['nic']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Date of Birth</b> <a class="float-right"><?php echo  strtoupper($staff_row['dob']); ?></a>
                            </li>

                            <br>
                            <h4>Contact Details</h4>
                            <li class="list-group-item">
                                <b>Contact Number</b> <a class="float-right"><?php echo  strtoupper($staff_row['contact_number']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Address</b> <a class="float-right"><?php echo  strtoupper($staff_row['address_l1']); ?>, <?php echo  strtoupper($staff_row['address_l2']); ?>, <?php echo  strtoupper($staff_row['city']); ?></a>
                            </li>
                        </ul>
                    <?php

                    }
                    ?>

                    </div>
                    <!-- /.card-body -->
                </div>


        </div><!-- /.container-fluid -->
    </div>
</div>



<?php include '../../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {
        // $("#user_list").DataTable({
        //     "responsive": true,
        //     "lengthChange": false,
        //     "autoWidth": false,
        //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#user_list_wrapper .col-md-6:eq(0)');
        $('#brand_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<?php ob_end_flush(); ?>