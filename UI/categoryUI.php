<?php
    session_start();
    require_once '../classes/movieSQL.php';
    require_once '../classes/userSQL.php';
    $movie = new Movie;
    $user = new User;
    $category = $_GET['movietype'];
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
                <a class="nav-link js-scroll-trigger" href="mypage.php">Logout</a>
              </li>
          </ul>
        </div>
      </div>
    </nav>

    <section>
        <div class='container-fluid' style='width:80%;'>
        <form action="../action/movieAction.php" method="post">
                <div class="row">
                    <input class="col-md-11 form-control" type="text" name="result" placeholder="Search  Movie/Cast/User">
                    <input style="background-color:#F5A431; color:#161B21;" class="col-md-1 form-control " type="submit" name="search" value="Search">
                </div>
            </form>
        <?php
        echo "<h1 class='my-5 text-center' style='color:#F5A431;'>$category Movie</h1>"
        ?>
        <?php
        $rows = $movie->displayCategoryMovies($category);
        $userid = $_SESSION['user_id'];
        foreach($rows as $row){
            $movieid = $row['movie_id'];
            $title = $row['title']; 
            $country = $row['country']; 
            $playdate = $row['playdate']; 
            $summary = $row['summary']; 
            $performer = $row['performer'];
            $director = $row['director'];
            $picture = $row['picture'];
            $allWatched = $user->countAllAlreadyWatched($movieid);
            $allWishlist = $user->countAllWish($movieid);
            $checkReview = $movie->checkReview($userid, $movieid);
            $checkWishlist = $movie->checkWish($userid, $movieid);
            echo 
            "<div class='card w-75 mx-auto mb-4 p-0'>
                <div class='card-body' style='height:465px;'>
                    <div class='row'>
                            <div class='col-md-3'>
                                <img style='width:100%; height:300px;' src='../img/portfolio/$picture' alt=''>
                                    <div class='row text-center mt-2 mp-3 mx-auto'>";

                                    if($checkReview == false){
                                      echo "<div class='add col-md-6 pt-2' style='height:100px;'>
                                          <a href='../action/userAction.php?actiontype=check&id=$movieid' class=''>
                                              <i class='fas fa-eye mt-3' style='color:#161B21; font-size:35px'></i>
                                              <p class='m-0' style='font-size:20px; color:#161B21;'>$allWatched</p>
                                          </a>
                                      </div>";
                                    }elseif($checkReview == true){
                                      echo "<div class='add col-md-6 pt-2' style='height:100px; background-color:#AA7638;'>
                                          <a href='../action/userAction.php?actiontype=check&id=$movieid' class=''>
                                              <i class='fas fa-eye mt-3' style='color:#161B21; font-size:35px'></i>
                                              <p class='m-0' style='font-size:20px; color:#161B21;'>$allWatched</p>
                                          </a>
                                      </div>";
                                    }
        
                                    
                                    if($checkWishlist == false){
                                      echo "<div class='add col-md-6 pt-2' style='height:100px;'>
                                              <a href='../action/userAction.php?actiontype=checkwishlist&id=$movieid' class=''>
                                                <i class='far fa-plus-square mt-3' style='color:#161B21; font-size:35px'></i>
                                                <p class='m-0' style='font-size:20px; color:#161B21;'>$allWishlist</p>
                                              </a>
                                            </div>";
                                    }elseif($checkWishlist == true){
                                      echo "<div class='add col-md-6 pt-2' style='height:100px; background-color:#AA7638;'>
                                              <a href='../action/movieAction.php?actiontype=delete&id=$movieid' class=''>
                                                  <i class='far fa-plus-square mt-3' style='color:#161B21; font-size:35px'></i>
                                                  <p class='m-0' style='font-size:20px; color:#161B21;'>$allWishlist</p>
                                              </a>
                                            </div>";
                                    }

                                    echo "</div>
                            </div>
                        <div class='col-md-9'>
                            <h4>$title</h4>
                            <p class='card-text' style='margin-bottom:0;'> Showing day: $playdate</p>
                            <p class='card-text' style='margin-bottom:0;'>	Production country: $country</p>
                            <p class='card-text' style='margin-bottom:0;'>	Category: $category</p>
                            <div class='container-fluid pl-0'>
                                    <i class='fas fa-star' style='color:#F5A431;'></i>
                                    <i class='fas fa-star' style='color:#F5A431;'></i>
                                    <i class='fas fa-star' style='color:#F5A431;'></i>
                                    <i class='fas fa-star' style='color:#F5A431;'></i>
                                    <i class='fas fa-star' style='color:#F5A431;'></i>
                                    <span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>5</span>
                            </div>
                            <div class='container pl-0 mt-3'>
                                <h6>Summary</h6>
                                <p>$summary</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='card-footer'>
                    <div class='container'>
                        <p>Movie director: <span>$director </span></p>
                        <p>Performer: <span>$performer</p>
                    </div>
                </div>
            </div>";                 
        }
        ?>     
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
