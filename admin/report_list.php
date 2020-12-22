<?php
include_once "navbar.php";
require_once "../dbconfig.php";
$qry = "select * from reports";


$res = mysqli_query($con, $qry);

/*if(mysqli_num_rows($res)>0){
    
  }*/
?>

<section class="report-list">
  <div class="container">
    <div class="row my-3">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>Blog with Reports</h4>
          </div>
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th>Blog</th>
                <th>Reported By</th>
                <th>Reason</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($report = mysqli_fetch_assoc($res)) {
                $qry_blog = "select blog_title from blogs where id=$report[blog_id]";
                $res_blog = mysqli_query($con, $qry_blog);
                $blog = mysqli_fetch_assoc($res_blog);
                $blog_title = $blog['blog_title'];

                $btn_txt = "";
                $btn_class = "";
                if ($report['status'] == 1) {
                  $btn_txt = "Solved";
                  $btn_class = "btn btn-success";
                } else {
                  $btn_txt = "Pending";
                  $btn_class = "btn btn-danger";
                }

                echo "
                    <tr>
                      <td><a href='blog_details.php?id=$report[blog_id]'>$blog_title</a></td>
                      <td>$report[reported_by]</td>
                      <td>$report[reason]</td>
                      <td><a href='report_toggle.php?id=$report[id]&status=$report[status]' class='$btn_class'>$btn_txt</a></td>
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