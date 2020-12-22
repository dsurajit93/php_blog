<?php
require_once "navbar.php";
require_once "../dbconfig.php";
?>

<link rel="stylesheet" href="../css/style-2.css">
<div class="container blogs">
  <div class="row">
    <div class="col-md-3 px-2 mt-3  catagory">
      <?php include_once "blog_report.php"; ?>
    </div>

    <div class="col-md-6 p-1">
      <?php
      $qry = "select * from blogs order by blogged_at desc";
      $res = mysqli_query($con, $qry);
      while ($blog = mysqli_fetch_assoc($res)) {
      ?>
        <div class="card my-3">
          <div class="card-header">
            <h4 class="card-title">
              <?php
              echo $blog['blog_title'];
              ?>
            </h4>
            <h6 class="card-subtitle text-muted">
              <?php
              if ($blog['updated'] == 0)
                echo "$blog[blogger_name] Posted on: " . $blog['blogged_at'];
              else
                echo "$blog[blogger_name] Updated on: " . $blog['updated_at'];
              ?>
            </h6>
          </div>
          <div class="card-body">
            <?php
            if ($blog['blog_image'] != "") {
              echo "<img src=../image/blog_img/$blog[blog_image] class='d-block mx-auto'>";
            }
            ?>
            <div class="card-text  text-justify mb-2 border-bottom" style="height: 150px; overflow: hidden; text-overflow: ellipsis;">
              <?php
              echo $blog['blog_content'];
              ?>
            </div>
            <span class="text-muted mt-2"><?php echo $blog['like_count'] ?> Likes <?php echo $blog['comment_count'] ?> Comments</span>
            <a class="btn btn-outline-info float-right" href="<?php echo "blog_details.php?blog=$blog[blog_title]&id=$blog[id]" ?>">Read More</a>
          </div>
        </div>
      <?php
      }
      ?>

    </div>

    <div class="col-md-3 mt-3 p-1">
      <?php include_once "panel.php"; ?>
    </div>


  </div>
</div>