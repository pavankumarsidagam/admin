<?php
  require_once('config.php');
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Gati - Admin Dashboard Template</title>

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
<body class="light theme-white light-sidebar">
        <div class="loader" style="display: none;">
        </div>
            <div id="app" class="pt-5 mt-5">
                <section class="section">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>Admin Login</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" class="needs-validation" id="loginForm" novalidate="">
                                            <div class="form-group">
                                                <label for="username">Username<span class="text-danger">*</span></label>
                                                <input id="username" type="Text" class="form-control" name="username" tabindex="1" required="" autofocus="">
                                                <div class="invalid-feedback">
                                                Please enter correct username
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-block">
                                                <label for="password" class="control-label">Password<span class="text-danger">*</span></label>
                                                </div>
                                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required="">
                                                <div class="invalid-feedback">
                                                Please enter correct password
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Login
                                                </button>
                                            </div>
                                        </form>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
    <script src="assets/bundles/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
    <script src="assets/bundles/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/index.js"></script>
    <script src="assets/js/page/form-wizard.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
  
    <script src="assets/bundles/cleave-js/dist/cleave.min.js"></script>
    <script src="assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
    <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
   
      <!-- JS Libraies -->
    <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
    <script src="assets/js/page/toastr.js"></script>
    <script src="assets/js/page/sweetalert.js"></script>
    <script src="assets/js/main.js"></script>


    <script>
        $(document).ready(function(){
          $('#loginForm').submit(function (event) {
              
              var formData = new FormData($('#loginForm')[0]);
              formData.append('work', 0);


            $.ajax({
                url: 'insert_data.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                      console.log(response);

                      if(response == 1){                       
                        window.location.href = 'admin_page.php';                           
                        }
                    $("#loginForm")[0].reset();
                      
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
            event.preventDefault();
                        
          });
        });
    </script>
      
</body>

</html>