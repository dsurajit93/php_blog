<?php
require_once "navbar.php";
require_once "dbconfig.php";

$id = $_GET['id'];

if (isset($_POST['submit'])) {
  extract($_POST);
  $qry = "update user set name= '$name', gender='$gender', dob='$dob', mobile=$mobile, email='$email' where id=$id";

  if (mysqli_query($con, $qry)) {
?>
    <script>
      window.location = "user_profile.php";
    </script>
  <?php
  } else {
    $_SESSION['msg'] = "Sorry !!! Something Wrong.";
  ?>
    <script>
      window.location = "update_profile.php?code=0";
    </script>
<?php
  }
}

$qry = "select * from user where id=$id";
$res = mysqli_query($con, $qry);
if (mysqli_num_rows($res) > 0) {
  $user = mysqli_fetch_assoc($res);
} else {
  die();
}
?>

<link rel="stylesheet" href="css/style-2.css">
<section class="sign-up">
  <div class="container ">
    <div class="row justify-content-center align-items-center ">
      <div class="col-md-6 text-center p-5 my-5 sign-up-form">
        <img src="image/avatar.png">
        <span class='d-block font-weight-bold text-center'>Update Your Basic Info</span>
        <?php
        if (isset($_GET['code'])) {
          if ($_GET['code'] == 0) {
            echo "
          <div class='alert alert-danger text-center'>
              $_SESSION[msg]<br>
          </div>  
          ";
            unset($_SESSION['msg']);
          }
        }

        ?>
        <form action="" method="post">
          <input type="text" name="name" class="form-control my-2" value="<?php echo $user['name']; ?>" required>
          <input type="date" name="dob" class="form-control my-2" value="<?php echo $user['dob']; ?>" required>
          <div class="form-group">
            <label class="radio-label"><input type="radio" name="gender" value="Male" <?php if ($user['gender'] == 'Male') echo 'checked'; ?> required>Male</label>
            <label class="radio-label"><input type="radio" name="gender" value="Female" <?php if ($user['gender'] == 'Female') echo 'checked'; ?> required>Female</label>
          </div>
          <input type="tel" name="mobile" class="form-control my-2" value="<?php echo $user['mobile']; ?>" required>
          <input type="email" name="email" class="form-control my-2" value="<?php echo $user['email']; ?>" required>
          <input type="submit" name="submit" value="Update" class="btn btn-info form-control my-2">
        </form>
      </div>
    </div>
  </div>
</section>

<?php
require_once "footer.php";
?>