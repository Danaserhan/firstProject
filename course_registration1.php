<?php
session_start(); // Start the session
echo "hello";
$host = "localhost";
$user = "root";
$password = "";
$db = "course_registration";
$conn = mysqli_connect($host, $user, $password, $db);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve student_id from the session
    if (isset($_SESSION['student_id'])) {
        $student_id = mysqli_real_escape_string($conn, $_SESSION['student_id']);

    // Retrieve selected courses from the form
$selected_courses = isset($_POST['selected_courses']) ? $_POST['selected_courses'] : [];

// Retrieve and add previously failed courses to selected courses
$sql_failed_courses = "SELECT * FROM failed_courses WHERE student_id = '$student_id'";
$result_failed_courses = $conn->query($sql_failed_courses);
echo "<h2>Your Previous Failed Courses:</h2>";

// Display table for failed courses
echo "<table border='1'>";
echo "<tr><th>Course ID</th><th>Course Name</th><th>Credits</th></tr>";

while ($row_failed_courses = $result_failed_courses->fetch_assoc()) {
    $course_id = $row_failed_courses['course_id'];
    $course_name = $row_failed_courses['course_name'];
    $course_credits = $row_failed_courses['course_credits'];

    echo "<tr><td>$course_id</td><td>$course_name</td><td>$course_credits</td></tr>";
    // test
}

echo "</table>";

while ($row_failed_courses = $result_failed_courses->fetch_assoc()) {
    $failed_course_id = $row_failed_courses['course_id'];

    // Check if the failed course is not already selected
    if (!in_array($failed_course_id, $selected_courses)) {
        $selected_courses[] = $failed_course_id;
    }
}

    }

            // Assuming $selected_courses is an array of course_ids selected by the student
            if (!empty($selected_courses)) {
                // Sanitize and enclose each course ID in single quotes
                $escaped_course_ids = array_map(function ($course_id) use ($conn) {
                    return "'" . mysqli_real_escape_string($conn, $course_id) . "'";
                }, $selected_courses);

                // Calculate the total sum of credits for the selected courses
                $sql_sum_credits = "SELECT SUM(course_credits) AS total_credits
                                    FROM courses
                                    WHERE course_id IN (" . implode(',', $escaped_course_ids) . ")";


                // Prepare and execute the query
                $stmt = $conn->prepare($sql_sum_credits);

                // Check if the statement is prepared successfully
                if ($stmt === false) {
                    die('Error preparing statement: ' . $conn->error);
                }

                // Execute the query
                $stmt->execute();

                // Bind the result variables
                $stmt->bind_result($total_credits);

                // Fetch the result
                $stmt->fetch();
                // Close the result set
                $stmt->close();
                // Check if the total credits meet your constraints
                $min_credits = 12;
                $max_credits = 72;

                if ($total_credits >= $min_credits && $total_credits <= $max_credits) {
                    // Clear existing registrations for the student
                    $sql_delete = "DELETE FROM registrations WHERE student_id = '$student_id'";
                    $conn->query($sql_delete);
                    
                    // Insert new registrations
                    foreach ($selected_courses as $course_id) {
                        $sql_insert = "INSERT INTO registrations (student_id, course_id) VALUES ('$student_id', '$course_id')";
                        $conn->query($sql_insert);
                    }

                    echo "Registration successful!";
                } else {
                    echo "Error: Total credits must be between $min_credits and $max_credits.";
                }
                
                // Close the statement
                //$stmt->close();
            }
        
        }
    

// Close the database connection
$conn->close();
?>
