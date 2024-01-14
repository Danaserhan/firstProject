<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Login Page </title>
    <link rel="icon" type="image/x-icon" href="logo_6.jpg">
 
<style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('luimage .jpg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
        
            align-self: auto;
            display: flex;
            height: 100vh;
            
        }
        .bottom-right{
            position:absolute;
            bottom:10px;
            right:10px;
            margin:10px;
            color:  green;
            font-family: Courier, monospace;
            font-size:30px;
        }
                h1 {
            color:darkblue; 
        }
        header {
            text-align: left;
            margin-bottom: 20px;
            margin: 20px 20px 0 20px;
        }
        form {
            align-self: center;
            align-items: center;
            justify-content: center;
            justify-items: center;
            justify-self: center; 
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
           margin-top: 50px;
           margin-left:130px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }
        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        </style>

</head>

<body >

<header><h1><p>Lebanese University <br> Faculty of sciences</p></h1></header>

          <form action="login_check.php" method="POST" >
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Submit</button>
                </form>
     <div class="bottom-right">
     


    
 <button onclick ="redirecttoadminlogin();">are you an admin?</button>


  <script>
    function redirecttoadminlogin() {
        window.location.href = 'adminlogin.php';
    }
    </script>

    

    </div>
</body>



</html>