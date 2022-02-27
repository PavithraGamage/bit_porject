<?php

include "site_nav.php";
include "dashboard_nav.php";
?>
<!-- Dashboard Content Area Start -->
<div class="col-10 dash_content">
    <div class="page_tables">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table_head">#</th>
                    <th scope="col" class="table_head">Invoice Number</th>
                    <th scope="col" class="table_head">Purchase Date</th>
                    <th scope="col" class="table_head">Item</th>
                    <th scope="col" class="table_head">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="table_body">1</th>
                    <td class="table_body">1021</td>
                    <td class="table_body">12/10/2021</td>
                    <td class="table_body">AMD Ryzen 9 3900X </td>
                    <td>
                        <a href="warranty_details.php">
                            <button>View</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="table_body">2</th>
                    <td class="table_body">1022</td>
                    <td class="table_body">12/11/2021</td>
                    <td class="table_body">Havit Gaming Mouse</td>
                    <td>
                        <button>No Action</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Dashbaord Content Area End -->
</div>
</div>


<!--dashboard end-->
</div>
</div>

<?php

include "site_footer.php";

?>