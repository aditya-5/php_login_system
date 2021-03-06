<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<link rel="stylesheet" href="style.css">

<?php 
require("index.php");

// Initialising the values
$username = $password = $confirm_password = '';
$username_err = $password_err = $confirm_password_err = '';

// Checking if form has been submitted or not (similar to isset())
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(empty(trim($_POST['username']))){
		$username_err = 'Email cannot be blank';
	}
	else{
		$sql = "SELECT id from users WHERE username=?";

		// Prepare the SQL query and bind the username param to it (in place of the question mark)
		if($stmt = mysqli_prepare($conn,$sql)){
			// Bind params to the query, s means string here.
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			$param_username = trim($_POST['username']);

			if(mysqli_stmt_execute($stmt)){

				// To store the result received (doesn't cause performance loss)
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt)==1){
					$username_err = "E-mail already in use";
				}
				else{
					$username = trim($_POST['username']);
				}
			}
		}
		else{
			echo("Something went wrong with the dollar stmt part");
		}
		mysqli_stmt_close($stmt);
	}



// Checking the password constraints
if(empty(trim($_POST['password']))) {
	$password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password']))<6){
	$password_err = "Password needs to be greater than 6 characters";
}
else{
	$password = trim($_POST['password']);
}

// Checking the confirm password 
if(empty(trim($_POST["confirmpass"]))){
	$confirm_password_err = "Confirm password field cannot be empty";
}
else{
	$confirm_password = trim($_POST["confirmpass"]);
	if( empty($password_err) && $password != trim($_POST["confirmpass"])){
		$confirm_password_err = "Passwords don't match";
			}
}

// Checking if any errors before entering into database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
	$sql = "INSERT INTO users (username, password) VALUES (?,?)";

	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "ss", $username, $param_password);
		$param_password = password_hash($password , PASSWORD_DEFAULT);
		if(mysqli_stmt_execute($stmt)){
			header("login.php");
		}
		else{
			echo "Something went wrong with the second dollar stmmt part";
		}
	
	mysqli_stmt_close($stmt);
}}

mysqli_close($conn);
}

 ?>


<html>
<head>
	<title>Register</title>
</head>
<body>

<form action="register.php" method="POST">
	<div class="container p-5 middle">
		<div class="form-group mb-3">
			<label for="email" class="form-label">E-mail</label>
			<input type="email" class="form-control" id="username" name="username" placeholder="Enter email">
		</div>
		<div class="form-group mb-3">
			<label for="pass" class="form-label">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
		</div>
		<div class="form-group mb-3">
			<label for="pass" class="form-label">Password</label>
			<input type="password" class="form-control" id="confirmpass" name="confirmpass" placeholder="Confirm Password">
		</div><br>
		<div class="text-center">
			<button class="btn btn-primary">Register</button>
		</div>
	</div>
</form>

</body>
</html>


