<?php 
include "include/connection.php";

mysql_connect($conhost, $conuser, $conpassword);
mysql_select_db($dbname);
if (isset($_POST['login'])) {

  $user =$_POST['username'];
  $pass =md5($_POST['password']);
  $log_type = "login";
  $date_log = date('Y-m-d H:i:m');

  // var_dump($user,$pass,$log_type,$date_log);exit;

  $q = mysql_query("SELECT * FROM pengguna WHERE username='$user' AND password='$pass'");

  if (mysql_num_rows($q) == 1) {
    session_start();
    $_SESSION['username']=$user;
    $query = mysql_query("INSERT INTO log VALUES(' ','$user','$log_type','$date_log',' ')");
    if ($query) {
      header("Location: ./index.php?ntf=100");
  } else {
      echo '<script>alert("Hai, ' . $user . '. kamu berhasil login");location.href = "index.php?ntf=100"</script>';
  }           
} else {
 echo '<script>alert("Gagal Login! | Periksa username atau password anda.");window.history.go(-1);</script>';
}
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SPK-SAW | Penilaian Kinerja Karyawan</title>
    <link rel="icon" type="assets/image/png" href="assets/img/logo/icon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="mode/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="mode/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="mode/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="mode/css/style.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-box">
        <div class="logo">
         <a href="javascript:void(0);">SPK-<b>SAW</b></a>
         <hr>
         <small>Sistem Informasi Penilaian Kinerja Karyawan Dengan Metode SAW(<i>Simple Additive Weighting</i>)</small>
     </div>
     <div class="card">
        <div class="body">
            <form id="sign_in" method="POST">
                <div class="msg">Silahkan login untuk memulai session anda</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" name="login" type="submit">LOGIN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="mode/plugins/jquery/jquery.min.js"></script>
<script src="mode/plugins/bootstrap/js/bootstrap.js"></script>
<script src="mode/plugins/node-waves/waves.js"></script>
<script src="mode/plugins/jquery-validation/jquery.validate.js"></script>
<script src="mode/js/admin.js"></script>
<script src="mode/js/pages/examples/sign-in.js"></script>
</body>
</html>