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
    <script src="js/custom.js"></script>
    
    <?php session_start(); ?>
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
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Find a Store <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		          	<li><a href="#">Liguanea</a></li>
		          	<li><a href="#">HWT</a></li>
		          	<li><a href="#">Manor Park</a></li>
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
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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

<div>
<div class="container">
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
	
	$SERIAL = $_GET["serial"];
	
	
	$itemQuery = "SELECT * from Product where serial_num = '$SERIAL';";

	$response = @mysqli_query($dbc, $itemQuery);
	
	
	while($row = mysqli_fetch_array($response)){
	
    	$picture = rand(1,10);
    	$rating = rand(6,11);
    	$PRICE = $row['product_price'];
    	echo '
    	<img src="/img/'.$picture.'.jpg" class="col-md-6" id="product_image">
    	<div class="col-md-5 col-md-offset-1 details">
    	<h2>'.$row['product_name'].' Laptop</h2>
    	<img src="/img/'.$rating.'.png">
    	<p id="price"><strong>Price:</strong> $'.$row['product_price'].'</p>
    	<p><strong>Brand:</strong> '.$row['product_brand'].'</p>
    	<p><strong>Serial Number:</strong> '.$row['serial_num'].'</p>
    	</div>';
	}
	
?>
</div>
<div class="col-md-5 col-md-offset-1">
    <h2>Available at branches:</h2>
    <?php
    
    $availableQuery  = "call branch_available('$SERIAL');" ;
    $availableResponse = @mysqli_query($dbc, $availableQuery );
    if (mysqli_num_rows($availableResponse) >0) {
        echo '<table class="table-condensed">
        <thead>
        <tr>
		<th>Branch</th>
		<th>Quantity</th>
	    </tr>
	    </thead>';
	    while($row = mysqli_fetch_array($availableResponse)){
	        echo "<tbody>
	        <tr>
    		<td>".$row['branch_name']."</td>
    		<td>".$row['quantity']."</td>
    	    </tr>
    	    </tbody>";
	    }
	    echo "</table>";
	}else{
	    
	    echo"<p>The item is not available at any locations</p>";
	}
    
    mysqli_close($dbc);
    ?>
    
</div>


<div>
<h1>Order</h1>
<form method = "POST" action = "buyitem.php" id="orderform" name="orderform">
	<select id="laptopNumber" name="quantity" onchange="calculateTotal()">
		<option selected="selected" value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
	</select>
	<input type="text" name="username" value= <?php echo '"'.$_SESSION["username"].'"'?>   >
	<input type="text" name="serial" value= <?php echo '"'.$SERIAL.'"'?>   >
	<p>Quantity</p>
	<p id="total_cost"></p>
	
	<button class="btn btn-primary" type="submit" name="submit">Confirm Order</button>
</form>
</div>
</div>
</body>
</html>
