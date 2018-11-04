<?php
$var= $_GET['email'];
$date= date('2018/10/23');
$conn= new mysqli("localhost","root","");
$conn->query("use admin");
$res=$conn->query("Select * from cart where customer_id='$var'");
while($row=$res->fetch_assoc())
{
	$quantity=$row['quantity'];
	$id=$row['book_id'];
	$conn->query("Update book set quantity=quantity-'$quantity' where book_id='$id'");
	mysqli_commit();
	$total=$total+$quantity;
}
$conn->query("INSERT into orders(order_date,ship_date,total,customer_id
) VALUES('$date','$date','$total','$var')");
mysqli_commit();
$conn->query("Delete from cart where customer_id='$var'");
mysqli_commit();
header('Location:/PHP/project/home.php');
?>