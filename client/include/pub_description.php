<?php require_once('include/header.php');
    require_once('include/function.php');
    checklogin();
    checklogout();
    $pub=$_GET['pubid'];
    //fetchbookdetails($id);
    $conn= new mysqli("localhost","root","");
        $conn->query("use admin");
        $fetch="Select * from publisher WHERE publisher_id='$pub'";
        $res=$conn->query($fetch);
        if($res->num_rows>0)
        {
            $row=$res->fetch_assoc();
            echo '<div class="container-fluid" id="books">
      <div class="row">
        <div class="col-sm-10 col-md-4">
                           <img height="400px" width="360px" padding-left="20px" class="center-block img-responsive" src="data:image/jpeg;base64,'.base64_encode($row['logo']).'" height="550px" style="padding:20px;">
        </div>
        <div class="col-sm-10 col-md-6 col-md-offset-1 " style="margin-top:100px;">
          <h2> '.$row['name'].'</h2>
          <hr>            
                                  
        <p>'.$row['description'].'</p>
                              </div>
    </div>
  </div>';  
        }
        require_once('include/footer.php');
?>
