<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <style media="screen">
    .header{
      background-image: linear-gradient(rgba(0, 0, 0, 0.616), rgba(0, 0, 0, 0.616)), url(book1.png);
      background-size:1600px;
      height: 750px;
      background-position: center;
      margin:0 ;
      padding: 0;
    }
    .image{
    }
    </style>
  </head>
  <body>
    <div class="header">
    <div class="container" align="center">
      <div class="header col-12">
        <div class="container" align="center">
      <div class="col-5 header" text-danger>
  <h1>.</h1>
  <h1>.</h1>
  <h1>.</h1>
  <h1>.</h1>
      <div class="card">
        <div class="card-header">
          <h4>Login customer</h4>
        </div>
        <div class="card-body">
          <form action="proses_login_customer.php" method="post">
            Username
            <input type="text" name="username" class="form-control" required />
            Password
            <input type="password" name="password" class="form-control" required />
            <button type="submit" name="login_customer" class="btn btn-block btn-danger">
              Login
            </button>
              </form>
            </div>
            </div>
            <h1>.</h1>
            <h1>.</h1>
            <h1>.</h1>
            <h1>.</h1>
        </div>
      </div>
      </div
      </div>
  </body>
</html>
