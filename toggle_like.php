<?php
include_once "dbconfig.php";
$blog_id = $_POST['blog_id'];
$blogger_email = $_POST['blogger_email'];

//$blog_id=$_GET['blog_id'];
//$blogger_email=$_GET['blogger_email'];


$qry = "select * from likes where blogger_email='$blogger_email' and blog_id=$blog_id";
echo $qry;
$res = mysqli_query($con, $qry) or die(mysqli_error($con));
if (mysqli_num_rows($res) > 0) {
  $qry1 = "update blogs set like_count=like_count-1 where id=$blog_id";
  $qry2 = "delete from likes where blogger_email='$blogger_email' and blog_id=$blog_id";
  if (mysqli_query($con, $qry2)) {
    if (mysqli_query($con, $qry1)) {
      return true;
    } else {
      return false;
    }
  }
} else {
  $qry1 = "update blogs set like_count=like_count+1 where id=$blog_id";
  echo $qry1;
  $qry2 = "insert into likes values(0,'$blogger_email',$blog_id,CURRENT_TIMESTAMP)";
  if (mysqli_query($con, $qry2)) {
    if (mysqli_query($con, $qry1)) {
      return true;
    } else {
      return false;
    }
  }
}
