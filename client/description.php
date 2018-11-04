<?php require_once('include/header.php');?>   
<?php
    require_once('include/function.php');
    checklogin();
    checklogout();
    $id=$_GET['id'];
    fetchbookdetails($id);
    require_once('include/footer.php');
?>
    

  </BODY>
</html>