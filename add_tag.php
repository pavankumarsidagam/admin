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
            <li class="breadcrumb-item">Add Tag</li>
          </ul>
          <div class="section-body">
            <!-- add content here -->
            <div class="row">
                <!-- <div class="col-12 col-md-3 col-lg-3"></div> -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-3">
                                <h4>Add Tags</h4>
                            </div>
                            <div class="card-body">
                                <form id="tagForm" enctype="multipart/form-data" method='POST' >
                                    <!-- forms come here -->
                                    <div class="form-group d-none">
                                        <label for="tag_id">Tag Id</label>
                                        <input type="number" class="form-control" name="tag_id" id="tag_id">
                                    </div>
                                    <!-- default form -->

                                    <div class="row g-3 align-items-center">
                                        <div class="form-group">
                                            <label for="tag">Tag<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tag" id="tag">
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
                                    <h4>Tags List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center" id="tagsTable">
                                            <thead id="mydata">
                                                <tr>
                                                    <th>Tag Id</th>
                                                    <th>Tags</th>
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
    $(document).ready(function () {
    $('#tagForm').submit(function (event) {
        var formData = new FormData($('#tagForm')[0]);
        formData.append('work', 4);

        $.ajax({
            url: 'insert_data.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);

                if (response == 1) {
                    swal("Good job!", "Updated Successfully!", "success");
                } else if (response == 2) {
                    swal("Error!", "Enter All Details!", "info");
                } else if (response == 3) {
                    swal("Good job!", "Inserted Successfully!", "success");
                } else if (response == 4) {
                    swal("Error!", "Enter All Details!!", "info");
                }

                fetchData();
                $("#tagForm")[0].reset();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

        event.preventDefault();
    });
    
    function fetchData() {
        $.ajax({
            url: 'fetch_data.php',
            type: 'GET',
            data: { 'work': 4 },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var count = 1;

                var dataTable = $('#tagsTable').DataTable();
                dataTable.clear().destroy();

                $.each(data, function (index, tags) {
                    var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction(' + tags.tag_id + ')"><i class="far fa-edit"></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction(' + tags.tag_id + ')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                    $('#tagsTable tbody').append(
                        '<tr>' +
                        '<td>' + count + '</td>' +
                        '<td>' + tags.tag_name + '</td>' +
                        '<td>' + dropdown + '</td>' +
                        '</tr>'
                    );
                    count += 1;
                });

                dataTable = $('#tagsTable').DataTable();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }
    fetchData();
  

});

/// Hello Tester I'm writing the fetch data Function outside the $(document).ready(function(){)); because when delecting it can only call the fetch data function when it is global.
function fetchData() {
        $.ajax({
            url: 'fetch_data.php',
            type: 'GET',
            data: { 'work': 4 },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var count = 1;

                var dataTable = $('#tagsTable').DataTable();
                dataTable.clear().destroy();

                $.each(data, function (index, tags) {
                    var dropdown = '<div class="btn-group"><button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="updateFunction(' + tags.tag_id + ')"><i class="far fa-edit"></i> Update</a></li><li><a class="dropdown-item delete-item has-icon" onclick="deleteFunction(' + tags.tag_id + ')"><i class="far fa-trash-alt"></i> Delete</a></li></ul></div>';

                    $('#tagsTable tbody').append(
                        '<tr>' +
                        '<td>' + count + '</td>' +
                        '<td>' + tags.tag_name + '</td>' +
                        '<td>' + dropdown + '</td>' +
                        '</tr>'
                    );
                    count += 1;
                });

                // Initialize DataTable after appending new data
                dataTable = $('#tagsTable').DataTable();
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }



function updateFunction(tag_id) {
        $.ajax({
            url: 'fetch_data.php', 
            type: 'GET',
            data: { 'tag_id': tag_id,'work': 4},
            dataType: 'json',
            success: function (data) {           
                    //console.log(data);
                    $('body, html').animate({
                        scrollTop: 0
                    }, 100);

                    $('#tag_id').val(data.tag_id);
                    $('#tag').val(data.tag_name);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }


    function deleteFunction(tag_id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'delete_data.php',
                    type: 'GET',
                    data: { 'tag_id': tag_id, 'work': 4 },
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