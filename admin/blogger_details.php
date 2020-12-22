<?php
require_once "navbar.php";
require_once "../dbconfig.php";

$qry_user = "select * from user where email='$_GET[blogger_email]'";
$qry_blog = "select * from blogs where blogger_email='$_GET[blogger_email]' order by blogged_at desc";

$res_user = mysqli_query($con, $qry_user);
$res_blog = mysqli_query($con, $qry_blog);

$user = mysqli_fetch_assoc($res_user);

$btn_txt = "";
$btn_class = "";
if ($user['status'] == 1) {
  $btn_txt = "Active";
  $btn_class = "btn btn-sm btn-success";
} else {
  $btn_txt = "Blocked";
  $btn_class = "btn btn-sm btn-danger";
}

?>
<link rel="stylesheet" href="../css/style-2.css">
<section class="profile">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <table class="table">
          <thead>
            <tr>
              <th>Blogger's Profile</th>
              <th class="text-right">
                <?php
                echo "<a href='block_toggle.php?id=$user[id]&status=$user[status]' class='$btn_class'>$btn_txt</a>";
                ?>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Name</td>
              <td><?php echo $user['name'] ?></td>
            </tr>
            <tr>
              <td>DOB</td>
              <td><?php echo $user['dob'] ?></td>
            </tr>
            <tr>
              <td>Gender</td>
              <td><?php echo $user['gender'] ?></td>
            </tr>
            <tr>
              <td>Mobile</td>
              <td><?php echo $user['mobile'] ?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><?php echo $user['email'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-8 blogs">
        <?php
        while ($blog = mysqli_fetch_assoc($res_blog)) {
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
                  echo $blog['blogger_name'] . " Posted on: " . $blog['blogged_at'];
                else
                  echo $blog['blogger_name'] . " Updated on: " . $blog['updated_at'];
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

              <span class="text-muted mt-2"><?php echo $blog['like_count']; ?> Likes <?php echo $blog['comment_count'] ?> Comments</span>
              <a class="btn btn-outline-info float-right" href="<?php echo "blog_details.php?blog=$blog[blog_title]&id=$blog[id]"; ?>">Read More</a>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>