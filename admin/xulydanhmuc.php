<?php
    include('../db/connect.php');
?>

<?php
    if(isset($_POST['themdanhmuc'])){
        $tendanhmuc = $_POST['danhmuc'];
        $sql_insert = mysqli_query($con,"INSERT INTO tbl_category(category_name) values ('$tendanhmuc')");
    }elseif(isset($_POST['capnhatdanhmuc'])){
        $id_post = $_POST['id_danhmuc'];
        $tendanhmuc= $_POST['danhmuc'];
        $sql_update = mysqli_query($con,"UPDATE tbl_category SET category_name = '$tendanhmuc' WHERE category_id = '$id_post'");
        header('Location:xulydanhmuc.php');
    }
    if(isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        $sql_xoa = mysqli_query($con,"DELETE FROM tbl_category WHERE category_id='$id'"); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục</title>
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
                if(isset($_GET['quanly'])=='capnhat'){
                    $id_capnhat = $_GET['id'];
                    $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_category WHERE category_id = '$id_capnhat'");
                    $row_capnhat = mysqli_fetch_array($sql_capnhat);
            ?>
            <div class="mx-2 my-4">
                <h4>Cập nhật danh mục</h4>
                <br>
                <label  for="" >Tên danh mục</label>
                <form action="" method="post">
                    <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name'] ?>"><br>
                    <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>"><br>
                    <input type="submit" name="capnhatdanhmuc"  value="Cập nhật danh mục" class="btn btn-info">
                </form>
            </div>
            <?php
                }else{
            ?>
            <div class="mx-2 my-3">
                <h4>Thêm danh mục</h4>
                <br>
                <label  for="" >Tên danh mục</label>
                <form action="" method="post">
                    <input type="text" class="form-control" name="danhmuc" placeholder="Nhập danh mục : "><br>
                    <input type="submit" name="themdanhmuc"  value="Thêm danh mục" class="btn btn-info">
                </form>
            </div>
            <?php
                }
            ?>
            <div class="row mx-3 my-5" >
                <h4>Danh sách danh mục</h4>
                <?php
                    $sql_select = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id ASC");
                ?>
                <table class="table " style="width: 100%;">
                    <tr>
                        <th style="width: 15%;"  class="">Thứ tự</th>
                        <th style="width: 45%;" class="">Tên danh mục</th>
                        <th style="width: 35%;">Quản lý</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_category = mysqli_fetch_array($sql_select)){
                            $i++;                        
                    ?>
                    <tr>
                        <td><?php echo $i;  ?></td>
                        <td><?php echo $row_category['category_name'] ?></td>
                        <td><a class="text-decoration-none btn btn-outline-danger mr-4" href="?xoa=<?php echo $row_category['category_id'] ?>">Xóa</a><a class="text-decoration-none btn btn-outline-success" href="?quanly=?capnhat&id=<?php echo $row_category['category_id'] ?>">Cập nhật</a></td>
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