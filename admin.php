<?php
session_start();
header("Content-type: text/html; charset=utf-8");

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
  echo "欢迎回来！" . $_SESSION['username'];
  echo "<br />";
  echo "<a href='logout.php'>注销</a>";
}else{
  echo "你还没有登录，<a href='login.php'>请登录</a>";
}

?>
