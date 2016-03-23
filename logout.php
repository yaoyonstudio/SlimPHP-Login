<?php
session_start();
session_unset();
session_destroy();
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Logged Out</title>
</head>

<body>
<h1>已经注销</h1>
<a href='login.php'>登录</a>
</body>
</html>
