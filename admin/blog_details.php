<?php
require_once "navbar.php";
require_once "../dbconfig.php";
$id = $_GET['id'];
?>


<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12 my-3 p-3">
        <?php

        $qry = "select * from blogs where id= $id";
        $res = mysqli_query($con, $qry);
        $blog = mysqli_fetch_assoc($res);
        ?>

        <h4><?php echo $blog['blog_title']; ?></h4>
        <sapn class="d-block text-muted"><?php echo $blog['blogger_name'] . " posted on " . $blog['blogged_at'];   ?> </sapn>
        <p>Popular Tags: <?php echo $blog['blog_tag']; ?>

          <a href="delete_blog.php?id=<?php echo $blog['id']; ?>" class="text-danger mx-2 float-right" onclick="return confirm('Do you realy wants to delete the blog? ');">Delete</a>
          <hr>
          <?php
          if ($blog['blog_image'] != "") {
          ?>
            <img src="../image/blog_img/<?php echo $blog['blog_image']; ?>" class="d-block mx-auto img-fluid img-thumbnail">
          <?php } ?>
          <div class="text-justify my-3"><?php echo $blog['blog_content'] ?></div>
          <hr>
          <span class="text-muted mt-2"><?php echo $blog['like_count'] ?> Likes <?php echo $blog['comment_count'] ?> Comments</span>
          <!-- -->
      </div>
    </div>
  </div>
</section>

<section class="comments">
  <div class="container">
    <div class="row">
      <div class="col-md-6 my-5">
        <label for="comments" class="d-block font-weight-bold border-bottom">Comments</label>
        <?php
        if ($blog['comment_count'] > 0) {
          $qry_comment = "select * from comments where blog_id=$id order by commented_at";
          $res_comment = mysqli_query($con, $qry_comment);
          while ($cmnt = mysqli_fetch_assoc($res_comment)) {
        ?>
            <div class="bg-light rounded text-justify my-3 p-2">
              <span class="font-weight-bold"><?php echo $cmnt['blogger_name']; ?></span>
              <?php echo $cmnt['comment']; ?>
            </div>
        <?php
          }
        }
        ?>
      </div>
      <div class="col-md-6 my-5">
        <label for="comments" class="d-block font-weight-bold border-bottom">Allegations</label>
        <?php
        $qry_report = "select * from reports where blog_id=$id order by id desc";
        $res_report = mysqli_query($con, $qry_report);
        while ($report = mysqli_fetch_assoc($res_report)) {
        ?>
          <div class="bg-light rounded text-justify my-3 p-2">
            <span class="font-weight-bold">
              <?php echo "<a href='blogger_details.php?blogger_email=$report[reported_by_email]'>" . $report['reported_by'] . "</a>"; ?>
            </span>
            <?php
            echo $report['reason'];
            if ($report['status'] == 1)
              echo "<span class='bg-success text-muted mx-2 p-1 rounded'>Solved</span>";
            else {
              echo "<span class='bg-warning text-muted mx-2 p-1 rounded'>Pending</span>";
            }
            ?>

          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script>

</script>