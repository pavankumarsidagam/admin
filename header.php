<?php
  require_once('config.php');
  session_start();
  $admin_username = $_SESSION['admin_username']
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Gati - Admin Dashboard</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/core/main.min.css' />
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/daygrid/main.min.css' />
  <link rel='stylesheet' href='assets/bundles/fullcalendar/packages/timegrid/main.min.css' />
  <link rel="stylesheet" href="assets/bundles/prism/prism.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/jqvmap/dist/jqvmap.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  

  <link rel="stylesheet" href="assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/bundles/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"> 
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline me-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="menu"></i></a></li>
            <li>
              <form class="form-inline me-auto">
                <div class="search-element d-flex">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
              <i data-feather="maximize"></i>
            </a></li>
          <li class="dropdown"><a href="#" data-bs-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $admin_username?> </div>
              <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> <a href="" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="index.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">Gati</span>
            </a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="assets/img/user.png">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name"><?php echo $admin_username?></div>
              <div class="user-role">Administrator</div>
              
              <div class="sidebar-userpic-btn">
                <a href="#" data-bs-toggle="tooltip" title="Profile">
                  <i data-feather="user"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" title="Mail">
                  <i data-feather="mail"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" title="Chat">
                  <i data-feather="message-square"></i>
                </a>
                <a href="index.php" data-bs-toggle="tooltip"  title="Log Out">
                  <i data-feather="log-out"></i>
                </a>
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <!-- <li class="dropdown">
              <a href="admin_page.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li> -->
            <!-- forms data -->
            <!-- <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Forms</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="forms-advanced-form.php">Advanced Form</a></li>
              </ul>
            </li> -->
            <!-- forms data -->

           <!-- dynamic data -->
            <?php
            $query = mysqli_query($conn, "SELECT * FROM menus WHERE status='1'") or die(mysqli_error($conn));

            while ($topMenu = mysqli_fetch_object($query)) {
                if ($topMenu->parent_id == '0') {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="<?php echo $topMenu->icons ?>"></i><span><?php echo $topMenu->menu_name ?></span></a>
                        <?php
                        $childQuery = mysqli_query($conn, "SELECT * FROM menus WHERE status='1' AND parent_id ='$topMenu->menu_id'") or die(mysqli_error($conn));

                        if (mysqli_num_rows($childQuery) > 0) {
                            ?>
                            <ul class="dropdown-menu">
                                <?php
                                while ($childMenu = mysqli_fetch_object($childQuery)) {
                                    ?>
                                    <li><a class="nav-link" href="<?php echo $childMenu->menu_url ?>"><?php echo $childMenu->menu_name ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                    <?php
                }else if($topMenu->parent_id == '119'){
                  ?>
                  <li class="dropdown">
                    <a href="<?php echo $topMenu->menu_url ?>" class="nav-link"><i data-feather="<?php echo $topMenu->icons ?>"></i><span><?php echo $topMenu->menu_name ?></span></a>
                  </li>
                <?php
                }
            }
            ?>
            <!--   dynamic data  -->
          </ul>
        </aside>
      </div>  