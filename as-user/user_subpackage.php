<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			.col-lg-1{
				text-align : left;
				color : black;
				background-color : #ff7f00;
				border : #ff7f00 ;
				width: 300px;
				height:70px;
			}
			.subpackage-outter {
				padding-top: 31px;
				padding-right: 0px;
				padding-bottom: 50px;
				padding-left: 30px;
			}
			.col-sm-1{
				background-color : black;
				height:70px;
				width:20px;
			}
			
		</style>

	</head>
	<body>
	<?php
		include dirname(dirname(__FILE__)) . "\as-config.php";
		session_start();
		if(isset($_POST['user_package'])){
			$_SESSION["user_package"] = $_POST['user_package'];
		}
		$user_subpackage = "SELECT `subpackage` FROM `as_subpackage` WHERE `package` = '".$_SESSION["user_package"]."'";
		$result = $conn->query($user_subpackage);
		while($row = $result->fetch_assoc()){
	?>
		<form action = "exam_instruction.php" method = "post">
			<div class = "subpackage-outter">
				<input type = "submit" class="col-lg-1" name = "user_test"  value = <?php echo $row['subpackage']; ?>>
				<i class="col-sm-1"></i>
			</div>
		</form>
	<?php
		}
		if(isset($_SESSION['test_time'])){ 
		unset($_SESSION['test_time'] );
		unset($_SESSION['test_mark'] );
		unset($_SESSION['total_question']);
		unset($_SESSION['total_mark']);
	}
	?>
	</body>
</html>
