<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<?php
$conn = new mysqli("localhost","root","");
$conn->query("use admin");
?>
<?php
session_start();
echo $_GET['que'];
if($_GET['que']==1)
{
  echo "Please login to access cart!";
  header('Location:/');
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $customer_email = isset($_POST["customer_email"])?test_input($_POST["customer_email"]):'';
  $customer_password = isset($_POST["customer_password"])?test_input($_POST["customer_password"]):'';
  $repeated="SELECT * FROM customer where emailid='$customer_email' AND password='$customer_password'";
  //$email_check="SELECT * FROM customer where 'customer_email' in (SELECT emailid from customer)";
  $variable = $conn->query($repeated);
  //$variable_email_check=$conn->query($email_check);
  //$customer_usernamedash=$conn->query("SELECT name FROM customer where emailid='$customer_email'");
  if($variable->num_rows>0)
  {
    while($row=$variable->fetch_assoc())
    {
      echo "LOGGED IN";
      $_SESSION['loggedin']=true;
      $_SESSION['username']=$row['name'];
      $_SESSION['email']=$customer_email;
      if($_GET['que']==1)
      {
        //header("location:javascript://history.go(-1)");
      }
      //echo $_SESSION['username'];
      //header("Location:http://localhost/PHP/project/home.php?username=welcome");
    }
    //header("Location:http://localhost/PHP/project/home.php/username=null");
  }
  else
  {
      echo "Invalid username/password";
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
    
    <div class="wrapper">
      <form class="loginForm"  method="post" >
        <span class="formTitle">Sign In</span>
        <span class="txt1">
          Email
        </span>

        <div class="inputBox">
          <input class="input" type="email" name="customer_email" placeholder="Enter Email" required >
        </div>

        <span class="txt1">
          Password
        </span>

        <div class="inputBox">
          <input class="input" type="password" name="customer_password" placeholder="Enter Password Here" required>
        </div>

        <div class="submitButton">
          <input class="submit" type="submit" name="submit" value="Submit">
        </div>

        <div class="smallLabel">
            <small>Haven't Registered Yet ? <a href="usersignup.php">Sign Up Now</a></small>
        </div>
      </form>
