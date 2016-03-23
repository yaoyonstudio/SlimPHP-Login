<?php
session_start();
header("Content-type: text/html; charset=utf-8");

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
  echo "您已登录";
  header("Location:admin.php");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台登录</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="lib/jquery/jquery-2.2.2.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>

    <div class="container">

      <form class="form-signin" action="submit.php" method="post" accept-charset="utf-8">
        <h2 class="form-signin-heading">用户登录</h2>
        <label for="inputEmail" class="sr-only">邮箱</label>
        <input type="email" id="inputEmail" class="form-control" name="userEmail" placeholder="邮箱" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" class="form-control" name="userPassword" placeholder="密码" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
      </form>

    </div>

  </body>
</html>
