<?php
include_once "navbar.php";
require_once "../dbconfig.php";
$qry = "select * from blogs order by blogged_at desc";


$res = mysqli_query($con, $qry);

/*if(mysqli_num_rows($res)>0){
    
  }*/
?>

<section class="dashboard">
  <div class="container">
    <div class="row my-3">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>Latest Posts</h4>
          </div>
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th>Blog</th>
                <th>Catagory</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($blog = mysqli_fetch_assoc($res)) {
                echo "
                    <tr>
                      <td>$blog[blog_title]</td>
                      <td>$blog[blog_catagory]</td>
                      <td>$blog[blogged_at]</td>
                      <td><a href='blog_details.php?id=$blog[id]' class='btn btn-secondary'>
                      <i class='fas fa-angle-double-right'></i> Details
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