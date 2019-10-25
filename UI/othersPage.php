<?php
    session_start();
    require_once '../classes/movieSQL.php';
    require_once '../classes/userSQL.php';
    $movie = new Movie;
    $user = new User;
    $userid = $_GET['id'];
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
        $countFollowers = $user->countFollowers($userid);
        $countFollowing = $user->countFollowing($userid);
        $myGoodCount = $movie->myGoodCount($userid);
        foreach($rows as $row){
            $icon = $row['icon'];
            $username = $row['username'];
            $userid = $row['user_id'];
            $others = $row['user_id'];
            $current_user_id = $_SESSION['user_id'];
            $check = $user->checkFollow($current_user_id, $userid);
        echo
        "<section class='container-fluid pb-5'>
            <h1 class='text-center' style='color:#f7941d;'>$username's Page</h1>
            <div class='container-fluid p-0'>
                <div class='row' style='padding-left:115px;'>
                    <div class='col-md-1 pr-0 py-5'>
                        <img src='../img/portfolio/$icon' alt='' style='width:100px; height:100px;'>
                    </div>
                    <div class='cpl-md-11 mt-5'>
                        <span class='align-top' style='color:#f7941d; font-size:20px; margin-left:15px;'>$username</span>
                        <span class='align-top' style='color:#f7941d; font-size:18px; margin-left:12px;'>@srgahwlgai$userid</span>
                        <div class='h-100 w-100 text-center mt-4'>";

                        if($check == false){
                          echo "<a class='border py-2 px-3' style='text-decoration:none; border-radius:6px;' href='../action/userAction.php?actiontype=follow&id=$userid'>+<i class='fas fa-user' style='color:#F4A950;'>follow</i></a>";
                        }elseif($check == true){
                          echo "<a class='border py-2 px-3' style='color:#161B21; background-color:#F39331; text-decoration:none; border-radius:6px;' href='../action/userAction.php?actiontype=unfollow&id=$userid'>×<i class='fas fa-user' style='color:#161B21;'>following</i></a>";
                        }

                    echo 
                    "</div>
                </div>
            </div>
            <div class='container-fluid' style='border-top:solid 1px #f7941d; border-bottom:solid 1px #f7941d; padding-left:130px;'>
                <div class='row'>
                    <div class='col-md-5'>
                        <div class='row'>
                            <a href='othersPage.php?id=$userid' class='menu col-md-2 d-inline-block text-center' style='width:50px; height:65px;text-decoration:none;'>
                                <i class='fas fa-eye mt-2' style='font-size:22px'></i>
                                <p>$totalWatched</p> 
                            </a>
                            <a href='othersWishlist.php?id=$userid' class='menu col-md-2 d-inline-block text-center' style='width:50px; height:65px;text-decoration:none;'>
                                <i class='far fa-plus-square mt-2' style='font-size:22px'></i>
                                <p>$totalWishlist</p>
                            </a>
                            <a href='othersLike.php?id=$userid' class='menu col-md-2 d-inline-block text-center' style='width:50px; height:65px;text-decoration:none;'>
                                <i class='fas fa-heart mt-2' style='font-size:22px'></i>
                                <p>$myGoodCount</p>
                            </a>
                            <a href='othersFollowers.php?id=$userid' class='menu col-md-2 d-inline-block' style='width:50px; height:65px;text-decoration:none;'>
                                <p class='m-0 mb-1 text-center' style='font-size:14px; padding-top:3px;'>followers</p>
                                <p class='m-0 text-center'>$countFollowers</p>
                            </a>
                            <a href='othersFollowing.php?id=$userid' class='menu col-md-2 d-inline-block' style='width:50px; height:65px;text-decoration:none;'>
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


  <section class='pt-0'>
    <div class='container'>
        <div class='row mb-5'>
    <?php
    $rows = $movie->displayMyReview($userid);
    if($rows == false){
      echo "<h4 class='w-5 mx-auto text-center mt-5' style='color:#F5A431;'>No Review</h4>";
    }else{
      foreach($rows as $row){
          $title = $row['title']; 
          $category = $row['category_name']; 
          $country = $row['country']; 
          $playdate = $row['playdate']; 
          $review = $row['review_content']; 
          $reviewid = $row['review_id']; 
          $rating = $row['rating_number']; 
          $performer = $row['performer'];
          $director = $row['director'];
          $picture = $row['picture'];
          $movieid = $row['movie_id'];
          $review_date = $row['review_date'];
          $current_user_id = $_SESSION['user_id'];
          $new_date = date("M d, Y", strtotime($review_date));
          $allWatched = $user->countAllAlreadyWatched($movieid);
          $allWishlist = $user->countAllWish($movieid);
          $checkReview = $movie->checkReview($current_user_id, $movieid);
          $checkWishlist = $movie->checkWish($current_user_id, $movieid);
          $countComment = $movie->countComment($reviewid);
          $goodCount = $movie->goodCount($reviewid);
          $check = $movie->checkGood($reviewid, $current_user_id);
            echo 
            "<div class='col-md-6 px-4'>
              <div class='card mb-5'>
                      <div class='card-body'>
                          <div class='row'>
                              <div class='col-md-8'>
                              <h4>$title</h4>
                              <p>$new_date</p>
                                  <div class='container-fluid pl-0'>";
  
                                  if($rating == 0) {
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>No Rating</span>";
                                  } elseif($rating >= 0.1 AND $rating < 1) {
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating == 1) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating >= 1.1 AND $rating < 2) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating == 2) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating >= 2.1 AND $rating < 3) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                  } elseif($rating == 3) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating >= 3.1 AND $rating < 4) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating == 4) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating >= 4.1 AND $rating < 5) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  } elseif($rating == 5) {
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                    echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rating</span>";
                                  }
  
                                         echo  "</div>
                                  <div class='container pl-0 mt-3'>
                                      <p>$review</p>
                                  </div>
                              </div>
                              <div class='col-md-4'>
                                  <img style='width:100%; height:200px;' src='../img/portfolio/$picture' alt=''>
                                  <div class='row text-center mt-2 mx-auto'>";
  
                                  if($checkReview == false){
                                    echo "<div class='add col-md-6 pt-2' style='height:80px;'>
                                        <a href='../action/userAction.php?actiontype=check&id=$movieid' style='text-decoration:none; font-size:25px;' >
                                        <i class='fas fa-eye' style='font-size:25px; color:#161B21;'></i>
                                        <p class='mb-0' style='font-size:15px; color:#161B21; '>$allWatched</p>
                                        </a>
                                    </div>";
                                  }elseif($checkReview == true){
                                    echo "<div class='add col-md-6 pt-2' style='height:80px; background-color:#AA7638;'>
                                        <a href='../action/userAction.php?actiontype=check&id=$movieid' style='text-decoration:none; font-size:25px;'>
                                        <i class='fas fa-eye' style='font-size:25px; color:#161B21;'></i>
                                        <p class='mb-0' style='font-size:15px; color:#161B21; '>$allWatched</p>
                                        </a>
                                    </div>";
                                  }
      
                                  if($checkWishlist == false){
                                    echo "<div class='add col-md-6 pt-2' style='height:80px;'>
                                            <a href='../action/userAction.php?actiontype=checkwishlist&id=$movieid' style='text-decoration:none; font-size:25px;'>
                                              <i class='far fa-plus-square' style='color:#161B21;'></i>
                                              <p class='mb-0' style='font-size:15px; color:#161B21;'>$allWishlist</p>
                                            </a>
                                          </div>";
                                  }elseif($checkWishlist == true){
                                    echo "<div class='add col-md-6 pt-2' style='height:80px; background-color:#AA7638;'>
                                            <a href='../action/movieAction.php?actiontype=delete&id=$movieid' style='text-decoration:none; font-size:25px;'>
                                              <i class='far fa-plus-square' style='color:#161B21;'></i>
                                              <p class='mb-0' style='font-size:15px; color:#161B21;'>$allWishlist</p>
                                            </a>
                                          </div>";
                                  }
  
  
                                
  
  
  
                                  echo "</div>
                              </div>
                          </div>
                      </div>
                      <div class='card-footer'>
                          <div class='container'>
                              <div class='row'>
                                  <div class='col-md-4 pt-2'>
                                    <a href='../UI/commentUI.php?reviewid=$reviewid' style='color:black; text-decoration:none;'>
                                        <i class='fas fa-comment' style='margin-right:15px'> :$countComment</i>
                                    </a>";
                                    if($check == false){
                                      echo "<a style='color:black; text-decoration:none;' href='../action/movieAction.php?type=good&reviewid=$reviewid&movieid=$movieid&userid=$current_user_id'>
                                      <i class='fas fa-heart'>:$goodCount</i></a>";
                                    }elseif($check == true){
                                      echo "<a style ='text-decoration:none;' href='../action/movieAction.php?type=ungood&reviewid=$reviewid&movieid=$movieid&userid=$current_user_id'>
                                      <i style='color:red;' class='fas fa-heart'>:$goodCount</i></a>";
                                    }
                                  echo "</div>
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
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contact Us</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Your Website 2019</span>
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
