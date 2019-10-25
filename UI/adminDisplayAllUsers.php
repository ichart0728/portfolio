<?php
    session_start();
    require_once '../classes/movieSQL.php';
    require_once '../classes/userSQL.php';
    $movie = new Movie;
    $user = new User;
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
              <!-- <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="adminMain.php">Home</a>
              </li> -->
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminEditTimeline.php">Timeline</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminDisplayAllUsers.php">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminhighlyRatedMovies.php">Movie Rating</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminAddMovie.php">Add Movie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="adminAddCategory.php">Add Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  <section>
  <div class="container-fluid mb-5" style="width:80%;">
        <form action="../action/userAction.php" method="post">
          <div class="row">
              <input class="col-md-11 form-control" type="text" name="result" placeholder="Search　Username">
              <input style="background-color:#F5A431; color:#161B21;" class="col-md-1 form-control" type="submit" name="adminSearchName" value="Search">
          </div>
        </form>
            <h1 class="text-center mt-5" style="color:#F5A431;">Display All Users</h1>
      </div>
    <div class="container">
        <div class="row mb-5">
        <?php
                $myUserid = $_SESSION['user_id'];
                $rows = $user->adminDisplayAllUser();
                // print_r($rows);
                // $rows = $user->getSearchUserResult($keyword);
                //make popular user display
                foreach($rows as $row){
                  $username = $row['username'];
                  $icon = $row['icon'];
                  $address = $row['address'];
                  $number = $row['number'];
                  $userid = $row['user_id'];
                  $loginid = $row['loginid'];
                  $follwers = $user->displayFollowers($userid);
                  $follwing = $user->displayFollowing($userid);
                  $others = $row['user_id'];
                  echo "<div class='container mb-5 col-md-6' style='width:400px; padding:0 80px;'>
                  <div class='card p-0'>
                          <div class='card-header'>
                              <div class='row mx-1'>
                                  <img src='../img/portfolio/$icon' style='width:55px; height:55px;'>
                                  <div class='d-inline ml-2'>
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
                                      <div class='col-md-6 text-right pt-3 px-0 pr-3'>

                                      <a class='border py-2 px-3' style='text-decoration:none; border-radius:6px;' href='../action/userAction.php?actiontype=deleteUser&userid=$userid&loginid=$loginid'>×<i class='fas fa-user' style='color:#F4A950;'>delete</i></a>

                                     </div>
                                  </div>
                              </div>
                          </div>
                          <div class='card-body'>
                              <div class='row'>
                                  <div class='col-md-4'>
                                      <img src='../img/portfolio/_ (1).jpg' alt=''>
                                  </div>
                                  <div class='col-md-4'>
                                          <img src='../img/portfolio/_ (2).jpg' alt=''>
                                  </div>
                                  <div class='col-md-4'>
                                          <img src='../img/portfolio/_.jpg' alt=''>
                                  </div>
                              </div>
                          </div>
                  </div>
                  </div>";
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
