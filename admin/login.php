<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="login.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<title>LOGIN</title>
</head>
<body>
	<?php
		$dbServername="localhost";
		$dbUsername="root";
		$dbPassword="";
		$dbName="admin";
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		if(!$conn){
			die("couldn't connect:".mysql_error());
		}
	?>
	<div class="wrapper">
		<form class="loginform" method="post">
			<span class="formtitle">Login</span>
			<span class="txt1">ID</span>
			<div class="inputbox"><input class="input" type="number" name="id" placeholder="Enter id" required></div>
			<span class="txt1">Password</span>
			<div class="inputbox"><input class="input" type="password" name="pass" placeholder="Enter password" required></div>
			<div class="submitbutton"><input class="submit" type="submit" name="login_submit" value="Submit"></div>
		</form>
	</div>
	<?php
		session_start();
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$admin_id=mysqli_real_escape_string($conn,$_POST["id"]);
			$admin_pass=mysqli_real_escape_string($conn,$_POST["pass"]);
			$query="SELECT * FROM admin_table WHERE id=$admin_id AND password='$admin_pass'";
			$result=mysqli_query($conn,$query);
			$rows=mysqli_num_rows($result);
			if($rows>0) {
				if($rows==1) {
					if($row=mysqli_fetch_assoc($result)) {
				    	$_SESSION['username']=$row['name'];
				    	$var=$row['name'];
				    	header("Location: home.php?user=$var");
				    }
				    else {
				    	header("Location: login.php?login=unsuccessful&error=sql");
				    }
				}
				else {
					header("Location: login.php?login=unsuccessful&user_found=multi");
				}
			}
			else {
				header("Location: login.php?login=unsuccessful&user_found=false");
			}
		}
		mysqli_close($conn);
	?>
</body>
</html>