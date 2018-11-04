<!DOCTYPE HTML>
	<HEAD>
    <?php session_start();?>
    <script>
    function method()
    {
      alert('CONFIRM LOGOUT?
        Are You sure you want to logout?Press logout again to logout');
    }
    </script>
    <style type="text/css">
      .dropdown {
    position: relative;
    display: inline-block;
    padding-top: 10px;
    }

.dropdown-content {
    margin-top: 20px;
    display: none;
    vertical-align: 100px;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 325px;
    max-width: 325px;
    max-height: 600px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {
  display: block;
}
    </style>
    <script>
</script>

		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
		</script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
		</script>
    <script>
function showResult(str) {
  if (str.length<=2) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      //document.getElementById("livesearch").style.margin-top="50px";
      document.getElementById("livesearch").classList.toggle("show");
      window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>
    <title>BookBazaar</title>
	</HEAD>
	<BODY>
    <?php 
    require_once('function.php');?>
	    <nav class="navbar navbar-expand-lg"style="height: 90px;background-color: #fe3636">
  <img class="logo" src="https://bowlsbuddy.com/assets/bb_logo_blue-7d210d527ecee93c476fb3251053f9adaa7736ddbfe78ed7163758f2bca0a7db.png" style="height: 43px;width: 50px;">
  <form class="form-inline my-2 my-lg-0" style="padding-right: 230px;padding-left: 280px;">
      <div id="dropdown">
        <div id="livesearch" class="dropdown-content" style="height=25px;overflow:scroll;"></div>
      </div>
      <input class="form-control mr-sm-2 " type="search" onkeyup="showResult(this.value)" placeholder="Search by title,author or publisher" aria-label="Search"style="width: 325px;" >
      <button class="btn btn-dark"style="height:40px;"type="submit"><i class="fas fa-search"></i></button>
          
    </form>
    <button class="navbar-toggler" style="background-color: black"type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!--<div class="signup collapse navbar-collapse" id="navbarSupportedContent">-->
    <ul class="navbar-nav mr-auto">
      <?php if(!isset($_SESSION['username'])) {?>
      <li class="nav-item active">
        <a class="btn btn-dark" href="userlogin.php" role="button" style="margin-right: 10px;">LOGIN</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-dark" href="usersignup.php" style="margin-right:10px;">REGISTER</a>
      </li>
      <?php } ?>
    </ul>
  <!--</div>-->
  <!--<div class="logout collapse navbar-collapse " id="navbarSupportedContent">-->
    
      <?php if(isset($_SESSION['username'])) {?>
      <div>
        <?php echo '<a href="profile.php" id="notify" style="margin-right:10px;">Welcome  
        '.$_SESSION['username'].'!</a>'?>
 

        <?php echo '<a class="btn btn-dark" href="cart.php" type="submit" style="margin-right:10px; display:inline-block; height:35px;" ><i class="fas fa-shopping-cart"></i></a>';?>
        <?php echo'<a class="btn btn-dark" style="display:inline-block;" href="logout.php?logout=YES" role="submit" >LOGOUT</a>';?>
      <?php }
      ?></div>
  <!--<input type="submit" name="LOGOUT" class="logout btn btn-dark" value="LOGOUT">-->
<!--</div>-->
</nav>
        
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <div id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="featuredauthors.php">Featured Authors</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="featuredpublishers.php">Featured Publishers</a>
      </li>
    </ul>
  </div>
</nav>