<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $stmt=$mysqli->prepare("SELECT username,email,password,id FROM admin WHERE (userName=?|| email=?) and password=? ");
    $stmt->bind_param('sss',$username,$username,$password);
    $stmt->execute();
    $stmt -> bind_result($username,$username,$password,$id);
    $rs=$stmt->fetch();
    $_SESSION['id']=$id;
    $uip=$_SERVER['REMOTE_ADDR'];
    $ldate=date('d/m/Y h:i:s', time());
    if($rs)
    {
        header("location:admin-profile.php");
    }
    else
    {
        echo "<script>alert('Invalid Username/Email or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #007bff; /* Blue */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-container h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
        }

        .login-container label {
            font-weight: bold;
            color: #555555;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
        }

        .login-container input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .login-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .login-container .error-message {
            color: #ff0000;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="" method="post">
            <label for="username">Username or Email</label>
            <input type="text" id="username" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <input type="submit" name="login" value="Login">
        </form>
        <?php
        if (isset($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        ?>
    </div>
</body>

</html>
