<?php
include_once "navbar.php";
require_once "../dbconfig.php";
$qry = "";
if (isset($_GET['blogger_email'])) {
  $qry = "select * from user where email='$_GET[blogger_email]'";
} else {
  $qry = "select * from user";
}

$res = mysqli_query($con, $qry);

/*if(mysqli_num_rows($res)>0){
    
  }*/
?>

<section class="blogger-list">
  <div class="container">
    <div class="row my-3">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>Bloggers</h4>
          </div>
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($blogger = mysqli_fetch_assoc($res)) {
                $btn_txt = "";
                $btn_class = "";
                if ($blogger['status'] == 1) {
                  $btn_txt = "Active";
                  $btn_class = "btn btn-success";
                } else {
                  $btn_txt = "Blocked";
                  $btn_class = "btn btn-danger";
                }
                echo "
                    <tr>
                      <td><a href='blogger_details.php?blogger_email=$blogger[email]'>$blogger[name]</a></td>
                      <td>$blogger[mobile]</td>
                      <td>$blogger[email]</td>
                      <td><a href='block_toggle.php?id=$blogger[id]&status=$blogger[status]' class='$btn_class'>
                       $btn_txt
                    </a>
                    </tr>
                  ";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-3">
        <?php include_once "panel.php"; ?>
      </div>
    </div>
  </div>
</section>