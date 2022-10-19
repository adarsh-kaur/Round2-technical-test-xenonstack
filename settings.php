<?php include('core/database.php'); ?>

<?php 

	if(!isset($_SESSION["uid"]))
{
	header('location: login-2.php');
} else if($_SESSION["uid"] == "") {
	header('location: login-2.php');
}

		$conn = getConnection();
        if($conn == false){
          echo "Database not connected";
        } else {
			$sql = "SELECT * FROM users where  id = '".$_SESSION["uid"]."' ";
	        $result= mysqli_query($conn,$sql);
	        $user_detail = array();
	        if (mysqli_num_rows($result)) {
            	while ($row = mysqli_fetch_assoc($result)) {
            		// print_r($row);
            		$user_detail = $row;
            		break;
            	}
        	} else {
        		session_destroy();
        		header('location: login-2.php');
        	}
        }
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
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

          	<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <?php if(isset($user_detail["username"])){
                    echo $user_detail["username"]; } ?>
                  </h4>
                  <form class="forms-sample" method="post" action="">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="<?php if(isset($user_detail["username"]))
                      echo $user_detail["username"];
                       ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php if(isset($user_detail["email"]))
                      	echo $user_detail["email"];
                      ?>" disabled>
                    </div>

                    

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gender</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php if(isset($user_detail["gender"])) 
                        echo $user_detail["gender"];
                      ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">City</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php if(isset($user_detail["location"])) 
                        echo $user_detail["location"];
                      ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Bio</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php if(isset($user_detail["text"])) 
                        echo $user_detail["text"];
                      ?>" disabled>
                    </div>
                    
                    <button class="btn btn-primary mr-2"> <a href="profile-2.php"> edit profile </a></button>
                    
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

  </body>
</html>


