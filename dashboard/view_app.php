<?php

include "site_nav.php";
include "dashboard_nav.php";

?>


            <!-- Dashbaord Content Area Start -->
            <div class="col-10 dash_content">
                <div class="page_tables">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="table_head">#</th>
                                <th scope="col" class="table_head">Date</th>
                                <th scope="col" class="table_head">Delivery Company Name</th>
                                <th scope="col" class="table_head">ETA</th>
                                <th scope="col" class="table_head">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="table_body">1</th>
                                <td class="table_body">12/10/2021</td>
                                <td class="table_body">Promt Express</td>
                                <td class="table_body">12/10/2021</td>
                                <td>
                                    <a href="delivery_info.php">
                                    <button>VIEW</button>
                                    </a>
                                    
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="table_body">2</th>
                                <td class="table_body">12/10/2021</td>
                                <td class="table_body">Globle Express</td>
                                <td class="table_body">12/10/2021</td>
                                <td>
                                    <button>VIEW</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="table_body">3</th>
                                <td class="table_body">12/10/2021</td>
                                <td class="table_body">Grasshoppers</td>
                                <td class="table_body">12/10/2021</td>
                                <td>
                                    <button>VIEW</button>
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