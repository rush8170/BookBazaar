<?php require_once('include/header.php');?>
<script>
  function method()
  {
    alert('Order placed!');
  }
</script>
<h2 style="padding: 20px">My Cart</h2>
      <ul class="list-group mb-3">
            
  <?php
    $conn= new mysqli("localhost","root","");
    $conn->query("use admin");
    $var=0;
    if(isset($_GET['id']) && isset($_GET['quantity'])) {
      $userid=$_SESSION['email'];
      $bookid=$_GET['id'];
      $quantity=$_GET['quantity'];
      //echo $userid.$bookid.$quantity;
      $conn->query("INSERT INTO cart(customer_id,book_id,quantity) VALUES ('$userid','$bookid','$quantity')");
      mysqli_commit($conn);
      $fetch="Select * from cart where customer_id='$userid'";

      $res=$conn->query($fetch) or die($conn->error);
      while($row=$res->fetch_assoc())
      {
        echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
              <table style="width: 100%">';
        //$row=$res->fetch_assoc();
        $bookid=$row['book_id'];
        $subfetch=$conn->query("Select * from book where book_id='$bookid' ");
        $subrow=$subfetch->fetch_assoc();
        $disp1=substr($subrow['name'],0,15).'...';
        $disp=substr($subrow['description'],0,50).'...';
        echo'<tr>
      <td><img src="data:image/jpeg;base64,'.base64_encode($subrow['image']).'" style="height: 75px;width: 75px;"class="rounded"></td>
      <td><div>
                  <h4 class="my-0">'.$disp1.'</h4>
                  <small class="text-muted">'.$disp.'</small>
                </div></td>
              <td style="padding-right: 10px;">Qty:'.$row['quantity'].'</td>
              <td style="padding-right: 10px;">'.(int)($subrow['price']-$subrow['discount']*$subrow['price']/100)*$row['quantity'].'</td>
              <td><a class="btn btn-dark" href="new.php?user='.$userid.'&amp;bookid='.$bookid.'"><i class="fas fa-times-circle"></i></a></td>
    </tr>';
    $var=$var+(int)($subrow['price']-$subrow['discount']*$subrow['price']/100)*$row['quantity'];
    echo '</table>
              </li>';
      }
  }
else {
  $userid=$_SESSION['email'];
 $fetch="Select * from cart where customer_id='$userid'";

    $res=$conn->query($fetch) or die($conn->error);
    while($row=$res->fetch_assoc())
    {
      echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
            <table style="width: 100%">';
      //$row=$res->fetch_assoc();
      $bookid=$row['book_id'];
      $subfetch=$conn->query("Select * from book where book_id='$bookid' ");
      $subrow=$subfetch->fetch_assoc();
      $disp=substr($subrow['description'],0,50).'...';
      $disp1=substr($subrow['name'],0,15).'...';
      //echo $disp1;
      echo'<tr>
    <td><img src="data:image/jpeg;base64,'.base64_encode($subrow['image']).'" style="height: 75px;width: 75px;"class="rounded"></td>
    <td><div>
                <h4 class="my-0">'.$disp1.'</h4>
                <small class="text-muted">'.$disp.'</small>
              </div></td>
            <td style="padding-right: 10px;">Qty:'.$row['quantity'].'</td>
            <td style="padding-right: 10px;">'.(int)($subrow['price']-$subrow['discount']*$subrow['price']/100)*$row['quantity'].'</td>
            <td><a class="btn btn-dark" href="new.php?user='.$userid.'&amp;bookid='.$bookid.'"><i class="fas fa-times-circle"></i></a></td>
  </tr>';
  $var=$var+(int)($subrow['price']-$subrow['discount']*$subrow['price']/100)*$row['quantity'];
  echo '</table>
            </li>';
    } 
}
  ?>
            <li class="list-group-item d-flex justify-content-between">
              <span style="margin-left: 110px;"><b>Total (₹)</b></span>
              <?php echo '<strong style="margin-right: 266px;">'.$var.'</strong>'?>
            </li>
          </ul>
          <?php
echo '<a padding-bottom="20px" class="btn btn-dark" style="margin-left: 600px;" href="temp.php?email='.$_SESSION['email'].'" onclick="method()">CHECKOUT</a>' ?>
<?php require_once('include/footer.php');?>
</BODY>