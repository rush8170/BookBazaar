<!DOCTYPE HTML>
    <?php require_once('include/header.php');
    ?>
           
<?php
    require_once('include/function.php');
    checklogin();
    checklogout();
    $auth=$_GET['authid'];
    //fetchbookdetails($id);
    $conn= new mysqli("localhost","root","");
        $conn->query("use admin");
        $fetch="Select * from author WHERE author_id='$auth'";
        $res=$conn->query($fetch);
        if($res->num_rows>0)
        {
            $row=$res->fetch_assoc();
            echo '<div class="container-fluid" id="books">
      <div class="row">
        <div class="col-sm-10 col-md-4">
                           <img height="400px" width="360px" padding-left="20px" class="center-block img-responsive" src="data:image/jpeg;base64,'.base64_encode($row['image']).'"  style="padding:20px;">
        </div>
        <div class="col-sm-10 col-md-6 col-md-offset-1" style="margin-top:100px;">
          <h2> '.$row['name'].'</h2>
          <hr>            
                                  
        <p>'.$row['description'].'</p>
                              </div>
    </div>
  </div>';
          }
echo "<p align='center'><STRONG>POPULAR BOOKS</STRONG></p>".'<br>';
$fetch="Select * from book where author_id='$auth'";
$res=$conn->query($fetch);
        if($res->num_rows>0)
        {
          ?><div class="cardview"><?php
          while($row=$res->fetch_assoc())
          {
            $temp=$row['image'];
            $id=$row['book_id'];
            $nam=$row['name'];
            $discountper=$row['discount'];
            $mrp=$row['price'];
            $dp=(int)($mrp-($discountper*$mrp/100));
            ?>
            <div class="col-sm-6 col-md-3 col-lg-3"> 
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="tag.png"></div>
                  <?php echo '<a  href="description.php?id='.$id.'"><img class="book block-center img-responsive" height="299px" width="171px" src="data:image/jpeg;base64,'.base64_encode($temp).'">'."<br>";
                  ?></a>
                  <hr>
                  <p class="price"> <?php echo "<a href=description.php?id=",urlencode($id),">$nam </a>";?></p>
                  <p class="price"> &#8377;<?php echo $dp?>  &nbsp;
                  <span id="sp"style="text-decoration:line-through;color:#828282;">&#8377;<?php echo  $mrp ?></span>
                  <span id="spa" class="label label-warning"><?php echo $discountper.'%'?></span></p>
              </div>
          </div>
          <?php
          }
          ?></div><?php
        }
        else
        {
          echo "No books retrieved from db";
        }

        require_once('include/footer.php');
?>
  </BODY>
</html>