<?php
require_once('header.php');
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <ul class="breadcrumb breadcrumb-style ">
            <li class="breadcrumb-item">
              <h4 class="page-title m-b-0">Meta Tags</h4>
            </li>
            <li class="breadcrumb-item">
              <a href="admin_page.php">
                <i data-feather="home"></i></a>
            </li>
            <li class="breadcrumb-item">Meta Tags</li>
            <li class="breadcrumb-item">Add MetaTag</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Meta Tag</h4>
                            </div>
                            <div class="card-body">
                                <form id="metaTagForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none ">
                                        <label for="meta_id">Meta Id</label>
                                        <input type="number" class="form-control" name="meta_id" id="meta_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-6">
                                            <label for="metaName">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="metaName" id="metaName">
                                        </div>
                                        <!-- <div class="form-group col-2"></div> -->
                                        <div class="form-group col-6">
                                            <label for="property">Property<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="property" id="property">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center">
                                        <div class="form-group col-4">
                                            <label for="menu">Menu<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="menu" id="menu">
                                                <option value="">Select Menu</option>
                                                <?php
                                                    $m_names = mysqli_query($conn,"SELECT * from menus WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($menu_name = mysqli_fetch_object($m_names)){
                                                ?>
                                                <option value="<?php echo $menu_name->menu_id ?>" > <?php echo $menu_name->menu_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="tag">Tag<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="tag" id="tag">
                                                <option value="">Select Tag</option>
                                                <?php
                                                    $t_names = mysqli_query($conn,"SELECT * from tags WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($tag_name = mysqli_fetch_object($t_names)){
                                                ?>
                                                <option value="<?php echo $tag_name->tag_id ?>" > <?php echo $tag_name->tag_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="course">Course<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" name="course" id="course">
                                                <option value="">Select Course</option>
                                                <?php
                                                    $c_names = mysqli_query($conn,"SELECT * from courses WHERE status = '1'") or die(mysqli_error($conn));
                                                    while ($course_name = mysqli_fetch_object($c_names)){
                                                ?>
                                                <option value="<?php echo $course_name->course_id ?>" > <?php echo $course_name->course_name ?></option>
                                                <?php } ?>                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="content" id="content"></textarea>
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
                                    <h4>Meta List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="metaTable">
                                            <thead id="mydata">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Property</th>
                                                   
                                                    <th>Menu</th>
                                                    <th>Tag</th>
                                                    <th>Course</th>
                                                    <th>Content</th>
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
          $('#metaTagForm').submit(function (event) {
              
              var formData = new FormData($('#metaTagForm')[0]);
              formData.append('work', 5);

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
                      $("#metaTagForm")[0].reset();
                      
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
                  data: {'work': 5},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#metaTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, metaTag) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+metaTag.meta_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+metaTag.meta_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#metaTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + metaTag.name	 + '</td>' +                    
                      '<td>' + metaTag.property + '</td>' +
                      
                      '<td>' + metaTag.menu_name + '</td>' +
                      '<td>' + metaTag.tag_name + '</td>' +
                      '<td>' + metaTag.course_name + '</td>' +
                      '<td>' + metaTag.content + '</td>' +

                    //   '<td>' + metaTag.about_instructor + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#metaTable').DataTable();
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
                  data: {'work': 5},
                  dataType: 'json',
                  success: function (data) {                 
                    console.log(data);
                    var count = 1;

                    var dataTable = $('#metaTable').DataTable();
                    dataTable.clear().destroy();

                    
                    $.each(data, function (index, metaTag) {

                      var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction('+metaTag.meta_id+')"><i class="far fa-edit" ></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction('+metaTag.meta_id+')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                      $('#metaTable tbody').append(
                      '<tr>' +
                      '<td>' + count	 + '</td>' +
                      '<td>' + metaTag.name	 + '</td>' +                    
                      '<td>' + metaTag.property + '</td>' +
                      
                      '<td>' + metaTag.menu_name + '</td>' +
                      '<td>' + metaTag.tag_name + '</td>' +
                      '<td>' + metaTag.course_name + '</td>' +
                      '<td>' + metaTag.content + '</td>' +

                    //   '<td>' + metaTag.about_instructor + '</td>' +
                      '<td>' + dropdown +'</td>' +
                      '</tr>'
                      );
                      count += 1;
                  });
                  dataTable = $('#metaTable').DataTable();
                  },
                  error: function (error) {
                    console.error('Error:', error);
                  }
              });
          };


      function updateFunction(meta_id) {
        $.ajax({
        url: 'fetch_data.php', 
        type: 'GET',
        data: { 'meta_id': meta_id,'work': 5 },
        dataType: 'json',
        success: function (data) {           
               // console.log(data);
               $('body, html').animate({
                    scrollTop: 0
                }, 100);

                $('#meta_id').val(data.meta_id);
                $('#metaName').val(data.name);
                $('#property').val(data.property);
                $('#menu').val(data.menu_id);
                $('#tag').val(data.tag_id);
                $('#content').val(data.content);
                $('#course').val(data.course_id); 
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
    }

   

    function deleteFunction(meta_id) {
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
                    data: { 'meta_id': meta_id,'work': 5},
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
