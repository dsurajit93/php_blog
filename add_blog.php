<?php
include_once "navbar.php";

if (isset($_POST['submit'])) {
  include_once("dbconfig.php");
  extract($_POST);
  if (empty($blog_tag))
    $blog_tag = " ";
  if (empty($_FILES['blog_image']['name']))
    $blog_image_name = "";
  else {
    $file = $_FILES['blog_image'];
    $file_name = $file['name'];
    $temp = explode(".", $file_name);
    $blog_image_name = round(microtime(true)) . "." . end($temp);
    $path = "image/blog_img/" . $blog_image_name;
    move_uploaded_file($file['tmp_name'], $path);
  }

  $blog = str_replace("'", "''", $blog);

  $qry = "insert into blogs values(0,'$_SESSION[name]','$_SESSION[email]','$blog_title','$blog_catagory','$blog_tag','$blog_image_name','$blog',CURRENT_TIMESTAMP,NULL,0,0,0)";
  //echo $qry;
  if (!mysqli_query($con, $qry)) {
    $_SESSION['blog_msg'] = "Something Wrong. Please try again later";
    echo mysqli_error($con);
  } else {
    header("location:user_home.php");
  }
}

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
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateBlog();">
          <div class="form-group">
            <label for="title">Add Title<span class="required">*</span></label>
            <input type="text" name="blog_title" id="" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="catagory">Select Catagory<span class="required">*</span></label>
            <select name="blog_catagory" id="" class="form-control" required>
              <option value="Education">Education</option>
              <option value="Food">Food</option>
              <option value="Health">Health</option>
              <option value="Review">Review</option>
              <option value="Sports">Sports</option>
              <option value="Technology">Technology</option>
              <option value="Travel">Travel</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label for="tag">Add Tag (Optional) </label>
            <span class='text-muted d-block'>Eg: COVID19 MovieReview ProductReview etc </span>
            <input type="text" name="blog_tag" id="" class="form-control">
          </div>

          <div class="form-group">
            <label for="file">Add Photo (Optional)</label>
            <input type="file" id="file" name="blog_image" class="form-control-file">
            <small class="form-text text-muted" id="fileHelp">Max 1mb size</small>
          </div>

          <div class="form-group">
            <label for="blog">Your Blog<span class="required">*</span></label>
            <textarea id="editor" name="blog" required></textarea>
            <label for="editor" id="error_editor" class="text-danger d-block text-left"></label>
          </div>

          <input type="submit" name="submit" value="POST" class="btn btn-info">

        </form>
      </div>
    </div>
  </div>
</section>
<?php
include_once "footer.php";
?>

<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

<script src="js/user-main.js"></script>
<script>
  CKEDITOR.replace('editor');

  function validateBlog() {
    $blog = CKEDITOR.instances.editor.getData();
    if ($blog == "" || $blog == null) {
      document.getElementById("error_editor").innerHTML = "Please add some content";
      return false;
    }
  }
</script>