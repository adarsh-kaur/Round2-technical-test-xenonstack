<?php include('core/database.php'); ?>


<?php 

	if(!isset($_SESSION["uid"]))
{
	header('location: login-2.php');
} else if($_SESSION["uid"] == "") {
	header('location: login.php');
}

		$conn = getConnection();
        if($conn == false){
          echo "Database not connected";
        } else {
			
        }


  $conn = getConnection();
        if($conn == false){
          echo "Database not connected";
        } else {
      
        }
  
 $sql = "SELECT *  FROM users where  id = '".$_SESSION["uid"]."'  ";
    $result= mysqli_query($conn,$sql);
    $user_detail = array();
    if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
           $user_detail = $row;
          break;
        }
    } else {
      session_destroy();
      header('location: login-2.php');
    }

?>

<?php  
$msg3 = "";
	
	if (isset($_POST)) {
		if (isset($_POST['submit-2']) && isset($_POST['gender']) && isset($_POST['location'])  && isset($_POST['text']) && isset($_POST['password']) ) {
			if (isset($_POST['gender']) !='' && isset($_POST['location']) !='' && isset($_POST['text']) !='' && isset($_POST['password']) !='' ) {
				
				$conn = getConnection();
				if ($conn==false) {
					echo "connection error";
				}else{
					$gender = $_POST['gender'];
					$location = $_POST['location'];
					$text = $_POST['text'];
					$image = $_FILES['image']['name'];
					$target = "fileupload/".basename($image);
          $password = $_POST['password'];

         // echo $user_detail["password"];

					$sql2 = "UPDATE users SET gender = '$gender' , location = '$location' , text = '$text' , password = '$password' WHERE id = '".($_SESSION["uid"])."'  " ;

					if (mysqli_query($conn,$sql2)) {

            if($_FILES['image']["name"] != ""){
  						$target_dir = "fileupload/";
  						$image = time()."_". basename($_FILES["image"]["name"]);
  						$target_file = $target_dir .$image;
  						$uploadOk = 1;
  						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  						if(isset($_POST["submit"])) {
  						  $check = getimagesize($_FILES["image"]["tmp_name"]);
  						  if($check !== false) {
  						    echo "File is an image - " . $check["mime"] . ".";
  						    $uploadOk = 1;
  						  } else {
  						    echo "File is not an image.";
  						    $uploadOk = 0;
  						  }
  						}

  						if (file_exists($target_file)) {
  						  echo "Sorry, file already exists.";
  						  $uploadOk = 0;
  						}

  						if ($_FILES["image"]["size"] > 500000) {
  						  echo "Sorry, your file is too large.";
  						  $uploadOk = 0;
  						}

  						if ($uploadOk == 0) {
  						  echo "Sorry, your file was not uploaded.";

  						} else {
  						  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  						   $msg3 = "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
  						  } else {
  						    echo "Sorry, there was an error uploading your file.";
  						  }
  						}


						  $sql2 = "UPDATE users SET image = '$image' WHERE id = '".($_SESSION["uid"])."' " ;

    					if (mysqli_query($conn,$sql2)) {
    					}
            }

					}else{
						echo "not submitted";
					}
				mysqli_close($conn);
				}
			}
			//die();
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>
      <?php include("partials/styles.php"); ?>
      

  </head>
  <body>
    <div class="container-scroller">
      

        <?php include("partials/header.php"); ?>
      
        <div class="container-fluid page-body-wrapper">

       		<?php include("partials/sidebar.php"); ?>

       <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Complete your profile</h4>
                  <form class="forms-sample" method="post" action=""  enctype="multipart/form-data">

                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" required class="form-control" id="exampleInputName1"
                       disabled placeholder="<?php
                                    if(isset($user_detail["username"])){
                                     echo $user_detail["username"];}
                                    ?>"
                        name="username">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail3"
                       disabled placeholder="<?php if(isset($user_detail["email"])){
                       					echo $user_detail["email"];
                       				} ?>"
                       name="email" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleSelectGender">Gender</label>
                    <?php 
                    $gender = "";
                      if(isset($user_detail["gender"])) {
                        $gender = $user_detail["gender"];
                      }

                      ?>
                        <select class="form-control" id="exampleSelectGender" name="gender" >
                          <option <?php if($gender == ""){ echo " selected ";} ?> >select gender</option>
                          <option <?php if($user_detail["gender"] == "Male"){ echo " selected ";} ?> >Male</option>
                          <option <?php if($user_detail["gender"] == "Female"){ echo " selected ";} ?> >Female</option>
                        </select>
                    </div>

                    <div class="form-group" id="display-image">
                      <label>Profile Image</label>
                      <div class="input-group col-xs-12" >
                        <input type="file" class="form-control file-upload-info" placeholder="Upload Image" name="image" >
                        </div>
                        <?php  
                          if (isset($user_detail["image"])) {
                            if ($user_detail["image"]!="") {
                              echo "<img src='fileupload/".$user_detail["image"]."' >";
                            }
                          }else{
                        ?>
                          <img src="fileupload/blank.jpg">
                        <?php 
                          }
                        ?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputCity1">City</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location" name="location" required value="<?php 
                      if(isset($user_detail["location"])) {
                        echo $user_detail["location"];
                      }

                      ?>" >
                    </div>

                    <div class="form-group">
                      <label for="exampleTextarea1">Bio</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="text"><?php 
                      if(isset($user_detail["text"])) {
                        echo $user_detail["text"];
                      }

                      ?></textarea>

                      
                      	

                     
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="submit-2">Submit</button>
                    <button class="btn btn-light" type="Cancel">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php include('partials/footer.php'); ?>

      </div>
   		</div>
	</div>

      <?php include("partials/scripts.php"); ?>

<?php  
	if(isset($msg1)){
		if ($msg1!="") {
		?>
		<script>
			alert('<?php echo $msg1; ?>')
		</script>
	<?php 
		}
	}
?>

<?php  
if(isset($msg2)){
	if ($msg2!="") {
	?>
	<script>
		alert('<?php echo $msg2; ?>')
	</script>
<?php 
	}
}
?>

<?php  
  if (isset($msg3)) {
    if ($msg3!="") {
?>
  <script>
    alert('<?php echo $msg3; ?>')
  </script>
<?php 
    }
  }
?>

  </body>
</html>


