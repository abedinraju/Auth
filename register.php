<?php require_once "app/autoload.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Social Site</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
<?php 

/**
 * Social Ragistration Form Isseting
 * 
 */
    if(isset($_POST['social'])){

	// Get Value

	$name =$_POST['name'];
	$email =$_POST['email'];
	$cell =$_POST['cell'];
	$uname =$_POST['uname'];
	$pass =$_POST['pass'];
	$cpass =$_POST['cpass'];



	// Make Password Hash or Salt

   	$hash_pass= password_hash($pass,PASSWORD_DEFAULT);
    
	// Agreement Status

  	$status = 'disagree';
	if(isset($_POST['status'])){
	$status =$_POST['status'];
	}

	
   // Email check

   $email_check = valueCheck('users','email',$email);

   // User name check
   $uname_check = valueCheck('users','uname',$uname);

   //Cell check
   $cell_check = valueCheck('users','cell',$cell);

   // File Upload

   $file_name = $_FILES ['photo']{'name'};
   $file_tmp = $_FILES ['photo']{'tmp_name'};

   $unique_name = md5 (time() . rand()) . $file_name;


  /**
 * Form Validation
 */


    if( empty($name) || empty($email) || empty($cell) || empty($uname) || empty($pass)){
  
	$mess = validationMsg ('All fields are required !');

	}elseif( $status == 'disagree'){
    
	$mess = validationMsg ('You should agree first !','warning');

	}elseif( $pass != $cpass ){

	$mess = validationMsg ('Password Not Match !','warning');

	}elseif(!filter_var($email ,FILTER_VALIDATE_EMAIL)){
     
	$mess = validationMsg ('Invalid email address','warning');

	}elseif($email_check >0){

	$mess = validationMsg ('Email already taken','warning');

	}elseif( $uname_check > 0){
	$mess = validationMsg ('User name already taken','warning');

	}elseif( $cell_check >0 ){
    $mess = validationMsg ('Cell number already taken','warning');

	}else{

	  insert("INSERT INTO users (name,email,cell,uname,pass,photo,status)VALUES ('$name','$email','$cell','$uname','$hash_pass','$unique_name','$status' )");
	 move_uploaded_file($file_tmp,'photos/users/' . $unique_name );
		$mess = validationMsg ('User ragistration successful ','success');
	}
    
	
}



?>


	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Create Your Account</h2>
				<?php 
				 
				 if(isset($mess )){
					 echo $mess;
				 }
				
				?>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="uname" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="pass" class="form-control" type="password">
					</div>
					<div class="form-group">
						<label for="">Confirm Password</label>
						<input name="cpass" class="form-control" type="password">
					</div>
					<div class="form-group">
						<label for="">Profile Picture</label>
						<input name="photo" class="form-control-file" type="file">
					</div>
					<div class="form-group">
					<input name="status" value="agree" type="checkbox" id=""> <label for="agree" >I agree to go</label>
					</div>
					<div class="form-group">
						<input name="social" class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
			<div class="card-footer">
			<a class="card-link"href="index.php">Log In Now</a>
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