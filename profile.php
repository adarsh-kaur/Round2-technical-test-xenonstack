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
			$sql = "SELECT username,email,id,country,password FROM users where  id = '".$_SESSION["uid"]."'  ";
	        $result= mysqli_query($conn,$sql);
	        $user_detail = array();
	        if (mysqli_num_rows($result)) {
            	while ($row = mysqli_fetch_assoc($result)) {
            		 $user_detail = $row;
            		break;
            	}
        	} else {
        		session_destroy();
        		header('location: login-2.php');
        	}
        }


$msg1="";
$msg2="";
	
	if (isset($_POST)) {
		if  (isset($_POST['submit-2']) && isset($_POST['gender']) && isset($_POST['location'])) {
			if (isset($_POST['gender']) !='' && isset($_POST['location']) !='' ) {
				
				$conn = getConnection();
				if ($conn == false) {
					echo "connection error";
				}else{

					$gender = $_POST['gender'];
					$location = $_POST['location'];	

					$sql2 = "UPDATE users SET gender  = '$gender' , location = '$location'  where id='".($_SESSION["uid"])."'";  
		
				if (mysqli_query($conn,$sql)) {
					$msg1= " submitted ";
				}
				else{
					$msg2= " not submitted ";
				}
					mysqli_close($conn);
				}			
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
    <title>Profile</title>
    <!-- base:css -->
      <?php include("partials/styles.php"); ?>
      

  </head>
  <body>
    <div class="container-scroller">
      
      <!--header-->
        <?php include("partials/header.php"); ?>
      
        <div class="container-fluid page-body-wrapper">

        	<!-- theme setitng -->
        	<?php include('partials/theme-setting.php'); ?>
      		<!---- sidebar --->
       		<?php include("partials/sidebar.php"); ?>

       		<!-- main panel -->
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
                        <select class="form-control" id="exampleSelectGender" name="gender" >
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label>File upload</label>
                      <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" placeholder="Upload Image" name="image">
                        <span class="input-group-append">
                        </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputCity1">City</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location" name="location" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleTextarea1">Textarea</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="text"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="submit-2">Submit</button>
                    <button class="btn btn-light" type="Cancel">Cancel</button>
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
	if ($msg1!="") {
	?>
	<script>
		alert('<?php echo $msg1; ?>')
	</script>
<?php 
	}
?>

<?php  
	if ($msg2!="") {
	?>
	<script>
		alert('<?php echo $msg2; ?>')
	</script>
<?php 
	}
?>


  </body>
</html>


