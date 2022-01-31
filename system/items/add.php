<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Items</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Items</a></li>
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
                        <h3 class="card-title">Insert New Item</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php

                    $db = db_con();

                    // categories drop down data fletch 
                    $sql_cat = "SELECT * FROM `categories`";
                    $cat_result = $db->query($sql_cat);

                    // manufactures drop down data fletch 
                    $sql_man = "SELECT * FROM `manufacturers`";
                    $man_result = $db->query($sql_man);

                    // brand drop down data fletch 
                    $sql_brand = "SELECT * FROM `brands`";
                    $brand_result = $db->query($sql_brand);



                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select class="form-control select2" style="width: 100%;" name="categories">
                                    <?php

                                    // fletch data
                                    if ($cat_result->num_rows > 0) {
                                        while ($cat_row = $cat_result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $cat_row['category_id'] ?>"><?php echo $cat_row['category_name']; ?></option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Manufacture</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <?php

                                    // fletch data
                                    if ($man_result->num_rows > 0) {
                                        while ($man_row = $man_result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $man_row['man_id'] ?>"><?php echo $man_row['man_name']; ?></option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <?php

                                    // fletch data
                                    if ($man_result->num_rows > 0) {
                                        while ($man_row = $man_result->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $man_row['man_id'] ?>"><?php echo $man_row['man_name']; ?></option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Model</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">ASUS TUF GAMING GEFORCE RTX 3080TI 12GB</option>
                                    <option>AMD RYZEN THREADRIPPER 3990X</option>
                                    <option>INTEL CORE I9-12900K PROCESSOR</option>
                                    <option>INTEL CORE I9-12900KF PROCESSOR</option>
                                    <option>ASUS ROG MAXIMUS Z690 EXTREME GLACIAL</option>
                                    <option>ASUS ROG MAXIMUS Z690 EXTREME</option>
                                    <option>ASUS ROG STRIX TRX40-XE GAMING WIFI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Serial Number</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">SKU</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Reorder Level</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Unit Price</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sale Price</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount Rate</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Right Section Start -->
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Insert Item Specifications</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Name</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">ASUS TUF GAMING GEFORCE RTX 3080TI 12GB</option>
                                    <option>AMD RYZEN THREADRIPPER 3990X</option>
                                    <option>INTEL CORE I9-12900K PROCESSOR</option>
                                    <option>INTEL CORE I9-12900KF PROCESSOR</option>
                                    <option>ASUS ROG MAXIMUS Z690 EXTREME GLACIAL</option>
                                    <option>ASUS ROG MAXIMUS Z690 EXTREME</option>
                                    <option>ASUS ROG STRIX TRX40-XE GAMING WIFI</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 1</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 2</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 3</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 4</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Spec 5</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" name="category_name">
                            </div>





                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Insert</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- item table -->
        <div class="row">
            <div class="col">
                <?php

                // db connect
                $db = db_con();

                // sql query
                $sql = "SELECT * FROM `categories`";

                // fletch data
                $result = $db->query($sql);

                ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories Models</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brand_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['category_id'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>
                                            <td><?php echo $row['category_name'] ?> </td>


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

<?php include '../footer.php'; ?>

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