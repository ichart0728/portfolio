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
    <div class="container mt-5">
        <h1 class="text-center" style="color:#f7941d;">Register</h1>
        <form action="../action/userAction.php" method="post" enctype="multipart/form-data">
            <label style="color:#f7941d;" for="">Username</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d; border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="text" name="username" placeholder="Username">
            <label style="color:#f7941d;" for="">Email</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="text" name="email" placeholder="Email">
            <label style="color:#f7941d;" for="">Address</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="text" name="address" placeholder="Address">
            <label style="color:#f7941d;" for="">Number</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="number" name="number" placeholder="Number">
            <label style="color:#f7941d;" for="">Icon</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="file" name="pic">

            <label style="color:#f7941d;" for="">Password</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="password" name="pass" placeholder="Password">

            <input class="form-control form-control-lg mt-5" style="background-color:#f7941d; color:#161B21;" type="submit" name="register" value="Register">
        </form>
    </div>
</body>

</html>
