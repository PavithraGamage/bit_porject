<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);


print_r($_POST);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name" name="first_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name" name="last_nam">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIC</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter NIC" name="nic">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of Birth</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter Date of Birth" name="dob">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Age</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Age" name="age">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Verify Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Verify Password" name="verify_password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Number</label>
                                <input type="tel" class="form-control" id="exampleInputEmail1" placeholder="Enter Contact Number" name="contact_number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address Line 1</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 1" name="address_line_1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address Line 2</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address Line 2" name="address_line_2">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter City" name="city">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Province</label>
                                <select class="form-control" id="exampleInputEmail1" placeholder="Enter Province" name="province">
                                    <option value="Select Province">Select Province</option>
                                    <option value="Western Province">Western Province</option>
                                    <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                                    <option value="Central Province">Central Province</option>
                                    <option value="Southern Province">Southern Province</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Postal Code</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Postal Code" name="postal_code">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Profile Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="profile_image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col">
                <?php

                // db connect
                $db = db_con();

                // sql query
                $sql = "SELECT * FROM `users`";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="user_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['user_id'] ?> </td>
                                            <td><?php echo $row['first_name'] ?> </td>
                                            <td><?php echo $row['last_name'] ?> </td>
                                        </tr>

                                <?php
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<!-- Page specific script -->
<script>
    $(function() {
        $("#user_list").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#user_list_wrapper .col-md-6:eq(0)');
        $('#user_list1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>