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

	$SERIAL = $_POST["serial"];
	$QUANTITY = $_POST["quantity"];
	
	
	$branchquery = "call max_branch('$SERIAL');";
    $response = @mysqli_query($dbc, $branchquery);
    if($response){
        while($row = mysqli_fetch_array($response)){
            $BRANCH = $row["b_id"];
        }
        // mysqli_free_result($result);
    }
    //echo $BRANCH;
    mysqli_close($dbc);
    
	
    $buyQuery = "Insert into Purchase(username,b_id,serial_num,quantity,purchase_date)
    values ('".$_SESSION["username"]."','$BRANCH','$SERIAL','$QUANTITY','2015-04-14');";
    $updateQuery = "call Update_warehouse('$SERIAL','$BRANCH','$QUANTITY');";
    
    mysqli_free_result();
    
    // $buyQuery = "Insert into Purchase(username,b_id,serial_num,quantity,purchase_date)
    // values ('".$_SESSION["username"]."','6987873','$SERIAL','$QUANTITY','2015-04-14');";
    // $updateQuery = "call update_warehouse('$SERIAL','6987873','$QUANTITY');";
    // echo $buyQuery;
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT)
	OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());

    $responseX=mysqli_query($dbc, $buyQuery) ;//OR  die('Buy fail:'.mysqli_error($dbc));
    //   var_dump($dbc);

    mysqli_close($dbc);
 
    
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT)
	OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());
 
    mysqli_query($dbc, $updateQuery) OR  die("Upsate fail:".mysqli_error($dbc));
    //     echo mysql_errno();
    // echo mysql_error();
    
    
    mysqli_close($dbc);
    
    
   
	
?>