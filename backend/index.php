<?php include 'processes/queries.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login_style.css">
	<link rel="icon" type="image/x-icon" href="images/app_icon.png">
	<title>Login</title>
</head>
<body>

	<div class="main-container">
		<div class="container">
			<form action="index.php" method="POST">
				<img src="images/app_icon.png" alt="Aladin's Aviary">
				<h1 class="login-header">Welcome Back!</h1>
				<p class="login-description">Please enter your account credentials and login to access Aladin's Aviary's Database Management System.</p>
				<?php include('processes/prompt.php');?>
				<input type="text" placeholder="Username" name="username" autocomplete="off" required>
				<input type="password" placeholder="Password" name="password" id="password" autocomplete="off" required>
				<div class="checkbox-container">
					<input type="checkbox" id="show-password-cb" onchange="showPassword()">
					<label for="show-password-cb">Show Password</label>
				</div>
				<button type="submit" class="btn btn-login" name="login">Login</button>
				<a href="#"><p class="login-trouble">Having trouble signing in?</p></a>
			</form>
		</div>
	</div>
	
</body>
<script src="js/login-script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>