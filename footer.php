      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Design By <a href="#">Redstar</a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
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
    <!-- <script>
        // window.addEventListener('beforeunload', function (event) {
        //       Swal.fire({
        //             title: "Are you sure?",
        //             text: "You won't be able to revert this!",
        //             icon: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#3085d6",
        //             cancelButtonColor: "#d33",
        //             confirmButtonText: "Yes, delete it!"
        //           }).then((result) => {
        //             if (result.isConfirmed) {
        //               window.location.href = "admin_page.php";
        //             }
        //           });
        //       });


            window.addEventListener('beforeunload', function (event) {
            // Display a standard confirmation dialog
            var confirmationMessage = 'Are you sure you want to leave?';

            // Display the confirmation dialog
            var result = confirm(confirmationMessage);

            if (result) {
                // User confirmed - redirect to login.php
                window.location.href = 'login_page.php';
            } else {
                // User canceled - prevent the default behavior of the unload event
                event.preventDefault();
            }
        });
    </script> -->
    <!-- <script>
        $(document).ready(function () {
            // Listen for popstate event (back/forward button clicks)
            window.addEventListener('popstate', function (event) {
                // Display a custom confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'If you leave, your session will be terminated.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, leave!',
                    cancelButtonText: 'Stay',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked "Yes, leave!" - perform actions like destroying the session and redirecting
                        // Use AJAX to send a request to the server to destroy the session
                        window.location.href = 'login_page.php';
                    }
                });
            });
        });
    </script> -->
</body>
</html>