<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" href="../css/admin-style.css" />
  <title>Geeky Blogger</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-light ">
    <div class="container">
      <a href="index.php" class="navbar-brand"><img src="../Assets/logo.png" style="height:70px; width: 200px;"></a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <?php
          session_start();
          /* $page = explode("/",$_SERVER['REQUEST_URI'])[2];
              $pages=array("index.php","signin.php","signup.php");
              if((!isset($_SESSION['email']))  && (!in_array($page,$pages))){
                header("location:index.php");
              }*/
          if (isset($_SESSION['email'])) {
          ?>
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link">Home</a>
            </li>

            <li class="nav-item">
              <a href="../logout.php" class="nav-link">Log Out</a>
            </li>
            <li class="nav-item">
              <span class="nav-link"><?php echo "Welcome, $_SESSION[email]"; ?></span>
            </li>

          <?php
          } else {
          ?>
            <li class="nav-item">
              <!-- <a href="signin.php" class="nav-link btn btn-info btn-sm text-white font-weight-bold">Sign In</a>-->
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>




  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

  <script>

  </script>

</body>

</html>