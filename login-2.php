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
    if(isset($_POST["login-btn"]) && isset($_POST["email"])  && isset($_POST["password"])) {
      if(isset($_POST["email"]) != ''  && isset($_POST["password"]) != '') {
        $conn = getConnection();
        if($conn == false){
          echo "Database not connected";
        } else {
          // $username = $_POST["username"];
          $email = $_POST["email"];
          $password = $_POST["password"];

          $sql = "SELECT id FROM users where  email = '$email'  and password = '$password' ";

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
  <title>login</title>
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
              <h4>Hello! Let's get started!</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post" action="" id="login-form">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="email" name="email" name="username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required>
                  <?php 
                      if($message != ''){
                        ?>
                        <div class="no-user">
                          <?php echo "incorrect details" ?>
                        </div>
                        <?php
                      }
                  ?>
                </div>
                <div class="mt-3">
                  <button type="submit" name="login-btn" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in!
                    </label>
                  </div>
                  <a href="forgot-pass.php" class="auth-link text-black">Forgot password?</a>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  CONTACT US!
                  <a href="contact.php" class="text-primary">Contact</a>
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


