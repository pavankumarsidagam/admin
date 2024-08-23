<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Add Technology</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Technologies</li>
            <li class="breadcrumb-item">Add Technology</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                <!-- <div class="col-12 col-md-3 col-lg-3"></div> -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Add Technology</h4>
                            </div>
                            <div class="card-body">
                                <form id="technologyForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none">
                                        <label for="technology_id">Technology Id</label>
                                        <input type="number" class="form-control" name="technology_id" id="technology_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group">
                                            <label for="technologyName">Technology Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="technologyName" id="technologyName">
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
            
            <div class="row" >
            <!-- <div class="col-2"></div> -->
            <div class="col-12">
                            <div class="card">
                                <div class="card-header pt-3">
                                    <h4>Technology List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="technologyTable">
                                            <thead  class="card-body table-responsive">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Technologies</th>
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
          $('#technologyForm').submit(function (event) {
              
              var formData = new FormData($('#technologyForm')[0]);
              formData.append('work', 6);

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
                     
                      $("#technologyForm")[0].reset();
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
                  data: {'work': 6 },
                  dataType: 'json',
                  success: function (data) {                 
                    var dataTable = $('#technologyTable').DataTable();
                    dataTable.clear().destroy();

                    var count = 1;
                    $.each(data, function (index, technology) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+technology.technology_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+technology.technology_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#technologyTable tbody').append(
                      '<tr>' +
                      '<td>' + count+ '</td>' +                    
                      '<td>' + technology.technology_name + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                    });
                    
                    dataTable = $('#technologyTable').DataTable();
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
                  data: {'work': 6 },
                  dataType: 'json',
                  success: function (data) {                 
                    var dataTable = $('#technologyTable').DataTable();
                    dataTable.clear().destroy();

                    var count = 1;
                    $.each(data, function (index, technology) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+technology.technology_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+technology.technology_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#technologyTable tbody').append(
                      '<tr>' +
                      '<td>' + count+ '</td>' +                    
                      '<td>' + technology.technology_name + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                    });
                    
                    dataTable = $('#technologyTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
        };    
      


      function updateFunction(technology_id) {
            $.ajax({
            url: 'fetch_data.php', 
            type: 'GET',
            data: { 'technology_id': technology_id,'work': 6},
            dataType: 'json',
            success: function (data) {           
                    
                    $('body, html').animate({
                        scrollTop: 0
                    }, 100);

                    $('#technology_id').val(data.technology_id);
                    $('#technologyName').val(data.technology_name);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

        function deleteFunction(technology_id) {
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
                        data: { 'technology_id': technology_id,'work': 6},
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