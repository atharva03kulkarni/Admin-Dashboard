<?php
include('connection.php'); 


$msg = "";

if(isset($_POST['submit'])) {
	
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$passwords = mysqli_real_escape_string($db,$_POST['passwords']);
	
  
    $sql = "SELECT * FROM users WHERE username='$username' AND passwords='$passwords'";
    $result = mysqli_query($db, $sql);

    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['ADMIN_LOGIN'] = 'yes';
        $_SESSION['ADMIN_USERNAME'] = $username;

    } else {
        $msg = "Please enter correct login details";
    }

	if(isset($_SESSION["ADMIN_USERNAME"])) {
		header("location:index.php");
	}
}

?>



<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<!-- BOOTSTRAP STYLES-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
		                    		<h1>LOGIN</h1>
		                    	</div>
		                    	<br/>
		                    	<div style="text-align: center;">
		                    		<form method="POST">
										<!-- <table>
											<tr>
												<td>Username:</td>
												<td><input type="text" name="username" class="textInput"></td>
											</tr>
											<tr>
												<td>Password:</td>
												<td><input type="password" name="password" class="textInput"></td>
											</tr>
											<tr>
												<td></td>
												<td><input type="submit" name="login_btn" value="Login"/></td>
											</tr>
											<p>
												Not Registered?<a href="register.php">Create an Account</a>
											</p>
											<p>
												<a href="register.php">Forget Password?</a>
											</p>
									  	</table> -->
									  	<div class="row">
									  		<div class="col-sm-3">
									  		</div>
									  		<div class="col-sm-3" style="text-align: right; padding-right: 45px">
									  		Username:
									  		</div>
									  		<div class="col-sm-3">
									  			<input type="text" name="username" class="form-group" placeholder="Enter username" required style="float: left">
									  		</div>
									  		<div class="col-sm-3">
									  		</div>
									  	</div>
									  	<div class="row">
									  		<div class="col-sm-3">
									  		</div>
									  		<div class="col-sm-3" style="text-align: right; padding-right: 45px">
									  		Password:
									  		</div>
									  		<div class="col-sm-3">
									  			<input type="password" name="passwords" class="form-group" placeholder="Enter password" required style="float: left">
									  		</div>
									  		<div class="col-sm-3">
									  		</div>
									  	</div>
									  	<div class="row">
									  		<div class="col-sm-12">
									  			&nbsp;&nbsp;<input type="submit" class="btn btn-primary" name="submit" value="Login"/>
									  		</div>
									  	</div>
									  	<br />
									  	<div class="row">
									  		<div class="col-sm-12" style="color: red">
									  			<?php echo $msg ?>
									  		</div>
									  	</div>
									  	<div class="row">
									  		<div class="col-sm-4">
									  		</div>
									  		<div class="col-sm-4">
									  			Not Registered ?<a href="register.php"> Create an Account</a>
									  		</div>
									  		<div class="col-sm-4">
									  		</div>
									  	</div>
									  	<div class="row">
									  		<div class="col-sm-4">
									  		</div>
									  		<div class="col-sm-4">
									  			<a href="register.php">Forget Password?</a>
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
