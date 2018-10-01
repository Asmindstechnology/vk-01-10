<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.col-lg-1{
			color : black;
			border: #ff7f00;
			background-color : #ff7f00;
			width:150px;
			height:100px;
			}
		body{
			padding-left: 30px;
			padding-top :30px
			}
		.col-sm-1{
			background-color: black;
			width: 32px;
			height: 100px;
		}
	</style>
	</head>
	<body>
	<?php
		include dirname(dirname(__FILE__)) . "\as-config.php";
		session_start();
		$_SESSION["username"] = "venkat@asminds.com";
		
		$user_package = "SELECT `available_package` FROM `as_user` WHERE `email` = '".$_SESSION["username"]."'";
		
		$result = $conn->query($user_package);
		
		while($row = $result->fetch_assoc()) {
			$available_package = explode (",",$row['available_package']);
			
		}
		foreach($available_package as $package){
			$package_names = trim($package);
			if(!empty($package_names)){
	?>
			<form class="container-fluid" action = "user_subpackage.php" method = "post">
				<div>
					<input class="col-lg-1"  type = "submit" name = "user_package" value = <?php echo $package_names; ?> >
					<div class="col-sm-1"></div>
				</div>
			</form>
	<?php
			}
		}
		if(isset($_SESSION['user_test'])){
			unset($_SESSION['user_test']);
		}
	?>
	</body>
</html>
