 <?php  include('core/database.php'); ?>

<?php  
  if(!isset($_SESSION["uid"])){
  header('location: login-2.php');
}else if($_SESSION["uid"] == "") {
  header('location: login-2.php');
 }

  $conn = getConnection();
  if ($conn == false) {
    echo "database not connected";
  }else{
    $sql = "SELECT * FROM users WHERE id = '".($_SESSION["uid"])."' " ;
  }
  $result = mysqli_query($conn,$sql);
  $user_detail = array();
  if (mysqli_num_rows($result)) {
    while ($row=mysqli_fetch_assoc($result)) {
      $user_detail=$row;

    }
  }
 ?>


<?php  
$msg1 = "";
$msg2 = "";
	if ($_POST) {
			if (isset($_POST['submit-btn']) && isset($_POST['title']) && isset($_POST['description']) ) {
				if (isset($_POST['title']) !="" && isset($_POST['description']) !="" ) {
					
					$conn = getConnection();
					if ($conn ==  false) {
						echo "db error";
					}else{
					$title = $_POST['title'];
					$description = $_POST['description'];
          $content=$_POST['content'];
					
					$author = $user_detail["username"];
					 date_default_timezone_set('Asia/Kolkata');
					$lastmodified = date('d-m-Y H:i');
          $authorid=$_SESSION["uid"];

          $thumbnail=$_FILES['fileToUpload']['name'];
          $target_dir = "fileupload/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }
          }

          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }

					$sql = "INSERT INTO posts (title,description,content,author,lastmodified,authorid,thumbnail) VALUES('$title','$description','$content','$author','$lastmodified','$authorid','$thumbnail')" ;
					if (mysqli_query($conn,$sql)) {
            while ($row=mysqli_fetch_assoc($result)) {

              $msg1= "post submitted";
            }
						
					}else{$msg2= "post not submitted";}
					}
          // echo $_SESSION["pid"];

					/*$sql2 = "SELECT * FROM posts" ;
					$result2*/
				}
			}
		}	
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Post</title>
    <!-- base:css -->
      <?php include("partials/styles.php"); ?>
      

  </head>
  <body>
    <div class="container-scroller">
      
      <!--header-->
        <?php include("partials/header.php"); ?>
      
        <div class="container-fluid page-body-wrapper">
      		<!---- sidebar --->
       		<?php include("partials/sidebar.php"); ?>

       		<!-- main panel -->
       <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Post</h4>
                  <form class="forms-sample" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="title" name="title" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Meta Description</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="3" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Content</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="6" name="content" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Image</label>
                      <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Author</label>
                      <input disabled type="text" class="form-control" name="author" id="exampleInputUsername1" 
                      value= "<?php if(isset($user_detail["username"])) {echo $user_detail["username"];} ?>" >
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 " name="submit-btn">POST</button>
                  </form>
                </div>
              </div>
            </div>            
          </div>
        </div>

        <!-- footer -->
        <?php include('partials/footer.php'); ?>

      </div>


   		</div>
   
	</div>

	  <!-- scrippts -->
      <?php include("partials/scripts.php"); ?>
<?php  
	if (isset($msg1)) {
		if ($msg1!="") {
?>
	<script>
		alert('<?php echo $msg1; ?>')
	</script>
<?php 
		}
	}
?>
  </body>
</html>


