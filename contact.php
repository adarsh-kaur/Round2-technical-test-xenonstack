<?php include('core/database.php') ?>

<?php

if(isset($_SESSION["uid"]))
{
  if($_SESSION["uid"] != "") {
    header('location: dashboard.php');
  }
 
}
?>


<?php 
  $message = "";

  if(isset($_POST)){
    if(isset($_POST["submit-2-btn"]) && isset($_POST["username"])  && isset($_POST["email"])) {
      if(isset($_POST["username"]) != ''  && isset($_POST["email"]) != '') {
        $conn = getConnection();
        if($conn == false){
          echo "Database not connected";
        } else {
          // $username = $_POST["username"];
          $email = $_POST["email"];
          $username = $_POST["username"];

          $sql = "SELECT id FROM users where  email = '$email'  and username = '$username' ";

          $result= mysqli_query($conn,$sql);
          if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
              $_SESSION["uid"] = $row["id"];
              header('Location:dashboard.php');
              die();
            }
          }else{
            $message = "user not found";
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

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>contact</title>
  <?php include("partials/styles.php"); ?>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/miller_logo.png" alt="logo">
              </div>
              <h4>Hello! Feel free to contact us.</h4>
              <form class="pt-3" method="post" action="" id="login-form">
              <div class="form-group">
              <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="enter name" name="name" name="username" required>
              </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="email" name="email" name="username" required>
                </div>

                <div class="form-group">

                 <input type="text" class="form-control form-control-lg" id="exampleInputQuery" placeholder="Write your query" name="message">
                </div>


                <div class="mt-3">
                  <button type="submit" name="submit-2-btn" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>
                </div>


                
                
                <div class="text-right mt-4 font-weight-light">

                  <div class="call-logo">
                <img src="images/call-logo.jpg" height="30px" width="10%"  alt="logo">Call! 
                <p>8000812345</p>
              </div>
              <br>

              <div class="email-logo">
                <img src="images/email.png" height="12px" width="7%"  alt="logo">  Email
                <p>millers.shuck@gamil.com</p>
              </div>
              <br>

              <div class="meet-logo">
                <img src="images/loc.png" height="17px" width="7%"  alt="logo">Meet
                <p>Office at XYZ</p>
              </div>


                </div>
                
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php 
    if($message != ''){
      ?>
      <script>
        alert('<?php echo $message; ?>');
      </script>
      <?php
    }

  ?>

  <?php include("partials/scripts.php"); ?>
  <script>

    $(document).ready(function(){
       $("#login-form").validate({
        submitHandler: function(form) {
          form.submit();
        }
       });
    });
  </script>
</body>
</html>