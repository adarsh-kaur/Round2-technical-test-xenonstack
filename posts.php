<?php include('core/database.php'); ?>

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
  mysqli_close($conn);
 ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recent Posts</title>
    
    <!-- css -->
      <?php include("new-pages/partials/styles.php"); ?>

      

  </head>
  <body>

    <!-- sidebar -->
    <?php include('new-pages/partials/header.php'); ?>

    <!-- main panel -->
    <?php include('new-pages/partials/new-main-panel.php'); ?>
    <?php include('new-pages/partials/color-panel.php'); ?>

<!-- scripts -->
<?php include('new-pages/partials/scripts.php'); ?>


  </body>
</html>
