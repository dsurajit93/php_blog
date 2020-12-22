<?php
include_once "navbar.php";
require_once "dbconfig.php";

$id = $_GET['id'];

if (isset($_POST['submit'])) {
  extract($_POST);
  $qry = "select * from user where email='$_SESSION[email]' and password='$password'";
  //echo $qry;
  $result = mysqli_query($con, $qry);
  if (mysqli_num_rows($result) > 0) {
    $update_qry = "update user set password='$new_password' where id=$id";
    if (mysqli_query($con, $update_qry)) {
?>
      <script>
        alert("Please Login again to continue");
        window.location = 'logout.php';
      </script>
<?php
    } else {
      $_SESSION['msg'] = "Sorry !!! Something Wrong";
    }
  } else {
    $_SESSION['msg'] = "Old Password Does Not match";
  }
}

?>
<link rel="stylesheet" href="css/style-2.css">
<section class="sign-in">
  <div class="container">
    <div class="row justify-content-center align-items-center ">
      <div class="col-md-6 text-center p-5 my-5 sign-in-form">
        <span class="d-block font-weight-bold">Update Your Password</span>
        <?php
        if (isset($_SESSION['msg'])) {
          echo "
              <div class='alert alert-danger text-center'>
                  $_SESSION[msg]
              </div>  
              ";
          unset($_SESSION['msg']);
        }
        ?>
        <form action="" method="post">
          <input type="password" name="password" class="form-control my-2" placeholder="Current Password" required>
          <input type="password" name="new_password" class="form-control my-2" placeholder="New Password" required>
          <input type="password" name="confirm_password" class="form-control my-2" placeholder="Confirm New Password" required>
          <input type="submit" name='submit' value="Update Password" class="btn btn-info form-control my-2">
        </form>
      </div>
    </div>
  </div>
</section>

<?php
include_once "footer.php";
?>