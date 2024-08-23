<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Bootcamp</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Bootcamp</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                <!-- <div class="col-12 col-md-3 col-lg-3"></div> -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Add Bootcamp</h4>
                            </div>
                            <div class="card-body">
                                <form id="bootcampForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none">
                                        <label for="bc_id">Bootcamp Id</label>
                                        <input type="number" class="form-control" name="bc_id" id="bc_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="bc_email">Email<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="bc_email" id="bc_email">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="bc_contact">Contact<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="bc_contact" id="bc_contact">
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
                                    <h4>Bootcamp List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="bootcampTable">
                                            <thead id="mydata">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Action</th>
                                                </tr>                                 
                                            </thead>
                                            <tbody class="table-responsive"></tbody>
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
          $('#bootcampForm').submit(function (event) {
              
              var formData = new FormData($('#bootcampForm')[0]);
              formData.append('work', 10);

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
                      $("#bootcampForm")[0].reset();
                      
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
                  data: {'work': 10},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);

                    var dataTable = $('#bootcampTable').DataTable();
                    dataTable.clear().destroy();

                    count = 1;
                    $.each(data, function (index, bootcamp) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+bootcamp.bc_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+bootcamp.bc_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#bootcampTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +
                      '<td>' + bootcamp.bc_email + '</td>' +                      
                      '<td>' + bootcamp.bc_contact + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;

                  });
                  dataTable = $('#bootcampTable').DataTable();
                  
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
                  data: {'work': 10},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);

                    var dataTable = $('#bootcampTable').DataTable();
                    dataTable.clear().destroy();

                    count = 1;
                    $.each(data, function (index, bootcamp) {
                      var dropdown = '<div class="btn-group"><button type="button" class="btn"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+bootcamp.bc_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+bootcamp.bc_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#bootcampTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +
                      '<td>' + bootcamp.bc_email + '</td>' +                      
                      '<td>' + bootcamp.bc_contact + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count+=1;

                  });
                  dataTable = $('#bootcampTable').DataTable();
                  
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }

              });
              
          };

      function updateFunction(bc_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'bc_id': bc_id,'work': 10},
        dataType: 'json',
        success: function (data) {           
                $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#bc_id').val(data.bc_id);
                $('#bc_email').val(data.bc_email);
                $('#bc_contact').val(data.bc_contact);
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(bc_id) {
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
                    data: {'bc_id': bc_id,'work': 10},
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