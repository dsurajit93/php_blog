<?php
require_once "navbar.php";
require_once "dbconfig.php";
?>

<link rel="stylesheet" href="css/style-2.css">
<div class="container blogs">
  <div class="row">
    <div class="col-md-8 p-1">
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
              if ($blog['blogger_name'] == $_SESSION['name'])
                echo "You have ";
              else
                echo $blog['blogger_name'] . " have";

              if ($blog['updated'] == 0)
                echo " Posted on: " . $blog['blogged_at'];
              else
                echo " Updated on: " . $blog['updated_at'];
              ?>
            </h6>
          </div>
          <div class="card-body">
            <?php
            if ($blog['blog_image'] != "") {
              echo "<img src=image/blog_img/$blog[blog_image] class='d-block mx-auto'>";
            }
            ?>
            <div class="card-text  text-justify mb-2 border-bottom" style="height: 150px; overflow: hidden; text-overflow: ellipsis;">
              <?php
              echo $blog['blog_content'];
              ?>
            </div>
            <span class="text-muted mt-2"><?php echo $blog['like_count'] ?> Likes <?php echo $blog['comment_count'] ?> Comments</span>
            <a class="btn btn-outline-info float-right" href="<?php echo "blog_details.php?blog=$blog[blog_title]&blogid=$blog[id]" ?>">Read More</a>
          </div>
        </div>
      <?php
      }
      ?>

    </div>

    <div class="col-md-4 px-2 mt-3 d-none d-lg-block catagory">
      <div>
        <?php
        $qry_count = "select blog_catagory,count(*) as total from blogs group by blog_catagory order by blog_catagory;";
        $res_count = mysqli_query($con, $qry_count);
        while ($cc = mysqli_fetch_assoc($res_count)) {
        ?>
          <span class="d-block bg-info rounded my-2 px-2 py-1"><a href="blog_catagory.php?catagory=<?php echo $cc['blog_catagory']; ?>" style="color: white;"><?php echo $cc['blog_catagory'] . " ( " . $cc['total'] . " )";  ?></a></span>
        <?php
        }
        ?>
      </div>
      <div class="populer">
        <h5 class="display-5 text-center mt-2 border-bottom p-1">Populer Blogs</h3>
          <?php
          $qry_pop = "SELECT id,blog_title,blog_content,comment_count,like_count,(sum(comment_count)+sum(like_count)) as popularity from blogs group by blog_title order by popularity DESC limit 3";
          $res_pop = mysqli_query($con, $qry_pop);
          while ($pop = mysqli_fetch_assoc($res_pop)) {
          ?>
            <div class="card my-3 ">
              <div class="card-header">
                <p class="card-title font-weight-bold">
                  <?php
                  echo "<a href='blog_details.php?blog=$pop[blog_title]&blogid=$pop[id]' class='text-primary' > $pop[blog_title] </a>";
                  ?>
                </p>
              </div>
              <div class="card-body">
                <div class="card-text  text-justify" style="height: 75px; overflow: hidden; text-overflow: ellipsis;">
                  <?php
                  echo $pop['blog_content'];
                  ?>
                </div>

              </div>
              <span class="mx-auto mb-1 pop bg-info text-center text-white p-1  rounded">
                <i class='fa fa-thumbs-up'></i> <?php echo $pop['like_count']; ?>
                <i class="fa fa-comments-o"></i> <?php echo $pop['comment_count']; ?>
              </span>
            </div>

          <?php
          }
          ?>
      </div>
    </div>
  </div>
</div>