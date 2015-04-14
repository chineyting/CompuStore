<?php 
	DEFINE ('DB_USER', 'chineyting');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_HOST', 'chineyting-compustore-1428384');
	DEFINE ('DB_NAME', 'shoptest');
	DEFINE ('DB_PORT', '3306');
	session_start();

	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT)
	OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());

	$USERNAME = $_POST["username"];
	$PASSWORD = $_POST["password"];
	
	$passwordQuery = "Select * From Account where username = '$USERNAME' AND password = '$PASSWORD'";
	$response = @mysqli_query($dbc, $passwordQuery);
	
	if (mysqli_num_rows($response) >0) {
		// echo "Log In Succesful";
		$_SESSION["username"] = $USERNAME;
		header('Location: ../index.php');
	}else{
	    
	    header('Location: ../failurelogin.php');
	}
	
	mysqli_close($dbc);
 ?>