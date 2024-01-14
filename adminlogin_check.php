<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "course_registration";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    $sql = "SELECT * FROM admin  WHERE username = '".$admin_username."'
     AND password ='".$admin_password."' ";

    $stmt = mysqli_query($data, $sql);
    $checkAdminExistsSql = "SELECT * FROM admin WHERE username = '$admin_username'";
    $checkAdminExistsResult = mysqli_query($data, $checkAdminExistsSql);

    if ($checkAdminExistsResult && mysqli_num_rows($checkAdminExistsResult) === 0) {
        echo "Admin does not exist in the database.";
        exit();
    }

    if ($stmt) {
        /*mysqli_stmt_bind_param($stmt, "ss", $admin_username, $admin_password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);*/
        $row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);

        if ($row) {


            
            // Authentication successful
            header("location: adminprofile.php");
            exit();
        } 
        else {
            echo "Admin username or password do not match";
        }

       /*mysqli_stmt_close($stmt);*/
    } else {
        echo "Error in prepared statement:".mysqli_error($data);
    }
}
  
?>

