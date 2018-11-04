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
      <script>
        function validate()
        {
          //$password=document.getElementById('customer_username').value;  
        }
      </script>
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
          NAME
        </span>
        <div class="inputBox">
          <input class="input" type="text" name="customer_username" placeholder="Enter Name" required >
        </div>

        <span class="txt1">
          DATE OF BIRTH
        </span>
        <div class="inputBox">
          <input class="input" type="date" name="customer_dob" >
        </div>

        <span class="txt1">
          EMAIL ID
        </span>
        <div class="inputBox">
          <input class="input" type="email" name="customer_email" placeholder="Enter Email Here" required>
        </div>

        <span class="txt1">
          PASSWORD
        </span>
        <div class="inputBox">
          <input class="input" type="password" name="customer_password" placeholder="Enter Password Here" required>
        </div>

        <span class="txt1">
          REENTER PASSWORD
        </span>
        <div class="inputBox">
          <input class="input" type="password" name="customer_repassword" placeholder="Re-enter Password Here" required>
        </div>

        <span class="txt1">
          ADDRESS
        </span>
        <div class="inputBox">
          <input class="input" type="text" name="customer_add" placeholder="Enter Address Here" required>
        </div>

        <span class="txt1">
          PIN CODE
        </span>
        <div class="inputBox">
          <input class="input" type="text" name="customer_pincode" placeholder="Enter Pincode Here" required>
        </div>

        <span class="txt1">
          STATE
        </span>
        <div class="inputBox">
          <input class="input" type="text" name="customer_state" placeholder="Enter State Here" required>
        </div>

        <span class="txt1">
          CONTACT
        </span>
        <div class="inputBox">
          <input class="input" type="text" name="customer_phoneno" placeholder="Enter Phone number Here" required>
        </div>

        <span class="txt1">
          GENDER
        </span>
        <div class="inputBox">
          <input name="customer_gender" type="radio" value="M">MALE<br>
          <input name="customer_gender" type="radio" value="F">FEMALE<br>
          <input name="customer_gender" type="radio" value="O">OTHERS<br>
        </div>



        <div class="submitButton">
          <input class="submit" type="submit" name="submit" value="Submit" onclick="validate()">
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
  $customer_repassword = test_input($_POST["customer_repassword"]);
	$customer_add = test_input($_POST["customer_add"]);
  $customer_pincode = test_input($_POST["customer_pincode"]);
  $customer_state = test_input($_POST["customer_state"]);
  $customer_phoneno = test_input($_POST["customer_phoneno"]);
  $customer_gender = $_POST["customer_gender"];
	$repeated="SELECT * FROM customer where emailid='$customer_email'";
	$variable = $conn->query($repeated);
	if($variable->num_rows==0)
	{
		$insert="INSERT INTO customer VALUES('$customer_email',
			'$customer_password',
			'$customer_phoneno',
			'$customer_username',
			'$customer_gender',
      '$customer_dob',
      '$customer_add',
      '$customer_pincode',
      '$customer_state')";
		if($conn->query($insert)===true)
		{
			echo "INSERTED IN DB";
      $_SESSION['loggedin']=true;
      $_SESSION['username']=$customer_username;
      header("Location:http://localhost/PHP/project/home.php");
		}
		else
		{
			echo "Error";
		}
	}
	else
	{
		echo "YOU HAVE ALREADY SIGNED UP PLEASE LOG IN"."<br>";
    header("Location:http://localhost/PHP/project/userlogin.php?user=$customer_username");
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