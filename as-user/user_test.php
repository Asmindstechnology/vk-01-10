<?php 	
	session_start(); 
	$exam_time = (int)$_SESSION['test_time'];
?>

<html>
	<head>
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
		window.onbeforeunload = function() {
			alert("Please dont refresh the page before you finish the exam");
			return "Please dont refresh the page before you finish the exam";
		}
	</script>
	<style>
		.time-attr{
			background-color: black;
			color: #ff7f00;
			width: 300px;
			height: 54px;
			padding-top: 2px;
			padding-left: 58px;
			padding-bottom: 20px;
			font-size: 59px;
		}

		.col-sm-8{
		    background-color: #ff7f00;
			height: 40px;
			padding-top: 16px;
			padding-left: 26px;
		}
		.col-sm-1{
			background-color: #ff7f00;
			border: #ff7f00;
			color: black;
			height: 57px;
			width: 221px;
			font-size: 31px;
		}
		.col-sm-8 , .col-sm-1 , .time-attr {
			 border-radius: 25px;
		}
	</style>
	<script>
		var upgradeTime = 60*<?php echo $exam_time;?>;
		var seconds = upgradeTime;
		function timer() {
			var days        = Math.floor(seconds/24/60/60);
			var hoursLeft   = Math.floor((seconds) - (days*86400));
			var hours       = Math.floor(hoursLeft/3600);
			var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
			var minutes     = Math.floor(minutesLeft/60);
			var remainingSeconds = seconds % 60;
			if (remainingSeconds < 10) {
				remainingSeconds = "0" + remainingSeconds; 
			}
			document.getElementById('exam_time').innerHTML = "   "+hours + ":" + minutes + ":" + remainingSeconds;
			if (seconds == 0) {
				clearInterval(countdownTimer);
				document.getElementById('exam_time').innerHTML = "Completed";
				document.getElementById("exam_form").submit();
			} else {
				seconds--;
			}
		}
		var countdownTimer = setInterval('timer()', 1000);
	</script>
	</head>
	<body>
		<span class = "col-sm-2"></span><div class = "time-attr">
			<i class="fa fa-clock-o"></i><span id="exam_time">
			</span>
		</div>

		<form action = "user_test_validation.php" method = "post" id = 'exam_form'>
<?php



	include dirname(dirname(__FILE__)) . "\as-config.php";


	if(isset($_POST['user_test'])){
		$_SESSION["user_test"] = $_POST['user_test'];
	}
	$test_question = "SELECT * FROM `as_question` WHERE `subpackage` = '".$_SESSION["user_test"]."'";
	$result = $conn->query($test_question);

	$i = 1;
	while($row = $result->fetch_assoc()){
		
		 $row['question'];
		 if($row['question_type'] === 'radio'){
?>
			<h3 class="col-sm-8"  ><?php echo $i." . ".$row['question']; ?></h3>
			<input type = "radio" name = <?php echo $row['id']; ?> value = <?php echo $row['id']."-1"; ?>><?php echo $row['option1']; ?><br><br>
			<input type = "radio" name = <?php echo $row['id']; ?> value = <?php echo $row['id']."-2"; ?>><?php echo $row['option2']; ?><br><br>
			<input type = "radio" name = <?php echo $row['id']; ?> value = <?php echo $row['id']."-3"; ?>><?php echo $row['option3']; ?><br><br>
			<input type = "radio" name = <?php echo $row['id']; ?> value = <?php echo $row['id']."-4"; ?>><?php echo $row['option4']; ?><br><br>
<?php
		
		
		 }else if($row['question_type'] === 'checkbox'){
?>
			<h3 class="col-sm-8" ><?php echo $i." . ".$row['question']; ?></h3>
			<input type = "checkbox" name = <?php echo $row['id']."-1[]"; ?> value =<?php echo $row['id']."-1"; ?>><?php echo $row['option1']; ?><br><br>
			<input type = "checkbox" name = <?php echo $row['id']."-1[]"; ?> value =<?php echo $row['id']."-2"; ?>><?php echo $row['option2']; ?><br><br>
			<input type = "checkbox" name = <?php echo $row['id']."-1[]"; ?> value =<?php echo $row['id']."-3"; ?>><?php echo $row['option3']; ?><br><br>
			<input type = "checkbox" name = <?php echo $row['id']."-1[]"; ?> value =<?php echo $row['id']."-4"; ?>><?php echo $row['option4']; ?><br><br>
<?php
		 }else if($row['question_type'] === 'true'){
?>
			<h3 class="col-sm-8" ><?php echo $i." . ".$row['question']; ?></h3>
			<input type = "radio" name = <?php echo $row['id']; ?> value =<?php echo $row['id']."-T"; ?>><?php echo $row['option1']; ?><br><br>
			<input type = "radio" name = <?php echo $row['id']; ?> value =<?php echo $row['id']."-F"; ?>><?php echo $row['option2']; ?><br><br>
<?php
	}$i++;
	}
	
	
?>
			<input class = "col-sm-1" type = "submit" name = "user_exam_complete" value = "Finish" >
		</form>
	</body>
</html>
