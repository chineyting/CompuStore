<?php 
	DEFINE ('DB_USER', 'chineyting');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_HOST', 'chineyting-compustore-1428384');
	DEFINE ('DB_NAME', 'shoptest');
	DEFINE ('DB_PORT', '3306');

	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT)
	OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());

	$USERNAME = $_POST["username"];
	$FIRSTNAME = $_POST["firstName"];
	$LASTNAME = $_POST["lastName"];
	$EMAIL = $_POST["email"];
	$PHONENUM = $_POST["phone"];
	$PASSWORD = $_POST["password"];
	$CARDNUMBER = $_POST["cardnumber"];

	$usernameQuery = "SELECT * from Account where username = '$USERNAME';";
	$Insertquery = "INSERT INTO Customer VALUES (NULL, '$FIRSTNAME','$LASTNAME','$EMAIL', '$PHONENUM');";
	$response = @mysqli_query($dbc, $usernameQuery);
	if (mysqli_num_rows($response) >0) {
		echo "That username already exists. Please try again";
		echo '<a href="/signup.html"><button>Back to form </button></a>';
	}else{

		$response2 = @mysqli_query($dbc, $Insertquery);
		if ($response2) {
			$last_id = mysqli_insert_id($dbc);
			$accoutQuery = "INSERT INTO Account VALUES ( '$USERNAME','$CARDNUMBER','$last_id','$PASSWORD');";
			$response3 = @mysqli_query($dbc, $accoutQuery);
			if ($response3) {
				echo "Account created";
				echo '<a href="/index.html"><button>Home</button></a>';
			}else{
				echo "Something went wrong";
			}
		}else{
			echo "Something went wrong!";
		}
	}
	
	
   mysqli_close($dbc);
	
 ?>