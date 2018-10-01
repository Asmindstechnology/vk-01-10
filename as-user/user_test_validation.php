<?php
	session_start();
	include dirname(dirname(__FILE__)) . "\as-config.php";
	$mark = 0;
	$checkbox_validate = 0;
	$checkbox_mark = 0;
	foreach($_POST as $test_info){
		if($test_info != "Submit" && !is_array($test_info)){
				
			$package_answer = explode("-",$test_info);
		
			$validate_query = "SELECT `answer` FROM `as_question` WHERE `id` = '".$package_answer[0]."'";
			$result = $conn->query($validate_query);
			while($row = $result->fetch_assoc()){
				if( $package_answer[1] == $row['answer'] ){
					$mark++;
				}
			}
		}
	
		if(is_array($test_info)){
			$num_value = sizeof($test_info);

			$package_answer = explode("-",$test_info[0]);
			$validate_query = "SELECT `answer` FROM `as_question` WHERE `id` = '".$package_answer[0]."'";
			$result = $conn->query($validate_query);
			while($row = $result->fetch_assoc()){
				$value_num = sizeof(explode(",",$row['answer']));
			}

			if( $num_value == 1 && $value_num == $num_value ){

				$result = $conn->query($validate_query);
				while($row = $result->fetch_assoc()){

						$check_answer = explode(",",$row['answer']);

						if( $package_answer[1] == $check_answer[0] ){
							$mark++;
						}
					}
			}else if($num_value == 2 && $value_num == $num_value){

				$checkbox_2val = explode("-",$test_info[1]);

				$result = $conn->query($validate_query);
				while($row = $result->fetch_assoc()){

						$check_answer = explode(",",$row['answer']);

						if( $package_answer[1] == $check_answer[0] ){
							$checkbox_mark++;
						}
						if($checkbox_mark == 1 && $checkbox_2val[1] == $check_answer[1] ){
							$mark++;
						}

					}	$checkbox_mark = 0;

			}else if($num_value == 3  && $value_num == $num_value){

				$checkbox_2val = explode("-",$test_info[1]);
				$checkbox_3val = explode("-",$test_info[2]);

				$result = $conn->query($validate_query);
				while($row = $result->fetch_assoc()){

						$check_answer = explode(",",$row['answer']);

						if( $package_answer[1] == $check_answer[0] ){
							$checkbox_mark++;
						}
						if($checkbox_mark == 1 && $checkbox_2val[1] == $check_answer[1] ){
							$checkbox_mark++;
						}
						if($checkbox_mark == 2 && $checkbox_3val[1] == $check_answer[2] ){
							$mark++;
						}

					}	$checkbox_mark =0;

			}else if($num_value == 4 && $value_num == $num_value){
				$mark++;

			}

		}
	}
	date_default_timezone_set('Asia/Kolkata'); 
	$user_test_mark = (int)$_SESSION['test_mark']*$mark; 
	
	$get_name = "SELECT `username` FROM `as_user` WHERE `email` = '".$_SESSION['username']."'";
	$result = $conn->query($get_name);
		while($row = $result->fetch_assoc()){
			$username = $row['username'];
			}
	
	$insert_marks ="INSERT INTO `as_benchmark`.`as_user_test` ( `email`, `mark_out_of`, `package`, `sub_package`, `time`) VALUES ( '".$_SESSION['username']."', '".$user_test_mark."/".$_SESSION['total_mark']."', '".$_SESSION['user_package']."', '".$_SESSION['user_test']."', '".date("Y-m-d h:i:sa")."');";
	if ($conn->query($insert_marks) === FALSE) {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
 ?>
 <html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			.btn-warning {
				background-color: #ff7f00;
				border : #ff7f00;
				color : black ; 
				height: 50px;
				width: 170px;
			}
			a{
				color: black;
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
			.table-align{
				padding-left: 161px;
				padding-top: 49px;
			}
			.button-attr{
				padding-left: 73px;
			}
		</style>
	</head>
	<body>
		 <div class = "table-align">
			<table >
				<tr>
					<td><h4>User Name</h4></td>
					<td><h5><?php echo $username;?></h5></td>
				</tr>
				<tr>
					<td><h4>Email Id</h4></td>
					<td><h5><?php echo$_SESSION['username'];?></h5></td>
				</tr>
				<tr>
					<td><h4>Course Name</h4></td>
					<td><h5><?php echo $_SESSION['user_package'];?></h5></td>
				</tr>
				<tr>
					<td><h4>Test Name</h4></td>
					<td><h5><?php echo $_SESSION['user_test'];?></h5></td>
				</tr>
				<tr>
					<td><h4>Marks Obtained</h4></td>
					<td><h5><?php echo $user_test_mark." Out Of ".$_SESSION['total_mark'];?></h5></td>
				</tr>
			</table>
			<div class = "button-attr">
				<button class = " btn-warning"><a href = "as-userdashboard.php">Home</a></button>
			</div>
		</div>
	</body>
 </html>























