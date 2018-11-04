<?php 
	session_start();
	$conn= new mysqli("localhost","root","");
    $conn->query("use admin");
    $userid=$_SESSION['email'];
    $bookid=$_GET['bookid'];
    echo $userid.$bookid;
    $res=$conn->query("DELETE FROM cart where book_id='$bookid' and customer_id='$userid'") or die($conn->error);
    mysqli_commit($conn);
    header("Location:http://localhost/PHP/project/cart.php");
    ?>