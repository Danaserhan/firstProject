<?php
session_start(); // Start the session

$host="localhost";

$user="root";

$password="";

$db="course_registration";

$conn=mysqli_connect($host,$user,$password,$db);



if($conn===false)
{
    die("connection error");
}

// Retrieve student_id from the session
if (isset($_SESSION['student_id'])) {
    $student_id = mysqli_real_escape_string($conn, $_SESSION['student_id']);

    // Retrieve student information
    $sql_student = "SELECT * FROM students WHERE username = $student_id";
    $result_student = $conn->query($sql_student);

    if ($result_student->num_rows > 0) {
        $row_student = $result_student->fetch_assoc();

        // Display student information
        echo "<h2>Welcome, " . $row_student['name'] . "!</h2>";
        echo "<p>Academic Year: " . $row_student['academic_year'] . "</p>";

        // Retrieve and display the courses for the student's academic year
        $academic_year = $row_student['academic_year'];

        $sql_courses = "SELECT * FROM courses WHERE academic_year = '$academic_year'";
        $result_courses = $conn->query($sql_courses);

        if ($result_courses->num_rows > 0) {
            echo "<h3>Available Courses</h3>";
            echo "<form action='course_registration1.php' method='post'>";
            echo "<table border='1'>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Number of Credits</th>
                        <th>Select</th>
                    </tr>";

            while ($row_courses = $result_courses->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row_courses['course_id'] . "</td>
                        <td>" . $row_courses['course_name'] . "</td>
                        <td>" . $row_courses['course_credits'] . "</td>
                        <td><input type='checkbox' name='selected_courses[]' value='" . $row_courses['course_id'] . "'></td>
                      </tr>";
            }

            echo "</table>";
            echo "<input type='hidden' name='student_id' value='$student_id'>";
            echo "<input type='submit' value='Register'>";
            echo "</form>";
        } else {
            echo "<p>No courses available for the selected academic year.</p>";
        }
    } else {
        echo "<p>Student not found.</p>";
    }
} else {
    echo "<p>Student ID not provided.</p>";
}

// Close the database connection
$conn->close();
?>
