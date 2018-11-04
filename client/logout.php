<?php
session_start();
$_SESSION['loggedin']=null;
$_SESSION['username']=null;
$_SESSION['email']=null;
session_destroy();
session_write_close();
header('Location: /PHP/project/home.php');
die;
?>