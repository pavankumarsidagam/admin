<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Current Openings</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Current Openings</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Current Openings</h4>
                            </div>
                            <div class="card-body">
                                <form id="currentOpeningForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none ">
                                        <label for="co_id">CO Id</label>
                                        <input type="number" class="form-control" name="co_id" id="co_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-4">
                                            <label for="coursename">Course Name<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="coursename" id="coursename">
                                                <option value="">Select Course</option>
                                                <?php
                                                    $c_names = mysqli_query($conn,"SELECT * from courses WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($course_name = mysqli_fetch_object($c_names)){
                                                ?>
                                                <option value="<?php echo $course_name->course_name ?>" > <?php echo $course_name->course_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="noofopen">Number Of Openings<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="noofopen" id="noofopen">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="hiring">Hirings<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="hiring" id="hiring">
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
                                    <h4>Current Openings List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="currentOpeningsTable">
                                            <thead  class="card-body table-responsive">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Course</th>
                                                    <th>Number of Openings</th>
                                                    <th>Hiring</th>
                                                    <th>Action</th>
                                                </tr>                                 
                                            </thead>
                                            <tbody class="table-responsive">
                                            </tbody>
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
          $('#currentOpeningForm').submit(function (event) {
              
              var formData = new FormData($('#currentOpeningForm')[0]);
              formData.append('work', 13);

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
                          //fetchData();                        
                      }else if (response == 2){
                          swal("Error!", "Enter All Details!", "info");
                      }else if (response == 3){
                          swal("Good job!", "Inserted Successfully!", "success");
                      }
                      else if (response == 4){
                          swal("Error!", "Enter All Details!!", "info");
                      }
                      
                      fetchData();
                      $("#currentOpeningForm")[0].reset();
                      
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
                  data: {'work': 13},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#currentOpeningsTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, co) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+co.co_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+co.co_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#currentOpeningsTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + co.coursename + '</td>' +                    
                      '<td>' + co.noofopean + '</td>' +
                      '<td>' + co.hiring + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#currentOpeningsTable').DataTable();
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
                  data: {'work': 13},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#currentOpeningsTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, co) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+co.co_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+co.co_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#currentOpeningsTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + co.coursename + '</td>' +                    
                      '<td>' + co.noofopean + '</td>' +
                      '<td>' + co.hiring + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#currentOpeningsTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }
              });
          };

      function updateFunction(co_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'co_id': co_id,'work': 13},
        dataType: 'json',
        success: function (data) {           
               // console.log(data);
               $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#co_id').val(data.co_id);
                $('#coursename').val(data.coursename);
                $('#noofopen').val(data.noofopean);
                $('#hiring').val(data.hiring);
               
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(co_id) {
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
                    data: { 'co_id': co_id,'work': 13},
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
