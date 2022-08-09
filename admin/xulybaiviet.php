<?php
    include('../db/connect.php');
?>

<?php
    if(isset($_POST['thembaiviet'])){
        $tenbaiviet = $_POST['tenbaiviet'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $danhmuc = $_POST['danhmuc'];
        $chitiet= $_POST['chitiet'];
        $mota = $_POST['mota'];
        $path = '../uploads/';
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $sql_insert_product = mysqli_query($con,"INSERT INTO tbl_baiviet(tenbaiviet,tomtat,noidung,danhmuctin_id,baiviet_image) values ('$tenbaiviet','$mota','$chitiet','$danhmuc','$hinhanh')");
        move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
    }elseif(isset($_POST['capnhatbaiviet'])){
        $id_update = $_POST['id_update'];
        $tenbaiviet = $_POST['tenbaiviet'];
        $hinhanh = $_FILES['hinhanh']['name'];       
        $danhmuc = $_POST['danhmuc'];
        $chitiet= $_POST['chitiet'];
        $mota = $_POST['mota'];
        $path = '../uploads/';
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        if($hinhanh ==''){
            $sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet = '$tenbaiviet' ,noidung='$chitiet',tomtat = '$mota' ,danhmuctin_id = '$danhmuc' WHERE baiviet_id = '$id_update' ";
        }else{
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            $sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet = '$tenbaiviet' ,noidung='$chitiet',tomtat = '$mota' ,danhmuctin_id = '$danhmuc',baiviet_image = '$hinhanh' WHERE baiviet_id = '$id_update' ";
        }
        mysqli_query($con,$sql_update_image);
    }
?>
<?php
    if(isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        $sql_xoa = mysqli_query($con,"DELETE FROM tbl_baiviet WHERE baiviet_id='$id'"); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
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
                    $id_capnhat = $_GET['capnhat_id'];
                    $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_baiviet WHERE baiviet_id = '$id_capnhat'");
                    $row_capnhat = mysqli_fetch_array($sql_capnhat);
                    $id_category_1 = $row_capnhat['danhmuctin_id'];
            ?>
            <div class="mx-2 my-4">
                <h4>Cập nhật bài viết</h4>
                <br>
                <form  action="" method="post" enctype="multipart/form-data">
                    <div class="d-flex">
                        <div class="w-50 mr-5">
                            <label  for="" >Tên bài viết</label>
                            <input type="text" class="form-control " name="tenbaiviet" value="<?php echo $row_capnhat['tenbaiviet'] ?>"><br>
                            <input type="hidden" class="form-control " name="id_update" value="<?php echo $row_capnhat['baiviet_id'] ?>"><br>
                            <label class="form-label"  for="formFile" >Hình ảnh</label>
                            <input type="file" id="formFile" class="form-control" name="hinhanh">
                            <img src="../uploads/<?php echo $row_capnhat['baiviet_image'] ?> " height="90" width="90" alt=""><br>
                            <label  for="" >Danh mục</label>
                            <?php
                                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tintuc ORDER BY danhmuctin_id ASC");
                            ?>
                            <select name="danhmuc" class="form-control" id="">
                                <option value="0">-----Chọn Danh mục-----</option>
                                <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                     if($id_category_1==$row_danhmuc['danhmuctin_id']){   
                                ?>
                                <option selected value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                                <?php
                                    }else{
                                ?>
                                    <option  value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select><br>                            
                        </div>
                        <div class="w-50">
                            <label  for="" >Mô tả</label>
                            <textarea type="text" class="form-control" rows="6"  name="mota"><?php echo $row_capnhat['tomtat'] ?></textarea><br>
                            <label  for="" >Chi tiết</label>
                            <textarea type="text" class="form-control" rows="6" name="chitiet"><?php echo $row_capnhat['noidung'] ?></textarea><br>
                            
                        </div>
                    </div>
                    <input type="submit" name="capnhatbaiviet"  value="Cập nhật bài viết" class="btn btn-info">
                </form>
            </div>
            <?php
                }else{
            ?>
            <div class="my-3">
                <h4>Thêm bài viết</h4>
                <br>
                <form  action="" method="post" enctype="multipart/form-data">
                    <div class="d-flex">
                        <div class="w-50 mr-5">
                            <label  for="" >Tên bài viết</label>
                            <input type="text" class="form-control " name="tensanpham" placeholder="Nhập tên bài viết : "><br>
                            <label class="form-label"  for="formFile" >Hình ảnh</label>
                            <input type="file" id="formFile" class="form-control" name="hinhanh"><br>
                            <label  for="" >Danh mục</label>
                            <?php
                                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tintuc ORDER BY danhmuctin_id ASC");
                            ?>
                            <select name="danhmuc" class="form-control" id="">
                                <option value="0">-----Chọn Danh mục-----</option>
                                <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                ?>
                                <option value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                                <?php
                                    }
                                ?>
                            </select><br>
                        </div>
                        <div class="w-50">
                            <label  for="" >Mô tả</label>
                            <textarea type="text" class="form-control" rows="5" name="mota"></textarea><br>
                            <label  for="" >Chi tiết</label>
                            <textarea type="text" class="form-control" rows="5" name="chitiet"></textarea><br>
                            
                        </div>
                    </div>
                    <input type="submit" name="thembaiviet"  value="Thêm bài viết" class="btn btn-info">
                </form>
            </div>
            <?php
                }
            ?>
            <div class="row my-5" >
                <h4>Danh sách bài viết</h4>
                <?php
                    $sql_select_bv = mysqli_query($con,"SELECT * FROM tbl_baiviet,tbl_danhmuc_tintuc WHERE tbl_baiviet.danhmuctin_id=tbl_danhmuc_tintuc.danhmuctin_id ORDER BY tbl_baiviet.baiviet_id ASC");
                ?>
                <table class="table table-bordered" style="width: 100%;">
                    <tr>
                        <th  class="">Thứ tự</th>
                        <th  class="">Tên sản phẩm</th>
                        <th  class="">Hình ảnh</th>                        
                        <th  class="">Danh mục</th>                        
                        <th >Quản lý</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_bv = mysqli_fetch_array($sql_select_bv)){
                            $i++;                        
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_bv['tenbaiviet'] ?></td>
                        <td><img src="../uploads/<?php echo $row_bv['baiviet_image'] ?>" alt="" height="90" width="90" ></td>
                        <td><?php echo $row_bv['tendanhmuc'] ?></td>                        
                        <td><a class="text-decoration-none btn btn-outline-danger mr-4" href="?xoa=<?php echo $row_bv['baiviet_id'] ?>">Xóa</a><a class="text-decoration-none btn btn-outline-success" href="xulybaiviet.php?quanly=capnhat&capnhat_id=<?php echo $row_bv['baiviet_id'] ?>">Cập nhật</a></td>
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