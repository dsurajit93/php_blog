<?php
include_once "navbar.php";

if (isset($_POST['submit'])) {
  require_once "dbconfig.php";
  extract($_POST);
  $qry = "insert into user values(0,'$name','$dob','$gender',$mobile,'$email','$password',1)";
  if (mysqli_query($con, $qry)) {
    $_SESSION['msg'] = "Account have been created successfully. Sign in and enjoy Blogging";
    $_SESSION['code'] = 1;
    header("location:signin.php?code=1");
?>
  <?php
  } else {
    $_SESSION['msg'] = "Sorry Somthing Wrong !!! Please try Again.";
    $_SESSION['code'] = 0;
    //echo mysqli_error($con);
    //header("location:signup.php?code=0");
  ?>
    <script>
      //window.location = 'signup.php';
    </script>
<?php
  }
}
?>

<link rel="stylesheet" href="css/style-2.css">
<section class="sign-up">
  <div class="container ">
    <div class="row justify-content-center align-items-center ">
      <div class="col-md-6 text-center p-5 my-5 sign-up-form">
        <img src="image/avatar.png">
        <?php
        if (isset($_SESSION['code'])) {
          if ($_SESSION['code'] == 0) {
            echo "
                <div class='alert alert-danger text-center'>
                    $_SESSION[msg]<br>
                    <span class='text-muted'>Try with a different email or mobile number</span>
                </div>  
                ";
            unset($_SESSION['msg']);
            unset($_SESSION['code']);
          }
        }

        ?>
        <form action="" method="post" onsubmit="return validateUser();">
          <input type="text" name="name" id="uname" class="form-control my-2" placeholder="Name" required>
          <input type="date" name="dob" id="dob" class="form-control my-2" required>
          <label for="dob" id="error_dob" class="text-danger d-block text-left"></label>
          <div class="form-group">
            <label class="radio-label"><input type="radio" name="gender" value="Male" required>Male</label>
            <label class="radio-label"><input type="radio" name="gender" value="Female" required>Female</label>
          </div>
          <input type="tel" name="mobile" id="mobile" class="form-control my-2" placeholder="Mobile" required>
          <label for="mobile" id="error_mobile" class="text-danger d-block text-left"></label>
          <input type="email" name="email" id="email" class="form-control my-2" placeholder="Email" required>
          <label for="email" id="error_email" class="text-danger d-block text-left"></label>
          <input type="password" name="password" id="password" class="form-control my-2" placeholder="Password" required>
          <label for="password" id="error_password" class="text-danger d-block text-left"></label>
          <input type="password" name="password" id="cpassword" class="form-control my-2" placeholder="Confirm Password" required>
          <label for="cpassword" id="error_cpassword" class="text-danger d-block text-left"></label>
          <input type="submit" name="submit" value="Sign Up" class="btn btn-info form-control my-2">
        </form>
        <a href="signin.php" class="btn btn-light d-block">Already have an account? Sign In</a>
      </div>
    </div>
  </div>
</section>

<script src="js/user-main.js"></script>

<?php
include_once "footer.php";
?>