<?php 


session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){	
	header("location: welcome.php");
	exit();
}

require("index.php");


$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(empty(trim($_POST['username']))){
		$username_err = "Username field cannot be blank";
	}
	else{
		$username = trim($_POST['username']);
	}

	if(empty(trim($_POST['password']))){
		$password_err = "Password field cannot be blank";
	}
	else{
		$password = trim($_POST['password']);
	}


	if(empty($username_err) && empty($password_err)){

		$sql = "SELECT id, username, password from users where username= ?";

		if($stmt = mysqli_prepare($conn,$sql)){
			mysqli_stmt_bind_param($stmt, 's', $param_username);
			$param_username = $username;
			if(mysqli_stmt_execute($stmt)){
				// To store the result
				mysqli_stmt_store_result($stmt);

				// If any information has been retrieved or not
				if(mysqli_stmt_num_rows($stmt)==1){
					// Used to bind the fetched stuff to the variables
					mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

					// Fetch the results into the variables above
					if(mysqli_stmt_fetch($stmt)){
						if(password_verify($password, $hashed_password)){
							session_start();

							$_SESSION['loggedin'] = true;
							$_SESSION['id'] = $id;
							$_SESSION['username'] = $username;
							header("location : welcome.php");
						}
						else{
							echo "Oops. The password is incorrect";
						}

					}
				}
				else{
					echo "No account was found with these credentials";
				}
			}
			else{
				echo "Something is wrong with the dollar stmt part";
			}
			mysqli_stmt_close($stmt);
		}

	}

    mysqli_close($conn);

}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>
 		Login
 	</title>
 </head>
 <body>
 	<div class="container middle p-3">
 		<form action="login.php" method="POST">
 			<h2 class="text-center">Login</h2><br>
 			<div class="form-group">
 				<label for="username" class="form-label">E-mail</label>
 				<input type="email" class="form-control" id="username" name="username">
 			</div>
 			<div class="form-group">
 				<label for="password" class="form-label">Password</label>
 				<input type="password" class="form-control" id="password" name="password">
 			</div>
 			<br><br>
 			<div class="text-center">
	 			<button class="btn btn-primary">Login</button>
 			</div>
 		</form>
 	</div>
 
 </body>
 </html>