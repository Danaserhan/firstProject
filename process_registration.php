<?php

phpinfo();

// Establish a database connection (replace placeholders with your database credentials)
$password = "";
$username ="root";
$dbname = "course_registration";
$servername = "localhost";

$conn= mysqli($password ,$username ,$dbname,$servername);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
   if (isset($_POST['Course Registration'])){
    header("Location: course_registration.php");
    exit();
   }

    // Insert data into the database
    $sql = "INSERT INTO course_registration ( username, password ) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location:profile1.php");
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header("Location:login.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>