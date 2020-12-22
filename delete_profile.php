<?php
require_once "navbar.php";
require_once "dbconfig.php";

$err_msg = "";

if (isset($_POST['delete'])) {
  $feedback = $_POST['feedback'];
  if ($feedback == 'Other' && !isset($_POST['other_txt'])) {
    $err_msg = "Please mention a reason";
  } else {
    if (isset($_POST['other_txt']))
      $feedback = $_POST['other_txt'];
    $qry = "select mobile from user where email='$_SESSION[email]'";
    $res = mysqli_query($con, $qry);
    $data = mysqli_fetch_assoc($res);
    $mob = $data['mobile'];

    $qry = "insert into feedback values(0,'$_SESSION[name]',$mob,'$_SESSION[email]','$feedback')";
    if (mysqli_query($con, $qry)) {
      if (mysqli_query($con, "delete from user where email='$_SESSION[email]'")) {
?>
        <script>
          window.location = "logout.php";
        </script>
<?php
      } else {
        echo mysqli_error($con);
        mysqli_rollback($con);
      }
    }
  }
}

?>

<section>
  <div class="container">
    <div class="row justify-content-center align-items-center ">
      <div class="col-md-6 text-center p-5 my-5 border border-dark rounded">
        <form action="" class="form-group text-left" method="post">
          <input type="radio" name="feedback" id="" class="mr-1" value="Website is not so helpful" required>Website is not so helpful.<br>
          <input type="radio" name="feedback" id="" class="mr-1" value="There are some security issue in the website" required>There are some security issue in the website.<br>
          <input type="radio" name="feedback" id="" class="mr-1" value="I don't want to say" required>I don't want to say<br>
          <input type="radio" name="feedback" id="other" class="mr-1" value="Other" required>Other<br>
          <textarea name="other_txt" id="other_txt" class="form-control my-2" placeholder="Please mention a reason if you are selecting other"></textarea>
          <span id="err_msg" class="text-danger"><?php echo $err_msg; ?></span>
          <input type="submit" name="delete" value="Delete My Account" class="form-control btn btn-warning">
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  // A $( document ).ready() block.
  $(document).ready(function() {
    $('#other_txt').hide();
  });

  $('input[name="feedback"]').on('change', function() {
    if ($('input[name="feedback"]:checked').val() == 'Other') {
      $('#other_txt').show();
    } else {
      $('#other_txt').hide();
    }

  });
</script>