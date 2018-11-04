<?php
require_once('include/header.php');
$conn=new mysqli('localhost','root','');
$conn->query('use admin');
$id=$_SESSION['email'];
//echo $id;
$fetch="Select * from customer where emailid='$id'";
$res=$conn->query($fetch);
      if($res->num_rows>0)
      {
          $row=$res->fetch_assoc();
          $parts=explode(' ', $row['name']);
          $fname=trim($parts[0]);
          $lname='---';
          if (empty($parts[1])){}
          else $lname=trim($parts[1]);
          
          echo '
            <form style="width:70%;padding-top: 30px; margin-left: 331px;">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName"><b>First name:</b></label>
                <br><label>'.$fname.'</label>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName"><b>Last name:</b></label>
                <br><label>'.$lname.'</label>
              </div>
            </div>

            <div class="mb-3">
              <label for="email"><b>Email:</b></label>
              <br><label>'.$row['emailid'].'</label>
            </div>
              <div class="mb-3">
                <label for="firstName"><b>Date Of Birth:</b></label>
                <br><label>'.$row['dob'].'</label>
              </div>
              <div class="mb-3">
                <label for="lastName"><b>Gender:</b></label>
                <br><label>'.$row['gender'].'</label>
              </div> 

            <div class="mb-3">
              <label for="address"><b>Phone:</b></label>
              <br><label>'.$row['phone_no'].'</label>
            </div>

            <div class="mb-3">
              <label for="address"><b>Address:</b></label>
              <br><label>'.$row['address'].'</label>
            </div>
              <div class="mb-3">
                <label for="zip"><b>Pincode:</b></label>
                <br><label>'.$row['pincode'].'</label>

              </div>
          </form>';
        }
require_once('include/footer.php');
?>