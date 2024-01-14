<?php
// Assuming you have a database connection established
include'studentsidebar.php';
// Query to fetch failed courses for the student
$failedCoursesQuery = "SELECT courses.*, grades.grade FROM courses
                      JOIN grades ON courses.course_id = grades.course_id
                      WHERE grades.student_id = '$studentId' AND grades.grade < 'passing_grade'";
$failedCoursesResult = mysqli_query($conn, $failedCoursesQuery);
?>

<!-- Display failed courses on the grades page -->
<h2>Failed Courses</h2>
<table>
    <thead>
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Grade</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($failedRow = mysqli_fetch_assoc($failedCoursesResult)) { ?>
            <tr>
                <td><?php echo $failedRow['course_id']; ?></td>
                <td><?php echo $failedRow['course_name']; ?></td>
                <td><?php echo $failedRow['grade']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>