<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="book.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
		$id = intval($_GET['id']);
		$query="SELECT * FROM book WHERE book_id=$id";
		$result=mysqli_query($conn,$query);
		while ($row=mysqli_fetch_assoc($result)) {
			echo "<span class='txt1'>Existing Details</span><br>";
			echo "<span class='txt1'>Quantity: ".$row['quantity']."</span><br>";
			echo "<span class='txt1'>Price: ".$row['price']."</span><br>";
			echo "<span class='txt1'>Discount: ".$row['discount']."</span><br>";
		}
		mysqli_close($conn);
	?>
</body>
</html>