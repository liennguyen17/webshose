<?php
    include('../db/connect.php');
?>

<!-- <?php
    if(isset($_POST['capnhatdonhang'])){
        $xuly = $_POST['xuly'];
        $mahang = $_POST['mahang_xuly'];
        $sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang = '$mahang' ");
    }
?>

<?php
    if(isset($_GET['xoadonhang'])){
        $mahang = $_GET['xoadonhang'];
        $sql_delete = mysqli_query($con,"DELETE FROM tbl_donhang WHERE mahang = '$mahang'");
        header('Location:xulydonhang.php');
    }
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
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
    
        <div class="mt-3">
            <div class="mx-2 my-3">
                <h4>Khách hàng</h4>                
            </div>
            <div class="row mx-3 my-5" >
                <h5>Danh sách Khách hàng </h5>
                <?php
                    $sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang,tbl_giaodich WHERE tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhang.khachhang_id ASC");
                ?>
                <table class="table table-bordered " style="width: 100%;">
                    <tr>
                        <th  class="">Thứ tự</th>
                        <th  class="">Tên khách hàng</th>
                        <th  class="">Số điện thoại</th>
                        <th  class="">Địa chỉ</th>
                        <th  class="">Ghi chú</th>
                        <th  class="">Email</th>
                        <th  class="">Ngày đặt hàng</th>
                        <th  class="">Quản lý</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){
                            $i++;                        
                    ?>
                    <tr>
                        <td><?php echo $i;  ?></td>
                        <td><?php echo $row_khachhang['name']  ?></td>
                        <td><?php echo $row_khachhang['phone']  ?></td>
                        <td><?php echo $row_khachhang['address'] ?></td>
                        <td><?php echo $row_khachhang['note'] ?></td>
                        <td><?php echo $row_khachhang['email'] ?></td>
                        <td><?php echo $row_khachhang['ngaythang'] ?></td>
                        <td><a class="text-decoration-none btn btn-outline-success" href="?quanly=?xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>">Xem giao dịch</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <div class="row mx-3 my-4" >
                <h5>Lịch sử đơn hàng </h5>
                <br>
                <?php
                if(isset($_GET['khachhang'])){
                    $magiaodich = $_GET['khachhang'];
                }else{
                    $magiaodich = '';
                }
                    $sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham  WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich = '$magiaodich' ORDER BY tbl_giaodich.giaodich_id ASC");
                ?>
                <table class="table table-bordered" style="width: 100%;">
                    <tr>
                        <th  class="">Thứ tự</th>
                        <th  class="">Mã giao dịch</th>
                        <th  class="">Tên sản phẩm</th>
                        <th  class="">Ngày đặt</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_select)){
                            $i++;                        
                    ?>
                    <tr>
                        <td><?php echo $i;  ?></td>
                        <td><?php echo $row_donhang['magiaodich']  ?></td>
                        <td><?php echo $row_donhang['sanpham_name']  ?></td>
                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                        <!-- <td><a class="text-decoration-none btn btn-outline-danger mr-4" href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a><a class="text-decoration-none btn btn-outline-success" href="?quanly=?xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td> -->
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>