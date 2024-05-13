<?php
session_start();
include ('includes/config.php');
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin_approved = 0;
    $stmt = $mysqli->prepare("SELECT email,password,id,admin_approved FROM userregistration WHERE email=? and password=? ");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->bind_result($email, $password, $id, $admin_approved);
    $rs = $stmt->fetch();
    // $stmt->close();
    if ($admin_approved == 0) {
        // echo "".$_SERVER['PHP_SELF']."";
        header("Location: " . $_SERVER["PHP_SELF"] . "?admin_approval_error=1");
    } else {
        $_SESSION['id'] = $id;
        $_SESSION['login'] = $email;
        $uip = $_SERVER['REMOTE_ADDR'];
        $ldate = date('d/m/Y h:i:s', time());
        if ($rs) {
            $uid = $_SESSION['id'];
            $uemail = $_SESSION['login'];
            $ip = $_SERVER['REMOTE_ADDR'];

            $stmt->execute();
            $res = $stmt->get_result();
            $cnt = 1;
            while ($row = $res->fetch_object())

            // 	$geopluginURL = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
            // $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
            // $city = $addrDetailsArr['geoplugin_city'];
            // $country = $addrDetailsArr['geoplugin_countryName'];
            // $log = "insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
            // $mysqli->query($log);
            header("location:dashboard.php");
            // if ($log) {
            // }
        } else {
            echo "<script>alert('Invalid Username/Email or password');</script>";
        }

    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>HMS</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
        function valid() {
            if (document.registration.password.value != document.registration.cpassword.value) {
                alert("Password and Re-Type Password Field do not match  !!");
                document.registration.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <style>
        body {
            background-color: #337ab7;
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .login-form label {
            font-weight: bold;
            color: #333;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #337ab7;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .login-form input[type="submit"]:hover {
            background-color: #286090;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include ('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include ('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($_GET["admin_approval_error"])) {
                            echo '<h1>You are not approved by admin</h1>';
                        } ?>
                        <div class="login-container">
                            <h2>User Login</h2>
                            <form action="" class="login-form" method="post">
                                <label for="email">Email</label>
                                <input type="text" placeholder="Email" name="email" required>
                                <label for="password">Password</label>
                                <input type="password" placeholder="Password" name="password" required>
                                <input type="submit" name="login" value="Login">
                            </form>
                            <div class="error-message">
                                <?php if (isset($login_error)) {
                                    echo $login_error;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
