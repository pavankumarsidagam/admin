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
            <li class="breadcrumb-item">Instructor Social Tags</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Instructor Social Tags</h4>
                            </div>
                            <div class="card-body">
                                <form id="instructorSocialTagsForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none ">
                                        <label for="instructor_social_tags_id">Instructor Id</label>
                                        <input type="number" class="form-control" name="instructor_social_tags_id" id="instructor_social_tags_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-4">
                                            <label for="instructor">Instructor<span class="text-danger">*</span></label>
                                            <select class="form-control form-select"  name="instructor" id="instructor">
                                                <option value="">Select Instructor</option>
                                                <?php
                                                    $i_names = mysqli_query($conn,"SELECT * from instructors WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($instructor_name = mysqli_fetch_object($i_names)){
                                                ?>
                                                <option value="<?php echo $instructor_name->instructor_id ?>" > <?php echo $instructor_name->instructor_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="socialMedia">Social Media<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="socialMedia" id="socialMedia">
                                                <option value="">Select Social Type</option>
                                                <option value="1">Twitter</option>
                                                <option value="2">Facebook</option>
                                                <option value="3">Instagram</option>                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="socialUrl">Social Tag Url<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="socialUrl" id="socialUrl">
                                        </div>
                                    </div>                                                              
                                    <div class="form-group text-center" >
                                        <input class="btn btn-primary" type="submit" value="Add" name="formSubmit" id="formSubmit">
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
                                    <h4>Instructor Social Tags List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="instructorSocialTagTable">
                                            <thead class="card-body table-responsive" id="mydata">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Instructor Name</th>
                                                    <th>Profile</th>
                                                    <th>Social Tag Type</th>
                                                    <th>Social Tag Url</th>
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
          $('#instructorSocialTagsForm').submit(function (event) {
              
              var formData = new FormData($('#instructorSocialTagsForm')[0]);
              formData.append('work', 3);

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
                      $("#instructorSocialTagsForm")[0].reset();
                      
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
                  data: {'work': 3 },
                  dataType: 'json',
                  success: function (data) {                 
                    
                    var dataTable = $('#instructorSocialTagTable').DataTable();
                    dataTable.clear().destroy();

                    count = 1;
                    $.each(data, function (index, instructor) {
                        var $uploadDir = 'http://localhost/admin_portal/instructor_profile_image/'+instructor.instructor_profile_image ;
                    
                        var instructorImage = '<img alt="image" src="' + $uploadDir + '"class="rounded-circle" width="60" data-bs-toggle="tooltip" >';
                        var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction(' + instructor.instructor_social_tags_id + ')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction(' + instructor.instructor_social_tags_id + ')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                        var icon = ''; 

                        if (instructor.instructor_social_tags_type == "1") {
                            icon = '<i class=""></i><span>Twitter</span>';
                        } else if (instructor.instructor_social_tags_type == "2") {
                            icon = '<i class=""></i><span>Facebook</span>';
                        } else if (instructor.instructor_social_tags_type == "3") {
                            icon = '<i class=""></i><span>Instagram</span>';
                        }

                        $('#instructorSocialTagTable tbody').append(
                            '<tr>' +
                            '<td>' + count + '</td>' +
                            '<td>' + instructor.instructor_name + '</td>' +
                            '<td>' + instructorImage + '</td>' +
                            '<td>' + icon + '</td>' +
                            '<td>' + instructor.instructor_social_tags_url + '</td>' +
                            '<td>' + dropdown + '</td>' +
                            '</tr>'
                        )
                        count+=1;
                  });
                  dataTable = $('#instructorSocialTagTable').DataTable();
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
                  data: {'work': 3 },
                  dataType: 'json',
                  success: function (data) { 
                    console.log(data);                
                    
                    var dataTable = $('#instructorSocialTagTable').DataTable();
                    dataTable.clear().destroy();

                    count = 1;
                    $.each(data, function (index, instructor) {
                    
                        var instructorImage = '<img alt="image" src="' + instructor.instructor_profile_image + '"class="rounded-circle" width="60" data-bs-toggle="tooltip" >';
                        var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction(' + instructor.instructor_social_tags_id + ')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction(' + instructor.instructor_social_tags_id + ')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                        var icon = ''; 

                        if (instructor.instructor_social_tags_type == "1") {
                            icon = '<i class=""></i><span>Twitter</span>';
                        } else if (instructor.instructor_social_tags_type == "2") {
                            icon = '<i class=""></i><span>Facebook</span>';
                        } else if (instructor.instructor_social_tags_type == "3") {
                            icon = '<i class=""></i><span>Instagram</span>';
                        }

                        $('#instructorSocialTagTable tbody').append(
                            '<tr>' +
                            '<td>' + count + '</td>' +
                            '<td>' + instructor.instructor_name + '</td>' +
                            '<td>' + instructorImage + '</td>' +
                            '<td>' + icon + '</td>' +
                            '<td>' + instructor.instructor_social_tags_url + '</td>' +
                            '<td>' + dropdown + '</td>' +
                            '</tr>'
                        )
                        count+=1;
                  });
                  dataTable = $('#instructorSocialTagTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
        };





      function updateFunction(instructor_social_tags_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'instructor_social_tags_id': instructor_social_tags_id,'work': 3 },
        dataType: 'json',
        success: function (data) {           
                console.log(data);
                $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#instructor_social_tags_id').val(data.instructor_social_tags_id);
                $('#instructor').val(data.instructor_id);
                $('#socialMedia').val(data.	instructor_social_tags_type	);
                $('#socialUrl').val(data.instructor_social_tags_url);
               
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(instructor_social_tags_id) {
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
                    data: { 'instructor_social_tags_id': instructor_social_tags_id,'work': 3},
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
