<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// user details
$sql = "SELECT * FROM `users`  WHERE `user_id` = '$user_id'";
$result = $db->query($sql);

// staff details
$cus_sql = "SELECT * FROM `customers`  WHERE `user_id` = '$user_id'";
$cus_result = $db->query($cus_sql);


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

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="../../../assets/images/<?php echo $row['profile_image'] ?>" alt="User profile picture" style="width: 100px; height:100px">
                        </div>

                        <h1 class="profile-username text-center"><?php echo  strtoupper($row['user_name']); ?></h1>

                        <p class="text-muted text-center">Software Engineer</p>

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

                    if ($cus_result->num_rows > 0) {
                        $cus_row = $cus_result->fetch_assoc();

                        ?>
                            <br>
                            <h4>Contact Details</h4>
                            <li class="list-group-item">
                                <b>Contact Number</b> <a class="float-right"><?php echo  strtoupper($cus_row['contact_nmuber']); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Address</b> <a class="float-right"><?php echo  strtoupper($cus_row['address_l1']); ?>, <?php echo  strtoupper($cus_row['address_l2']); ?>, <?php echo  strtoupper($cus_row['city']); ?></a>
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