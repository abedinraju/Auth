<?php require_once "app/autoload.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	<?php
     
	 /**
	  * Login form isseting
	  */
     if(isset($_POST['submit'])){
     
		// Get value
		$login =$_POST['login'];
		$pass =$_POST['password'];

		if(empty($login)|| empty($pass)){
        $mess = validationMsg ('All fields are required !');

		}else{
        
		$sql = "SELECT * FROM users WHERE email='$login' or uname='$login'";
		$login_data = $connection ->query($sql);
		$login_num = $login_data ->num_rows;

		$login_users = $login_data -> fetch_assoc();

        if($login_num ==1){


			if( password_verify($pass, $login_users['pass'])){

				$_SESSION['name'] = $login_users ['name'];
				$_SESSION['email'] = $login_users ['email'];
				$_SESSION['cell'] = $login_users ['cell'];
				$_SESSION['photo'] = $login_users ['photo'];
				$_SESSION['uname'] = $login_users ['uname'];

             header('location:profile.php');
			}else{

			$mess = validationMsg('Wrong password !');
			}


		}else{

			$mess = validationMsg('Wrong username or email !');
		}

		}
	 }



    ?>

	<div class="wrap ">
		<div class="card shadow-sm">
			<div class="card-body">
				<h2>Log In Here</h2>
				<?php include "templates/message.php"; ?>
				<form action="" method ="POST">
					<div class="form-group">
						<label for="">User Name/Email</label>
						<input name="login" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" class="form-control" type="password">
					</div>
					
					<div class="form-group">
						<input name="submit" class="btn btn-primary" type="submit" value="Log In">
					</>
				</form>
			</div>
			<div class="card-footer">
			<a class="card-link" href="register.php">Create An Account</a>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>