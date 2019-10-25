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

<body  style="background-color: #161B21;" id="page-top">
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
    <div class="container mt-5">
        <h1 class="text-center" style="color:#f7941d; margin-top:230px;">Add Movies</h1>
        <form action="../action/movieAction.php" method="post" enctype="multipart/form-data">
            <label style="color:#f7941d;" for="">Add Category</label>
            <input class="form-control form-control-lg mb-5" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;"type="text" name="category" placeholder="Category">
            <input class="form-control form-control-lg mb-5" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="file" name="pic">
            <input class="register-submit form-control form-control-lg mt-5" style="background-color:#f7941d; color:#161B21;" type="submit" name="addCategory" value="Add Category">
        </form>
    </div>
</body>

</html>
