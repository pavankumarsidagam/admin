<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Courses</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Courses</li>
            <li class="breadcrumb-item">Course Curriculum</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Course Curriculum</h4>
                            </div>
                            <div class="card-body">
                                <form id="curriculumForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none ">
                                        <label for="curriculum_id">Curriculum Id</label>
                                        <input type="number" class="form-control" name="curriculum_id" id="curriculum_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                          <label for="day_no">Day No<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" name="day_no" id="day_no">
                                        </div>
                                        <div class="form-group col-6">
                                          <label for="technology_id">Technology<span class="text-danger">*</span></label>
                                          <select class="form-control form-select"  name="technology_id" id="technology_id">
                                                <option value="">Select Technology</option>
                                                <?php
                                                    $t_names = mysqli_query($conn,"SELECT * from technologies WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($technology_name = mysqli_fetch_object($t_names)){
                                                ?>
                                                <option value="<?php echo $technology_name->technology_id ?>" > <?php echo $technology_name->technology_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>                                        
                                    </div>
                                    
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                          <label for="technology_details">Technology Details<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" name="technology_details" id="technology_details">
                                        </div>
                                        <div class="form-group col-3">
                                          <label for="training_time">Training Time<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" name="training_time" id="training_time">
                                        </div>
                                        <div class="form-group col-3">
                                          <label for="practice_time">Pratice Time<span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" name="practice_time" id="practice_time">
                                        </div>
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
                                    <h4>Course Curriculum List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="curriculumTable">
                                            <thead class="card-body table-responsive" id="mydata">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Day No</th>
                                                    <th>Technology</th>
                                                    <th>Topic</th>
                                                    <th>Training Time</th>
                                                    <th>Pratice Time</th>
                                                    <th>Action</th>
                                                </tr>                                 
                                            </thead>
                                            <tbody class="card-body table-responsive"></tbody>
                                        </table>
                                    </div>
                                </div>

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
          $('#curriculumForm').submit(function (event) {
              
              var formData = new FormData($('#curriculumForm')[0]);
              formData.append('work', 11);

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
                          fetchData();   
                      }
                      else if (response == 4){
                          swal("Error!", "Enter All Details!!", "info");
                      }
                      
                      fetchData();
                      $("#curriculumForm")[0].reset();
                      
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
                  data: {'work': 11},
                  dataType: 'json',
                  success: function (data) {                 
                   
                    var dataTable = $('#curriculumTable').DataTable();
                    dataTable.clear().destroy();
                
                    count = 1;
                    $.each(data, function (index, curriculum) {
                    
                   
                    var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction(' + curriculum.curriculum_id + ')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction(' + curriculum.curriculum_id  + ')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                        

                        $('#curriculumTable tbody').append(
                            '<tr>' +
                            '<td>' + count + '</td>' +
                            '<td>' + curriculum.day_no + '</td>' +
                            '<td>' + curriculum.technology_name + '</td>' +
                            '<td>' + curriculum.technology_details + '</td>' +
                            '<td>' + curriculum.training_time + '</td>' +
                            '<td>' + curriculum.practice_time + '</td>' +
                            '<td>' + dropdown + '</td>' +
                            '</tr>'
                        )
                        count+=1;
                  });
                  dataTable = $('#curriculumTable').DataTable();
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
                  data: {'work': 11},
                  dataType: 'json',
                  success: function (data) {                 
                   
                    var dataTable = $('#curriculumTable').DataTable();
                    dataTable.clear().destroy();
                
                    count = 1;
                    $.each(data, function (index, curriculum) {
                    
                   
                    var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction(' + curriculum.curriculum_id + ')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction(' + curriculum.curriculum_id  + ')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                        

                        $('#curriculumTable tbody').append(
                            '<tr>' +
                            '<td>' + count + '</td>' +
                            '<td>' + curriculum.day_no + '</td>' +
                            '<td>' + curriculum.technology_name + '</td>' +
                            '<td>' + curriculum.technology_details + '</td>' +
                            '<td>' + curriculum.training_time + '</td>' +
                            '<td>' + curriculum.practice_time + '</td>' +
                            '<td>' + dropdown + '</td>' +
                            '</tr>'
                        )
                        count+=1;
                  });
                  dataTable = $('#curriculumTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
        
          };
      
      
      
        function updateFunction(curriculum_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'curriculum_id': curriculum_id,'work': 11},
        dataType: 'json',
        success: function (data) {           
                
                $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#curriculum_id').val(data.curriculum_id);
                $('#technology_id').val(data.technology_id);
                $('#day_no').val(data.day_no);
                $('#training_time').val(data.training_time);
                $('#practice_time').val(data.practice_time);
                $('#technology_details').val(data.technology_details);
                              
                
               
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(curriculum_id) {
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
                    data: { 'curriculum_id': curriculum_id,'work': 11},
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
