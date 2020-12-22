<?php
require_once "../dbconfig.php";
$id = $_GET['id'];
$status = $_GET['status'];

$qry = "";
if ($status == 1)
  $qry = "update user set status=0 where id=$id";
else
  $qry = "update user set status=1 where id=$id";

if (mysqli_query($con, $qry)) {
  header("location:blogger_list.php");
} else {
  echo mysqli_error($con);
}
