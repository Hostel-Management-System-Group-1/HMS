
<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">
		<br>
		<li class="ts-label" style=color:white; >Main</li>
		<?PHP if (isset($_SESSION['id'])) { ?>
			<li><a href="dashboard.php"><i class="fa fa-desktop" style=color:white;></i>Dashboard</a></li>
			<li><a href="my-profile.php"><i class="fa fa-user" style=color:white;></i> My Profile</a></li>
			<li><a href="change-password.php"><i class="fa fa-files-o" style=color:white;></i>Change Password</a></li>
			<li><a href="book-hostel.php"><i class="fa fa-file-o" style=color:white;></i>Book Hostel</a></li>
			<li><a href="room-details.php"><i class="fa fa-file-o" style=color:white;></i>Room Details</a></li>
		<?php } else { ?>

			<li><a href="registration.php"><i class="fa fa-files-o"></i> User Registration</a></li>
			<li><a href="index.php"><i class="fa fa-users"></i> User Login</a></li>
			<li><a href="admin"><i class="fa fa-user"></i> Admin Login</a></li>
		<?php } ?>

	</ul>
</nav>