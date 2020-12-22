<?php
require_once "../dbconfig.php";
$id = $_GET['id'];
$status = $_GET['status'];

$qry = "";
if ($status == 1)
  $qry = "update reports set status=0 where id=$id";
else
  $qry = "update reports set status=1 where id=$id";
echo $qry;
if (mysqli_query($con, $qry)) {
  header("location:report_list.php");
} else {
  echo mysqli_error($con);
}
