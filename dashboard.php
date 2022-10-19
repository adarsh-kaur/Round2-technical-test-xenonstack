<?php include('core/database.php') ?>
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
			$sql = "SELECT username,email,id FROM users where  id = '".$_SESSION["uid"]."' ";
	        $result= mysqli_query($conn,$sql);
	        $user_detail = array();
	        if (mysqli_num_rows($result)) {
            	while ($row = mysqli_fetch_assoc($result)) {
            		//print_r($row);
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
      
      <!--header-->
        <?php include("partials/header.php"); ?>
      
        <div class="container-fluid page-body-wrapper">

      		<!---- sidebar --->
       		<?php include("partials/sidebar.php"); ?>
<div class="totalblogs">
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="counter">
                <div class="counter-icon">
                    <i class="fa fa-globe"></i>
                </div>
                <h3>Total Blogs</h3>
                <span class="counter-value"><?php echo $rowcount; ?></span>
            </div>
        </div>  
    </div>
</div>
       		<!-- main panel -->
          <?php include("partials/main-panel.php"); ?>
   		</div>
	</div>
      <?php include("partials/scripts.php"); ?>
  </body>
</html>


