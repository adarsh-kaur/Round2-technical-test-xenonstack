<?php include('core/database.php'); ?>

<!-- user id session -->
<?php  
  if(!isset($_SESSION["uid"])){
  header('location: login-2.php');
}else if($_SESSION["uid"] == "") {
  header('location: login-2.php');
 } 

?>

<!--fetch user  details -->
<?php  
	$conn=getConnection();
	if ($conn==false) {
		echo "connection error";
	}else{
		$sql="SELECT * FROM users WHERE id='".$_SESSION["uid"]."'" ;
		$result=mysqli_query($conn,$sql);
		$user_detail=array();
		if (mysqli_num_rows($result)) {
			while ($row=mysqli_fetch_assoc($result)) {
				$user_detail=$row;
			}
		}
	mysqli_close($conn);
	}

?>

<!--fetch post data -->
<?php  
$conn2=getConnection();
	if ($conn2==false) {
		echo "connection error";
	}else{
		$sql2="SELECT * FROM posts WHERE authorid='".($_SESSION["uid"])."'" ;
		$result2=mysqli_query($conn2,$sql2);
		$posts_details=array();

		if (mysqli_num_rows($result2)) {
			while ($row2=mysqli_fetch_assoc($result2)) {
				// $_SESSION["pid"]=$row2["id"];
				$posts_details[] = $row2;	
			}
		}
	}
?>

<!-- subscription email  -->
<?php  
	$conn3=getConnection();
	if ($conn3==false) {
		echo "connection error";
	}else{
		if (isset($_POST)) {
			if (isset($_POST['subs-btn']) && isset($_POST['semail'])) {
				if (isset($_POST['semail'])!="") {
					$semail=$_POST['semail'];
					$sql3="INSERT INTO subscriptions (semail) VALUES ('$semail')" ;
					if (mysqli_query($conn3,$sql3)) {	
						echo "thanks for being our member";
					}
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recent Posts</title>
    
      <?php include("new-pages/partials/styles.php"); ?>

      

  </head>
  <body>

    <?php include('new-pages/partials/header.php'); ?>


    <div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center">
			    <h2 class="heading">Subscribe to our newsletter!</h2>
			    <form class="signup-form form-inline justify-content-center pt-3" method="post" action="">
                    <div class="form-group">
                        <label class="sr-only" for="semail">Your email</label>
                        <input type="email" id="semail" name="semail" class="form-control mr-md-1 semail" placeholder="Enter email" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="subs-btn">Subscribe</button>
                </form>
		    </div>
	    </section>

	    <section class="blog-list px-3 py-5 p-md-5">
		    <div class="container">
		    	
		    	<?php foreach($posts_details as $posts_detail) { ?>
			    <div class="item mb-5">
				    <div class="media">
					<?php  
						if (isset($posts_detail["thumbnail"])) {
							if ($posts_detail["thumbnail"]!="") {
								echo "<img class='mr-3 img-fluid post-thumb d-none d-md-flex' src='fileupload/".$posts_detail["thumbnail"]."' alt='image' >";
							}else{
					?>
						<img src="fileupload/blank.jpg" class="mr-3 img-fluid post-thumb d-none d-md-flex" alt="thumbnail image">
					<?php
							}
						}
					?>
					    <div class="media-body">
						    <h3 class="title mb-1">
						    	<?php 
						    		if (isset($posts_detail["title"])) {
						    			if ($posts_detail["title"]!="") {
						    				echo $posts_detail["title"];
						    			}
						    		}else{ 
						    		}
						    	?>
						    	<?php  
						    		echo $posts_detail["id"];
						    	?>
						    </h3>
						    <div class="meta mb-1"><span class="date">
						    	<?php if (isset($posts_detail["date"])) {
						    		if ($posts_detail["date"]!="") {
						    			echo $posts_detail["date"];
						    		}
						    	} ?>
						    </span>
						    <span class="time">
						    	<?php if (isset($posts_detail["author"])) {
						    		if ($posts_detail["author"]!="") {
						    			echo $posts_detail["author"];
						    		}
						    	} ?>
						    </span> </div>
						    <div class="intro">
						    	<?php if (isset($posts_detail["description"])) {
						    		if ($posts_detail["description"]!="") {
						    			echo $posts_detail["description"];
						    		}
						    	} 
					?>
						    </div>
						    	

						    <a class="more-link" target="_blank" href="view-post.php?id=<?php echo $posts_detail["id"]; ?>">Read more &rarr;</a>
					    </div>
				    </div>
			    </div>
			    
			<?php } ?>
			    
			    <nav class="blog-nav nav nav-justified my-5">
				  <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
				  <a class="nav-link-next nav-item nav-link rounded" href="">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
				</nav>
				
		    </div>
	    </section>    
    </div>

<?php include('new-pages/partials/scripts.php'); ?>

  </body>
</html>
