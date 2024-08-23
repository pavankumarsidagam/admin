<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Add Course</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Courses</li>
            <li class="breadcrumb-item">Add Course</li>
          </ul>
          
          <div class="section-body">
                <!-- add content here -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Add Course</h4>
                            </div>
                            <div class="card-body">
                                <form id="courseForm" enctype="multipart/form-data" method='POST'>
                                    <!-- forms come here -->
                                    <div class="form-group">
                                        <label for="courseId">Course Id</label>
                                        <input type="number" class="form-control" name="courseId" id="courseId">
                                    </div>
                                    <!-- default form -->
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                              <label for="courseName">Course Name<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="courseName" id="courseName">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="instructor">Instructor<span class="text-danger">*</span></label>
                                            <select class="form-control form-select" name="instructor" id="instructor">
                                                <option value="">Select Instructor</option>
                                                <?php
                                                    $i_names = mysqli_query($conn,"SELECT * from instructors WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($instructor_name = mysqli_fetch_object($i_names)){
                                                ?>
                                                <option value="<?php echo $instructor_name->instructor_id ?>" > <?php echo $instructor_name->instructor_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="courseImage">Course Image<span class="text-danger">*</span></label>
                                            <!--  -->
                                            <img id="courseImageDisplay" class="gallery-item d-none" width="75" data-bs-toggle="tooltip">
                                            <input id='hidden_courseImage' type="text" class='hidden_courseImage d-none' name='hidden_courseImage'>
                                            <!--  -->
                                            <input type="file" class="form-control" name="courseImage" id="courseImage" accept="image/*">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="relatedCourses">Related Courses<span class="text-danger">*</span></label>
                                            <select class="form-control select2" multiple="" name="relatedCourses[]" id="relatedCourses">
                                                    <?php
                                                        $r_courses = mysqli_query($conn,"SELECT course_name from courses WHERE status = '1'") or die(mysqli_error($conn));
                                                        while ($related_courses = mysqli_fetch_object($r_courses)){
                                                    ?>
                                                    <option value="<?php echo $related_courses->course_name ?>" > <?php echo $related_courses->course_name ?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseDescription">Course Description<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="courseDescription" id="courseDescription"></textarea>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="courseBannerImage">Course Banner Image<span class="text-danger">*</span></label>
                                            <!--  -->
                                            <img id="courseBannerImageDisplay" class="gallery-item d-none" width="75" data-bs-toggle="tooltip">
                                            <input id='hidden_courseBannerImage' type="text" class='hidden_courseBannerImage d-none' name='hidden_courseBannerImage'>
                                            <!--  -->
                                            <input type="file" class="form-control" name="courseBannerImage" id="courseBannerImage" accept="image/*">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lessons">Lessions<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="lessons" id="lessons">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="courseShareImage">Course Share Image<span class="text-danger">*</span></label>
                                            <!--  -->
                                            <img id="courseShareImageDisplay" class="gallery-item d-none" width="75" data-bs-toggle="tooltip">
                                            <input id='hidden_courseShareImage' type="text" class='hidden_courseShareImage d-none' name='hidden_courseShareImage'>
                                            <!--  -->
                                            <input type="file" class="form-control" name="courseShareImage" id="courseShareImage" accept="image/*">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="iframeUrl">Iframe Url<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="iframeUrl" id="iframeUrl"> 
                                        </div>                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="courseShareDescription">Course Share Description<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="courseShareDescription" id="courseShareDescription"></textarea>
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
                                        <h4>Course List</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped text-center" id="courseTable">
                                                <thead  class="card-body table-responsive">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Course Name</th>
                                                        <th>Instructor Name</th>
                                                        <!-- <th>Instructor Name</th> -->
                                                        <th>Course Image</th>
                                                        <th>Course Description</th>
                                                        <th>Banner Image</th> 
                                                        <th>Related Courses</th>

                                                        <th>Lessions</th>
                                                        <!-- <th>Course Name</th>  -->
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

<!-- Ajax Function -->
   
<script>
    $(document).ready(function(){
        $('#courseForm').submit(function (event) {
            
            var formData = new FormData($('#courseForm')[0]);
            formData.append('work', 1);

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
                    $("#courseForm")[0].reset();
                    
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
                data: {'work': 1 },
                dataType: 'json',
                success: function (data) {    
                    console.log(data); 

                    var dataTable = $('#courseTable').DataTable();
                    dataTable.clear().destroy();

                    var count = 1;
                  $.each(data, function (index, course) {

                    var relatedCourses = course.related_courses.split(',');
                    var relatedCoursesString = relatedCourses.join(', ');


                    var courseImageuploadDir = 'http://localhost/admin_portal/course_image/'+course.course_image;
                    var courseShareImageuploadDir = 'http://localhost/admin_portal/course_share_image/' + course.course_share_image;
                    var courseBannerImageuploadDir = 'http://localhost/admin_portal/course_banner_image/'+ course.course_banner_image;

                    var courseImage = '<img alt="image" src="' + courseImageuploadDir + '" class="gallery-item" width="120" data-bs-toggle="tooltip" >';
                    var courseShareImage = '<img alt="image" src="' + courseShareImageuploadDir + '" class="square" width="120" data-bs-toggle="tooltip" >';
                    var courseBannerImage = '<img alt="image" src="' + courseBannerImageuploadDir + '" class="gallery-item" width="120" data-bs-toggle="tooltip" >';



                    var dropdown = '<div class="btn-group"><button type="button" class="btn"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+course.course_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+course.course_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';


                    

                    $('#courseTable tbody').append(
                     '<tr>' +
                     '<td>' + count + '</td>' +  
                     '<td>' + course.course_name + '</td>' +  
                     '<td>' + course.instructor_name + '</td>' +                  
                     '<td>' + courseImage + '</td>' +
                     '<td>' + course.course_description + '</td>' +
                    // '<td>' + courseShareImage + '</td>' +
                    '<td>' + courseBannerImage + '</td>' +
                    // '<td>' + course.courseShareDescription + '</td>' +
                    '<td>' + relatedCoursesString + '</td>' +
                    // '<td>' + course.iframeUrl + '</td>' +
                     
                    '<td>' + course.lessions + '</td>' +
                    //  '<td>' + dropdown2 + '</td>' +
                    '<td>' + dropdown +'</td>' +
                    '</tr>'
                    );
                    count+=1;
                });
                dataTable = $('#courseTable').DataTable();
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
                data: {'work': 1 },
                dataType: 'json',
                success: function (data) {     

                    var dataTable = $('#courseTable').DataTable();
                    dataTable.clear().destroy();

                    var count = 1;
                  $.each(data, function (index, course) {

                    var relatedCourses = course.related_courses.split(',');
                    var relatedCoursesString = relatedCourses.join(', ');

                    var courseImageuploadDir = 'http://localhost/admin_portal/course_image/' + course.course_image;
                    var courseShareImageuploadDir = 'http://localhost/admin_portal/course_share_image/' + course.course_share_image;
                    var courseBannerImageuploadDir = 'http://localhost/admin_portal/course_banner_image/'+ course.course_banner_image;

                    var courseImage = '<img alt="image" src="' + courseImageuploadDir + '" class="gallery-item" width="120" data-bs-toggle="tooltip" >';
                    var courseShareImage = '<img alt="image" src="' + courseShareImageuploadDir + '" class="square" width="120" data-bs-toggle="tooltip" >';
                    var courseBannerImage = '<img alt="image" src="' + courseBannerImageuploadDir + '" class="gallery-item" width="120" data-bs-toggle="tooltip" >';



                    var dropdown = '<div class="btn-group"><button type="button" class="btn"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+course.course_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+course.course_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';


                    

                    $('#courseTable tbody').append(
                     '<tr>' +
                     '<td>' + count + '</td>' +  
                     '<td>' + course.course_name + '</td>' +  
                     '<td>' + course.instructor_name + '</td>' +                  
                     '<td>' + courseImage + '</td>' +
                     '<td>' + course.course_description + '</td>' +
                    // '<td>' + courseShareImage + '</td>' +
                    '<td>' + courseBannerImage + '</td>' +
                    // '<td>' + course.courseShareDescription + '</td>' +
                    '<td>' + relatedCoursesString + '</td>' +
                    // '<td>' + course.iframeUrl + '</td>' +
                     
                    '<td>' + course.lessions + '</td>' +
                    //  '<td>' + dropdown2 + '</td>' +
                    '<td>' + dropdown +'</td>' +
                    '</tr>'
                    );
                    count+=1;
                });
                dataTable = $('#courseTable').DataTable();
                },
                error: function (error) {
                  console.error('Error:', error);
                }

            });
    };



    function updateFunction(course_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'course_id': course_id,'work': 1 },
        dataType: 'json',
        success: function (data) {           
                console.log(data);

                $('body, html').animate({
                    scrollTop: 0
                }, 100);
                
                var course_image_url = data.course_image;
                var course_share_image_url = data.course_share_image;
                var course_banner_image_url = data.course_banner_image;


                
                $('#courseId').val(data.course_id);
                $('#courseName').val(data.course_name);
                $('#courseDescription').val(data.course_description);
                $('#courseShareDescription').val(data.course_share_desc);
                $('#iframeUrl').val(data.iframe_url);
                $('#instructor').val(data.instructor_id);
                $('#lessons').val(data.lessions);


                var relatedCoursesArray = data.related_courses.split(',');
                $('#relatedCourses').val(relatedCoursesArray).trigger('change');                


                $('#hidden_courseImage').val(course_image_url);
                $('#courseImageDisplay').attr('src', course_image_url);

                $('#hidden_courseShareImage').val(course_share_image_url);
                $('#courseShareImageDisplay').attr('src', course_share_image_url);


                $('#hidden_courseBannerImage').val(course_banner_image_url);
                $('#courseBannerImageDisplay').attr('src', course_banner_image_url);

                console.log($('#courseForm').length);
               
        },
        error: function (error) {
            console.error('Error:', error);
        }
        });
    }

    function deleteFunction(course_id) {
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
                    data: { 'course_id': course_id,'work': 1 },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                         fetchData();
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
                swal("Poof! Your Record has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your Record is safe!");
            }
            });

        
    }   

</script>
