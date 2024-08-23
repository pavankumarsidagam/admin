<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Course Count</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Courses</li>
            <li class="breadcrumb-item">Course Count</li>
          </ul>
          
          <div class="section-body">
                <!-- add content here -->
                   

                    <div class="row">
                        <div class="col-12">
                                <div class="card">
                                    <div class="card-header pt-3">
                                        <h4>Course Count List</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped text-center" id="courseCountTable">
                                                <thead class="card-body table-responsive">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Course Name</th>
                                                        <th>Student Enrolled</th>
                                                    </tr>                                 
                                                </thead>
                                                <tbody class="card-body table-responsive"></tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <!--  -->
                                
        
                                <!-- closing div -->
                                </div>
                        </div>  
                    </div>               
          </div>
        </section>
      </div>

<?php
require_once('footer.php');
?>

<script>
    $(document).ready(function () {
    function fetchEnrollmentCounts() {
        $.ajax({
            url: 'enrollment_count.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var dataTable = $('#courseCountTable').DataTable();
                dataTable.clear().destroy();
                
                var count = 1;
                data.forEach(function (course) {
                    $('#courseCountTable tbody').append(
                        '<tr>' +
                        '<td>' + count + '</td>' +
                        '<td>' + course.course_name + '</td>' +
                        '<td>' + course.enrollment_count + '</td>' +
                        '</tr>'
                    );
                    count++;
                });
                dataTable = $('#courseCountTable').DataTable();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }
    fetchEnrollmentCounts();
});

</script>
