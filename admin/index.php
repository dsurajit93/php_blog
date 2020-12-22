<?php
require_once "navbar.php";
?>

<?php
if (isset($_POST['submit'])) {
  require_once "../dbconfig.php";
  extract($_POST);
  $qry = "select * from admin where email='$email' and password='$password'";
  $result = mysqli_query($con, $qry);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $email;
    header("location:dashboard.php");
?>
    <script>
      //  window.location='user_home.php';
    </script>
  <?php
  } else {
    $_SESSION['msg'] = "Invalid username or password";
    $_SESSION['code'] = 0;
    //header("location:index.php");
  ?>
    <script>
      //window.location='signin.php';
    </script>
<?php
  }
}

?>
<link rel="stylesheet" href="../css/admin-style.css">
<section class="sign-in">
  <div class="container">
    <div class="row justify-content-center align-items-center ">
      <div class="col-md-6 text-center px-5 pb-5 my-5 sign-in-form border border-dark rounded">
        <img src="../image/aa.jpg">
        <h6 class="display-4">Administrative Login</h6>
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
        <form action="" method="post">
          <input type="email" name="email" class="form-control my-2" placeholder="Email" required>
          <input type="password" name="password" class="form-control my-2" placeholder="Password" required>
          <input type="submit" name='submit' value="Sign In" class="btn btn-info form-control my-2">
        </form>
      </div>
    </div>
  </div>
</section>