<?php include('core/database.php') ?>

<?php  

  if (isset($_POST)) {
    if (isset($_POST['submit-btn']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ) {
      if (isset($_POST['username'])!="" && isset($_POST['email'])!="" && isset($_POST['password']) ) {
        
        $conn=getConnection();
        if ($conn==false) {
          echo "databse connection error";
        }else{
          $username=$_POST['username'];
          $email=$_POST['email'];
          $password=$_POST['password'];

          $sql="INSERT INTO users (username,email,password) VALUES('$username','$email','$password') " ;
          if (mysqli_query($conn,$sql)) {
            header('location:login-2.php');
          }else{echo "error";}
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
  <title>Miller Register</title>

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
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps.</h6>

              <form class="pt-3" action="" method="post" id="register-form">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Enter Username" name="username" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter Email" name="email" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder=" Enter Password" name="password" required>
                </div>
                <div class="form-group">
                  <input type="confirm-password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder=" Confirm Password" name="password" required>
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class=" text-left form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" required>
                      I agree to all Terms & Conditions.
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit-btn" >Sign Up</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login-2.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 
  <?php include("partials/scripts.php"); ?>


  <script>
    $(document).ready(function(){
       $("#register-form").validate({
        submitHandler: function(form) {
          form.submit();
        }
       });
    });
      </script>

</body>

</html>
