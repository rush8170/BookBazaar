<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="book.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<title>BOOK</title>
</head>
<body>
	<?php
		$dbServername="localhost";
		$dbUsername="root";
		$dbPassword="";
		$dbName="admin";
		$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
		if(!$conn){
			die("couldn't connect:".mysql_error());
		}
		session_start();

		if(isset($_POST['add_submit_book'])) {
			$var=$_SESSION['username'];
			$book_name=mysqli_real_escape_string($conn,$_POST["name"]);
			$book_category=mysqli_real_escape_string($conn,$_POST["category"]);
			$book_quantity=mysqli_real_escape_string($conn,$_POST["quantity"]);
			$book_price=mysqli_real_escape_string($conn,$_POST["price"]);
			$book_discount=mysqli_real_escape_string($conn,$_POST["discount"]);
			$book_description=mysqli_real_escape_string($conn,$_POST["description"]);
			$book_release_date=mysqli_real_escape_string($conn,$_POST["release_date"]);
			$book_image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$book_publisher_id=mysqli_real_escape_string($conn,$_POST["publisher_id"]);
			$book_author_id=mysqli_real_escape_string($conn,$_POST["author_id"]);
			$query="INSERT INTO book(name,category,quantity,price,discount,description,release_date,image,publisher_id,author_id) VALUES('$book_name','$book_category',$book_quantity,$book_price,$book_discount,'$book_description','$book_release_date','$book_image',$book_publisher_id,$book_author_id)";
			$result=mysqli_query($conn,$query);
			if($result) {
				echo '<script type="text/javascript">alert("Book Details Added Successfully !!")</script>';
			}
			else {
				die("Couldn't Insert:".mysql_error());
			}
			mysqli_commit($conn);
		}
		else if(isset($_POST['update_submit_book'])) {
			$var=$_SESSION['username'];
			$book_id=mysqli_real_escape_string($conn,$_POST["id"]);
			$book_quantity=mysqli_real_escape_string($conn,$_POST["quantity"]);
			$book_price=mysqli_real_escape_string($conn,$_POST["price"]);
			$book_discount=mysqli_real_escape_string($conn,$_POST["discount"]);
			$query="UPDATE book SET quantity=$book_quantity,price=$book_price,discount=$book_discount WHERE book_id=$book_id";
			$result=mysqli_query($conn,$query);
			if($result) {
				echo '<script type="text/javascript">alert("Book Details Updated Successfully !!")</script>';
			}
			else {
				die("Couldn't update:".mysql_error());
			}
			mysqli_commit($conn);
		}
		else if(isset($_POST['delete_submit_book'])) {
			$var=$_SESSION['username'];
			$book_id=mysqli_real_escape_string($conn,$_POST["id"]);
			$query="DELETE FROM book WHERE book_id=$book_id";
			$result=mysqli_query($conn,$query);
			if($result) {
				echo '<script type="text/javascript">alert("Book Details Deleted Successfully !!")</script>';
			}
			else {
				die("Couldn't Delete:".mysql_error());
			}
			mysqli_commit($conn);
		}
		else if(isset($_POST['home_book'])) {
			$var=$_SESSION['username'];
			header("Location: home.php?user=$var");
		}
		else if(isset($_POST['logout_book'])) {
			$_SESSION['username']=null;
			session_destroy();
			header("Location: login.php");
		}
	?>
	<script type="text/javascript">
		$(document).ready(function(){
	    	$("#1").click(function(){
	    		$(".add").show();
	    		$(".update").hide();
	       		$(".delete").hide();
	   		});
	    	$("#2").click(function(){
	    		$(".add").hide();
	        	$(".update").show();
	        	$(".delete").hide();
	        	$(".edit1").hide();
	    	});
	    	$("#3").click(function(){
	    		$(".add").hide();
	    		$(".update").hide();
	        	$(".delete").show();
	    	});
	    	$("#4").click(function(){
				$(".edit1").show();
			});
		});
		function bookdata() {
			var id=document.getElementById("id").value;
			if(id=="") {
				alert("Enter Book ID !! And Try Again");
    			return;
			}
			if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
			} else { // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					document.getElementById("existingdata").innerHTML=this.responseText;
				}
			}
			xmlhttp.open("GET","loaddata.php?id="+id,true);
			xmlhttp.send();
		}
	</script>
	<div class="wrapper">
		<div class="heading"><p class="salutation">Manage Book Details</p></div>
		<div class="buttonbox" style="display: inline-block;"><button class="button" type="button" name="button" id="1">Add Book</button></div>
		<div class="buttonbox" style="display: inline-block;"><button class="button" type="button" name="button" id="2">Update Book</button></div>
		<div class="buttonbox" style="display: inline-block;"><button class="button" type="button" name="button" id="3">Delete Book</button></div>
		<form class="add" method="post" id="ad" style="display: none;" enctype="multipart/form-data">
			<span class="formtitle">Add</span>
			<span class="txt1">Name</span>
			<div class="inputbox"><input class="input" type="text" name="name" placeholder="Enter name" required></div>
			<span class="txt1">Category</span>
			<div class="inputbox"><input class="input" type="text" name="category" placeholder="Enter category" required></div>
			<span class="txt1">Quantity</span>
			<div class="inputbox"><input class="input" type="number" name="quantity" placeholder="Enter quantity" required></div>
			<span class="txt1">Price</span>
			<div class="inputbox"><input class="input" type="number" name="price" placeholder="Enter price" required></div>
			<span class="txt1">Discount</span>
			<div class="inputbox"><input class="input" type="number" name="discount" placeholder="Enter discount" required></div>
			<span class="txt1">Description</span>
			<div class="textbox"><textarea class="inputarea" name="description" form="ad" placeholder="Enter description"></textarea></div>
			<span class="txt1">Release Date</span>
			<div class="inputbox"><input class="input" type="date" name="release_date" required></div>
			<span class="txt1">Image</span>
			<div class="inputbox"><input class="inputfile" type="file" name="image" id="image" placeholder="Browse" accept=".jpg"></div>
			<span class="txt1">Publisher ID</span>
			<div class="inputbox"><input class="input" type="number" name="publisher_id" placeholder="Enter publisher id" required></div>
			<span class="txt1">Author ID</span>
			<div class="inputbox"><input class="input" type="number" name="author_id" placeholder="Enter author id" required></div>
			<div class="submitbutton"><input class="submit" type="submit" name="add_submit_book" value="Submit"></div>
		</form>
		<form class="update" method="post" style="display: none;">
			<span class="formtitle">Update</span>
			<span class="txt1">ID</span>
			<div class="inputbox"><input class="input" type="number" name="id" id="id" placeholder="Enter id" required></div>
			<div class="buttonbox"><button class="button" name="get_data_book" type="button" id="4" onclick="bookdata()">Get Data</button></div>
			<div class="edit1" style="display: none;">
				<div id="existingdata" class="txt1"></div>
				<div>
					<span class='txt1'>Enter New Details</span><br>
					<span class="txt1">Quantity</span>
					<div class="inputbox"><input class="input" type="number" name="quantity" placeholder="Enter new quantity" required></div>
					<span class="txt1">Price</span>
					<div class="inputbox"><input class="input" type="number" name="price" placeholder="Enter new price" required></div>
					<span class="txt1">Discount</span>
				</div>
				<div class="inputbox"><input class="input" type="number" name="discount" placeholder="Enter new discount" required></div>
				<div class="submitbutton"><input class="submit" type="submit" name="update_submit_book" value="Submit"></div>
			</div>
		</form>
		<form class="delete" method="post" style="display: none;">
			<span class="formtitle">Delete</span>
			<span class="txt1">ID</span>
			<div class="inputbox"><input class="input" type="number" name="id" placeholder="Enter id" required></div>
			<div class="submitbutton"><input class="submit" type="submit" name="delete_submit_book" value="Submit"></div>
		</form>
		<form class="home" method="post">
			<div class="submitbutton"><input class="submit" type="submit" name="home_book" value="Home"></div>
		</form>
		<form class="logout" method="post">
			<div class="submitbutton"><input class="submit" type="submit" name="logout_book" value="Logout"></div>
		</form>
	</div>
</body>
</html>