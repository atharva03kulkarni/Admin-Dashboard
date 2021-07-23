<?php
include('connection.php'); 


$msg = "";
$userExists ="";

if(isset($_POST['register_btn'])) {
	
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$password = mysqli_real_escape_string($db,$_POST['password']);
	$password_1 = mysqli_real_escape_string($db,$_POST['password_1']);

	if ($password == $password_1) {
		$sql = "SELECT * FROM users WHERE username='$username'";
    	$result = mysqli_query($db, $sql);
    	if (mysqli_num_rows($result) == 0) {
			// create user
			//$password = md5($password); //hash password before storing for security purpose
			$sql = "INSERT INTO users(username,email,passwords) VALUES ('$username','$email','$password')";
			mysqli_query($db, $sql);
	        $_SESSION['message'] = "You are logged in";
	        $_SESSION['username'] = $username;
	        header("location: login.php");
    	} 

    	else
        {
        	 
          		$userExists = "User Already Registered";
    	
    	}
	}else

	{
		// failed
		$_SESSION['message'] = "The two password do not match";
		$msg = "The two password does not match";
	}
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		   		<!-- BOOTSTRAP STYLES-->
	    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	     <!-- FONTAWESOME STYLES-->
	    <link href="assets/css/font-awesome.css" rel="stylesheet" />
	        <!-- CUSTOM STYLES-->
	    <link href="assets/css/custom.css" rel="stylesheet" />
	     <!-- GOOGLE FONTS-->
	   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


	</head>
		<body>
		<div class="row">
			<div class="col-sm-12">
			 	<div class="navbar navbar-inverse navbar-fixed-top">
		            <div class="adjust-nav">
		                <div class="navbar-header">
		                    <a class="navbar-brand" href="#">
		                        <img src="assets/img/Logo.png" />
		                    </a>
		                    
		                </div>
		            </div>
		        </div>
	
				<div class="row" style="margin-top: 50px;">
		        	<div class="col-sm-12" style="padding: 100px;">
		            	<div class="row">
		                    <div class="col-sm-12"> 
		                    	<div style="text-align: center;">
		                    		<h1>REGISTER</h1>
		                    	</div>
		                    	<br/>
		                    	<div style="text-align: center;">
		                    		<form method="post" action="register.php">
		                    			<div class="row">
									  		<div class="col-sm-3">
									  		</div>
									  		<div class="col-sm-3" style="text-align: right; padding-right: 45px">
									  		Username:
									  		</div>
									  		<div class="col-sm-6">
									  			<input type="text" name="username" class="form-group" placeholder="Enter username" required value="" style="float: left">
									  			<p style="color: red; text-align: left; padding-left: 200px">
									  			<?php echo $userExists ?>
									  			</p>
									  		</div>
									  	</div>
									  	<div class="row">
									  		<div class="col-sm-3">
									  		</div>
									  		<div class="col-sm-3" style="text-align: right; padding-right: 45px">
									  		Email:
									  		</div>
									  		<div class="col-sm-3">
									  			<input type="text" name="email" class="form-group" placeholder="Enter email-id" required value=""style="float: left">
									  		</div>
									  		<div class="col-sm-3">
									  		</div>
									  	</div>
									  	<div class="row">
									  		<div class="col-sm-3">
									  		</div>
									  		<div class="col-sm-3" style="text-align: right; padding-right: 45px">
									  		Password :
									  		</div>
									  		<div class="col-sm-3">
									  			<input type="password" name="password" class="form-group" placeholder="Enter password" required value="" style="float: left">
									  		</div>
									  		<div class="col-sm-3">
									  		<?php	echo$msg;?>
									  		</div>
									  	</div>
									  	
									  	<div class="row">
									  		<div class="col-sm-3">
									  		</div>
									  		<div class="col-sm-3" style="text-align: right; padding-right: 45px">
									  		Confirm Password:
									  		</div>
									  		<div class="col-sm-6">
									  			<input type="password" name="password_1" class="form-group" placeholder="Confirm password" required value="" style="float: left">
									  			<p style="color: red; text-align: left; padding-left: 200px">
									  			
									  			</p>
									  		</div>
									  	</div>
									  	<div class="row">
									  		<div class="col-sm-4">
									  		</div>
									  		<div class="col-sm-4">
									  			&nbsp;&nbsp;<input type="submit" class="btn btn-primary" name="register_btn" value="Register"/>
									  		</div>
									  		<div class="col-sm-4">
									  			
									  		</div>
									  	</div>
									  	<br />
									  	<div class="row">
									  		<div class="col-sm-4">
									  		</div>
									  		<div class="col-sm-4">
									  			Already Registered ?<a href="login.php"> Login </a>
									  		</div>
									  		<div class="col-sm-4">
									  		</div>
									  	</div>
									  </form>
		                    	</div>
		                    </div>
		                </div>
		            </div>
	        	</div>
	        </div>
		 </div>
	
	<!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	</body>
</html>
	
				
