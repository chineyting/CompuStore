<?php
    DEFINE ('DB_USER', 'chineyting');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_HOST', 'chineyting-compustore-1428384');
	DEFINE ('DB_NAME', 'shoptest');
	DEFINE ('DB_PORT', '3306');
	session_start();
	
	$quantity = $_POST["quantity"];
	$serial_num = $_POST["serial"];
	$branch_id = $_POST["branch_id"];
	$username = $_SESSION["username"];

	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT)
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

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT)
	OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());
	$branchQuery = "SELECT * from Branch where b_id = '$branch_id';";
	$response = mysqli_query($dbc, $branchQuery);
	if(!$response){echo "It failed";}
	while($row = mysqli_fetch_array($response)){
		$branch_name = $row["branch_name"];
		$branch_address = $row["branch_add"];
	}
	mysqli_close($dbc);
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT)
	OR die('Could not connect to MySQL: ' .
	mysqli_connect_error());
	
	$branchQuery = "SELECT * from Account where username ='$username';";
	$response = mysqli_query($dbc, $branchQuery);
	if(!$response){echo "It failed";}
	while($row = mysqli_fetch_array($response)){
		$cardnumber = $row["credit_cardnum"];
	}
	mysqli_close($dbc);



	
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
			<h1>Buying Confirmation </h1>
			<h2 class="page_title">Purchase Summary</h2>
			<p><strong>Product:</strong> <?php echo $name; ?> </p>
			<p><strong>Brand:</strong> <?php echo $brand; ?></p>
			<p><strong>Price:</strong> <?php echo $price; ?></p>
			<p><strong>From Branch:</strong> <?php echo $branch_name; ?> </p>
			<p><strong>Shipping From:</strong> <?php echo $branch_address; ?> </p>
			<p><strong>Quantity:</strong> <?php echo $quantity; ?> </p>
			<p><strong>Total:</strong> $<?php echo $quantity*$price;?> </p>
			
			<p><strong>Purchase with card number:</strong> <?php echo $cardnumber;?> </p>
			<form method="POST" action="buy.php">
				<input type="hidden" name="serial_num" value= <?php echo "'".$serial_num."'";?>>
				<input type="hidden" name="quantity" value=<?php echo "'".$quantity."'";?>>
				<input type="hidden" name="branch_id" value=<?php echo "'".$branch_id."'";?>>
				<input type="hidden" name="serial_num" value=<?php echo "'".$serial_num."'";?>>
				<button type="submit" class="btn btn-primary">BUY NOW</button>
			</form>
			<div>
		</div>
	
</div>



	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>