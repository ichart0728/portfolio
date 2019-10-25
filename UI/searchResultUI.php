<?php
    session_start();
    require_once '../classes/movieSQL.php';
    require_once '../classes/userSQL.php';
    $movie = new Movie;
    $user = new User;
    $keyword = $_GET['keyword'];
    $status = $_SESSION['status']
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
        <?php
        if($_GET['type'] == 'movies'){
            echo 
              "<div class='container-fluid' style='width:80%;'>
              <form action='../action/movieAction.php' method='post'>
                  <div class='row'>
                      <input class='col-md-11 form-control' type='text' name='keyword' placeholder='Search  Movie/Cast/Director'>
                      <input style='background-color:#F5A431; color:#161B21;' class='col-md-1 form-control' type='submit' name='searchLatest' value='Search'>
                  </div>
              </form>
                <h1 class='my-5 text-center' style='color:#F5A431;'>Search Results</h1>
            <div class='row'>";
            $rows = $movie->getSearchResult($keyword);
            if($rows == false){
              echo "<div class='container text-center'>
            <h4 style='color:#F5A431;'>No Result</h4>
            </div>";
            }else{
              foreach($rows as $row){
                  $movieid = $row['movie_id'];
                  $title = $row['title']; 
                  $category = $row['category_name']; 
                  $country = $row['country']; 
                  $playdate = $row['playdate']; 
                  $summary = $row['summary']; 
                  $performer = $row['performer'];
                  $director = $row['director'];
                  $picture = $row['picture'];
                  $allWatched = $user->countAllAlreadyWatched($movieid);
                  $allWishlist = $user->countAllWish($movieid);
              "<div class='card w-75 mx-auto mb-4 p-0'>
                      <div class='card-body' style='height:465px;'>
                          <div class='row'>
                                  <div class='col-md-3'>
                                      <img style='width:100%; height:300px;' src='../img/portfolio/$picture' alt=''>
                                          <div class='row text-center mt-2 mp-3 mx-auto'>
                                              <div class='add col-md-6 pt-2' style='height:100px;'>
                                                  <a href='../action/userAction.php?actiontype=check&id=$movieid' class=''>
                                                      <i class='fas fa-eye mt-3' style='color:#161B21; font-size:35px'></i>
                                                      <p class='m-0' style='font-size:20px; color:#161B21;'>$allWatched</p>
                                                  </a>
                                              </div>
                                              <div class='add col-md-6 pt-2' style='height:100px;'>
                                                  <a href='../action/userAction.php?actiontype=checkwishlist&id=$movieid' class=''>
                                                      <i class='far fa-plus-square mt-3' style='color:#161B21; font-size:35px'></i>
                                                      <p class='m-0' style='font-size:20px; color:#161B21;'>$allWishlist</p>
                                                  </a>
                                              </div>
                                          </div>
                                  </div>
                              <div class='col-md-9'>
                                  <h4>Movie Title</h4>
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
            }
        }elseif($_GET['type'] == 'user'){
    echo "<div class='container-fluid mb-5' style='width:80%;''>
            <form action='../action/userAction.php' method='post'>
              <div class='row'>
                  <input class='col-md-11 form-control' type='text' name='result' placeholder='Search　Username'>
                  <input style='background-color:#F5A431; color:#161B21;' class='col-md-1 form-control' type='submit' name='searchName' value='Search'>
              </div>
            </form>
            <h1 class='text-center my-5' style='color:#F5A431;'>Search Result</h1>
            <div class='container'>
            <div class='row'>";

            $userid = $_SESSION['user_id'];
                $rows = $user->getSearchUserResult($keyword, $userid);
                if($rows == false){
                  echo "<div class='container text-center'>
            <h4 style='color:#F5A431;'>No Result</h4>
            </div>";
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
                    $current_user_id = $_SESSION['user_id'];
                    $check = $user->checkFollow($current_user_id, $userid);
  
              echo"<div class='container mb-5 col-md-6' style='width:400px; padding:0 80px;'>
                      <div class='card p-0'>
                            <div class='card-header'>
                                <div class='row mx-1'>
                                    <a href='../UI/othersPage.php?id=$others' class='d-inline'>
                                    <img src='../img/portfolio/$icon' style='width:55px; height:55px;'>
                                    </a>
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
                                        <div class='col-md-6 text-right pt-3 px-0 pr-3'>";
  
                                        
                                        if($check == false){
                                          echo "<a class='border py-2 px-3' style='text-decoration:none; border-radius:6px;' 
                                          href='../action/userAction.php?actiontype=follow&id=$userid'>+<i class='fas fa-user' style='color:#F4A950;'>follow</i></a>";
                                        }elseif($check == true){
                                          echo "<a class='border py-2 px-3' style='color:#F7F7F7; background-color:#F4A950; text-decoration:none; border-radius:6px;' 
                                          href='../action/userAction.php?actiontype=unfollow&id=$userid'>×<i class='fas fa-user' style='color:#F7F7F7;'>following</i></a>";
                                        }
  
  
                                  echo "</div>
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
                }
                echo "</div>";
        }elseif($_GET['type'] == 'timeline'){
          echo 
          "<div class='container-fluid mb-5' style='width:80%;'>
            <form action='../action/userAction.php' method='post'>
              <div class='row'>
                <input class='col-md-11 form-control' type='text' name='keyword' placeholder='Search  Movie/Cast/Director/User'>
                <input style='background-color:#F5A431; color:#161B21;' class='col-md-1 form-control ' type='submit' name='searchReview' value='Search'>
              </div>
            </form>
            <h1 class='text-center my-5' style='color:#F5A431;'>Search Result</h1>
            <div class='row'>";
          $userid = $_SESSION['user_id'];
          $rows = $user->getSearchReviewResult($keyword);
          if($rows == false){
            echo "<div class='container text-center'>
            <h4 style='color:#F5A431;'>No Result</h4>
            </div>";
          }else{
            foreach($rows as $row){
              $reviewid = $row['review_id'];
              $title = $row['title'];
              $country = $row['country'];
              $playdate = $row['playdate'];
              $summary = $row['summary'];
              $performer = $row['performer'];
              $director = $row['director'];
              $picture = $row['picture'];
              $movieid = $row['movie_id'];
              $icon = $row['icon'];
              $name = $row['username'];
              $othersid = $row['user_id'];
              $rating = $row['rating_number'];
              $content = $row['review_content'];
              $totalWishlist = $user->countWishlist($movieid);
              $totalReview = $user->countReview($movieid);
              $countComment = $movie->countComment($reviewid);
              $goodCount = $movie->goodCount($reviewid);
              $check = $movie->checkGood($reviewid, $userid);
                echo "<div class='card p-0 w-75 mx-auto mb-3'>
                            <div class='card-header'>
                                <div class='row mx-1'>
                                    <a href='../UI/othersPage.php?id=$othersid' class='d-inline'>
                                    <img src='../img/portfolio/$icon' style='width:55px; height:55px;'>
                                    </a>
                                    <div class='d-inline ml-2'>
                                        <p class='card-text' style='margin-bottom:0;'> $name's　review</p>
                                        <p class='card-text' style='margin-bottom:0;'>$playdate</p>
                                    </div>
                                </div>
                            </div>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-md-8 px-4 py-3'>
                                        <h2>$title</h2>";

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

                                        echo 
                                        "<div>

                                        </div>
                                        <div class='container pl-0 mt-3'>
                                            <h4>Summary</h4>
                                            <p>$summary</p>
                                            <h4>Reiview</h4>
                                            <p>$content</p>
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <img style='width:100%; height:80%;' src='../img/portfolio/$picture'>
                                        <div class='row text-center mt-2 mx-auto'>
                                            <a href='../action/userAction.php?actiontype=check&movieid=$movieid' class='add col-md-6' style='font-size:25px;'>
                                                <i class='fas fa-eye' style='font-size:25px; color:#161B21;'></i>
                                                <p style='font-size:15px; color:#161B21;'>$totalWishlist</p>
                                            </a>
                                            <a class='add col-md-6' style='font-size:25px;'>
                                                <i class='far fa-plus-square' style='color:#161B21;'></i>
                                                <p style='font-size:15px; color:#161B21;'>$totalReview</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='card-footer'>
                                <div class='container'>
                                    <div class='row'>
                                        <div class='col-md-2 pt-2'>
                                            <a href='../UI/commentUI.php?reviewid=$reviewid' style='color:black; text-decoration:none;'>
                                            <i class='fas fa-comment' style='margin-right:15px'> :$countComment</i>
                                            </a>";
                                            
                                            if($check == false){
                                              echo "<a style='color:black; text-decoration:none;' href='../action/movieAction.php?type=good&reviewid=$reviewid&movieid=$movieid&userid=$userid'>
                                              <i class='fas fa-heart'> :$goodCount</i></a>";
                                            }elseif($check == true){
                                              echo "<a style ='text-decoration:none;' href='../action/movieAction.php?type=ungood&reviewid=$reviewid&movieid=$movieid&userid=$userid'>
                                              <i style='color:red;' class='fas fa-heart'>:$goodCount</i></a>";
                                            }

                                        echo "</div>
                                        <form class='col-md-10' action='../action/movieAction.php' method='post'>
                                            <div class='row'>
                                                <input class='form-control col-md-10' type='text' name='comment' placeholder='Comment'>
                                                <input type='hidden' name='movieid' value='$movieid'>
                                                <input type='hidden' name='reviewid' value='$reviewid'>
                                                <input type='hidden' name='userid' value='$userid'>

                                                <input class='form-control col-md-2' style='background-color:#F4A950; color:#161B21;' type='submit' name='send' 'value='Submit'>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }
          }
        }elseif($_GET['type'] == 'latest'){
          echo 
          "<div class='container-fluid' style='width:80%;'>
            <form action='../action/movieAction.php' method='post'>
                <div class='row'>
                    <input class='col-md-11 form-control' type='text' name='keyword' placeholder='Search  Movie/Cast/Director'>
                    <input style='background-color:#F5A431; color:#161B21;' class='col-md-1 form-control' type='submit' name='searchLatest' value='Search'>
                </div>
            </form>
            <h1 class='text-center my-5' style='color:#F5A431;'>Search Result</h1>
            <div class='row'>";
            
            $userid = $_SESSION['user_id'];
            $rows = $movie->getSearchResult($keyword);
            if($rows == false){
              echo "<div class='container text-center'>
              <h4 style='color:#F5A431;'>No Result</h4>
              </div>";
            }else{
              foreach($rows as $row){
                // $reviewid = $row['review_id'];
                $title = $row['title'];
                $country = $row['country'];
                $playdate = $row['playdate'];
                $summary = $row['summary'];
                $performer = $row['performer'];
                $director = $row['director'];
                $picture = $row['picture'];
                $movieid = $row['movie_id'];
                $category = $row['category_name'];
                $reviewid = $movie->getReviewid($movieid);
                $allWatched = $user->countAllAlreadyWatched($movieid);
                $allWishlist = $user->countAllWish($movieid);
                $rateAverage = $movie->reviewAvg($movieid);
                $totalWishlist = $user->countWishlist($movieid);
                $totalReview = $user->countReview($movieid);
                echo 
                "<div class='card w-75 mx-auto mb-4 p-0'>
                    <div class='card-body' style='height:465px;'>
                        <div class='row'>
                                <div class='col-md-3'>
                                    <img style='width:100%; height:300px;' src='../img/portfolio/$picture' alt=''>
                                        <div class='row text-center mt-2 mp-3 mx-auto'>
                                            <div class='add col-md-6 pt-2' style='height:100px;'>
                                                <a href='../action/userAction.php?actiontype=check&id=$movieid' class=''>
                                                    <i class='fas fa-eye mt-3' style='color:#161B21; font-size:35px'></i>
                                                    <p class='m-0' style='font-size:20px; color:#161B21;'>$allWatched</p>
                                                </a>
                                            </div>
                                            <div class='add col-md-6 pt-2' style='height:100px;'>
                                                <a href='../action/userAction.php?actiontype=checkwishlist&id=$movieid' class=''>
                                                    <i class='far fa-plus-square mt-3' style='color:#161B21; font-size:35px'></i>
                                                    <p class='m-0' style='font-size:20px; color:#161B21;'>$allWishlist</p>
                                                </a>
                                            </div>
                                        </div>
                                </div>
                            <div class='col-md-9'>
                                <h4>$title</h4>
                                <p class='card-text' style='margin-bottom:0;'> Showing day: $playdate</p>
                                <p class='card-text' style='margin-bottom:0;'>	Production country: $country</p>
                                <p class='card-text' style='margin-bottom:0;'>	Category: $category</p>
                                <div class='container-fluid pl-0'>";
    
                                if($rateAverage == 0) {
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>No Rating</span>";
                                } elseif($rateAverage >= 0.1 AND $rateAverage < 1) {
                                  echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage == 1) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage >= 1.1 AND $rateAverage < 2) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage == 2) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage >= 2.1 AND $rateAverage < 3) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage == 3) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage >= 3.1 AND $rateAverage < 4) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage == 4) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='far fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage >= 4.1 AND $rateAverage < 5) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star-half-alt' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                } elseif($rateAverage == 5) {
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<i class='fas fa-star' style='color:#F5A431;'></i>";
                                  echo "<span class='align-baseline ml-1' style='color:#F5A431; font-size:19px;'>$rateAverage</span>";
                                }
  
                                echo "</div>
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
            }
            }
        ?>     

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
