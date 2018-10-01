
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.col-lg-2 {
			background-color: #ff7f00;
			border : #ff7f00;
			color : black ; 
			height: 50px;
		}
		h4 {
			background-color: #ff7f00;
			height: 50px;
			padding-left: 30px;
			padding-top: 15px;
			padding-right: 35px;
		}
		h5 {
			background-color: black;
			color : #ff7f00;
			height: 50px;
			padding-left: 30px;
			padding-top: 15px;
			padding-right: 35px;
		}
	</style>
	</head>
	<body>
		<form action = 'user_test.php' method = 'post'>
<?php
		session_start();
		include dirname(dirname(__FILE__)) . "\as-config.php";

		if(isset($_POST['user_test'])){
			$_SESSION['user_test'] = $_POST['user_test'];
		}
		$user_package = "SELECT * FROM `as_test` WHERE `test_name` = '".$_SESSION['user_test']."'";
		
		$result = $conn->query($user_package);
		
		while($row = $result->fetch_assoc()) {
			$_SESSION['test_time'] = (int)$row['test_time'];
			$_SESSION['test_mark'] = $row['test_mark'];
			$_SESSION['total_question'] = $row['total_question'];
			$_SESSION['total_mark'] = $row['total_mark'];
		}
?>
		<div class = "col-sm-1"></div><table >
			<tr>
				<td><h4>Total Question</h4></td>
				<td><h5><?php echo $_SESSION['total_question']." Question"; ?></h5></td>
			</tr>
			<tr>
				<td><h4>Time</h4></td>
				<td><h5><?php echo $_SESSION['test_time']." Minutes"; ?></h5></td>
			</tr>
			<tr>
				<td><h4>Mark For Each Question</h4></td>
				<td align="center"><h5><?php echo $_SESSION['test_mark']." Marks"; ?></h5></td>
			</tr>
		</table>
			<input type = "hidden" name = "set_time" value = <?php echo $_SESSION['test_time'];?>>
			<div class = "col-sm-2"></div>
			<input type = "submit" class = "col-lg-2 btn-warning" name = "start_exam"  value = 'Start' ><div class = "submit-attr"></div>
			
		</form>
	</body>
</html>
