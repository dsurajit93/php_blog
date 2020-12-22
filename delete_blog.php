<?php
require_once "dbconfig.php";
$id = $_GET['id'];
$qry1 = "delete from blogs where id=$id";
$qry2 = "delete from comments where blog_id=$id";
$qry3 = "delete from likes where blog_id=$id";

if (mysqli_query($con, $qry1)) {
  if (mysqli_query($con, $qry2)) {
    if (mysqli_query($con, $qry3)) {
?>
      <script>
        window.location = "user_home.php";
      </script>
<?php
    } else {
      echo "sorry !! Something wrong" . mysqli_error($con);
    }
  } else {
    echo "sorry !! Something wrong" . mysqli_error($con);
  }
} else {
  echo "sorry !! Something wrong" . mysqli_error($con);
}
?>