<?php
// Assuming you have a database connection established
$host = "localhost";
$user = "root";
$password = "";
$db = "course_registration";

$data = mysqli_connect($host, $user, $password, $db);

// Fetch the student's academic year (replace with your actual query)

$sql = "SELECT * FROM courses ";
$result = mysqli_query($data, $sql);

if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

session_start();


// Fetch the student's academic year
$user_id = $_SESSION['user_id'];
$academic_year_query = "SELECT academic_year FROM students WHERE user_id = $user_id";
$academic_year_result = mysqli_query($data, $academic_year_query);

if (!$academic_year_result) {
    die("Error fetching academic year: " . mysqli_error($data));
}

$academic_year_row = mysqli_fetch_assoc($academic_year_result);
$academic_year = $academic_year_row['academic_year'];

// Fetch courses matching the student's academic year
$sql = "SELECT * FROM courses WHERE academic_year = '$academic_year'";
$result = mysqli_query($data, $sql);

if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

include 'studentsidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <style type="text/css">
        .table_th {
            padding: 20px;
            font-size: 20px;
        }

        .table_td {
            padding: 20px;
            background-color: skyblue;
        }

        .content {
            padding-bottom: 50px;
            padding-top: -550px;
            margin-block: -40px 40px;
        }
    </style>
</head>
<body>
    <div class="content">
        <center>
            <h1>Courses</h1>
            <br></br>
            <form action="process_selected_courses.php" method="post">
            <table border="1px">
                <tr>
                    <th class="table_th">Course Name</th>
                    <th class="table_th">Course Credits</th>
                    <th class="table_th">Prerequesites</th>
                    <th class="table_th">Academic Year</th>
                    <th class="table_th">Select</th>
                </tr>
                <?php while ($info = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="table_td"><?php echo $info['course_name']; ?></td>
                        <td class="table_td"><?php echo $info['course_credits']; ?></td>
                        <td class="table_td"><?php echo $info['prerequesites']; ?></td>
                        <td class="table_td"><?php echo $info['academic_year']; ?></td>
                        <td class="table_td">
                            <input type = "checkbox" name="selected_courses[]" value="<?php echo $info['course_id']; ?>">
                    </tr>
                <?php } ?>
            </table>
            <br>
            <input type = "submit" value="Enroll Selected Courses">
                </form>
        </center>
    </div>
</body>
</html>