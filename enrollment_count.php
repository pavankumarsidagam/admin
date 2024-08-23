<?php
require_once('config.php');


$enrollmentCounts = array();

$query = "SELECT courses.course_id, courses.course_name, COUNT(registration.student_id) as enrollment_count FROM courses LEFT JOIN registration ON courses.course_name = registration.student_courses WHERE courses.status = '1' GROUP BY courses.course_id, courses.course_name";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $enrollmentCounts[] = array(
            'course_id' => $row['course_id'],
            'course_name' => $row['course_name'],
            'enrollment_count' => $row['enrollment_count']
        );
    }


    echo json_encode($enrollmentCounts);
}
?>
