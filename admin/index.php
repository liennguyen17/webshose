<?php
session_start();
include('../db/connect.php');
?>

<?php 
  // session_destroy();
  if(isset($_POST['dangnhap'])){
    $taikhoan = $_POST['taikhoan'];
    $matkhau = md5($_POST['matkhau']);
    if($taikhoan == '' || $matkhau == ''){
      echo'<h3 class="text-center text-white pt-5">Nhập đủ thông tin</h3>';
    }else{
      $sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_admin WHERE email='$taikhoan' AND password= '$matkhau' LIMIT 1");
      $count = mysqli_num_rows($sql_select_admin);
      $row_dangnhap = mysqli_fetch_array($sql_select_admin);
      if($count>0){
        $_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
        $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
        header('Location: dashboard.php');
      }else{
        echo'<h4 class="text-center text-white pt-5">Tài khoản hoặc mật khẩu sai!</h4>';
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
</head>
<style>
  body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
  <body>
    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">Đăng nhập Admin</h3> -->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Đăng nhập Admin</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Tài khoản:</label><br>
                                <input type="email" name="taikhoan" placeholder="Nhập email" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mật khẩu:</label><br>
                                <input type="password" name="matkhau" placeholder="Nhập mật khẩu" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <!-- <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                                <br>
                                <input type="submit" name="dangnhap" class="btn btn-info btn-md" value="Đăng nhập Admin">
                            </div>
                            <!-- <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</body>
</html>