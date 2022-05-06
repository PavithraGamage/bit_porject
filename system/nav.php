  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          

          
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-envelope mr-2"></i> 4 new messages
                      <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-users mr-2"></i> 8 friend requests
                      <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-file mr-2"></i> 3 new reports
                      <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo SITE_URL; ?>logout.php">
                  Log Out
              </a>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link" >
          
          <i class="fas fa-globe" style="margin-left: 20px;"></i>
          <span class="brand-text font-weight-light">U-Star Digital</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="http://localhost/bit/assets/images/<?php echo $_SESSION['profile_image'] ?>" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?php echo $_SESSION['first_name'] . " " .  $_SESSION['last_name']; ?></a>
              </div>
          </div>

         

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <?php

                    $sql = "SELECT m.module_id, m.description, m.path, m.view, m.icon, m.status, um.status
                    FROM users_modules um
                    INNER JOIN modules m ON m.module_id = um.module_id
                    WHERE length(m.module_id) = '2' AND um.user_id ='" . $_SESSION['user_id'] . "' AND m.status = '0' AND um.status = '0'";

                    // database connection call
                    $db = db_con();

                    // assign the query
                    $result = $db->query($sql);

                    ?>

                  <?php

                    // check the result grater than 1
                    if ($result->num_rows > 0) {

                        // assign the result to row variable
                        while ($row = $result->fetch_assoc()) {

                    ?>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon <?php echo $row['icon'] ?>"></i>
                                  <p>

                                      <?php
                                        //   display module name
                                        echo $row['description'];
                                        ?>
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">

                                  <?php

                                    $sql_sub = "SELECT m.module_id, m.description, m.path, m.view, m.icon, m.status
                                                FROM users_modules um
                                                INNER JOIN modules m ON m.module_id = um.module_id
                                                WHERE length(m.module_id) = '4' AND um.user_id ='" . $_SESSION['user_id'] . "' AND substr(m.module_id, 1,2) = '" . $row['module_id'] . "' AND m.status = '0' AND um.status = '0'";

                                    // assign the query
                                    $result_sub = $db->query($sql_sub);

                                    ?>

                                  <?php

                                    if ($result_sub->num_rows > 0) {

                                        while ($row_sub = $result_sub->fetch_assoc()) {

                                            // create file path for sub menu 
                                            $file = $row_sub['path'] . "/" . $row_sub['view'] . ".php";
                                    ?>
                                          <li class="nav-item">
                                              <a href="<?php echo SITE_URL; ?><?php echo $file; ?>" class="nav-link">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p><?php echo $row_sub['description'] ?></p>
                                              </a>
                                          </li>

                                  <?php
                                        }
                                    }
                                    ?>
                              </ul>
                          </li>

                  <?php
                        }
                    }

                    ?>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>