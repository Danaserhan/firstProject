<?php

$host="localhost";

$user="root";

$password="";

$db="course_registration";


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
    die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$name=$_POST['admin_username'];

$pass = $_POST['admin_password'];


$sql="select * from admin where username ='".$name."' AND password ='".$pass."' ";

$result=mysqli_query($data,$sql);
if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row !== null && is_array($row) && isset($row["usertype"])) {
        // Authentication successful
        if ($row["usertype"] == "student") {
            header("location: login.php");
        } elseif ($row["usertype"] == "admin") {
            header("location: adminprofile.php");
        } else {
            die("Invalid usertype");
        }
        exit();
    } else {
        die("Username or password do not match");
    }
} else {
    echo "Error in query execution: " . mysqli_error($data);
}
}









?>


