<?php
require_once('config.php');
session_start();


if(isset($_POST['work']) && $_POST['work'] == 0){
    // session_start();
    $response = 0;
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admin_login WHERE admin_username = '$username' AND admin_password = '$password' AND status = '1'");
    if (mysqli_num_rows($query) > 0) {

        $admin_login = mysqli_fetch_object($query);

        $admin_login_id = $admin_login->admin_login_id;
        $admin_username = $admin_login->admin_username;                               
        $_SESSION['admin_login_id'] = $admin_login_id;
        $_SESSION['admin_username'] = $admin_username;
        $response = 1;
        }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 1) {
    
    $response = 0;

    // $admin_login_id = $_POST['$admin_login_id'];
    

    $courseId = mysqli_real_escape_string($conn, $_POST['courseId']);
    $courseName = mysqli_real_escape_string($conn, $_POST['courseName']);
    $courseDescription = mysqli_real_escape_string($conn, $_POST['courseDescription']);

    $hidden_courseImage = isset($_POST['hidden_courseImage']) ? $_POST['hidden_courseImage'] : '';
    $hidden_courseShareImage = isset($_POST['hidden_courseShareImage']) ? $_POST['hidden_courseShareImage'] : '';
    $hidden_courseBannerImage = isset($_POST['hidden_courseBannerImage']) ? $_POST['hidden_courseBannerImage'] : '';

    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];

    $courseImage = '';
    $courseShareImage = '';
    $courseBannerImage = '';
    // For First Image //////////
    if($hidden_courseImage != '' && $_FILES['courseImage']['name'] != ''){
        $uploadDir = 'F:\xampp\htdocs\admin_portal\course_image/';
        $imageExtension = pathinfo($_FILES['courseImage']['name'], PATHINFO_EXTENSION);
        $newCourseImageName = $courseId . '.' . $imageExtension;
    
        $courseImage = $uploadDir . $newCourseImageName;
        
        
        move_uploaded_file($_FILES['courseImage']['tmp_name'], $courseImage);
        $courseImage = $newCourseImageName;

    }elseif ($hidden_courseImage != '' ) {

        $courseImage = $hidden_courseImage;

    } elseif ($_FILES['courseImage']['name'] != '') {

        $uploadDir = 'F:\xampp\htdocs\admin_portal\course_image/';
        $query = mysqli_query($conn, "SELECT COUNT(course_id) AS courseImageCount FROM courses");
        $row = mysqli_fetch_assoc($query);
        $existingImageCount = $row['courseImageCount'] + 1;
    
        $imageExtension = pathinfo($_FILES['courseImage']['name'], PATHINFO_EXTENSION);
        $newCourseImageName = $existingImageCount . '.' . $imageExtension;
    
        $courseImage = $uploadDir . $newCourseImageName;
        
        
        move_uploaded_file($_FILES['courseImage']['tmp_name'], $courseImage);
        $courseImage = $newCourseImageName;
    };

    // For Second Image //////////

    if($hidden_courseShareImage != '' && $_FILES['courseShareImage']['name'] != ''){
        $uploadDir = 'F:\xampp\htdocs\admin_portal\course_share_image/';
        $imageExtension = pathinfo($_FILES['courseShareImage']['name'], PATHINFO_EXTENSION);
        $newCourseShareImageName = $courseId . '.' . $imageExtension;
    
        $courseShareImage = $uploadDir . $newCourseShareImageName;
        
        
        move_uploaded_file($_FILES['courseShareImage']['tmp_name'], $courseShareImage);
        $courseShareImage = $newCourseShareImageName;

    }elseif ($hidden_courseShareImage != '' ) {

        $courseShareImage = $hidden_courseShareImage;

    } elseif ($_FILES['courseShareImage']['name'] != '') {
        $uploadDir = 'F:\xampp\htdocs\admin_portal\course_share_image/';

        $query = mysqli_query($conn, "SELECT COUNT(course_id) AS courseShareImageCount FROM courses");
        $row = mysqli_fetch_assoc($query);
        $existingImageCount = $row['courseShareImageCount'] + 1;
    
        $imageExtension = pathinfo($_FILES['courseShareImage']['name'], PATHINFO_EXTENSION);
        $newCourseShareImageName = $existingImageCount . '.' . $imageExtension;
    
        $courseShareImage = $uploadDir . $newCourseShareImageName;
        
        
        move_uploaded_file($_FILES['courseShareImage']['tmp_name'], $courseShareImage);
        $courseShareImage = $newCourseShareImageName;
    };

    // For Third Image //////////


    if($hidden_courseBannerImage != '' && $_FILES['courseBannerImage']['name'] != ''){
        $uploadDir = 'F:\xampp\htdocs\admin_portal\course_banner_image/';
        $imageExtension = pathinfo($_FILES['courseBannerImage']['name'], PATHINFO_EXTENSION);
        $newCourseBannerImageName = $courseId . '.' . $imageExtension;
    
        $courseBannerImage = $uploadDir . $newCourseBannerImageName;
        
        
        move_uploaded_file($_FILES['courseBannerImage']['tmp_name'], $courseBannerImage);
        $courseBannerImage = $newCourseBannerImageName;

    }elseif ($hidden_courseBannerImage != '' ) {

        $courseBannerImage = $hidden_courseBannerImage;

    } elseif ($_FILES['courseImage']['name'] != '') {
        $uploadDir = 'F:\xampp\htdocs\admin_portal\course_banner_image/';
        $query = mysqli_query($conn, "SELECT COUNT(course_id) AS courseBannerImageCount FROM courses");
        $row = mysqli_fetch_assoc($query);
        $existingImageCount = $row['courseBannerImageCount'] + 1;
    
        $imageExtension = pathinfo($_FILES['courseBannerImage']['name'], PATHINFO_EXTENSION);
        $newCourseBannerImageName = $existingImageCount . '.' . $imageExtension;
    
        $courseBannerImage = $uploadDir . $newCourseBannerImageName;
        
        
        move_uploaded_file($_FILES['courseBannerImage']['tmp_name'], $courseBannerImage);
        $courseBannerImage = $newCourseBannerImageName;
    };

    $courseShareDescription = mysqli_real_escape_string($conn, $_POST['courseShareDescription']);
    $relatedCourses = isset($_POST['relatedCourses']) ? implode(',', $_POST['relatedCourses']) : '';
    $iframeUrl = mysqli_real_escape_string($conn, $_POST['iframeUrl']);
    $instructor = mysqli_real_escape_string($conn, $_POST['instructor']);
    $lessons = mysqli_real_escape_string($conn, $_POST['lessons']);

    if ($courseId != '') {
        if ($courseName != '' && $courseDescription != '' && $courseImage != '' && $courseBannerImage != '' && $courseShareDescription != '' && $relatedCourses != '' && $iframeUrl != '' && $instructor != '' && $lessons != '')
        
        {
            $query = mysqli_query($conn, "UPDATE courses SET course_name = '$courseName',course_description = '$courseDescription',course_image = '$courseImage',course_share_image = '$courseShareImage',course_banner_image = '$courseBannerImage',course_share_desc = '$courseShareDescription',related_courses = '$relatedCourses',iframe_url = '$iframeUrl',instructor_id = '$instructor',lessions = '$lessons',modified_by='$modified_by' WHERE course_id = '$courseId'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($courseName != '' && $courseDescription != '' && $courseImage != '' && $courseBannerImage != '' && $courseShareDescription != '' && $relatedCourses != '' && $iframeUrl != '' && $instructor != '' && $lessons != '') {
            $query = mysqli_query($conn, "INSERT INTO courses (course_name,course_description,course_image,course_share_image,course_banner_image,course_share_desc,related_courses,iframe_url,instructor_id,lessions,created_by,modified_by) VALUES('$courseName','$courseDescription','$courseImage','$courseShareImage','$courseBannerImage','$courseShareDescription','$relatedCourses','$iframeUrl','$instructor','$lessons','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }

    echo json_encode($response);

}elseif (isset($_POST['work']) && $_POST['work'] == 2){
    $response = 0;


    $instructorId = mysqli_real_escape_string($conn, $_POST['instructorId']);
    $instructorName = mysqli_real_escape_string($conn, $_POST['instructorName']);
    $instructorDesignation = mysqli_real_escape_string($conn, $_POST['instructorDesignation']);
    $aboutInstructor = mysqli_real_escape_string($conn, $_POST['aboutInstructor']);

    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
    
    $hidden_instructorImage = isset($_POST['hidden_instructorImage']) ? $_POST['hidden_instructorImage'] : '';
    
    $instructorImage = '';



    if($hidden_instructorImage != '' && $_FILES['instructorImage']['name'] != ''){
            $uploadDir = 'F:\xampp\htdocs\admin_portal\instructor_profile_image/';
            
            $imageExtension = pathinfo($_FILES['instructorImage']['name'], PATHINFO_EXTENSION);
            $newImageName = $instructorId . '.' . $imageExtension;
    
            $instructorImage = $uploadDir . $newImageName;
        
        
            move_uploaded_file($_FILES['instructorImage']['tmp_name'], $instructorImage);
            $instructorImage = $newImageName;    
    
    }elseif ($hidden_instructorImage != '' ) {

            $instructorImage = $hidden_instructorImage;
    
    } elseif ($_FILES['instructorImage']['name'] != '') {
            $uploadDir = 'F:\xampp\htdocs\admin_portal\instructor_profile_image/';
           

            $query = mysqli_query($conn, "SELECT COUNT(instructor_id) AS imageCount FROM instructors");
            $row = mysqli_fetch_assoc($query);
            $existingImageCount = $row['imageCount'] + 1;
    
            $imageExtension = pathinfo($_FILES['instructorImage']['name'], PATHINFO_EXTENSION);
            $newImageName = $existingImageCount . '.' . $imageExtension;
    
            $instructorImage = $uploadDir . $newImageName;
        
        
            move_uploaded_file($_FILES['instructorImage']['tmp_name'], $instructorImage);
            $instructorImage = $newImageName;
        
    };
        
    
    
   
    
    if ($instructorId != '') {
        if ($instructorName != '' && $instructorDesignation != '' && $aboutInstructor != '' && $instructorImage != '') {

            $query = mysqli_query($conn, "UPDATE instructors SET instructor_name = '$instructorName',instructor_designation = '$instructorDesignation',about_instructor = '$aboutInstructor',instructor_profile_image = '$instructorImage',modified_by='$modified_by' WHERE instructor_id = '$instructorId'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($instructorName != '' && $instructorDesignation != '' && $aboutInstructor != '' && $instructorImage != '') {

            $query = mysqli_query($conn, "INSERT INTO instructors (instructor_name, instructor_designation, about_instructor, instructor_profile_image,created_by,modified_by) VALUES ('$instructorName', '$instructorDesignation', '$aboutInstructor', '$instructorImage','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    
    echo json_encode($response);

}elseif (isset($_POST['work']) && $_POST['work'] == 3){
    $response = 0;


    $instructor_social_tags_id = mysqli_real_escape_string($conn, $_POST['instructor_social_tags_id']);
    $instructor = mysqli_real_escape_string($conn, $_POST['instructor']);
    $socialMedia = mysqli_real_escape_string($conn, $_POST['socialMedia']);
    $socialUrl = mysqli_real_escape_string($conn, $_POST['socialUrl']); 
    
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];

    if ($instructor_social_tags_id != '') {
        if ($instructor != '' && $socialMedia != '' && $socialUrl != '') {

            $query = mysqli_query($conn, "UPDATE instructor_social_tags SET instructor_id = '$instructor',instructor_social_tags_type = '$socialMedia',instructor_social_tags_url = '$socialUrl',modified_by='$modified_by' WHERE 	instructor_social_tags_id = '$instructor_social_tags_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($instructor != '' && $socialMedia != '' && $socialUrl != '') {

            $query = mysqli_query($conn, "INSERT INTO instructor_social_tags (instructor_id, instructor_social_tags_type, instructor_social_tags_url,created_by,modified_by) VALUES ('$instructor', '$socialMedia', '$socialUrl','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 4){
    $response = 0;


    $tag_id = mysqli_real_escape_string($conn, $_POST['tag_id']);
    $tag = mysqli_real_escape_string($conn, $_POST['tag']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($tag_id != '') {
        if ($tag != '') {

            $query = mysqli_query($conn, "UPDATE tags SET tag_name = '$tag',modified_by='$modified_by' WHERE tag_id = '$tag_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($tag != '') {

            $query = mysqli_query($conn, "INSERT INTO tags (tag_name,created_by,modified_by) VALUES ('$tag','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 5){
    $response = 0;


    $meta_id = mysqli_real_escape_string($conn, $_POST['meta_id']);
    $metaName = mysqli_real_escape_string($conn, $_POST['metaName']);
    $property = mysqli_real_escape_string($conn, $_POST['property']);
    $menu = mysqli_real_escape_string($conn, $_POST['menu']);
    $tag = mysqli_real_escape_string($conn, $_POST['tag']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);   
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];    

    
    if ($meta_id != '') {
        if ($metaName != '' && $property != '' && $menu != '' && $tag != ''&& $course != '' && $content != '') {

            $query = mysqli_query($conn, "UPDATE meta SET name = '$metaName',property = '$property',content = '$content',menu_id = '$menu',tag_id='$tag',course_id='$course',modified_by='$modified_by' WHERE meta_id  = '$meta_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($metaName != '' && $property != '' && $menu != '' && $tag != ''&& $course != '' && $content != '') {

            $query = mysqli_query($conn, "INSERT INTO meta (name, property, content, menu_id, tag_id, course_id,created_by,modified_by) VALUES ('$metaName', '$property', '$content', '$menu', '$tag', '$course','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    
    echo json_encode($response);

}elseif (isset($_POST['work']) && $_POST['work'] == 6){
    $response = 0;


    $technology_id = mysqli_real_escape_string($conn, $_POST['technology_id']);
    $technologyName = mysqli_real_escape_string($conn, $_POST['technologyName']);

    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($technology_id != '') {
        if ($technologyName != '') {

            $query = mysqli_query($conn, "UPDATE technologies SET technology_name = '$technologyName',modified_by='$modified_by' WHERE technology_id = '$technology_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($technologyName != '') {

            $query = mysqli_query($conn, "INSERT INTO technologies (technology_name,created_by,modified_by) VALUES ('$technologyName','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 7){
    $response = 0;


    $courses_technologies_id = mysqli_real_escape_string($conn, $_POST['courses_technologies_id']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $technology = mysqli_real_escape_string($conn, $_POST['technology']);   
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id']; 

    
    if ($courses_technologies_id != '') {
        if ($course != '' && $technology != '') {

            $query = mysqli_query($conn, "UPDATE courses_technologies SET course_id = '$course',technology_id = '$technology',modified_by='$modified_by' WHERE courses_technologies_id  = '$courses_technologies_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($course != '' && $technology != '') {

            $query = mysqli_query($conn, "INSERT INTO courses_technologies (course_id, technology_id,created_by,modified_by) VALUES ('$course', '$technology','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    
    echo json_encode($response);

}elseif (isset($_POST['work']) && $_POST['work'] == 8){
    $response = 0;


    $student_id = mysqli_real_escape_string($conn, $_POST['studentId']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $alt_number = mysqli_real_escape_string($conn, $_POST['alt_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $program1 = mysqli_real_escape_string($conn, $_POST['program1']);
    $program2 = mysqli_real_escape_string($conn, $_POST['program2']);
    $program3 = mysqli_real_escape_string($conn, $_POST['program3']);
    $hearAboutUs = mysqli_real_escape_string($conn, $_POST['hearAboutUs']);
    $recommendUs = mysqli_real_escape_string($conn, $_POST['recommendUs']);
    $reference1 = mysqli_real_escape_string($conn, $_POST['reference1']);
    $reference1Num = mysqli_real_escape_string($conn, $_POST['reference1Num']);
    $reference2 = mysqli_real_escape_string($conn, $_POST['reference2']);
    $reference2Num = mysqli_real_escape_string($conn, $_POST['reference2Num']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
  

    


    if ($student_id  != '') {
        if ( $firstName != '' && $lastName != '' && $email != '' && $gender != '' && $number != '' && $address != '' && $program1 != '' && $program2 != '' && $program3 != '' && $hearAboutUs != '' && $recommendUs != '' && $course !='') {

            $query = mysqli_query($conn,"UPDATE registration SET student_fname = '$firstName',student_lname = '$lastName',student_email ='$email',student_number = '$number',student_alt_number = '$alt_number',student_gender = '$gender',student_address = '$address',student_courses = '$course',student_program1 = '$program1',student_program2 = '$program2',student_program3 = '$program3',student_hear_aboutus = '$hearAboutUs',student_recommend = '$recommendUs',ref1 = '$reference1',ref1_number = '$reference1Num',ref2 = '$reference2',ref2_number = '$reference2Num',modified_by='$modified_by' WHERE student_id = '$student_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($firstName != '' && $lastName != '' && $email != '' && $gender != '' && $number != '' && $address != '' && $program1 != '' && $program2 != '' && $program3 != '' && $hearAboutUs != '' && $recommendUs != '' && $course !='') {

            $query = mysqli_query($conn, "INSERT INTO registration (student_fname, student_lname, student_email, student_number, student_alt_number, student_gender, student_address, student_courses, student_program1, student_program2, student_program3, student_hear_aboutus, student_recommend, ref1, ref1_number, ref2, ref2_number,created_by,modified_by) VALUES ('$firstName', '$lastName', '$email', '$number', '$alt_number', '$gender', '$address', '$course', '$program1', '$program2', '$program3', '$hearAboutUs', '$recommendUs', '$reference1', '$reference1Num', '$reference2', '$reference2Num','$created_by','$modified_by')");

            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 9){
    $response = 0;


    $ak_id = mysqli_real_escape_string($conn, $_POST['ak_id']);
    $ak = mysqli_real_escape_string($conn, $_POST['ak']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($ak_id != '') {
        if ($ak != '') {

            $query = mysqli_query($conn, "UPDATE number_verify_access_key SET ak = '$ak',modified_by='$modified_by' WHERE ak_id = '$ak_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($ak != '') {

            $query = mysqli_query($conn, "INSERT INTO number_verify_access_key (ak,created_by,modified_by) VALUES ('$ak','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 10){
    $response = 0;


    $bc_id = mysqli_real_escape_string($conn, $_POST['bc_id']);
    $bc_email = mysqli_real_escape_string($conn, $_POST['bc_email']);
    $bc_contact = mysqli_real_escape_string($conn, $_POST['bc_contact']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($bc_id != '') {
        if ($bc_email != '' && $bc_contact != '') {

            $query = mysqli_query($conn, "UPDATE bootcamp SET bc_email = '$bc_email',bc_contact = '$bc_contact',modified_by='$modified_by' WHERE bc_id = '$bc_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($bc_email != '' && $bc_contact != '') {

            $query = mysqli_query($conn, "INSERT INTO bootcamp (bc_email,bc_contact,created_by,modified_by) VALUES ('$bc_email','$bc_contact','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 11){
    $response = 0;


    $curriculum_id = mysqli_real_escape_string($conn, $_POST['curriculum_id']);
    $day_no = mysqli_real_escape_string($conn, $_POST['day_no']);
    $technology_id = mysqli_real_escape_string($conn, $_POST['technology_id']);
    $technology_details = mysqli_real_escape_string($conn, $_POST['technology_details']);
    $training_time = mysqli_real_escape_string($conn, $_POST['training_time']);
    $practice_time = mysqli_real_escape_string($conn, $_POST['practice_time']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($curriculum_id != '') {
        if ($day_no != '' && $technology_id != '' && $technology_details != '' && $training_time != '' && $practice_time != '') {

            $query = mysqli_query($conn, "UPDATE course_curriculum SET day_no = '$day_no',technology_id = '$technology_id',technology_details = '$technology_details',training_time = '$training_time',practice_time = '$practice_time',modified_by='$modified_by' WHERE curriculum_id = '$curriculum_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($day_no != '' && $technology_id != '' && $technology_details != '' && $training_time != '' && $practice_time != '') {

            $query = mysqli_query($conn, "INSERT INTO course_curriculum (day_no,technology_details,technology_id,training_time,practice_time,created_by,modified_by) VALUES ('$day_no','$technology_details','$technology_id','$training_time','$practice_time','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 12){
    $response = 0;


    $contact_id = mysqli_real_escape_string($conn, $_POST['contact_id']);
    $contact_name = mysqli_real_escape_string($conn, $_POST['contact_name']);
    $contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    $contact_subject = mysqli_real_escape_string($conn, $_POST['contact_subject']);
    $email_headers = mysqli_real_escape_string($conn, $_POST['email_headers']);
    $contact_message = mysqli_real_escape_string($conn, $_POST['contact_message']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($contact_id != '') {
        if ($contact_name != '' && $contact_email != '' && $contact_subject != '' && $email_headers != '' && $contact_message != '') {

            $query = mysqli_query($conn, "UPDATE reach_us SET contact_name = '$contact_name',contact_email = '$contact_email',contact_subject = '$contact_subject',email_headers = '$email_headers',contact_message = '$contact_message',modified_by='$modified_by' WHERE contact_id = '$contact_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($contact_name != '' && $contact_email != '' && $contact_subject != '' && $email_headers != '' && $contact_message != '') {

            $query = mysqli_query($conn, "INSERT INTO reach_us (contact_name,contact_email,contact_subject,email_headers,contact_message,created_by,modified_by) VALUES ('$contact_name','$contact_email','$contact_subject','$email_headers','$contact_message','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 13){
    $response = 0;


    $co_id = mysqli_real_escape_string($conn, $_POST['co_id']);
    $coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
    $noofopen = mysqli_real_escape_string($conn, $_POST['noofopen']);
    $hiring = mysqli_real_escape_string($conn, $_POST['hiring']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($co_id != '') {
        if ($coursename != '' && $noofopen != '' && $hiring != '') {

            $query = mysqli_query($conn, "UPDATE currentopening SET coursename = '$coursename',noofopean = '$noofopen',hiring = '$hiring',modified_by='$modified_by' WHERE co_id = '$co_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if ($coursename != '' && $noofopen != '' && $hiring != '') {

            $query = mysqli_query($conn, "INSERT INTO currentopening (coursename,noofopean,hiring,created_by,modified_by) VALUES ('$coursename','$noofopen','$hiring','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}elseif (isset($_POST['work']) && $_POST['work'] == 14){
    $response = 0;


    $count_id = mysqli_real_escape_string($conn, $_POST['count_id']);
    $finished_sessions = mysqli_real_escape_string($conn, $_POST['finished_sessions']);
    $online_enrollment = mysqli_real_escape_string($conn, $_POST['online_enrollment']);
    $subjects_taught = mysqli_real_escape_string($conn, $_POST['subjects_taught']);
    $satisfaction_rate = mysqli_real_escape_string($conn, $_POST['satisfaction_rate']);
    $created_by = $_SESSION['admin_login_id'];
    $modified_by = $_SESSION['admin_login_id'];
     

    if ($count_id != '') {

        if($satisfaction_rate > 100){

            $response = 5;
        }elseif ($finished_sessions != '' && $online_enrollment != '' && $subjects_taught != '' && $satisfaction_rate != '') {

            $query = mysqli_query($conn, "UPDATE counts SET finished_sessions = '$finished_sessions',online_enrollment = '$online_enrollment',subjects_taught = '$subjects_taught',satisfaction_rate= '$satisfaction_rate',modified_by='$modified_by' WHERE count_id = '$count_id'");
            //echo "SQL Query: $query";
            $response = 1;
            //$response = array('success' => true, 'message' => 'Form Updated successfully');
        } else {
            $response = 2;
            //$response = array('success' => false, 'message' => 'Error Updated data: ' . mysqli_error($conn));
        }
    } else {
        if($satisfaction_rate > 100){

            $response = 5;

        }elseif ($finished_sessions != '' && $online_enrollment != '' && $subjects_taught != '' && $satisfaction_rate != '') {

            $query = mysqli_query($conn, "INSERT INTO counts (finished_sessions,online_enrollment,subjects_taught,satisfaction_rate,created_by,modified_by) VALUES ('$finished_sessions','$online_enrollment','$subjects_taught','$satisfaction_rate','$created_by','$modified_by')");
            //echo "SQL Query: $query";
            $response = 3;
            //$response = array('success' => true, 'message' => 'Form inserting successfully');
        } else {
            $response = 4;
            //$response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn));
        }
    }
    echo json_encode($response);
}
?>