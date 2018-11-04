<?php
    require_once('include/header.php');
    require_once('include/function.php');
    checklogin();
    checklogout();
?>
<h1 align="centre"><?php echo $_GET['value']?></h1>
<?php
	$category=$_GET['value'];
	fetchbookswithcondition("category",$category);
  require_once('include/footer.php');
?>

	</BODY>
</HTML>