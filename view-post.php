<?php include('core/database.php'); ?>

<?php  
  if(!isset($_SESSION["uid"])){
  header('location: login-2.php');
}else if($_SESSION["uid"] == "") {
  header('location: login-2.php');
 }
?>

<?php  
$conn=getConnection();
if ($conn==false) {
	echo "connection error";
}else{
	$sql="SELECT * FROM users WHERE id='".($_SESSION["uid"])."'" ;
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

<?php  
	$conn2=getConnection();
	if ($conn2==false) {
		echo "db connection error";
	}else{
		$id=$_REQUEST["id"];
		$sql2="SELECT * FROM posts WHERE id ='$id'" ;
		$result2=mysqli_query($conn2,$sql2);
		$post_detail=array();
		if (mysqli_num_rows($result2)) {
			while ($row2=mysqli_fetch_assoc($result2)) {
				$post_detail=$row2;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $post_detail["title"]; ?></title>
    
      <?php include("new-pages/partials/styles.php"); ?>      

  </head>
  <body>

    <?php include('new-pages/partials/header.php'); ?>

    <div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center">
			    <h2 class="heading">DevBlog - A Blog Template Made For Developers</h2>
			    <div class="intro">Welcome to my blog. Subscribe and get my latest blog post in your inbox.</div>
			    <form class="signup-form form-inline justify-content-center pt-3" method="post" action="">
                    <div class="form-group">
                        <label class="sr-only" for="semail">Your email</label>
                        <input type="email" id="semail" name="semail" class="form-control mr-md-1 semail" placeholder="Enter email" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="subs-btn">Subscribe</button>
                </form>
		    </div>
	    </section>

	     <article class="blog-post px-3 py-5 p-md-5">
		    <div class="container">
			    <header class="blog-post-header">
				    
				    <h2 class="title mb-2"><?php if (isset($post_detail["title"])) {
				    	echo $post_detail["title"];
				    } ?></h2>

				    <div class="meta mb-3"><span class="date"><?php if (isset($post_detail["date"])) {
				    	echo $post_detail["date"];
				    } ?></span>
				    <span class="comment"><?php if (isset($post_detail["author"])) {
				    	echo $post_detail["author"];
				    } ?>
				    </span>
					</div>
			    </header>
			    
			    <div class="blog-post-body">

				    <figure class="blog-banner">

				        <?php if (isset($post_detail["thumbnail"])) {
				        	if ($post_detail["thumbnail"]!="") {
				        		echo "<img alt='post_thumbnail' class='img-fluid' src='fileupload/".($post_detail["thumbnail"])."' >";
				        	}
				        } ?>
				        
				    </figure>

				    <p>
				    	<?php if (isset($post_detail["content"])) {
				    		if ($post_detail["content"]!="") {
				    			echo $post_detail["content"];
				    		}
				    	} ?>
				    </p>
			    </div>

			    <div class="my-2 my-md-3">
				    <a class="btn btn-primary" href="posts-2.php">All Posts</a>
				</div>		
		    </div>
	    </article>
	    
	    <footer class="footer text-center py-2 theme-bg-dark">
                <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
	    </footer>
    
    </div>

<!-- scripts -->
<?php include('new-pages/partials/scripts.php'); ?>


  </body>
</html>
