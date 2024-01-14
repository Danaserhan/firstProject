<?php

session_start();
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
$student_id=$_POST['username'];

$pass = $_POST['password'];


$sql="select * from students where username ='".$student_id."' AND password='".$pass."' ";

$result=mysqli_query($data,$sql);
$row= mysqli_fetch_array($result);

if ($student_id) {
    // Store student_id in a session variable
    $_SESSION['student_id'] = $student_id;



if ($row["usertype"]=="student") {
 
    header("location:student_courses.php");
}

elseif ($row["usertype"]=="admin"){

 
    header("location:adminprofile.php"); 
}


else
{
    echo "username or password do not match";

}
}
}






?>



