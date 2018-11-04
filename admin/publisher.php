<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="publisher.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<title>PUBLISHER</title>
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
		session_start();
	?>
	<script type="text/javascript">
		$(document).ready(function(){
	    	$("#1").click(function(){
	    		$(".add").show();
	       		$(".delete").hide();
	   		});
	    	$("#2").click(function(){
	    		$(".add").hide();
	        	$(".delete").show();
	    	});
		});
	</script>
	<div class="wrapper">
		<div class="heading"><p class="salutation">Manage Publisher Details</p></div>
		<div class="buttonbox" style="display: inline-block;"><button class="button" type="button" name="button" id="1">Add Publisher</button></div>
		<div class="buttonbox" style="display: inline-block;"><button class="button" type="button" name="button" id="2">Delete Publisher</button></div>
		<form class="add" method="post" id="ad" style="display: none;" enctype="multipart/form-data">
			<span class="formtitle">Add</span>
			<span class="txt1">Name</span>
			<div class="inputbox"><input class="input" type="text" name="name" placeholder="Enter name" required></div>
			<span class="txt1">Description</span>
			<div class="textbox"><textarea class="inputarea" name="description" form="ad" placeholder="Enter description" required></textarea></div>
			<span class="txt1">Image</span>
			<div class="inputbox"><input class="inputfile" type="file" name="image" id="image" placeholder="Browse" accept=".jpg" required></div>
			<div class="submitbutton"><input class="submit" type="submit" name="add_submit_publisher" value="Submit"></div>
		</form>
		<form class="delete" method="post" style="display: none;">
			<span class="formtitle">Delete</span>
			<span class="txt1">ID</span>
			<div class="inputbox"><input class="input" type="number" name="id" placeholder="Enter id" required></div>
			<div class="submitbutton"><input class="submit" type="submit" name="delete_submit_publisher" value="Submit"></div>
		</form>
		<form class="home" method="post">
			<div class="submitbutton"><input class="submit" type="submit" name="home_publisher" value="Home"></div>
		</form>
		<form class="logout" method="post">
			<div class="submitbutton"><input class="submit" type="submit" name="logout_publisher" value="Logout"></div>
		</form>
	</div>
	<?php
		if(isset($_POST['add_submit_publisher'])) {
			$var=$_SESSION['username'];
			$publisher_name=mysqli_real_escape_string($conn,$_POST["name"]);
			$publisher_description=mysqli_real_escape_string($conn,$_POST["description"]);
			$publisher_image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$query="INSERT INTO publisher(name,description,logo) VALUES('$publisher_name','$publisher_description','$publisher_image')";
			$result=mysqli_query($conn,$query);
			if($result) {
				echo '<script type="text/javascript">alert("Publisher Details Added Successfully !!")</script>';
			}
			else {
				die("Couldn't Insert:".mysql_error());
			}
			mysqli_commit($conn);
		}
		else if(isset($_POST['delete_submit_publisher'])) {
			$var=$_SESSION['username'];
			$publisher_id=mysqli_real_escape_string($conn,$_POST["id"]);
			$query="DELETE FROM publisher WHERE publisher_id=$publisher_id";
			$result=mysqli_query($conn,$query);
			if($result) {
				echo '<script type="text/javascript">alert("Publisher Details Deleted Successfully !!")</script>';
			}
			else {
				die("Couldn't Delete:".mysql_error());
			}
			mysqli_commit($conn);
		}
		else if(isset($_POST['home_publisher'])) {
			$var=$_SESSION['username'];
			header("Location: home.php?user=$var");
		}
		else if(isset($_POST['logout_publisher'])) {
			$_SESSION['username']=null;
			session_destroy();
			header("Location: login.php");
		}
	?>
</body>
</html>