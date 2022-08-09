<?php
    include('../db/connect.php');
?>

<?php
    if(isset($_POST['capnhatdonhang'])){
        $xuly = $_POST['xuly'];
        $mahang = $_POST['mahang_xuly'];
        $sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang = '$mahang' ");
        $sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET tinhtrangdon='$xuly' WHERE magiaodich = '$mahang' ");
    }
?>

<?php
    if(isset($_GET['xoadonhang'])){
        $mahang = $_GET['xoadonhang'];
        $sql_delete = mysqli_query($con,"DELETE FROM tbl_donhang WHERE mahang = '$mahang'");
        header('Location:xulydonhang.php');
    }
    if(isset($_GET['xacnhanhuy'])&& isset($_GET['mahang'])){
        $huydon = $_GET['xacnhanhuy'];
        $magiaodich = $_GET['mahang'];
    }else{
        $huydon = '';
        $magiaodich = '';
    }
    $sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
    $sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
    // header('Location:xulydonhang.php?quanly=?xemdonhang&mahang='.$magiaodich);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>
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
            <?php
                if(isset($_GET['quanly'])=='xemdonhang'){
                    $mahang = $_GET['mahang'];
                    $sql_chitiet = mysqli_query($con,"SELECT * FROM tbl_donhang,tbl_sanpham WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.mahang = '$mahang'");
                    $row_chitiet = mysqli_fetch_array($sql_chitiet);
                    ?>
                    <br>
                    <h3>Chi tiết đơn hàng</h3>
                    <form action="" method="post">
                    <table class="table table-bordered" style="width: 100%;">
                    <tr>
                        <th  class="">Thứ tự</th>
                        <th  class="">Mã hàng</th>
                        <th  class="">Tên sản phẩm</th>
                        <th  class="">Số lượng</th>
                        <th  class="">Giá</th>
                        <th  class="">Tổng tiền</th>
                        <th  class="">Ngày đặt hàng</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_chitiet)){
                            $i++;                        
                    ?>
                    <tr>
                        <td><?php echo $i;  ?></td>
                        <td><?php echo $row_donhang['mahang'];  ?></td>
                        <td><?php echo $row_donhang['sanpham_name'];  ?></td>
                        <td><?php echo $row_donhang['soluong'];  ?></td>
                        <td><?php echo number_format($row_donhang['sanpham_giakhuyenmai']).'vnđ';  ?></td>
                        <td><?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_giakhuyenmai']).'vnđ';  ?></td>
                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                        <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang']?>">
                        
                        </td>
                        <!-- <td><a class="text-decoration-none btn btn-outline-danger mr-4" href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a><a class="text-decoration-none btn btn-outline-success" href="?quanly=?xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td> -->
                    </tr>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <select class="form-control my-3 w-25" name="xuly">
                        <option value="1">Đã xử lý | Giao hàng</option>
                        <option value="0">Chưa xử lý</option>
                </select>
                <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success">
                    </form>
            <?php
                }else{
            ?>
            <div class="mx-2 my-3">
                <h4>Đơn hàng</h4>
            </div>
            <?php
                }
            ?>
            <div class="row  my-4" >
                <h5>Danh sách đơn hàng </h5>
                <?php
                    $sql_select = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang ");
                ?>
                <table class="table table-bordered" style="width: 100%;">
                    <tr>
                        <th  class="">Thứ tự</th>
                        <th  class="">Mã hàng</th>
                        <th  class="">Tên khách hàng</th>
                        <th  class="">Ngày đặt hàng</th>
                        <th  class="">Ghi chú</th>
                        <th  class="">Tình trạng</th>
                        <th  class="">Hủy đơn</th>
                        <th  class="">Quản lý</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_select)){
                            $i++;                        
                    ?>
                    <tr>
                        <td><?php echo $i;  ?></td>
                        <td><?php echo $row_donhang['mahang']  ?></td>
                        <td><?php echo $row_donhang['name']  ?></td>
                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                        <td><?php echo $row_donhang['note'] ?></td>
                        <td><?php
                            if($row_donhang['tinhtrang']==0){
                                echo 'Chưa xử lý';
                            }else{
                                echo 'Đã xử lý';
                            }    
                        ?></td>
                        <td><?php if($row_donhang['huydon']==0){ }elseif($row_donhang['huydon']==1){
                            echo '<a href="xulydonhang.php?quanly=?xemdonhang&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2" class="btn btn-outline-primary">Xác nhận hủy đơn</a>';
                        }else{
                            echo 'Đã hủy';
                        } ?></td>
                        <td><a class="text-decoration-none btn btn-outline-danger mr-4" href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a><a class="text-decoration-none btn btn-outline-success" href="?quanly=?xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td>
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