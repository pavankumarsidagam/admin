<?php
require_once('header.php');
session_start();
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Access Keys</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Access keys</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                <!-- <div class="col-12 col-md-3 col-lg-3"></div> -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Acess Key</h4>
                            </div>
                            <div class="card-body">
                                <form id="accessForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none">
                                        <label for="ak_id">Access Id</label>
                                        <input type="number" class="form-control" name="ak_id" id="ak_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group">
                                            <label for="ak">Access Key<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="ak" id="ak">
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
                                    <h4>Access Key List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="akTable">
                                            <thead class="card-body table-responsive">
                                                <tr>
                                                    <th>Tag Id</th>
                                                    <th>Access Key</th>
                                                    <th>Action</th>
                                                </tr>                                 
                                            </thead>
                                            <tbody lass="card-body table-responsive"></tbody>
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
          $('#accessForm').submit(function (event) {
              
              var formData = new FormData($('#accessForm')[0]);
              formData.append('work', 9);

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
                      $("#accessForm")[0].reset();
                      fetchData();
                     
                      
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
                  data: {'work': 9},
                  dataType: 'json',
                  success: function (data) {                 
                    var dataTable = $('#akTable').DataTable();
                    dataTable.clear().destroy();
                
                    count = 1;
                    $.each(data, function (index, ak) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+ak.ak_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+ak.ak_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#akTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +                    
                      '<td>' + ak.ak + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                  });
                  dataTable = $('#akTable').DataTable();
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
                  data: {'work': 9},
                  dataType: 'json',
                  success: function (data) {                 
                    var dataTable = $('#akTable').DataTable();
                    dataTable.clear().destroy();
                
                    count = 1;
                    $.each(data, function (index, ak) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+ak.ak_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+ak.ak_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#akTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +                    
                      '<td>' + ak.ak + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;
                  });
                  dataTable = $('#akTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
          };

      function updateFunction(ak_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'ak_id': ak_id,'work': 9},
        dataType: 'json',
        success: function (data) {           
                
                $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#ak_id').val(data.ak_id);
                $('#ak').val(data.ak);
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(ak_id) {
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
                    data: {'ak_id': ak_id,'work': 9},
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