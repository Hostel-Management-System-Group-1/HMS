<?php
session_start();
include ('includes/config.php');
include ('includes/checklogin.php');
check_login();

$sql = "SELECT * FROM notice_board";
$result = $mysqli->query($sql);

$notices = "";
// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch data row by row
    while($row = $result->fetch_assoc()) {
        $notices = $row["date"]."\n".$row["notice"]."\n\n".$notices;
    }
} else {
    $notices = "No notices available.";
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

	<title>DashBoard</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div id="notice-modal-container" class="notice-modal-container"
		style="z-index:1111111;width:100%;height:100%;top:0px;left:0px;display:none;position:absolute;flex-direction:column;justify-content:center;align-items:center;background-color:rgba(0,0,0,0.5);">
		<div class="modal-content notice-modal"
			style="background-color:rgba(200,200,200,1);padding:10px;;border-radius:20px;min-width;50vw;min-height: 30vh;padding:40px;">
			<div style="display:flex;flex-direction:row;justify-content:space-between;align-items:center;s">
				<h2>Add Notice</h2>
				<span onclick="closeNoticeAddingModal()" class="close">&times;</span>
			</div>
			<textarea placeholder="Type your notice here..." id="new-notice-textarea"></textarea>
			<button type="submit" onclick="addNotice()">Add</button>
		</div>
	</div>
	<?php include ("includes/header.php"); ?>

	<div class="ts-main-content">
		<?php include ("includes/sidebar.php"); ?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">

													<?php
													$result = "SELECT count(*) FROM registration ";
													$stmt = $mysqli->prepare($result);
													$stmt->execute();
													$stmt->bind_result($count);
													$stmt->fetch();
													$stmt->close();
													?>

													<div class="stat-panel-number h1 "><?php echo $count; ?></div>
													<div class="stat-panel-title text-uppercase"> Students</div>
												</div>
											</div>
											<a href="manage-students.php" class="block-anchor panel-footer">Full Detail
												<i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
													<?php
													$result1 = "SELECT count(*) FROM rooms ";
													$stmt1 = $mysqli->prepare($result1);
													$stmt1->execute();
													$stmt1->bind_result($count1);
													$stmt1->fetch();
													$stmt1->close();
													?>
													<div class="stat-panel-number h1 "><?php echo $count1; ?></div>
													<div class="stat-panel-title text-uppercase">Total Rooms </div>
												</div>
											</div>
											<a href="manage-rooms.php" class="block-anchor panel-footer text-center">See
												All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>


								</div>
							</div>
						</div>
						<div style="max-width:50vw;">
							<div style="display:flex;flex-direction:row;justify-content:space-between;">
								<h1>Notice Board</h1>
								<button class="btn btn-primary" onclick="openNoticeAddingModal()">Add Notice</button>
							</div>
							<textarea id="notice-text" style="width:100%;height:30vh"><?php echo $notices; ?></textarea>
						</div>


					</div>
				</div>

			</div>
		</div>
	</div>

	<script>
		function openNoticeAddingModal() {
			document.getElementById("notice-modal-container").style.display = "flex";
		}
		function closeNoticeAddingModal() {
			document.getElementById("notice-modal-container").style.display = "none";
		}
		function addNotice() {
			const newNotice = document.getElementById("new-notice-textarea")?.value;
			alert("Addingn notice: "+newNotice.toString())
			window.open(`addNotice.php?notice=${newNotice}`);
		}
	</script>

	<!-- Loading Scripts -->
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

		window.onload = function () {

			// Line chart from swirlData for dashReport
			var ctx = document.getElementById("dashReport").getContext("2d");
			window.myLine = new Chart(ctx).Line(swirlData, {
				responsive: true,
				scaleShowVerticalLines: false,
				scaleBeginAtZero: true,
				multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
			});

			// Pie Chart from doughutData
			var doctx = document.getElementById("chart-area3").getContext("2d");
			window.myDoughnut = new Chart(doctx).Pie(doughnutData, { responsive: true });

			// Dougnut Chart from doughnutData
			var doctx = document.getElementById("chart-area4").getContext("2d");
			window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, { responsive: true });

		}
	</script>

</body>


<style>
	.foot {
		text-align: center;
		border: 1px solid black;
	}
</style>

</html>