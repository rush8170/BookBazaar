<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<title>WELCOME</title>
</head>
<body>
	<?php
		session_start();
	?>
	<div class="wrapper">
		<form class="homeform" method="post">
			<div class="heading"><p class="salutation">Welcome,<?php echo $_SESSION['username'] ?></p></div>
			<div class="buttonbox"><button class="button" type="submit" name="author_home">Add or delete Author</button></div>
			<div class="buttonbox"><button class="button" type="submit" name="publisher_home">Add or delete Publisher</button></div>
			<div class="buttonbox"><button class="button" type="submit" name="book_home">Add or update or delete Book</button></div>
			<div class="buttonbox"><button class="button" type="submit" name="logout_home">Logout</button></div>
		</form>
	</div>
	<?php
		if(isset($_POST['author_home'])) {
			$var=$_SESSION['username'];
			header("Location: author.php?user=$var");
		}
		else if(isset($_POST['publisher_home'])) {
			$var=$_SESSION['username'];
			header("Location: publisher.php?user=$var");
		}
		else if(isset($_POST['book_home'])) {
			$var=$_SESSION['username'];
			header("Location: book.php?user=$var");
		}
		else if(isset($_POST['logout_home'])) {
			$_SESSION['username']=null;
			session_destroy();
			header("Location: login.php");
			echo '<script type="text/javascript">alert("Logout Successfully !!")</script>';
		}
	?>
</body>
</html>