<?php
require_once "../dbconfig.php";
$qry_blog = "select count(*) as blog from blogs";
$qry_blogger = "Select count(*) as blogger from user";
$qry_report = "select count(*) as rc from reports where status=0";

$res_blogger = mysqli_query($con, $qry_blogger);
$res_blog = mysqli_query($con, $qry_blog);
$res_report = mysqli_query($con, $qry_report);


$blog = mysqli_fetch_assoc($res_blog);
$blog_count = $blog['blog'];

$blogger = mysqli_fetch_assoc($res_blogger);
$blogger_count = $blogger['blogger'];

$report = mysqli_fetch_assoc($res_report);
$report_count = $report['rc'];

?>

<div class="card text-center bg-primary text-white mb-3">
  <div class="card-body">
    <h3>Bloggers</h3>
    <h4 class="display-4">
      <i class="fas fa-users"></i> <?php echo $blogger_count; ?>
    </h4>
    <a href="blogger_list.php" class="btn btn-outline-light btn-sm">Details</a>
  </div>
</div>

<div class="card text-center bg-info text-white mb-3">
  <div class="card-body">
    <h3>Blogs</h3>
    <h4 class="display-4">
      <i class="fas fa-pencil-alt"></i> <?php echo $blog_count; ?>
    </h4>
    <a href="blog_list.php" class="btn btn-outline-light btn-sm">Details</a>
  </div>
</div>

<div class="card text-center bg-warning text-white mb-3">
  <div class="card-body">
    <h3>Reports</h3>
    <h4 class="display-4">
      <i class="fa fa-question" aria-hidden="true"></i> <?php echo $report_count; ?>
    </h4>
    <a href="report_list.php" class="btn btn-outline-light btn-sm">Details</a>
  </div>
</div>