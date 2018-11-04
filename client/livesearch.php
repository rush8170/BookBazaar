<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>

<?php
//include("home.php");
$q = $_GET['q'];

$con = mysqli_connect('localhost','root','','admin');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//echo $q;
mysqli_select_db($con,"admin");
$sql="SELECT * FROM book WHERE name LIKE '%$q%'";
$result = mysqli_query($con,$sql);
$authsql="SELECT * FROM author WHERE name LIKE '%$q%'";
$resultauth = mysqli_query($con,$authsql);
$pubsql="SELECT * FROM publisher WHERE name LIKE '%$q%'";
$resultpub = mysqli_query($con,$pubsql);
if($result->num_rows>0){
    echo '<b>BOOKS</b>';
    echo '<hr>';
while($row = mysqli_fetch_array($result)) {
    echo '<a href="description.php?id='.$row['book_id'].'" > '.$row['name'].'</a> ';
    echo '<hr>';
}
echo '<hr>';
}
if($resultauth->num_rows>0){
    echo '<b>AUTHORS</b>';
    echo '<hr>';
while($row = mysqli_fetch_array($resultauth)) {
    echo '<a href="auth_description.php?authid='.$row['author_id'].'" > '.$row['name'].' </a>';
    echo '<hr>';
}
}
if($resultpub->num_rows>0){
    echo '<b>PUBLISHERS</b>';
    echo '<hr>';
while($row = mysqli_fetch_array($resultpub)) {
    echo '<a href="pub_description.php?pubid='.$row['publisher_id'].'" > '.$row['name'].' </a>';
    echo '<hr>';
}
}
mysqli_close($con);
?>
</body>
</html>