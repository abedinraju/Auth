<?php include_once "app/autoload.php"; ?>
<?php 

if(isset($_GET['logout'])AND $_GET ['logout']== 'ok'){
session_destroy();
header('location:index.php');

}
     if(!isset($_SESSION['user_id'])){
	header('location:index.php');
	
	}
    
	if(isset($_SESSION['user_id'])){

    $id = $_SESSION['user_id'];
	$sql = "SELECT * FROM users WHERE id='$id'";	
    $login_info=$connection -> query($sql);

	$info = $login_info ->fetch_assoc();

	}
    
	if(isset($_GET['user_id'])){

		$id = $_GET['user_id'];
		$sql = "SELECT * FROM users WHERE id='$id'";	
		$login_info=$connection -> query($sql);
	
		$info = $login_info ->fetch_assoc();
	
		}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $info['name']; ?> </title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap ">
		<a class="btn btn-sm btn-primary" href="users.php">All Users</a>
		<div class="card shadow">
			<div class="card-body profile">
				<img  class="shadow" src="photos/users/<?php echo $info['photo']; ?>" alt="">
				<h1><?php echo $info['name']; ?></h1>
				<table class="table table-striped">
				<tr>
				<td>Name</td>
				<td><?php echo $info['name']; ?></td>
				</tr>
				<tr>
				<td>Email</td>
				<td><?php echo $info['email']; ?></td>
				</tr>
				<tr>
				<td>Username</td>
				<td><?php echo $info['uname']; ?></td>
				</tr>
				<tr>
				<td>Cell</td>
				<td><?php echo $info['cell']; ?></td>
				</tr>
				</table>
				<a class="btn btn-secondary btn-sm"href="?logout=ok">Log out</a>
			</div>
		</div>
	</div>
	
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