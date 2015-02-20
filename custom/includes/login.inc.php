<?php
require_once('config.inc.php');
require_once('functions.inc.php');

session_start();

if($_SESSION['logged_in'] == true){
	redirect('../index.html');
}else{
	if ( (!isset($_POST['username'])) || (!isset($_POST['password'])) OR (!ctype_alnum($_POST['username'])) ) { 
	 	redirect('../login.html'); 
	 }

	
	 // Connect to database 

 	$mysqli = @new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

 	if(mysqli_connect_errno()){
 		printf("Unable to connect to database : %s",mysqli_connect_errno);
 		exit();
 	}
	 	// Escape any unsafe characters before querying database 

	 $username = $mysqli->real_escape_string($_POST['username']); 

	 $password = $mysqli->real_escape_string($_POST['password']); 

	 // Construct SQL statement for query & execute 

	 $sql = "SELECT * FROM users WHERE username = '" . $username . "' AND 

	password = '" . md5($password) . "'"; 

	 $result = $mysqli->query($sql); 

	 // If one row is returned, username and password are valid 

	 if (is_object($result) && $result->num_rows == 1) { 

	 // Set session variable for login status to true 

	 $row = mysqli_fetch_array($result);

 	 $_SESSION['uid'] = $row['id'];
	 $_SESSION['logged_in'] = true; 


	 redirect('../index.html'); 

	 } else { 

	 // If number of rows returned is not one, redirect back to login screen 

	 redirect('../login.html'); 

		}
}
?>