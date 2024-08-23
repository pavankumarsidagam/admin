<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Counts</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Counts</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Counts</h4>
                            </div>
                            <div class="card-body">
                                <form id="countsForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none ">
                                        <label for="count_id">CO Id</label>
                                        <input type="number" class="form-control" name="count_id" id="count_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-3">
                                            <label for="finished_sessions">Finished Sessions</label>
                                            <input type="number" class="form-control" name="finished_sessions" id="finished_sessions">
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="online_enrollment">Online Enrollment<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="online_enrollment" id="online_enrollment">
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="subjects_taught">Subjects Taught<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="subjects_taught" id="subjects_taught">
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="satisfaction_rate">Satisfaction Rate<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="satisfaction_rate" id="satisfaction_rate">
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
                                    <h4>Count List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="countsTable">
                                            <thead class="card-body table-responsive" id="mydata">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Course</th>
                                                    <th>Number of Openings</th>
                                                    <th>Hiring</th>
                                                    <th>Hiring</th>
                                                    <th>Action</th>
                                                </tr>                                 
                                            </thead>
                                            <tbody class="card-body table-responsive">
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
          $('#countsForm').submit(function (event) {
              
              var formData = new FormData($('#countsForm')[0]);
              formData.append('work', 14);

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
                      }else if (response == 5){
                          swal("Error!", "The Satisfaction Rate Can't Be high Then 100%!", "info");
                      }else if (response == 2){
                          swal("Error!", "Enter All Details!", "info");
                      }else if (response == 3){
                          swal("Good job!", "Inserted Successfully!", "success");
                      }
                      else if (response == 4){
                          swal("Error!", "Enter All Details!!", "info");
                      }
                      
                      fetchData();
                      $("#countsForm")[0].reset();
                      
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
                  data: {'work': 14},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#countsTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, counts) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+counts.count_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+counts.count_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#countsTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + counts.finished_sessions + '</td>' +                    
                      '<td>' + counts.online_enrollment + '</td>' +
                      '<td>' + counts.subjects_taught + '</td>' +
                      '<td>' + counts.satisfaction_rate +' %' + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#countsTable').DataTable();
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
                  data: {'work': 14},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#countsTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, counts) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+counts.count_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+counts.count_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#countsTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + counts.finished_sessions + '</td>' +                    
                      '<td>' + counts.online_enrollment + '</td>' +
                      '<td>' + counts.subjects_taught + '</td>' +
                      '<td>' + counts.satisfaction_rate + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#countsTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }
              });
          };
        


      function updateFunction(count_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'count_id': count_id,'work': 14},
        dataType: 'json',
        success: function (data) {           
               // console.log(data);
               $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#count_id').val(data.count_id);
                $('#finished_sessions').val(data.finished_sessions);
                $('#online_enrollment').val(data.online_enrollment);
                $('#subjects_taught').val(data.subjects_taught);
                $('#satisfaction_rate').val(data.satisfaction_rate);
               
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(count_id) {
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
                    data: { 'count_id': count_id,'work': 14},
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
