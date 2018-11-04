<!-- Take images as a table -->
<?php
      function fetchbookswithquery($conn,$fetch)
      {
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
      }
      function fetchnewbooks()
      {
        
        $conn= new mysqli("localhost","root","");
        $conn->query("use admin");
        $fetch="Select * from book WHERE release_date>'2017/01/01' ORDER BY release_date LIMIT 8";
        fetchbookswithquery($conn,$fetch);
      }
      function fetchbookswithcondition($condition,$value)
      {
        $conn= new mysqli("localhost","root","");
        $conn->query("use admin");
        $fetch="Select * from book WHERE $condition LIKE '$value'";
        //echo $fetch;
        fetchbookswithquery($conn,$fetch);   
      }
      function checklogin(){
        //session_start();
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $conn= new mysqli("localhost","root","");
        $conn->query("use admin");
        $var=$_SESSION['username'];
        $fetch="SELECT emailid from customer where name='$var'";
        $res=$conn->query($fetch);
        $row=$res->fetch_assoc();
        $_SESSION['email']=$row['emailid'];
        ?>
      <script>document.getElementById('notify').innerHTML= <?php  "Welcome, " . $_SESSION['username'] . "!";?>
      //document.getElementById('welcome').style.color="white";
      </script>

          <style type="text/css">.signup{
          display:none;
          }
          .logout{
            display: inline-block;
            }</style>
      <?php
      } 
      else {
        ?>
          <style type="text/css">.signup{
          display:inline-block;
          }
          .logout{
            display: none;
            }</style>
        <?php
      //echo "Please log in first to see this page.";
      }
      }
      function checklogout()
      {
        //if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['LOGOUT']))
        if(isset($_GET['logout']))
        {
          echo '<style type="text/css">.signup{
          display:inline-block;
          }
          .logout{
            display: none;
            }</style>';
          //header("Location:http://localhost/PHP/project/home.php");
      }
      }
      function fetchbookdetails($id)
      {
        $conn= new mysqli("localhost","root","");
        $conn->query("use admin");
        $fetch="Select * from book WHERE book_id='$id'";
        $res=$conn->query($fetch);
        /*
        $publ="Select * from book INNER JOIN publisher ON book.publisher_id=publisher.publisher_id";
        $auth="Select * from book INNER JOIN author ON book.author_id=author.author_id";
        */
        if($res->num_rows>0)
        {
          $row=$res->fetch_assoc();
          $temp=$row['image'];
          $authid = $row['author_id'];
          $pubid=$row['publisher_id'];
          $auth=$conn->query("Select * from author where author_id='$authid'");
          $publ=$conn->query("Select * from publisher where publisher_id='$pubid'");
          $author=$auth->fetch_assoc();
          $publisher=$publ->fetch_assoc();
          ?>
          <div class="container-fluid" id="books">
          <div class="row">
          <div class="col-sm-10 col-md-6">
                          <div class="tag"><?php echo $row['discount'];?>%OFF</div>
                              <div class="tag-side"><img src="tag.png">
                          </div>
                         <?php echo '<img class="book block-center img-responsive" src="data:image/jpeg;base64,'.base64_encode($temp).'">'."<br>";?> 
      </div>
      <div class="col-sm-10 col-md-4 col-md-offset-1 title">
        <h2><?php echo $row['name'];?></h2>
                                <span style="color:#00B9F5;">
                                 <?php echo '<a href="auth_description.php?authid='.$author['author_id'].'"># '.$author['name'].'</a>';?> &nbsp; &nbsp;
                                 <?php echo '<a href="pub_description.php?pubid='.$publisher['publisher_id'].'"># '.$publisher['name'].'</a>';?> &nbsp; &nbsp;
                                </span>
        <hr>             
                                
                                <span style="font-weight:bold;" name="quantity"  > Quantity : </span><form method="post" action=""><select name="quantity" id="quantity" ><option value="1">1</option><option value="2">2</option></select><input type="submit" name="Submit" value="In stock?"></input></form>
                            
                                        <br><br>
                                        
                                <?php 
                                $quantity=1;
                                if($_SERVER['REQUEST_METHOD']=='POST')
                                {
                                    $quantity=$_POST['quantity'];
                                    $book_id=$_GET['id'];
                                    $conn= new mysqli("localhost","root","");
                                    $conn->query("use admin");
                                    $fetch="Select quantity from book WHERE book_id='$book_id'";
                                    $res=$conn->query($fetch);
                                    $row1=$res->fetch_assoc();
                                    $amount=$row1['quantity'];
                                    if($quantity>$amount)
                                    {
                                      echo "<b>Sorry, we are out of stock</b>";
                                    }
                                    else
                                    {
                                      //echo "Success";
                                    
                                
                                if(isset($_SESSION['loggedin'])){
                                echo'<a id="buyLink" href="cart.php?id='.$row['book_id'].'&amp;quantity='.$quantity.'" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;"> 
                                    ADD TO CART for Rs '.(int)($row['price']-$row['discount']*$row['price']/100).' <br>'?>
                                    <span style="text-decoration:line-through;"> Rs<?php echo  $row['price'];?></span> 
                                    | <?php echo $row['discount'].'% discount';
                                  }
                                  else {
                                    //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                   echo'<a id="buyLink" href="userlogin.php?que=1" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;"> 
                                    ADD TO CART for Rs '.(int)($row['price']-$row['discount']*$row['price']/100).' <br>'?>
                                    <span style="text-decoration:line-through;"> Rs<?php echo  $row['price'];?></span> 
                                    | <?php echo $row['discount'].'% discount'; 
                                  }
                                }
                              }
                                    ?>
                                 </a> 
                                 <div style="margin-top: 20px;">
                                  <div class="row">
                                    <div class="col-md-3">
                                      <img src="lim.png">
                                    </div>
                                    <div class="col-md-9" style="padding-left: 2px;">
                                      <p><b>The order quantity for this product is limited to 2 units per customer</b>
                                      </p>
                                    </div>
                                  </div>
                                  
                                  <p>
                                  Please note that orders which exceed the quantity limit will be auto-canceled. This is applicable across sellers.</p>
                                 </div>
                                

      </div>
    </div>
          </div>
          <div class="container-fluid" id="description">
    <div class="row">
      <h2> Description </h2> 
      <p><?php echo $row['description'].'<br>';?></p>
                        <pre style="background:inherit;border:none;">
                        <br> 
   TITLE         <?php echo $row['name']; ?><hr> 
   AUTHOR        <?php echo $author['name'];?> <hr>
   PUBLISHER     <?php echo $publisher['name'];?><hr> 
   GENRE         <?php echo $row['category'];?> <hr>
                        </pre>
    </div>
  </div><?php
        }
      }
    ?>
