<?php
require_once('config.php');
session_start();


if (isset($_GET['work']) && $_GET['work'] == 1) {
    if (isset($_GET['course_id'])) {

        
        $modified_by = $_SESSION['admin_login_id'];
        $course_id = mysqli_real_escape_string($conn, $_GET['course_id']);
        $delete_data = mysqli_query($conn, "UPDATE courses SET status='0',modified_by='$modified_by' WHERE course_id = '$course_id'");
    
    
        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Course deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting course.'];
        }
        
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 2){
    
    if (isset($_GET['instructor_id'])) {
        
        $instructor_id = mysqli_real_escape_string($conn, $_GET['instructor_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE instructors SET status='0',modified_by='$modified_by' WHERE instructor_id = '$instructor_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 3){
    
    if (isset($_GET['instructor_social_tags_id'])) {
        
        $instructor_social_tags_id = mysqli_real_escape_string($conn, $_GET['instructor_social_tags_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE instructor_social_tags SET status='0',modified_by='$modified_by' WHERE instructor_social_tags_id = '$instructor_social_tags_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 4){
    
    if (isset($_GET['tag_id'])) {
        
        $tag_id = mysqli_real_escape_string($conn, $_GET['tag_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE tags SET status='0',modified_by='$modified_by' WHERE tag_id = '$tag_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 5){
    
    if (isset($_GET['meta_id'])) {
        
        $meta_id = mysqli_real_escape_string($conn, $_GET['meta_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE meta SET status='0',modified_by='$modified_by' WHERE meta_id = '$meta_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 6){
    
    if (isset($_GET['technology_id'])) {
        
        $technology_id = mysqli_real_escape_string($conn, $_GET['technology_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE technologies SET status='0',modified_by='$modified_by' WHERE technology_id = '$technology_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 7){
    
    if (isset($_GET['courses_technologies_id'])) {
        
        $courses_technologies_id = mysqli_real_escape_string($conn, $_GET['courses_technologies_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE courses_technologies SET status='0',modified_by='$modified_by' WHERE courses_technologies_id = '$courses_technologies_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 8){
    
    if (isset($_GET['student_id'])) {
        
        $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE registration SET status='0',modified_by='$modified_by' WHERE student_id = '$student_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 9){
    
    if (isset($_GET['ak_id'])) {
        
        $ak_id = mysqli_real_escape_string($conn, $_GET['ak_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE number_verify_access_key SET status='0',modified_by='$modified_by' WHERE ak_id = '$ak_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 10){
    
    if (isset($_GET['bc_id'])) {
        
        $bc_id = mysqli_real_escape_string($conn, $_GET['bc_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE bootcamp SET status='0',modified_by='$modified_by' WHERE bc_id = '$bc_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 11){
    
    if (isset($_GET['curriculum_id'])) {
        
        $curriculum_id = mysqli_real_escape_string($conn, $_GET['curriculum_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE course_curriculum SET status='0',modified_by='$modified_by' WHERE curriculum_id = '$curriculum_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 12){
    
    if (isset($_GET['contact_id'])) {
        
        $contact_id = mysqli_real_escape_string($conn, $_GET['contact_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE reach_us SET status='0',modified_by='$modified_by' WHERE contact_id = '$contact_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 13){
    
    if (isset($_GET['co_id'])) {
        
        $co_id = mysqli_real_escape_string($conn, $_GET['co_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE currentopening SET status='0',modified_by='$modified_by' WHERE co_id = '$co_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 14){
    
    if (isset($_GET['count_id'])) {
        
        $count_id = mysqli_real_escape_string($conn, $_GET['count_id']);
        $modified_by = $_SESSION['admin_login_id'];
        $delete_data = mysqli_query($conn, "UPDATE counts SET status='0',modified_by='$modified_by' WHERE count_id = '$count_id'");

        if ($delete_data) {
            $response = ['status' => 'success', 'message' => 'Instructor deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting instructor.'];
        }
            
    }
}
echo json_encode($delete_data);  
?>