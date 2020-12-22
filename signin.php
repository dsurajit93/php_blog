<?php
include_once "navbar.php";


if (isset($_POST['submit'])) {
  require_once "dbconfig.php";
  extract($_POST);
  $qry = "select * from user where email='$email' and password='$password' and status=1";
  $result = mysqli_query($con, $qry);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $data['name'];
    //header("location:user_home.php");
?>
    <script>
      window.location = 'user_home.php';
    </script>
  <?php
  } else {
    $_SESSION['msg'] = "Invalid username or password";
    $_SESSION['code'] = 0;
    //header("location:signin.php?code=0");
  ?>
    <script>
      //window.location='signin.php';
    </script>
<?php
  }
}

?>
<link rel="stylesheet" href="css/style-2.css">
<section class="sign-in">
  <div class="container">
    <div class="row justify-content-center align-items-center ">
      <div class="col-md-6 text-center p-5 my-5 sign-in-form">
        <img src="image/avatar.png">
        <?php
        if (isset($_SESSION['code'])) {
          if ($_SESSION['code'] == 1) {
            echo "
              <div class='alert alert-success text-center'>
                  $_SESSION[msg]
              </div>  
              ";
          } else if ($_SESSION['code'] == 0) {
            echo "
              <div class='alert alert-danger text-center'>
                  $_SESSION[msg]
              </div>  
              ";
          }
          unset($_SESSION['msg']);
          unset($_SESSION['code']);
        }
        ?>
        <form action="signin.php" method="post">
          <input type="email" name="email" class="form-control my-2" placeholder="Email" required>
          <input type="password" name="password" class="form-control my-2" placeholder="Password" required>
          <input type="submit" name='submit' value="Sign In" class="btn btn-info form-control my-2">
        </form>
        <a href="signup.php" class="btn btn-light d-block">New User? Create an Account. It's Free.</a>
      </div>
    </div>
  </div>
</section>

<?php
include_once "footer.php";
?>