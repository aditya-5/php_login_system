<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<link rel="stylesheet" href="style.css">

<?php

define("DB_SERVER",'localhost');
define("DB_USERNAME", 'root');
define("DB_PASSWORD", '');
define("DB_NAME", 'loginSystem');

// First run
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);

// If database already created
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, DB_NAME);


if($conn === false){
	die("ERROR: COULDN'T CONNECT TO DATABASE " .  mysqli_connect_error());
}
else{
	echo("Connected Successfully<br>");
}

// First run only - Creating database

// $sql = "CREATE DATABASE ".DB_NAME;
// if(mysqli_query($conn, $sql)){
// 	echo "Created Database successfully";
// }
// else{
// 	echo("Error creating database : ". mysqli_error($conn));
// 	exit();
// }


// Creating table
// $sql = "CREATE TABLE users(
// 		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
// 		username VARCHAR(50) NOT NULL UNIQUE,
// 		password VARCHAR(255) NOT NULL,
// 		created_at DATETIME DEFAULT CURRENT_TIMESTAMP)";

// if(mysqli_query($conn, $sql)){
// 	echo("Created Table successfully");
// }
// else{
// 	echo("Error creating table : ". mysqli_error($conn));
// }


// To close the connection
// mysqli_close($conn);

?>
