<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

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
