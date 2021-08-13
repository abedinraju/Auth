<?php require_once "app/autoload.php"?>

<?php 

if(isset($_SESSION['user_id'])){

header('location:profile.php');
}

if(isset($_COOKIE['user_login'])){
$id = $_COOKIE['user_login'];
$cooke_user = $data = $connection ->query("SELECT * FROM user WHERE id='$id'");	

$user_login_data = $cooke_user ->fetch_assoc();

$_SESSION['user_id'] = $user_login_data ['id'];
header('location:profile.php');

}

?>

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

				$_SESSION['user_id'] = $login_users ['id'];
				setcookie('user_login' ,$login_users ['id'], time() +(60*60*24*30*12) ); 
				

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

		<div class="recent-login clearfix">
		<div class="card rl-item">
        <img class="card-img" src="photos/users/d0f7a0addd6c5378bc1c8cff5633a10e118651371_797384317469595_7437769822020981390_n.jpg" alt="">
		 
        
        <div class="card-body">
		<h4> Abedin Raju</h4>	
		<a class="btn btn-sm btn-primary" href="">Log In</a>
        </div>	
        </div>
		<div class="recent-login clearfix">
		<div class="card rl-item">
        <img class="card-img" src="photos/users/d0f7a0addd6c5378bc1c8cff5633a10e118651371_797384317469595_7437769822020981390_n.jpg" alt="">
		 
        
        <div class="card-body">
		<h4> Abedin Raju</h4>	
		<a class="btn btn-sm btn-primary" href="">Log In</a>
        </div>	
        </div>
		<div class="recent-login clearfix">
		<div class="card rl-item">
        <img class="card-img" src="photos/users/d0f7a0addd6c5378bc1c8cff5633a10e118651371_797384317469595_7437769822020981390_n.jpg" alt="">
		 
        
        <div class="card-body">
		<h4> Abedin Raju</h4>	
		<a class="btn btn-sm btn-primary" href="">Log In</a>
        </div>	
        </div>
		<div class="recent-login clearfix">
		<div class="card rl-item">
        <img class="card-img" src="photos/users/d0f7a0addd6c5378bc1c8cff5633a10e118651371_797384317469595_7437769822020981390_n.jpg" alt="">
		 
        
        <div class="card-body">
		<h4> Abedin Raju</h4>	
		<a class="btn btn-sm btn-primary" href="">Log In</a>
        </div>	
        </div>
		
		</div>
	</div>
	
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>