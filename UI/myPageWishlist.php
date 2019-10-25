<?php
    session_start();
    require_once '../classes/movieSQL.php';
    require_once '../classes/userSQL.php';
    $movie = new Movie;
    $user = new User;
    $userid = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Agency - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="../css/agency.css" rel="stylesheet">

</head>

<body style="background-color: #161B21;" id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="#page-top">Enjoy your Movie Life</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="timeline.php">Timeline</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="findUser.php">Find a user</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="latestMovie.php">Latest Movie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="mypage.php">My page</a>
              </li>
              <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
                </li>
            </ul>
          </div>
        </div>
      </nav>

      <?php
        $rows = $user->userInfo($userid);
        $totalWatched = $user->countMyAlreadyWatched($userid);
        $totalWishlist = $user->countMyWishlist($userid);
        $countFollowing = $user->countFollowing($userid);
        $countFollowers = $user->countFollowers($userid);
        $myGoodCount = $movie->myGoodCount($userid);
        foreach($rows as $row){
            $icon = $row['icon'];
            $username = $row['username'];
            $userid = $row['user_id'];
            
        echo
        "<section class='container-fluid pb-5'>
            <h1 class='text-center' style='color:#f7941d;'>My Page</h1>
            <div class='container-fluid' style='padding-left:115px;'>
                <div class='row'>
                    <div class='col-md-1 pr-0 py-5'>
                        <img src='../img/portfolio/$icon' alt='' style='width:100px; height:100px;'>
                    </div>
                    <div class='cpl-md-11 mt-5'>
                        <span class='align-top' style='color:#f7941d; font-size:20px; margin-left:15px;'>$username</span>
                        <span class='align-top' style='color:#f7941d; font-size:18px; margin-left:12px;'>@srgahwlgai$userid</span>
                        <p style='margin-top:25px; margin-left:35px;'><a href='editProfile.html' class='menu py-2 px-5' style='text-decoration:none; border:solid 1px #f7941d; border-radius:4px;' href=''>Edit Profile</a></p>
                    </div>
                </div>
            </div>
            <div class='container-fluid' style='border-top:solid 1px #f7941d; border-bottom:solid 1px #f7941d; padding-left:130px;'>
                <div class='row'>
                    <div class='col-md-5'>
                        <div class='row'>
                            <a href='myPage.php?id=$userid' class='menu col-md-2 d-inline-block text-center' style='width:50px; height:65px;text-decoration:none;'>
                                <i class='fas fa-eye mt-2' style='font-size:22px'></i>
                                <p>$totalWatched</p> 
                            </a>
                            <a href='myPageWishlist.php?id=$userid' class='menu col-md-2 d-inline-block text-center' style='width:50px; height:65px;text-decoration:none;'>
                                <i class='far fa-plus-square mt-2' style='font-size:22px'></i>
                                <p>$totalWishlist</p>
                            </a>
                            <a href='myPageLike.php?id=$userid' class='menu col-md-2 d-inline-block text-center' style='width:50px; height:65px;text-decoration:none;'>
                                <i class='fas fa-heart mt-2' style='font-size:22px'></i>
                                <p>$myGoodCount</p>
                            </a>
                            <a href='followers.php' class='menu col-md-2 d-inline-block' style='width:50px; height:65px;text-decoration:none;'>
                                <p class='m-0 mb-1 text-center' style='font-size:14px; padding-top:3px;'>followers</p>
                                <p class='m-0 text-center'>$countFollowers</p>
                            </a>
                            <a href='following.php' class='menu col-md-2 d-inline-block' style='width:50px; height:65px;text-decoration:none;'>
                                <p class='m-0 mb-1 text-center' style='font-size:14px; padding-top:3px;'>following</p>
                                <p class='m-0 text-center'>$countFollowing</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>";
            }
        ?>
  <section class="pt-0">
    <div class="container-fluid">
        <div class="row mb-5">
        
                <?php
                $rows = $user->displayWishlist($userid);
                if($rows == false){
                  echo "<h4 class='w-5 mx-auto text-center mt-5' style='color:#F5A431;'>No Wishlist</h4>";
                }else{
                  foreach($rows as $row){
                      $pic = $row['picture'];
                      $title = $row['title'];
                      $movieid = $row['movie_id'];
                      $allWatched = $user->countAllAlreadyWatched($movieid);
                      $allWishlist = $user->countAllWish($movieid);
                      $rateAverage = $movie->reviewAvg($movieid);
                      $checkReview = $movie->checkReview($userid, $movieid);
                      $checkWishlist = $movie->checkWish($userid, $movieid);
                      echo
                      "<div class='col-md-3 p-5'>
                      <div class='card' style='background-color:#161B21;'>
                      <div class='card-body px-1 py-2 text-center' style='color:#F4A950; border-top:1px solid #F4A950;'>
                          <p class='card-text m-0'>$title</p>
                      </div>
                          <img class='card-img-top w-100' style='height:450px; ' src='../img/portfolio/$pic' alt=''>
                          <div class='card-footer p-0'>
                              <div class='container'>
                                  <div class='row'>";
  
                                  if($checkReview == false){
                                      echo "<a href='../action/userAction.php?actiontype=check&id=$movieid' class='add col-md-4 p-0 text-center' style ='text-decoration:none;'>
                                          <i class='fas fa-eye' style='color:#161B21;'></i>
                                          <p class='card-text m-0' style='color:#161B21;'>$allWatched</p>                           
                                          <p class='card-text m-0' style='color:#161B21;'></p>
                                      </a>";
                                    }else{
                                      echo "<a href='../action/userAction.php?actiontype=check&id=$movieid' class='add col-md-4 p-0 text-center' style='background-color:#AA7638; text-decoration:none;'>
                                          <i class='fas fa-eye' style='color:#161B21;'></i>
                                          <p class='card-text m-0' style='color:#161B21;'>$allWatched</p>                           
                                          <p class='card-text m-0' style='color:#161B21;'></p>
                                      </a>";
                                    }
  
                                    if($checkWishlist == false){
                                        echo "<a href='../action/userAction.php?actiontype=wishlist&id=$movieid' class='add col-md-4 p-0 text-center' style ='text-decoration:none;'>
                                        <i class='far fa-plus-square' style='color:#161B21;'></i>
                                        <p class='card-text m-0' style='color:#161B21;'>$allWishlist</p>
                                    </a>";
                                    }else{
                                      echo "<a href='../action/movieAction.php?actiontype=delete&id=$movieid' class='add col-md-4 p-0 text-center' style='background-color:#AA7638; text-decoration:none;'>
                                          <i class='far fa-plus-square' style='color:#161B21;'></i>
                                          <p class='card-text m-0' style='color:#161B21;'>$allWishlist</p>
                                      </a>";
                                    }
  
                                      echo "<a href='../action/movieAction.php?actiontype=detail&id=$movieid' class='add col-md-4 p-0 text-center'>
                                          <i class='fas fa-star' style='color:#161B21;'></i>
                                          <p class='card-text m-0' style='color:#161B21;'>$rateAverage</p>                           
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>";
                  }
                }
                ?>
        </div>
    </div>
  </section>

  <!-- Contact -->

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright" style='color:#F5A431;'>Copyright &copy; Your Website 2019</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/agency.min.js"></script>

</body>

</html>
