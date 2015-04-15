<?php 
	DEFINE ('DB_USER', 'chineyting');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_HOST', 'chineyting-compustore-1428384');
	DEFINE ('DB_PORT', '3306');
    session_start();
	

	$serial_num=$_POST["serial_num"];
	$quantity=$_POST["quantity"];
	$branch_id=$_POST["branch_id"];
	$cardnumber=$_POST["cardnumber"];
	$username = $_SESSION["username"];
	$branchdb = "store".$branch_id;
	

	$transaction = FALSE;

	// Card check
// 	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, bank, DB_PORT)
//     OR die('Could not connect to MySQL: ' .
// 	mysqli_connect_error());
// 	$itemQuery = "SELECT card_nums from Bank where card_nums = '$cardnumber';";
// 	$response = mysqli_query($dbc, $itemQuery);
	
// 	if (mysqli_num_rows($response) == 0) {
// 		echo "Card does not exist";
// 	}else{}
// 	mysqli_close($dbc);


	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, shoptest, DB_PORT)
    OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());
	
	$buyQuery = "call make_purchase('$username',$branch_id,'$serial_num',$quantity);";
	$response = mysqli_query($dbc, $buyQuery);
	if (!$response) {
		die("Buy didnt work: ".mysql_error());
	}
	mysqli_close($dbc);


	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, $branchdb, DB_PORT)
    OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());
	$updateQuery = "call update_warehouse('$serial_num',$quantity);";

	$response = mysqli_query($dbc, $updateQuery);
	
	
	if (!$response) {
		die("Update didnt work: ".mysql_errno());
	}
	mysqli_close($dbc);


	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, shoptest, DB_PORT)
    OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());
	$itemQuery = "SELECT * from Product where serial_num = '$serial_num';";
	$response = mysqli_query($dbc, $itemQuery);
	
	while($row = mysqli_fetch_array($response)){
		$name = $row["product_name"];
		$brand = $row["product_brand"];
		$price = $row["product_price"];
	}
	mysqli_close($dbc);

	$transaction = TRUE;



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Products</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    <link href="css/index.css" rel="stylesheet">
 </head>
 <body>
     <nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="index.php"><img src="img/logo.png"</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Products <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		          	<li class="dropdown-submenu">
		          	    <a tabindex="-1" href="#">By Brand</a>
		          	    <ul class="dropdown-menu">
		          	        <li class="dropdown-submenu"></li>
		          	        <li><a href="#">Bell</a></li>
		          	        <li><a href="#">BookChrome</a></li>
		          	        <li><a href="#">Carebook</a></li>
		          	        <li><a href="#">Orange</a></li>
		          	        <li><a href="#">PH</a></li>
		          	        <li><a href="#">Yons</a></li>
		          	    </ul>
		          	</li>
		          </ul>
		        </li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		          	<li><a href="branch_sales.php">Branch Sales</a></li>
		          	<li><a href="customer_spending.php">Customer Spending</a></li>
		          	<li><a href="top_model.php">Top Models</a></li>
		          </ul>
		        </li>
		      </ul>
		      <form class="navbar-form navbar-left" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">Search</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#" id="cart"><img src="img/cart.png"></a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
		          <?php
		          if (empty($_SESSION["username"])) {
							echo '<form action="signin.html"><input type="submit" value="Sign In" class="btn btn-default" id="sign_in"></form>';		
							}else{
								echo $_SESSION["username"];
							}
		          ?></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="#">My Account</a></li>
		            <li class="divider"></li>
		            <li><a href="/signout.php">Sign Out</a></li>
		          </ul>
		        </li>
		        <li><a href="signup.html">Sign Up</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
     
<div class="container">     
<div <?php if(!$transaction){echo 'style="display:none;"';}?>>
	<h2 class="page_title">You just bought:</h2> <h1><?php echo $name;?></h1>
	<h2>Quantity <?php echo "'".$quantity."'";?></h2>
	<p class="trackNum">Your tracking number is <?php echo "'".$name."'";?></p>
	<a href="/index.php"><button class="btn btn-primary">Back to home page </button></a>
</div>
<div <?php if($transaction){echo 'style="display:none;"';}?>>
	<h1>Purchase failed</h1>
	<a href="/index.php"><button class="btn btn-primary">Back to home page </button></a>
</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
 </body>
 </html>

 