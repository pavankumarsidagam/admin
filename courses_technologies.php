<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Course Technologies</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Technologies</li>
            <li class="breadcrumb-item">Course Technologies</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                    <!-- <div class="col-12 col-md-3 col-lg-3"></div> -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Course Technology</h4>
                            </div>
                            <div class="card-body">
                                <form id="courseTechnologyForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none ">
                                        <label for="courses_technologies_id">Courses Technologies Id</label>
                                        <input type="number" class="form-control" name="courses_technologies_id" id="courses_technologies_id">
                                    </div>
                                    <!-- default form -->
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="course">Course<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="course" id="course">
                                                <option value="">Select Course</option>
                                                <?php
                                                    $c_names = mysqli_query($conn,"SELECT * from courses WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($course_name = mysqli_fetch_object($c_names)){
                                                ?>
                                                <option value="<?php echo $course_name->course_id  ?>" > <?php echo $course_name->course_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="technology">Technology<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="technology" id="technology">
                                                <option value="">Select Technology</option>
                                                <?php
                                                    $t_names = mysqli_query($conn,"SELECT * from technologies WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($technology_name = mysqli_fetch_object($t_names)){
                                                ?>
                                                <option value="<?php echo $technology_name->technology_id  ?>" > <?php echo $technology_name->technology_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                    </div>
                                        
                                    
                                    
                                                                                                 
                                    <div class="form-group text-end" >
                                        <input class="btn btn-primary" type="submit" value="Add" name="formSubmit" id="formSubmit">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
           
            </div>
            <div class="row">
            <!-- <div class="col-2"></div> -->
                <div class="col-12">
                        <div class="card">
                                <div class="card-header pt-3">
                                    <h4>Course Technologies List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="course_technologiesTable">
                                            <thead class="card-body table-responsive" id="mydata">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Course Name</th>
                                                    <th>Technology Name</th>
                                                    <!-- <th>About Instructor</th> -->
                                                    <th>Action</th>
                                                </tr>                                 
                                            </thead>
                                            <tbody  class="card-body table-responsive"></tbody>
                                        </table>
                                    </div>
                                </div>


                                <!--  -->
                            
    
                              <!-- closing div -->
                        </div>
                </div>   
            </div>                
            <!--  -->
          </div>
        </section>
      </div>

<?php
require_once('footer.php');
?>

<script>
      $(document).ready(function(){
          $('#courseTechnologyForm').submit(function (event) {
              
              var formData = new FormData($('#courseTechnologyForm')[0]);
              formData.append('work', 7);

              $.ajax({
                  url: 'insert_data.php',
                  type: 'POST',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function (response) {
                      console.log(response);

                      if(response == 1){
                          swal("Good job!", "Upated Successfully!", "success");                       
                      }else if (response == 2){
                          swal("Error!", "Enter All Details!", "info");
                      }else if (response == 3){
                          swal("Good job!", "Inserted Successfully!", "success");
                      }
                      else if (response == 4){
                          swal("Error!", "Enter All Details!!", "info");
                      }
                      
                      fetchData();
                      $("#courseTechnologyForm")[0].reset();
                      
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }
              });
              event.preventDefault();
                        
          });

          function fetchData(){
              $.ajax({
                  url: 'fetch_data.php',
                  type: 'GET',
                  data: {'work': 7},
                  dataType: 'json',
                  success: function (data) {                 

                    var dataTable = $('#course_technologiesTable').DataTable();
                    dataTable.clear().destroy();

                    count = 1;
                    $.each(data, function (index, courseTechnology) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+courseTechnology.courses_technologies_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+courseTechnology.courses_technologies_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#course_technologiesTable tbody').append(
                      '<tr>' +
                       '<td>' + count	 + '</td>' +
                       '<td>' + courseTechnology.course_name + '</td>' +                    
                       '<td>' + courseTechnology.technology_name + '</td>' +
                       '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                  });
                  dataTable = $('#course_technologiesTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
          };
          fetchData();
      });

       /// Hello Tester I'm writing the fetch data Function outside the $(document).ready(function(){)); because when delecting it can only call the fetch data function when it is global.

        function fetchData(){
              $.ajax({
                  url: 'fetch_data.php',
                  type: 'GET',
                  data: {'work': 7},
                  dataType: 'json',
                  success: function (data) {                 

                    var dataTable = $('#course_technologiesTable').DataTable();
                    dataTable.clear().destroy();

                    count = 1;
                    $.each(data, function (index, courseTechnology) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+courseTechnology.courses_technologies_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+courseTechnology.courses_technologies_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#course_technologiesTable tbody').append(
                      '<tr>' +
                       '<td>' + count	 + '</td>' +
                       '<td>' + courseTechnology.course_name + '</td>' +                    
                       '<td>' + courseTechnology.technology_name + '</td>' +
                       '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                  });
                  dataTable = $('#course_technologiesTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
          };

      function updateFunction(courses_technologies_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'courses_technologies_id': courses_technologies_id,'work': 7},
        dataType: 'json',
        success: function (data) {           
                $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#courses_technologies_id').val(data.courses_technologies_id);
                $('#course').val(data.course_id);
                $('#technology').val(data.technology_id);
               
        },
        error: function (error) {
            console.error('Error:', error);
        }
        });
    }

   

    function deleteFunction(courses_technologies_id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'delete_data.php', 
                    type: 'GET',
                    data: { 'courses_technologies_id': courses_technologies_id,'work': 7},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        swal("Poof! Your Record has been deleted!", {
                            icon: "success",
                            });
                            fetchData();
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
                
            } else {
                swal("Your Record is safe!");
            }
            });        
    }
  </script>