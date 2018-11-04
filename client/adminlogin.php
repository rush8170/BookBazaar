<!DOCTYPE html>
<html>
<head></head>
<body>
<form action="" method="post">
	<label>Username:</label><input type="text" id="admin_username" name="admin_username">
	<label>Password:</label><input type="password" id="admin_password" name="admin_password">
	<button type="submit" action="submit" >SUBMIT</button>
</form>
<?php
// define variables and set to empty values
$conn = new mysqli("localhost","root","");
$conn->query("use admin");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = isset($_POST["admin_username"])?test_input($_POST["admin_username"]):'';
  $password = isset($_POST["admin_password"])?test_input($_POST["admin_password"]):'';
  $check="SELECT * FROM admin_table where ('$username','$password') in (SELECT * from admin_table)";
  if($conn->query($check)->num_rows>0)
  {
	//echo "Valid user";
	header("Location:http://localhost/PHP/project/adminhomepage.php");
  }
  else
  {
	echo "Invalid user";
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</body>
</html>