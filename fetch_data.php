<?php
require_once('config.php');

if(isset($_GET['work']) && $_GET['work'] == 1){
    if (isset($_GET['course_id'])) {

        $course_id = mysqli_real_escape_string($conn, $_GET['course_id']);
        $query = mysqli_query($conn, "SELECT * FROM courses WHERE course_id = '$course_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Course not found']);
        }
    } else {
       
        $fetch_course_data = mysqli_query($conn, "SELECT courses.*,instructors.instructor_id,instructors.instructor_name FROM courses JOIN instructors ON courses.instructor_id = instructors.instructor_id WHERE courses.status = '1' AND instructors.status = '1' ORDER BY courses.modify_date_time DESC");
    
        $course_data = array();
        while ($course_row = mysqli_fetch_assoc($fetch_course_data)) {
            $course_data[] = $course_row;
        }
    
        echo json_encode($course_data);
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 2){
    if (isset($_GET['instructor_id'])) {

        $instructor_id = mysqli_real_escape_string($conn, $_GET['instructor_id']);
        $query = mysqli_query($conn, "SELECT * FROM instructors WHERE instructor_id = '$instructor_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    } else {
        
        $fetch_instructor_data = mysqli_query($conn, "SELECT * FROM instructors WHERE status = '1' ORDER BY modify_date_time DESC");
    
        $instructor_data = array();
        while ($instructor_row = mysqli_fetch_assoc($fetch_instructor_data)) {
            $instructor_data[] = $instructor_row;
        }
    
        echo json_encode($instructor_data);
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 3){
    if (isset($_GET['instructor_social_tags_id'])) {

        $instructor_social_tags_id = mysqli_real_escape_string($conn, $_GET['instructor_social_tags_id']);
        $query = mysqli_query($conn, "SELECT * FROM instructor_social_tags WHERE instructor_social_tags_id = '$instructor_social_tags_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT instructor_social_tags.*,instructors.instructor_id,instructors.instructor_profile_image,instructors.instructor_name FROM instructor_social_tags JOIN instructors ON instructor_social_tags.instructor_id = instructors.instructor_id WHERE instructor_social_tags.status = '1' AND instructors.status = '1' ORDER BY instructor_social_tags.modify_date_time DESC";

        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 4){
    if (isset($_GET['tag_id'])) {

        $tag_id = mysqli_real_escape_string($conn, $_GET['tag_id']);
        $query = mysqli_query($conn, "SELECT * FROM tags WHERE tag_id = '$tag_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $fetch_tags_data = mysqli_query($conn, "SELECT * FROM tags WHERE status = '1' ORDER BY modify_date_time DESC");
    
        $tag_data = array();
        while ($tag_row = mysqli_fetch_assoc($fetch_tags_data)) {
            $tag_data[] = $tag_row;
        }
    
        echo json_encode($tag_data);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 5){
    if (isset($_GET['meta_id'])) {

        $meta_id = mysqli_real_escape_string($conn, $_GET['meta_id']);
        $query = mysqli_query($conn, "SELECT * FROM meta WHERE meta_id = '$meta_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    } else {
        
        $fetch_meta_data = mysqli_query($conn, "SELECT meta.*,courses.course_id,courses.course_name,tags.tag_id,tags.tag_name,menus.menu_id,menus.menu_name FROM meta JOIN courses ON meta.course_id = courses.course_id JOIN tags ON meta.tag_id = tags.tag_id JOIN menus ON meta.menu_id = menus.menu_id WHERE meta.status = '1' AND courses.status = '1' AND tags.status = '1' AND menus.status = '1' ORDER BY meta.modify_date_time DESC");
    
        $meta_data = array();
        while ($meta_row = mysqli_fetch_assoc($fetch_meta_data)) {
            $meta_data[] = $meta_row;
        }
    
        echo json_encode($meta_data);
    }
}elseif(isset($_GET['work']) && $_GET['work'] == 6){
    if (isset($_GET['technology_id'])) {

        $technology_id = mysqli_real_escape_string($conn, $_GET['technology_id']);
        $query = mysqli_query($conn, "SELECT * FROM technologies WHERE technology_id = '$technology_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $fetch_technology_data = mysqli_query($conn, "SELECT * FROM technologies WHERE status = '1' ORDER BY modify_date_time DESC");
    
        $technology_data = array();
        while ($technology_row = mysqli_fetch_assoc($fetch_technology_data)) {
            $technology_data[] = $technology_row;
        }
    
        echo json_encode($technology_data);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 7){
    if (isset($_GET['courses_technologies_id'])) {

        $courses_technologies_id = mysqli_real_escape_string($conn, $_GET['courses_technologies_id']);
        $query = mysqli_query($conn, "SELECT * FROM courses_technologies WHERE courses_technologies_id = '$courses_technologies_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT courses_technologies.*,courses.course_id,courses.course_name,technologies.technology_id,technologies.technology_name FROM courses_technologies JOIN courses ON courses_technologies.course_id = courses.course_id JOIN technologies ON courses_technologies.technology_id = technologies.technology_id WHERE courses_technologies.status = '1' AND courses.status = '1' AND technologies.status = '1' ORDER BY courses_technologies.modify_date_time DESC";

        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 8){
    if (isset($_GET['student_id'])) {

        $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);
        $query = mysqli_query($conn, "SELECT * FROM registration WHERE student_id = '$student_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT * FROM registration WHERE status = '1' ORDER BY modify_date_time DESC";

        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 9){
    if (isset($_GET['ak_id'])) {

        $ak_id = mysqli_real_escape_string($conn, $_GET['ak_id']);
        $query = mysqli_query($conn, "SELECT * FROM number_verify_access_key WHERE ak_id = '$ak_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT * FROM number_verify_access_key WHERE status = '1' ORDER BY modify_date_time DESC";

        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 10){
    if (isset($_GET['bc_id'])) {

        $bc_id = mysqli_real_escape_string($conn, $_GET['bc_id']);
        $query = mysqli_query($conn, "SELECT * FROM bootcamp WHERE bc_id = '$bc_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT * FROM bootcamp WHERE status = '1' ORDER BY modify_date_time DESC";

        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 11){
    if (isset($_GET['curriculum_id'])) {

        $curriculum_id = mysqli_real_escape_string($conn, $_GET['curriculum_id']);
        $query = mysqli_query($conn, "SELECT * FROM course_curriculum WHERE curriculum_id = '$curriculum_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT course_curriculum.*,technologies.technology_id,technologies.technology_name FROM course_curriculum JOIN technologies ON course_curriculum.technology_id = technologies.technology_id WHERE course_curriculum.status = '1' AND technologies.status = '1' ORDER BY course_curriculum.modify_date_time DESC";
        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 12){
    if (isset($_GET['contact_id'])) {

        $contact_id = mysqli_real_escape_string($conn, $_GET['contact_id']);
        $query = mysqli_query($conn, "SELECT * FROM reach_us WHERE contact_id = '$contact_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT * FROM reach_us WHERE status = '1' ORDER BY modify_date_time DESC";
        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 13){
    if (isset($_GET['co_id'])) {

        $co_id = mysqli_real_escape_string($conn, $_GET['co_id']);
        $query = mysqli_query($conn, "SELECT * FROM currentopening WHERE co_id = '$co_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT * FROM currentopening WHERE status = '1' ORDER BY modify_date_time DESC";
        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}elseif(isset($_GET['work']) && $_GET['work'] == 14){
    if (isset($_GET['count_id'])) {

        $count_id = mysqli_real_escape_string($conn, $_GET['count_id']);
        $query = mysqli_query($conn, "SELECT * FROM counts WHERE count_id = '$count_id'");
        
        if ($row = mysqli_fetch_assoc($query)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Instructor not found']);
        }
    }else{
        $response = array();

        $query = "SELECT * FROM counts WHERE status = '1' ORDER BY modify_date_time DESC";
        $result = mysqli_query($conn, $query);

        $data_array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }


        echo json_encode($data_array);

    }
}
?>