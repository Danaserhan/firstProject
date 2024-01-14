<?php

$host="localhost";

$user="root";

$password="";

$db="course_registration";

$data=mysqli_connect($host,$user,$password,$db);
$sql="SELECT * FROM students  WHERE usertype='student'"; 
$result=mysqli_query($data,$sql);
    include'adminsidebar.php';
    
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Admin Dashboard</title>
   
    <style type="text/css">

.table_th
{
    padding: 20px;
    font-size: 20px;
}
.table_td
{
    padding:20px;
    background-color:skyblue;
}

.content
{
    padding-bottom:50px;
    padding-top:-550px;
    margin-block:-40px 40px;
}
</style>
</head>
<body>
    

    <div class="content">
        <center>
        <h1>Student Data</h1>
        <br></br>
        <table border="1px">
            <tr>
                <th class="table_th">name</th>
                <th class="table_th">Id</th>
                <th class="table_th">password</th>
                <th class="table_th">academic_year</th>
                <th class="table_th">major</th>
            </tr>
            <?php
            while($info=$result->fetch_assoc())
            {
            ?>
            <tr>
                <td class="table_td"><?php echo "{$info['name']}" ; ?></td>
                <td class="table_td"><?php echo "{$info['username']}";?></td>
                <td class="table_td"><?php echo "{$info['password']}";?></td>
                <td class="table_td"><?php echo "{$info['academic_year']}";?></td>
                <td class="table_td"><?php echo "{$info['major']}";?></td>
                

            </tr>

            <?php
        
            }
            ?>
            
            
            
</table>
        </center>
</div>
</body>
</html>