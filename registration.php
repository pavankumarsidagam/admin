<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Student Registration</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Student Registration</li>
          </ul>
          
          <div class="section-body">
                <!-- add content here -->
                <div class="row">
                <!-- <div class="col-12 col-md-2 col-lg-2"></div> -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Add Student</h4>
                            </div>
                            <div class="card-body">
                                <form id="studentForm" enctype="multipart/form-data" method='POST' action="insert_data.php">
                                    <!-- forms come here -->
                                    <div class="form-group d-none">
                                        <label for="studentId">Student Id</label>
                                        <input type="number" class="form-control" name="studentId" id="studentId">
                                    </div>
                                    <!-- default form -->
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-4">
                                              <label for="firstName">First Name<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="firstName" id="firstName">
                                        </div>
                                        <div class="form-group col-4">
                                              <label for="lastName">Last Name<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="lastName" id="lastName">
                                        </div>
                                        <div class="form-group col-4">
                                              <label for="email">Email<span class="text-danger">*</span></label>
                                              <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                    </div>
                                    
                                    <div class="row g-3 align-items-center">                                    
                                        <div class="form-group col-6">
                                            <label for="course">Course<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="course" id="course">
                                                <option value="">Select Course</option>
                                                <?php
                                                    $c_names = mysqli_query($conn,"SELECT * from courses WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($course_name = mysqli_fetch_object($c_names)){
                                                ?>
                                                <option value="<?php echo $course_name->course_name?>"> <?php echo $course_name->course_name?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                          <label for="gender">Gender<span class="text-danger">*</span></label>
                                            <div class="form-check pt-2">
                                              <input class="form-check-input" type="radio" value="male" id="male" name="gender">
                                              <label class="form-check-label" for="male">Male</label>
                                              <input class="form-check-input" type="radio" value="female" id="female" name="gender">
                                              <label class="form-check-label" for="female">Female</label>
                                              <input class="form-check-input" type="radio" value="other" id="other" name="gender">
                                              <label class="form-check-label" for="other">Other</label>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="number">Phone Number<span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="number" id="number" pattern="[0-9]{10}" maxlength="10"> 
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="alt_number">Alternative Number</label>
                                            <input type="tel"  class="form-control" name="alt_number" id="alt_number" pattern="[0-9]{10}" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="address" id="address"></textarea>
                                    </div>
                                    
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-4">
                                          <label for="program1">Program 1<span class="text-danger">*</span></label>
                                              <div class="form-check pt-2">
                                                <input class="form-check-input" type="radio" value="0" id="program10" name="program1">
                                                <label class="form-check-label" for="program10">0</label>
                                                <input class="form-check-input" type="radio" value="1" id="program1" name="program1">
                                                <label class="form-check-label" for="program1">1</label>
                                              </div>
                                        </div>
                                        <div class="form-group col-4">
                                          <label for="program2">Program 2<span class="text-danger">*</span></label>
                                              <div class="form-check pt-2">
                                                <input class="form-check-input" type="radio" value="0" id="program20" name="program2">
                                                <label class="form-check-label" for="program20">0</label>
                                                <input class="form-check-input" type="radio" value="1" id="program21" name="program2">
                                                <label class="form-check-label" for="program21">1</label>
                                              </div>
                                        </div>
                                        <div class="form-group col-4">
                                          <label for="program3">Program 3<span class="text-danger">*</span></label>
                                              <div class="form-check pt-2">
                                                <input class="form-check-input" type="radio" value="0" id="program30" name="program3">
                                                <label class="form-check-label" for="program30">0</label>
                                                <input class="form-check-input" type="radio" value="1" id="program31" name="program3">
                                                <label class="form-check-label" for="program31">1</label>
                                              </div>
                                        </div>
                                    </div>


                                    <div class="row g-3 align-items-center">
                                      <div class="form-group col-6">
                                        <label for="hearAboutUs">Select Option<span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="hearAboutUs" id="hearAboutUs">
                                          <option value="">Select</option>
                                          <option value="1">Youtube</option>
                                          <option value="2">Facebook</option>
                                          <option value="3">Twitter</option>
                                          <option value="4">Instagram</option>
                                          <option value="5">Website</option>
                                        </select>
                                      </div>
                                      <div class="form-group col-6">
                                        <label for="recommendUs">Would You Recommend Us<span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="recommendUs" id="recommendUs">
                                          <option value="">Select</option>
                                          <option value="Y">Yes</option>
                                          <option value="M">Maybe</option>
                                          <option value="N">No</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                      <div class="form-group col-6">
                                        <label for="reference1">Reference1 Name</label>
                                        <input type="text" class="form-control" name="reference1" id="reference1">
                                      </div>
                                      <div class="form-group col-6">
                                          <label for="reference1Num">Reference1 Number</label>
                                          <input type="text" class="form-control" name="reference1Num" id="reference1Num">
                                      </div>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                      <div class="form-group col-6">
                                        <label for="reference2">Reference2 Name</label>
                                        <input type="text" class="form-control" name="reference2" id="reference2">
                                      </div>
                                      <div class="form-group col-6">
                                          <label for="reference2Num">Reference2 Number</label>
                                          <input type="text" class="form-control" name="reference2Num" id="reference2Num">
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
                <div>
                <div class="col-12">
                            <div class="card">
                                <div class="card-header pt-3">
                                    <h4>Student List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="studentTable">
                                            <thead class="card-body table-responsive" >
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Student Name</th>
                                                    <th>Email</th>
                                                    <th>Course</th>
                                                    <th>Number</th> 
                                                    <th>Gender</th>
                                                    
                                                    <th>Address</th>
                                                    <th>Hear About Us</th>
                                                    <th>Recommend Us</th>
                                                    <th>Referal1 Name</th> 
                                                    <th>Referal1 Number</th>  
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
          </div>
        </section>
      </div>

<?php
require_once('footer.php');
?>

<script>
    $(document).ready(function(){
        $('#studentForm').submit(function (event) {
            
            var formData = new FormData($('#studentForm')[0]);
            formData.append('work', 8);

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
                    $("#studentForm")[0].reset();
                    
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
                data: {'work': 8},
                dataType: 'json',
                success: function (data) {
                                 
                var dataTable = $('#studentTable').DataTable();
                dataTable.clear().destroy();
                
                
                  var count = 1;
                  $.each(data, function (index, student) {


                    var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+student.student_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+student.student_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                    var student_hear_aboutus =student.student_hear_aboutus;

                    if(student_hear_aboutus == 1){
                      student_hear_aboutus = 'Youtube';
                    }else if(student_hear_aboutus == 2){
                      student_hear_aboutus = 'Facebook';
                    }else if(student_hear_aboutus == 3){
                      student_hear_aboutus = 'Twitter';
                    }else if(student_hear_aboutus == 4){
                      student_hear_aboutus = 'Instagram';
                    }else{
                      student_hear_aboutus = 'Website';
                    }

                    

                    $('#studentTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +
                     '<td>' + student.student_fname + ' ' + student.student_lname + '</td>' +                    
                     '<td>' + student.student_email+ '</td>' +
                     '<td>' + student.student_courses+ '</td>' +
                     '<td>' + student.student_number+ '</td>' +
                     '<td>' + student.student_gender+ '</td>' +                    
                     '<td>' + student.student_address+ '</td>' +
                     '<td>' + student_hear_aboutus+ '</td>' +
                     '<td>' + student.student_recommend+ '</td>' +
                     '<td>' + student.ref1+ '</td>' +
                     '<td>' + student.ref1_number+ '</td>' +
                     '<td>' + dropdown+ '</td>' +
                     '</tr>'
                    );
                    count+=1;
                });                
                dataTable = $('#studentTable').DataTable();
                
                },
                error: function (error) {
                  console.error('Error:', error);
                }

            });
            
        };
        fetchData();
});

   /// Hello Tester I'm writing the fetch data Function outside the $(document).ready(function(){)); because when delect function call fetch function it can only call the fetch data function when it isv global.


  
    function fetchData(){
            $.ajax({
                url: 'fetch_data.php',
                type: 'GET',
                data: {'work': 8},
                dataType: 'json',
                success: function (data) {                 
                var dataTable = $('#studentTable').DataTable();
                dataTable.clear().destroy();
                
                
                  var count = 1;
                  $.each(data, function (index, student) {


                    var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+student.student_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+student.student_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                    var student_hear_aboutus =student.student_hear_aboutus;

                    if(student_hear_aboutus == 1){
                      student_hear_aboutus = 'Youtube';
                    }else if(student_hear_aboutus == 2){
                      student_hear_aboutus = 'Facebook';
                    }else if(student_hear_aboutus == 3){
                      student_hear_aboutus = 'Twitter';
                    }else if(student_hear_aboutus == 4){
                      student_hear_aboutus = 'Instagram';
                    }else{
                      student_hear_aboutus = 'Website';
                    }

                    

                    $('#studentTable tbody').append(
                      '<tr>' +
                      '<td>' + count + '</td>' +
                     '<td>' + student.student_fname + ' ' + student.student_lname + '</td>' +                    
                     '<td>' + student.student_email+ '</td>' +
                     '<td>' + student.student_courses+ '</td>' +
                     '<td>' + student.student_number+ '</td>' +
                     '<td>' + student.student_gender+ '</td>' +                    
                     '<td>' + student.student_address+ '</td>' +
                     '<td>' + student_hear_aboutus+ '</td>' +
                     '<td>' + student.student_recommend+ '</td>' +
                     '<td>' + student.ref1+ '</td>' +
                     '<td>' + student.ref1_number+ '</td>' +
                     '<td>' + dropdown+ '</td>' +
                     '</tr>'
                    );
                    count+=1;
                });
                dataTable = $('#studentTable').DataTable();
                },
                error: function (error) {
                  console.error('Error:', error);
                }

            });
            
        };  


    function updateFunction(student_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'student_id': student_id,'work': 8 },
        dataType: 'json',
        success: function (data) {           
               
                $('body, html').animate({
                    scrollTop: 0
                }, 100);                
                $('#studentId').val(data.student_id);
                $('#firstName').val(data.student_fname);
                $('#lastName').val(data.student_lname);
                $('#email').val(data.student_email);

                $('input[name="gender"][value="' + data.student_gender + '"]').prop('checked', true);
               
                $('#number').val(data.student_number);
                $('#alt_number').val(data.student_alt_number);
                $('#address').val(data.student_address);
                $('#course').val(data.student_courses);

                $('input[name="program1"][value="' + data.student_program1 + '"]').prop('checked', true);  
                $('input[name="program2"][value="' + data.student_program2 + '"]').prop('checked', true);  
                $('input[name="program3"][value="' + data.student_program3 + '"]').prop('checked', true);  
                
                $('#hearAboutUs').val(data.student_hear_aboutus);
                $('#recommendUs').val(data.student_recommend);
               
        },
        error: function (error) {
            console.error('Error:', error);
        }
        });
    }

    function deleteFunction(student_id) {
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
                    data: { 'student_id': student_id,'work': 8},
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
