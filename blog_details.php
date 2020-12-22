<?php
require_once "navbar.php";
require_once "dbconfig.php";
$id = $_GET['blogid'];
//$title=$_GET['blog'];

if (isset($_POST['post_comment'])) {
  extract($_POST);
  $comment_content = str_replace("'", "''", $comment_content);
  $qry = "insert into comments values(0,'$_SESSION[name]','$_SESSION[email]',$id,'$comment_content',CURRENT_TIMESTAMP)";
  $qry2 = "update blogs set comment_count=comment_count+1 where id=$id";
  if (mysqli_query($con, $qry)) {
    if (mysqli_query($con, $qry2)) {
?>
      <script>
        window.location = "blog_details.php?blog=<?php echo $title ?>&blogid=<?php echo $id ?>";
      </script>
<?php
    } else {
      echo mysqli_error($con);
    }
  }
}


if (isset($_POST['report'])) {
  $qry = "insert into reports values(0,$id,'$_SESSION[name]','$_SESSION[email]','$_POST[report_reason]',0)";
  if (!mysqli_query($con, $qry)) {
    echo mysqli_error($con);
  }
}
?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12 my-3 p-3">
        <?php

        $qry = "select * from blogs where id= $id";
        $qry_like = "select * from likes where blog_id=$id and blogger_email='$_SESSION[email]'";
        $qry_report = "select * from reports where blog_id=$id and reported_by_email='$_SESSION[email]'";

        $res = mysqli_query($con, $qry);
        $res_like = mysqli_query($con, $qry_like);
        $res_report = mysqli_query($con, $qry_report) or die(mysqli_error($con));

        $blog = mysqli_fetch_assoc($res);
        ?>

        <h4><?php echo $blog['blog_title']; ?></h4>
        <sapn class="d-block text-muted"><?php echo $blog['blogger_name'] . " posted on " . $blog['blogged_at'];   ?> </sapn>
        <p>Popular Tags: <?php echo $blog['blog_tag']; ?>
          <?php
          if ($blog['blogger_name'] == $_SESSION['name']) {
          ?>
            <a href="delete_blog.php?id=<?php echo $blog['id']; ?>" class="text-danger mx-2 float-right" onclick="return confirm('Do you realy wants to delete the blog? ');">Delete</a>
            <a href="update_blog.php?id=<?php echo $blog['id']; ?>" class="text-info mx-2 float-right">Edit</a>
          <?php
          }
          ?>
          <hr>
          <?php
          if ($blog['blog_image'] != "") {
          ?>
            <img src="image/blog_img/<?php echo $blog['blog_image']; ?>" class="d-block mx-auto img-fluid img-thumbnail">
          <?php } ?>
          <div class="text-justify my-3"><?php echo $blog['blog_content'] ?></div>
          <hr>
          <span class="text-muted mt-2"><?php echo $blog['like_count'] ?> Likes <?php echo $blog['comment_count'] ?> Comments</span>

          <?php
          $btn_text = "";
          $btn_class = "";
          $tooltip_title = "";
          if (mysqli_num_rows($res_like) > 0) {
            $btn_class = 'btn btn-primary float-right mx-2';
            $btn_text = "<i class='fa fa-thumbs-up'></i>";
            $tooltip_title = "You liked this blog";
          } else {
            $btn_class = "btn btn-outline-primary float-right mx-2";
            $btn_text = "Like this Blog <i class='fa fa-thumbs-up'></i>";
          }

          $rbt = "";
          $rbc = "";
          $extra = "";
          if (mysqli_num_rows($res_report) > 0) {
            $rbt = "<i class='fa fa-ban'></i>";
            $rbc = "btn btn-warning float-right";
            $extra = "data-toggle='tooltip' data-placement='top' title='You have reported this blog'";
          } else {
            $rbt = "Report this Blog <i class='fa fa-ban'></i>";
            $rbc = "btn btn-outline-warning float-right";
            $extra = "data-toggle='modal' data-target='#reportModal'";
          }
          ?>

          <a class="<?php echo $rbc; ?>" <?php echo $extra; ?>><?php echo $rbt; ?></a>

          <a class="<?php echo $btn_class; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip_title; ?>" onclick="toggleLike('<?php echo $_SESSION['email']; ?>',<?php echo $id; ?>)"><?php echo $btn_text; ?></a>


          <!-- -->
      </div>
    </div>
  </div>
</section>

<section class="comments">
  <div class="container">
    <div class="row">
      <div class="col my-5">
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
        <form action="" method="post">
          <!--<label for="you" class="font-weight-bold">You</label>-->
          <textarea name="comment_content" id="comment" class="form-control" placeholder="Say someting about this blog" required></textarea>
          <input type="submit" value="Submit" name="post_comment" class="btn btn-info my-2">
        </form>
      </div>
    </div>
  </div>
</section>

<div class="modal" id="reportModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please Select A Reason</h5>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <input type="radio" name="report_reason" id="" value="This is a Meaningless blog" required> This is a Meaningless blog<br>
          <input type="radio" name="report_reason" id="" value="Blog is targatd to specific cast or community" required> Blog is targatd to specific cast or community<br>
          <input type="radio" name="report_reason" id="" value="Content of the blog is copid from other website" required> Content of the blog is copid from other website<br>
          <input type="radio" name="report_reason" id="" value="Other" required> Other <br>
        </div>
        <div class="modal-footer">
          <p class="d-block text-muted">Note: Make sure, your reason is valid. Else we will take necessary steps against your account</p>
          <input type="submit" class="btn btn-warning" name="report" value="Report">
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


<script>
  $('[data-toggle="tooltip"]').tooltip();

  function toggleLike(bloggerEmail, blogId) {
    $.ajax({
      type: 'POST',
      url: 'toggle_like.php',
      data: {
        blogger_email: bloggerEmail,
        blog_id: blogId
      },
      success: function(msg) {
        if (msg) {
          location.reload(true);
        } else {
          alert("Something Wrong. Please try again");
        }

      }
    });
  }
</script>

<?php
include_once "footer.php";
?>