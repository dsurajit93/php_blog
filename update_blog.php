<?php
require_once "navbar.php";
require_once "dbconfig.php";

$id = $_GET['id'];

if (isset($_POST['update'])) {
  $title = $_POST['blog_title'];
  $catagory = $_POST['blog_catagory'];
  $tags = $_POST['blog_tag'];
  $blog = $_POST['blog'];

  $qry = "update blogs set blog_title='$title',blog_catagory='$catagory',blog_tag='$tags',blog_content='$blog',updated=1 where id=$id";

  if (mysqli_query($con, $qry)) {
?>
    <script>
      window.location = "blog_details.php?blogid=<?php echo $id ?>";
    </script>
<?php
  } else {
    $_SESSION['blog_msg'] = "Something Wrong. Please try again later";
    echo mysqli_error($con);
  }
}

$qry = "select * from blogs where id=$id";
$res = mysqli_query($con, $qry);
if (mysqli_num_rows($res) < 1)
  header("location:user_home.php");
$blog = mysqli_fetch_assoc($res);
?>

<link rel="stylesheet" href="css/style-2.css">
<section id="add_blog">
  <div class="container add_blog">
    <div class="row">
      <div class="col my-5 p-3">
        <?php
        if (isset($_SESSION['blog_msg'])) {
          echo "<div class='alert alert-danger'>$_SESSION[blog_msg]</div>";
          unset($_SESSION['blog_msg']);
        }
        ?>
        <form action="" method="POST">
          <div class="form-group">
            <label for="title">Add Title<span class="required">*</span></label>
            <input type="text" name="blog_title" id="" class="form-control" required value="<?php echo $blog['blog_title']; ?>">
          </div>

          <div class="form-group">
            <label for="catagory">Select Catagory<span class="required">*</span></label>
            <select name="blog_catagory" id="" class="form-control" required>
              <option value="Education" <?php if ($blog['blog_catagory'] == "Education") echo "selected"; ?>>Education</option>
              <option value="Food" <?php if ($blog['blog_catagory'] == "Food") echo "selected"; ?>>Food</option>
              <option value="Health" <?php if ($blog['blog_catagory'] == "Health") echo "selected"; ?>>Health</option>
              <option value="Review" <?php if ($blog['blog_catagory'] == "Review") echo "selected"; ?>>Review</option>
              <option value="Sports" <?php if ($blog['blog_catagory'] == "Sports") echo "selected"; ?>>Sports</option>
              <option value="Technology" <?php if ($blog['blog_catagory'] == "Technology") echo "selected"; ?>>Technology</option>
              <option value="Travel" <?php if ($blog['blog_catagory'] == "Travel") echo "selected"; ?>>Travel</option>
              <option value="Other" <?php if ($blog['blog_catagory'] == "Other") echo "selected"; ?>>Other</option>
            </select>
          </div>

          <div class="form-group">
            <label for="tag">Add Tag (Optional) </label>
            <span class='text-muted d-block'>Eg: COVID19 MovieReview ProductReview etc </span>
            <input type="text" name="blog_tag" id="" class="form-control" value="<?php echo $blog['blog_tag']; ?>">
          </div>

          <div class="form-group">
            <label for="blog">Your Blog<span class="required">*</span></label>
            <textarea id="editor" name="blog" required><?php echo $blog['blog_content']; ?></textarea>
          </div>

          <input type="submit" name="update" value="Update" class="btn btn-info">

        </form>
      </div>
    </div>
  </div>
</section>
<?php
include_once "footer.php";
?>

<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');
</script>