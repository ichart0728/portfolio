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
        <h1 class="text-center" style="color:#f7941d;">Login</h1>
        <form action="../action/userAction.php" method="post">
            <label style="color:#f7941d;" for="">Email</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="text" name="email" placeholder="Email">
            <label style="color:#f7941d;" for="">Password</label>
            <input class="form-control form-control-lg mb-4" style="background-color:#161B21; color:#f7941d;border:1px solid #f7941d; border-top:0; border-right:0; border-left:0; border-radius:0;" type="password" name="pass" placeholder="Password">

            <input class="register-submit form-control form-control-lg mt-5" style="background-color:#f7941d; color:#161B21;" type="submit" name="login" value="Login">
            <a href="register.php" class="form-control form-control-lg mt-5 text-center" style="background-color:#f7941d; color:#161B21; text-decoration:none;">Create a New Account</a>
        </form>
    </div>
</body>

</html>
