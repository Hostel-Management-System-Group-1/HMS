<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>DashBoard</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .toast {
            background-color: red;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translate(-50%);
            
            z-index: 10;
        }
        .toast-content {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .toast button{
            border: none;
            background-color: transparent;
        }
        .toast button > i {
            color: white;
            font-size: 2em;
        }

    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body style="background-color:#337ab7;">
    <div class="toast">
        <div class="toast-content">
            You are not approved by admin
        </div>
        <div style="border:none;">
            <button onclick="closeToast()"><i class='bx bx-x-circle'></i></button>
        </div>
        <script>
            function closeToast(){
                document.querySelector('.toast').style.display='none';
            }
        </script>
    </div>
    <?php include ("includes/header.php"); ?>

    <div class="ts-main-content">
        <?php include ("includes/sidebar.php"); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title" style="color:white;">Dashboard</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-primary text-light">
                                                <div class="stat-panel text-center">



                                                    <div class="stat-panel-number h1 ">My Profile</div>

                                                </div>
                                            </div>
                                            <a href="nonApproved.php" class="block-anchor panel-footer">Full Detail <i
                                                    class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-success text-light">
                                                <div class="stat-panel text-center">

                                                    <div class="stat-panel-number h1 ">My Room</div>

                                                </div>
                                            </div>
                                            <a href="nonApproved.php" class="block-anchor panel-footer text-center">See
                                                All &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div style="max-width:50vw;">
                            <div style="display:flex;flex-direction:row;justify-content:space-between;">
                                <h1 style="color:white;">Notice Board</h1>
                            </div>
                            <textarea id="notice-text" 
                                style="width:100%;height:30vh;font-size:1.5em; text-align:center;">
                                

After approval, you will see notices here</textarea>
                        </div>




                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

<style>
    .foot {
        text-align: center;
        border: 1px solid black;
    }
</style>

</html>