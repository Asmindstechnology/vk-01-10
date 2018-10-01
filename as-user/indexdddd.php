<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
		body {font-family: Arial, Helvetica, sans-serif;}
		
		
		input[type=text], input[type=password] {
			width: 25%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}
		
		input[type=submit] , button {
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 12%;
		}
		
		.cancelbtn {
			width: auto;
			padding: 10px 18px;
			background-color: #f44336;
		}
		
		span.psw {
			float: right;
			padding-top: 16px;
		}
		
		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
			span.psw {
			display: block;
			float: none;
			}
			.cancelbtn {
			width: 100%;
			}
		}
		</style>
	</head>
	<body>
		<form method = "post">
			<input type = "text" name = "username" placeholder = "username" >
				<br><br>
			<input type = "password" name = "password" placeholder = "password">
			<br><br>
			<input type = "submit"  value = "login">
			<button><a href = "as-usersignup.php">Singn-up</button>
		</form>
	</body>
</html>
<!DOCTYPE html>
