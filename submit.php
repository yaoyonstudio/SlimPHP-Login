<?php
session_start();
header("Content-type: text/html; charset=utf-8");

function DB_Connection() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "yaoyon";
    $dbname = "slimphp";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    return $dbh;
}

if(!isset($_POST['userEmail'],$_POST['userPassword'])){
  $msg = "非法的用户邮箱";
}elseif (strlen($_POST['userEmail']) > 20 || strlen($_POST['userEmail']) < 4) {
  $msg = "用户邮箱长度不对";
}elseif (strlen($_POST['userPassword']) > 20 || strlen($_POST['userPassword']) < 4) {
  $msg = "密码长度不对";
}else{
  $userEmail = filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL);
  $userPassword = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);

  // $userPassword = sha1($userPassword);

  try{
    $dbh = DB_Connection();
    //设置错误代码
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("SELECT id, username, password FROM user
                    WHERE username = :username AND password = :password");

    $stmt->bindParam(':username', $userEmail, PDO::PARAM_STR);
    $stmt->bindParam(':password', $userPassword, PDO::PARAM_STR, 40);
    $stmt->execute();
    $user_id = $stmt->fetchColumn();

    if($user_id == false)
    {
      $msg = '登录失败,3秒后返回';
      echo"<meta http-equiv=\"refresh\" content=3;URL='login.php'>";
    }else{
      $msg = '登录成功，欢迎！';
      $_SESSION['user_id'] = $user_id;
      $_SESSION['username'] = $userEmail;
      header("Location:admin.php");
    }
    
  }catch(Exception $e){
    $msg = '无法连接或无法处理请求';
  }
}
echo $msg;
