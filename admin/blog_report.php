<?php
  require_once "../dbconfig.php";
?>
<link rel="stylesheet" href="../css/style-2.css">
<div class="catagories">
<h5 class="display-5 mt-2 border-bottom p-1">Catagories</h5>
      <?php
        $qry_count = "select blog_catagory,count(*) as total from blogs group by blog_catagory order by blog_catagory;";
        $res_count = mysqli_query($con,$qry_count);
        while($cc = mysqli_fetch_assoc($res_count)){
      ?>
        <span class="d-block bg-info rounded my-2 px-2 py-1"><a href="blog_catagory.php?catagory=<?php echo $cc['blog_catagory']; ?>" style="color: white;"><?php echo $cc['blog_catagory']." ( ".$cc['total']." )";  ?></a></span>
      <?php
        }
      ?>
  </div>

  <div class="timeline">
      <h5 class="display-5 mt-2 border-bottom p-1">Blog Timeline</h5>
      <?php
        $qry_bt = "SELECT YEAR(blogged_at) as year, MONTHNAME(blogged_at) as month,count(*) as blog_count FROM `blogs` GROUP BY year,month order by year desc,month desc";
        $res_bt = mysqli_query($con,$qry_bt);
        echo "<ul class='list-group'>";
        while($data=mysqli_fetch_assoc($res_bt)){
          echo " <li class='list-group-item'> $data[month] - $data[year] ( $data[blog_count] )</li>";
        }
        echo "</ul>";
      ?>
  </div>

      <div class="populer">
        <h5 class="display-5 mt-2 border-bottom p-1">Populer Blogs</h5>
        <?php
          $qry_pop = "SELECT id,blog_title,blog_content,comment_count,like_count,(sum(comment_count)+sum(like_count)) as popularity from blogs group by blog_title order by popularity DESC limit 3";
          $res_pop = mysqli_query($con,$qry_pop);
          while($pop = mysqli_fetch_assoc($res_pop)){
        ?>
            <div class="card my-3 ">
              <div class="card-header">
                <p class="card-title font-weight-bold">
                  <?php 
                    echo "<a href='blog_details.php?blog=$pop[blog_title]&id=$pop[id]' class='text-primary' > $pop[blog_title] </a>" ; 
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