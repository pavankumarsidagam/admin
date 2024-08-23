<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Instructors</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Instructors</li>
            <li class="breadcrumb-item">Add Instructor</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Add Instructor</h4>
                            </div>
                            <div class="card-body">
                                <form id="instructorForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none ">
                                        <label for="instructorId">Instructor Id</label>
                                        <input type="number" class="form-control" name="instructorId" id="instructorId">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-4">
                                          <label for="instructorName">Instructor Name<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" name="instructorName" id="instructorName">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="instructorImage">Instructor Profile Photo<span class="text-danger">*</span></label>
                                            <!--  -->
                                            <img id="instructorImageDisplay" class="gallery-item d-none" width="75" data-bs-toggle="tooltip">
                                            <input id='hidden_instructorImage' type="text" class='hidden_instructorImage d-none' name='hidden_instructorImage'>
                                            <!--  -->
                                            <input type="file" class="form-control" name="instructorImage" id="instructorImage" accept="image/*">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="instructorDesignation">Instructor Designation<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="instructorDesignation" id="instructorDesignation">
                                        </div>
                                    </div>                                   

                                    <div class="form-group">
                                        <label for="aboutInstructor">About Instructor<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="aboutInstructor" id="aboutInstructor"></textarea>
                                    </div>                                   
                                    <div class="form-group text-center" >
                                        <input class="btn btn-primary" type="submit" value="Submit" name="formSubmit" id="formSubmit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-12">
                            <div class="card">
                                <div class="card-header pt-3">
                                    <h4>Instructors List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="instructorTable">
                                            <thead  class="card-body table-responsive" id="mydata">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Instructor Name</th>
                                                    <th>Instructor Profile</th>
                                                    <th>Instructor Designation</th>
                                                    <th>About Instructor</th>
                                                    <th>Action</th>
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
            <!--  -->
          </div>
        </section>
      </div>

<?php
require_once('footer.php');
?>

<script>
      $(document).ready(function(){
          $('#instructorForm').submit(function (event) {
              
              var formData = new FormData($('#instructorForm')[0]);
              formData.append('work', 2);

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
                      $("#instructorForm")[0].reset();
                      
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
                  data: {'work': 2 },
                  dataType: 'json',
                  success: function (data) {  

                    var dataTable = $('#instructorTable').DataTable();
                    dataTable.clear().destroy();

                    var count=1;
                    $.each(data, function (index, instructor) {
                        var $uploadDir = 'http://localhost/admin_portal/instructor_profile_image/'+instructor.instructor_profile_image ;


                      var instructorImage = '<img alt="image" src="' + $uploadDir + '" class="rounded-circle" width="80" data-bs-toggle="tooltip" >'



                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+instructor.instructor_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+instructor.instructor_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';


                      

                      $('#instructorTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +  
                      '<td>' + instructor.instructor_name	 + '</td>' +                    
                      '<td>' + instructorImage + '</td>' +
                      '<td>' + instructor.instructor_designation + '</td>' +
                      '<td>' + instructor.about_instructor + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                  });
                  dataTable = $('#instructorTable').DataTable();
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
                  data: {'work': 2 },
                  dataType: 'json',
                  success: function (data) {  

                    var dataTable = $('#instructorTable').DataTable();
                    dataTable.clear().destroy();

                    var count=1;
                    $.each(data, function (index, instructor) {
                    var $uploadDir = 'http://localhost/admin_portal/instructor_profile_image/'+instructor.instructor_profile_image ;



                      var instructorImage = '<img alt="image" src="' + $uploadDir + '" class="rounded-circle" width="80" data-bs-toggle="tooltip" >'



                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+instructor.instructor_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+instructor.instructor_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      

                      $('#instructorTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +  
                      '<td>' + instructor.instructor_name	 + '</td>' +                    
                      '<td>' + instructorImage + '</td>' +
                      '<td>' + instructor.instructor_designation + '</td>' +
                      '<td>' + instructor.about_instructor + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                  });
                  dataTable = $('#instructorTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
          };

      function updateFunction(instructor_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'instructor_id': instructor_id,'work': 2 },
        dataType: 'json',
        success: function (data) {           
                $('body, html').animate({
                    scrollTop: 0
                }, 100);
                var instructor_image_url = data.instructor_profile_image;

                $('#instructorId').val(data.instructor_id);
                $('#instructorName').val(data.instructor_name);
                $('#instructorDesignation').val(data.instructor_designation);
                $('#aboutInstructor').val(data.about_instructor);
                              


                $('#hidden_instructorImage').val(instructor_image_url);
                $('#instructorImageDisplay').attr('src', instructor_image_url);  

               
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(instructor_id) {
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
                    data: { 'instructor_id': instructor_id,'work': 2},
                    dataType: 'json',
                    success: function (data) {
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
