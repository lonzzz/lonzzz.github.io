	<?php  require'individuals/connection.php'; ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Assignment</title>
		<!-- bootstrap css -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<style type="text/css">
			.jumbotron{
				min-width: 300px;
				min-height: 300px;
				background-image: url(images/ishaa.jpg);
				background-size: cover;
			}
			.container-text-center{
				font-weight: bold;
				color: red;
			}
		</style>
	</head>
	<body>
		<div class="jumbotron">
			<h1>Welcome to the to do list page</h1>
		<div class="container-text-center">
				<h2>Login/Register</h2>
				<!-- navpills -->
				<div class="row">
					<div class="col-3"></div>
					<div class="col-3">
						<a href="#login" class="btn btn-primary btn-lg">Login</a>
					</div>
					<div class="col-3">
						<a href="#Register" class="btn btn-success btn-lg">Register</a>
					</div>
					<div class="col-3"></div>
				</div>
		<div class="container-text-center">
			<div class="row">
				<div class="col-1"></div>
				<div class="col-5">
						<div id="Register">
						<form action="project.php" method="post">
							<legend>Register</legend>
							<div class="form-group btn btn-primary">
								<label for="username">username</label>
								<input type="text" name="user" required>
							</div>

							<div class="form-group btn btn-success">
								<label for="password">password</label>
								<input type="pwd" name="pass" required>
							</div>

							<div class="form-group btn btn-warning">
								<label for="phonenumber">phonenumber</label>
								<input type="INT" name="number" required>
							</div><br>
							<button type="Register" name="Register" class="btn btn-info btn-lg">Register</button>

						</form>
					</div>
				</div>
			
				<div class="col-5">
					<div id="Login">
							<form action="project.php" method="post">
								<legend>Login</legend>
								<div class="form-group btn btn-primary">
									<label for="username">user</label>
									<input type="text" name="user" required>
								</div>

								<div class="form-group btn btn-success">
									<label for="password">password</label>
									<input type="pwd" name="pass" required>
								</div><br>
									<button type="Login" name="Login" class="btn btn-info btn-lg">Login</button>

							</form>	
						</div>

				</div>
				<div class="col-1"></div>

		</div>
	</div>
</div>
</div>
		<?php 
  //check if the user has logged in
  if(isset($_POST["Login"])){
  		extract($_POST);
  		$encryptedPass=sha1($pass);
  		$query="SELECT* FROM 6407user WHERE username='$user' AND password_hash ='$encryptedPass'";
  		//$query="SELECT * FROM  6470user WHERE username= $user AND password= $pass";
  		$result =mysqli_query($conn, $query);
  		//check for query error 
  		if(!$result){
  			die("Query Failed :" .mysqli_error($conn));
  		}
  		//echo "<h2>QUERRY SUCCESS</h2>";
  		$count = mysqli_num_rows($result);

  		//check if email and password matched
  		if($count==1){
  			//successful login
  			session_start();
	  		$_SESSION['username']=$user;
	  		//reload page
	  		header("location:landing.php");
  			
  			//redirect to admin dashboard

  		}else{
  			echo "<h4>Username or password you entered is incorrect</h4>";
  		}
  	} 
  	if(isset($_POST["Register"])){
  	//getting user input
  	extract($_POST);

  	//$encryptedPass=md5($pass);
  	//save user input to db
  	$query="SELECT* FROM 6407user WHERE username='$user'";
  	  		//$query="SELECT * FROM  6470user WHERE username= $user AND password= $pass";
  	 $result =mysqli_query($conn, $query);
  	$count=mysqli_num_rows($result);
  	if($count!=0){
  		echo "Errohehj";
  	}
  	else{
  	$encryptedPass=sha1($pass);
  	$query="INSERT INTO `6407user`(`username`, `password_hash`, `phone`) VALUES('$user','$encryptedPass','$number')";
  	//run query
  	if(mysqli_query($conn,$query)){
  		//insert success
  
  		session_start();
  		$_SESSION['username']=$user;
  		//reload page
  		header("location:project.php");
  	}else{
  		die("Insert error :" . mysqli_error($conn));
  	}
  }
  } 
  ?>
	</body>
	</html>
		<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>