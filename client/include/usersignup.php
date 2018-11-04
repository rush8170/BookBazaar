<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="signup.css">
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <meta charset="UTF-8">
     <title>Registration Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
$conn = new mysqli("localhost","root","");
$conn->query("use admin");

?>
<div class="wrapper">
      <form class="loginForm"  method="post" >
        <span class="formTitle">Sign Up</span>

        <span class="txt1">
          Name
        </span>

        <div class="inputBox">
          <input class="input" type="text" name="customer_username" placeholder="Enter Name" required >
        </div>

        <span class="txt1">
          Date of birth
        </span>

        <div class="inputBox">
          <input class="input" type="date" name="customer_dob" >
        </div>

        <span class="txt1">
          Email ID
        </span>

        <div class="inputBox">
          <input class="input" type="email" name="customer_email" placeholder="Enter Email Here" required>
        </div>
        <span class="txt1">
          Password
        </span>

        <div class="inputBox">
          <input class="input" type="password" name="customer_password" placeholder="Enter Password Here" required>
        </div>
        <span class="txt1">
          Address
        </span>

        <div class="inputBox">
          <input class="input" type="text" name="customer_add" placeholder="Enter Address Here" required>
        </div>
        <div class="submitButton">
          <input class="submit" type="submit" name="submit" value="Submit">
        </div>

      </form>
    </div>
  </body>
</html>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$customer_username = test_input($_POST["customer_username"]); 
	$customer_dob = test_input($_POST["customer_dob"]);
	$customer_email = test_input($_POST["customer_email"]);
	$customer_password = test_input($_POST["customer_password"]);
	$customer_add = test_input($_POST["customer_add"]);
	$repeated="SELECT * FROM customer where emailid='$customer_email'";
	$variable = $conn->query($repeated);
	if($variable->num_rows==0)
	{
		$insert="INSERT INTO customer VALUES('$customer_username',
			'$customer_dob',
			'$customer_email',
			'$customer_password',
			'$customer_add')";
		if($conn->query($insert)===true)
		{
			echo "INSERTED IN DB";
      $_SESSION['loggedin']=true;
      $_SESSION['username']=$customer_username;
      $_SESSION['email']=$customer_email;
      header("Location:http://localhost/PHP/project/home.php/username=true");
		}
		else
		{
			echo "Error";
		}
	}
	else
	{
		echo "YOU HAVE ALREADY SIGNED UP PLEASE LOG IN"."<br>";
    header("Location:http://localhost/PHP/project/userlogin.php");
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
mysqli_close($conn);
?>