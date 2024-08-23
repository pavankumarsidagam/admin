<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Reach Us</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Reach Us</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                <!-- <div class="col-12 col-md-3 col-lg-3"></div> -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Reach Us</h4>
                            </div>
                            <div class="card-body">
                                <form id="reachUsForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none">
                                        <label for="contact_id">Contact Id Reach Us</label>
                                        <input type="number" class="form-control" name="contact_id" id="contact_id">
                                    </div>
                                    <!-- default form -->
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="contact_name">Contact Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="contact_name" id="contact_name">
                                        </div>
                                        <!-- <div class="form-group col-2"></div> -->
                                        <div class="form-group col-6">
                                            <label for="contact_email">Contact Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="contact_email" id="contact_email">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="contact_subject">Subject<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="contact_subject" id="contact_subject">
                                        </div>
                                        <!-- <div class="form-group col-2"></div> -->
                                        <div class="form-group col-6">
                                            <label for="email_headers">Email Header<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email_headers" id="email_headers">
                                        </div>
                                    </div>

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group">
                                            <label for="contact_message">Message<span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="4" name="contact_message" id="contact_message"></textarea>
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
            
            <div class="row" >
            <!-- <div class="col-2"></div> -->
            <div class="col-12">
                            <div class="card">
                                <div class="card-header pt-3">
                                    <h4>Reach Us List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="reachUsTable">
                                            <thead  class="card-body table-responsive">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Header</th>
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
          $('#reachUsForm').submit(function (event) {
              
              var formData = new FormData($('#reachUsForm')[0]);
              formData.append('work', 12);

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
                      $("#reachUsForm")[0].reset();
                      
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
                  data: {'work': 12},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#reachUsTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, reachUs) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+reachUs.contact_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+reachUs.contact_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#reachUsTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + reachUs.contact_name	 + '</td>' +                    
                      '<td>' + reachUs.contact_email + '</td>' +
                      '<td>' + reachUs.contact_subject + '</td>' +
                      '<td>' + reachUs.contact_message + '</td>' +
                      '<td>' + reachUs.email_headers + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#reachUsTable').DataTable();
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
                  data: {'work': 12},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#reachUsTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, reachUs) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+reachUs.contact_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+reachUs.contact_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#reachUsTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + reachUs.contact_name	 + '</td>' +                    
                      '<td>' + reachUs.contact_email + '</td>' +
                      '<td>' + reachUs.contact_subject + '</td>' +
                      '<td>' + reachUs.contact_message + '</td>' +
                      '<td>' + reachUs.email_headers + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#reachUsTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }
              });
          };

      function updateFunction(contact_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'contact_id': contact_id,'work': 12 },
        dataType: 'json',
        success: function (data) {           
               // console.log(data);
               $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#contact_id').val(data.contact_id);
                $('#contact_name').val(data.contact_name);
                $('#contact_email').val(data.contact_email);
                $('#contact_subject').val(data.contact_subject);
                $('#contact_message').val(data.contact_message);
                $('#email_headers').val(data.email_headers);
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(contact_id) {
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
                    data: { 'contact_id': contact_id,'work': 12},
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
