<?php 
require_once('include/header.php');
require_once('include/function.php');
$conn=new mysqli('localhost','root','');
$conn->query('use admin');
$fetch="Select * from publisher";
$res=$conn->query($fetch);
        if($res->num_rows>0)
        {
          echo '<div class="cardview">';
          while($row=$res->fetch_assoc())
          {
            echo '
            <div class="col-sm-6 col-md-3 col-lg-3" style="display:flex;justify-content:center;"> 
              <div class="book-block" >
            
            <a  href="pub_description.php?pubid='.$row['publisher_id'].'"><img class="rounded-circle" width="250px" height="250px" src="data:image/jpeg;base64,'.base64_encode($row['logo']).'" alt="Card image cap"></a>
            <div class="card-body">
            <a href="pub_description.php?pubid='.$row['publisher_id'].'"><h3 style="text-align:center"class="card-text">'.$row['name'].'</h3></a>
            </div>
             </div>
            
            </div>'; 
          }
          echo '</div>';
        }
        require_once('include/footer.php');
        ?>