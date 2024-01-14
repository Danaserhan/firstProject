<?php
$host="localhost";
$user="root";
$password="";
$db="course_registration";
$data = mysqli_connect($host, $user, $password, $db);
if(isset($_POST['add_teacher'])){
    $t_name=$_POST['name'];
    $t_description=$_POST['description'];
    $file=$_FILES['image']['name'];
    $dst="./image/".$file;
    $dst_db="image/".$file;
    move_uploaded_file($_FILES['image']['tmp_name'],$dst);
    $sql="INSERT INTO teacher (name,description,image) 
    VALUES('$t_name','$t_description','$dst_db')";
    $result=mysqli_query($data,$sql);
    if($result)
    {
        header('location:admin_add_teacher.php');
    }
}
?>
<html>

    <head>
        <title></title>
        <style>
            .div_deg{
                background-color:skyblue;
                padding-top:70px;
                padding-bottom:70px;
                width:500px;
            }
        </style>
    </head>
    <body>
    <?php
    include'adminsidebar.php';
    ?>
<div class="content">
    <center>
    <h1>Add teacher</h1><br><br>
    <div class="div_deg">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div>
                <label>Teacher Name:</label>
                <input type="text" name="name">
            </div>
            <br>
            <div>
                <label>Description:</label>
                <textarea name="description"></textarea>
            </div>
            <br>
            <div>
                <label>image:</label>
                <input type="file" name="image">
            </div>
            <div>
              
                <input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-primary">
            </div>
        </form>
    </div>
    </div>
  </center>

    </body>
    </html>
