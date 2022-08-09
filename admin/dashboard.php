<?php
    session_start();
    if(!isset($_SESSION['dangnhap'])){
        header('Location: index.php');
    }
?>
<?php
if(isset($_GET['login'])){
    $dangxuat = $_GET['login'];
}else{
    $dangxuat = '';
}
if($dangxuat=='dangxuat'){
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h4 class="float-left">Xin chào : <?php echo $_SESSION['dangnhap'] ?>  </h4>
    <h4><a class="btn btn-primary float-right" href="?login=dangxuat">Đăng xuất</a></h4>
    <br>
    <br>
<br>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand font-weight-bold" href="dashboard.php">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav font-weight-bold ">
      <li class="nav-item active">
        <a class="nav-link" href="xulydanhmuc.php">Danh mục sản phẩm</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="xulydonhang.php">Đơn hàng<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
          <a class="nav-link" href="xulydanhmucbaiviet.php">Danh mục bài viết</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="xulybaiviet.php">Bài viết</a>
        </li>
    </ul>
  </div>
</nav>
<div>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://brand.assets.adidas.com/video/upload/q_auto,vc_auto/video/upload/global%20brand%20publishing/Statement/ss21-oamc/02-ss21-oamc-eplp-d.mp4"  ></iframe>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>