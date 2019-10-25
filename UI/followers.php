<?php
    session_start();
    require_once '../classes/movieSQL.php';
    require_once '../classes/userSQL.php';
    // require_once '../action/movieAction.php';
    $movie = new Movie;
    $user = new User;
    $current_user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
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
        $rows = $user->userInfo($current_user_id);
        $totalWatched = $user->countMyAlreadyWatched($current_user_id);
        $totalWishlist = $user->countMyWishlist($current_user_id);
        $countFollowers = $user->countFollowers($current_user_id);
        $countFollowing = $user->countFollowing($current_user_id);
        $myGoodCount = $movie->myGoodCount($current_user_id);
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
                        <p style='margin-top:25px; margin-left:35px;'><a href='editProfile.php' class='menu py-2 px-5' style='text-decoration:none; border:solid 1px #f7941d; border-radius:4px;' href=''>Edit Profile</a></p>
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
  <!-- <section class="pt-0">
          <div class='container'>
            <div class='row mb-5'> -->
<?php
                echo "<div class='container'>
                <div class='row mb-5'>";
                $userid = $_SESSION['user_id'];
                $rows = $user->followerDisplay($userid);
                if($rows == false){
                  echo "<h4 class='w-5 mx-auto text-center mt-5' style='color:#F5A431;'>No Followers</h4>";
                }else{
                  foreach($rows as $row){
                    $username = $row['username'];
                    $icon = $row['icon'];
                    $address = $row['address'];
                    $number = $row['number'];
                    $userid = $row['user_id'];
                    $follwers = $user->displayFollowers($userid);
                    $follwing = $user->displayFollowing($userid);
                    $others = $row['user_id'];
                    $randomPicture = $user->getRandomMoviePicture($others);
                    $current_user_id = $_SESSION['user_id'];
                    $check = $user->checkFollow($current_user_id, $userid);
                    echo "<div class='container mb-5 col-md-6' style='width:400px; padding:0 80px;'>
                    <div class='card p-0'>
                            <div class='card-header'>
                                <div class='row mx-1'>";

                                if($current_user_id == $userid){
                                  echo "<a href='../UI/myPage.php?id=$current_user_id' class='d-inline'>
                                  <img src='../img/portfolio/$icon' style='width:55px; height:55px;'>
                                </a>";
                                }else{
                                  echo"<a href='../UI/othersPage.php?id=$others' class='d-inline'>
                                    <img src='../img/portfolio/$icon' style='width:55px; height:55px;'>
                                  </a>";
                                }
                                    echo "<div class='d-inline ml-2'>
                                        <p class='card-text' style='margin-bottom:0;'> $username</p>
                                        <p class='card-text' style='margin-bottom:0;'> ＠$address.$number</p>
                                    </div>
                                </div>
                                <div class='container mt-2'>
                                    <div class='row'>
                                        <div class='col-md-3  px-0'>
                                            <p class='mb-0'>following</p>
                                            <p class='mb-0'>$follwing</p>
                                        </div>
                                        <div class='col-md-3  px-0'>
                                            <p class='mb-0'>followers</p>
                                            <p class='mb-0'>$follwers</p>
                                        </div>
                                        <div class='col-md-6 text-right pt-3 px-0 pr-3'>";
  
                                        
                                        if($check == false){
                                          echo "<a class='border py-2 px-3' style='text-decoration:none; border-radius:6px;' href='../action/userAction.php?actiontype=follow&id=$userid'>+<i class='fas fa-user' style='color:#F4A950;'>follow</i></a>";
                                        }elseif($check == true){
                                          echo "<a class='border py-2 px-3' style='color:#F7F7F7; background-color:#F4A950; text-decoration:none; border-radius:6px;' href='../action/userAction.php?actiontype=unfollow&id=$userid'>×<i class='fas fa-user' style='color:#F7F7F7;'>following</i></a>";
                                        }
  
  
                                       echo "</div>
                                    </div>
                                </div>
                            </div>
                            <div class='card-body'>
                                <div class='row'>";
  
                                $rows = $user->getRandomMoviePicture($others);
                                if($rows == false){
                                  echo "<div class='col-md-12 text-center pt-5' style='width:100px; height:150px;'>
                                    <h4>No Review</h4>
                                  </div>";
                                } else {
                                foreach($rows as $row){
                                  $randomPicture = $row['picture'];
                                  echo "<div class='col-md-4'>
                                      <img style='width:100px; height:150px;' src='../img/portfolio/$randomPicture' alt=''>
                                  </div>";
                                }
                              }
                              echo "</div>
                                  </div>
                          </div>
                          </div>";
                  }
                }
                echo "</div>
                </div>";

                ?>
                </div>
              </div>
          </div>
      </div>
    </section>

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
