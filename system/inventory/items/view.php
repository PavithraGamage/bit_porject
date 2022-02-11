<?php
include '../../header.php';
include '../../nav.php';

// extract variables
extract($_POST);

// DB Connection
$db = db_con();

// Items data fletch 
$sql = "SELECT * FROM `items`  WHERE `item_id` = '$item_id'";
$result = $db->query($sql);


?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <h1 class="m-0"><?php echo $row['item_name']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Items</a></li>
                        <li class="breadcrumb-item active">View Items</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="row" style="padding-top: 40px;">
            <!--product image-->
            <div class="col-6">
                <div class="image_box" style="padding-left: 80px;">
                    <img src="../../../assets/images/<?php echo $row['item_image'] ?>" alt="" class="item_image" style="width: 80%;" />
                </div>

            </div>

            <!--second content box-->
            <div class="col-6" style="padding-right: 80px;">
                <h4 class="price_hedding">Product Description</h4>
                <hr>
                <p>
                    <?php echo $row['item_description']; ?>
                </p>
                <h5 class="price_hedding">Unit Price - Rs: <?php echo $row['unit_price']; ?></h5>
                <h5 class="price_hedding">Sale Price -  Rs: <?php echo $row['sale_price']; ?></h5>
                <h5 class="price_hedding">Discount Rate - <?php echo $row['discount_rate']; ?> %</h5>
                <h6>SKU: <?php echo $row['sku']; ?> </h6>
                <h6>Reorder Level: <?php echo $row['recorder_level']; ?></h6>
                <h6>In Stock: <?php echo $row['stock']; ?></h6>

            </div>

        </div>
    </div>
<?php
                        }
                    }
?>
<div class="row">

    <div class="item_table" style="padding: 80px;width: 100%;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="item_table_col" style="font-size: 22px;">Item Features</th>
                    <th scope="col" style="font-size: 22px;">Details</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Brand</th>
                    <td>AMD</td>

                </tr>
                <tr>
                    <th scope="row">Product Family</th>
                    <td>AMD Ryzen™ Processors</td>

                </tr>
                <tr>
                    <th scope="row">Product Line</th>
                    <td>AMD Ryzen™ 9 Desktop Processors</td>

                </tr>
                <tr>
                    <th scope="row">CPU Cores</th>
                    <td>12</td>

                </tr>
                <tr>
                    <th scope="row">CPU Threads</th>
                    <td>24</td>

                </tr>
                <tr>
                    <th scope="row">Max Boost Clock</th>
                    <td>Up to 4.6GHz</td>

                </tr>
                <tr>
                    <th scope="row">Base Clock</th>
                    <td>3.8GHz</td>

                </tr>
                <tr>
                    <th scope="row">Total L1 Cache</th>
                    <td>768KB</td>

                </tr>
                <tr>
                    <th scope="row">Total L2 Cache</th>
                    <td>6MB</td>

                </tr>
                <tr>
                    <th scope="row">Total L3 Cache</th>
                    <td>64MB</td>

                </tr>
                <tr>
                    <th scope="row">Default TDP</th>
                    <td>105W</td>

                </tr>
                <tr>
                    <th scope="row">CMOS</th>
                    <td>TSMC 7nm FinFET</td>

                </tr>
                <tr>
                    <th scope="row">Unlock for Overclocking</th>
                    <td>Yes</td>

                </tr>
                <tr>
                    <th scope="row">CPU Socket</th>
                    <td>AM4</td>

                </tr>


            </tbody>
        </table>
    </div>
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