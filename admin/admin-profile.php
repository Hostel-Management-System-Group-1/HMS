<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if($_POST['update']) {
    $email=$_POST['emailid'];
    $aid=$_SESSION['id'];
    $udate=date('Y-m-d');
    $query="update admin set email=?, updation_date=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('ssi',$email,$udate,$aid);
    $stmt->execute();
    echo"<script>alert('Email id has been successfully updated');</script>";
}

if(isset($_POST['changepwd'])) {
    $op=$_POST['oldpassword'];
    $np=$_POST['newpassword'];
    $ai=$_SESSION['id'];
    $udate=date('Y-m-d');
    $sql="SELECT password FROM admin where password=?";
    $chngpwd = $mysqli->prepare($sql);
    $chngpwd->bind_param('s',$op);
    $chngpwd->execute();
    $chngpwd->store_result(); 
    $row_cnt=$chngpwd->num_rows;
    if($row_cnt>0) {
        $con="update admin set password=?, updation_date=?  where id=?";
        $chngpwd1 = $mysqli->prepare($con);
        $chngpwd1->bind_param('ssi',$np,$udate,$ai);
        $chngpwd1->execute();
        $_SESSION['msg']="Password Changed Successfully !!";
    } else {
        $_SESSION['msg']="Old Password not match !!";
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
    <title>Admin Profile</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #007bff; /* Blue */
            font-family: Arial, sans-serif;
        }
        
        .ts-main-content {
            margin-top: 50px;
        }
        
        .panel-heading {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        
        .panel-body {
            background-color: #fff;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        
        .form-horizontal .form-group {
            margin-bottom: 20px;
        }
        
        .btn-default {
            background-color: #ddd;
            color: #333;
            border-color: #ccc;
        }
        
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body style="background-color:#337ab7;">
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Admin Profile</h2>
                        <?php
                        $aid=$_SESSION['id'];
                        $ret="select * from admin where id=?";
                        $stmt= $mysqli->prepare($ret);
                        $stmt->bind_param('i',$aid);
                        $stmt->execute();
                        $res=$stmt->get_result();
                        while($row=$res->fetch_object()) {
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Admin profile details</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="<?php echo $row->username;?>" disabled class="form-control">
                                                    <span class="help-block m-b-none">Username can't be changed.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="emailid" id="emailid" value="<?php echo $row->email;?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Reg Date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo $row->reg_date;?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <button class="btn btn-default" type="submit">Cancel</button>
                                                <input class="btn btn-primary" type="submit" name="update" value="Update Profile">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Change Password</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" name="changepwd" id="change-pwd" onSubmit="return valid();">
                                            <?php if(isset($_POST['changepwd'])) { ?>
                                            <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></p>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Old Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" value="" name="oldpassword" id="oldpassword" class="form-control" onBlur="checkpass()" required>
                                                    <span id="password-availability-status" class="help-block m-b-none" style="font-size: 12px;"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">New Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="newpassword" id="newpassword" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Confirm Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" value="" required id="cpassword" name="cpassword">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-sm-offset-4">
                                                <button class="btn btn-default" type="submit">Cancel</button>
                                                <input type="submit" name="changepwd" Value="Change Password" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
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
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data:'emailid='+$("#emailid").val(),
                type: "POST",
                success:function(data){
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }
    </script>
    <script>
        function checkpass() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data:'oldpassword='+$("#oldpassword").val(),
                type: "POST",
                success:function(data){
                    $("#password-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }
    </script>
</body>
</html>
