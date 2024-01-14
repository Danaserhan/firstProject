<?php
error_reporting(E_ALL);
include'adminsidebar.php';
$host="localhost";

$user="root";

$password="";

$db="course_registration";

$data = mysqli_connect($host, $user, $password, $db);

if($data->connect_error){
    die("connection failed:"  . $data->connect_error);
}


if(isset($_POST['add_student'])){



$Student_name=$_POST['name'];
$Student_id=$_POST['username'];
$Student_password=$_POST['password'];
$year=$_POST['academic_year'];
$major=$_POST['major'];
$usertype="student"; 

$check="SELECT * FROM students WHERE username='$Student_id' ";
$check_students=mysqli_query($data,$check);

$row_count=mysqli_num_rows($check_students);

if($row_count==1)
{
    echo " <script type='text/javascript'>
    alert('id already exists ') ;
    </script>";
       
    


}
else
{


$sql ="INSERT IGNORE INTO students(name,username,password, academic_year ,major,usertype)
 VALUES ('$Student_name','$Student_id','$Student_password','$year','$major',
 '$usertype')";
 
 if($data->query($sql)==TRUE){
    echo " <script type='text/javascript'>
    alert('student added successfully ') ;
    </script>";
       
    
 }
else{
    echo"error" . $sql . "<br>" . $data->error;
}

 $result = mysqli_query($data,$sql);
 
}

}
$data->close();
 ?>
<DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin Profile</title>
    <script src="https://fontawesome.com/b99e675b6e.js"></script>
    <style> </style>
    </head>
    <body>
<center>
<div class="content">
    <h1>Add student</h1>
    <div class="div_deg">
        <form method="post">
        <div>
                <label>Student name</label>
                <input type="text" name="name">
            </div>
            <div>
                <label>Student id</label>
                <input type="text" name="username">
            </div>
            <div>
                <label>Password</label>
                <input type="text" name="password">
            </div>
            <div>
                <label>Academic year</label>
                <input type="text" name="academic year">
            </div>
            <div>
                <label>Student major</label>
                <input type="text" name="major">
            </div>
            
            
            <div>
                
                <input type="submit"class="btn btn-primary" name="add_student" value="Add student">
            </div>

        </form>
</div>
</center>

</body>
</html>
</div>
</div>
   </body>

   </html>