<?php
    include('../db/connect.php');
?>

<?php
    if(isset($_POST['themsanpham'])){
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $soluong = $_POST['soluong'];
        $gia = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $chitiet= $_POST['chitiet'];
        $mota = $_POST['mota'];
        $path = '../uploads/';
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $sql_insert_product = mysqli_query($con,"INSERT INTO tbl_sanpham(sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image,category_id) values ('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh','$danhmuc')");
        move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
    }elseif(isset($_POST['capnhatsanpham'])){
        $id_update = $_POST['id_update'];
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $soluong = $_POST['soluong'];
        $gia = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $chitiet= $_POST['chitiet'];
        $mota = $_POST['mota'];
        $path = '../uploads/';
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        if($hinhanh ==''){
            $sql_update_image = "UPDATE tbl_sanpham SET sanpham_name = '$tensanpham' ,sanpham_chitiet='$chitiet',sanpham_mota = '$mota' ,sanpham_gia = '$gia' ,sanpham_giakhuyenmai = '$giakhuyenmai' ,sanpham_soluong = '$soluong' ,category_id = '$danhmuc' WHERE sanpham_id = '$id_update' ";
        }else{
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            $sql_update_image = "UPDATE tbl_sanpham SET sanpham_name = '$tensanpham' ,sanpham_chitiet='$chitiet',sanpham_mota = '$mota' ,sanpham_gia = '$gia' ,sanpham_giakhuyenmai = '$giakhuyenmai' ,sanpham_soluong = '$soluong',sanpham_image = '$hinhanh' ,category_id = '$danhmuc' WHERE sanpham_id = '$id_update' ";
        }
        mysqli_query($con,$sql_update_image);
    }
?>
<?php
    if(isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        $sql_xoa = mysqli_query($con,"DELETE FROM tbl_sanpham WHERE sanpham_id='$id'"); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S???n Ph???m</title>
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
            <a class="nav-link" href="xulydanhmuc.php">Danh m???c s???n ph???m</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="xulysanpham.php">S???n ph???m</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="xulykhachhang.php">Kh??ch h??ng</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="xulydonhang.php">????n h??ng<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="xulydanhmucbaiviet.php">Danh m???c b??i vi???t</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="xulybaiviet.php">B??i vi???t</a>
        </li>
    </ul>
  </div>
</nav>
    
        <div class="mt-3">
            <?php
                if(isset($_GET['quanly'])=='capnhat'){
                    $id_capnhat = $_GET['capnhat_id'];
                    $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id = '$id_capnhat'");
                    $row_capnhat = mysqli_fetch_array($sql_capnhat);
                    $id_category_1 = $row_capnhat['category_id'];
            ?>
            <div class="mx-2 my-4">
                <h4>C???p nh???t s???n ph???m</h4>
                <br>
                <form  action="" method="post" enctype="multipart/form-data">
                    <div class="d-flex">
                        <div class="w-50 mr-5">
                            <label  for="" >T??n s???n ph???m</label>
                            <input type="text" class="form-control " name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"><br>
                            <input type="hidden" class="form-control " name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>"><br>
                            <label class="form-label"  for="formFile" >H??nh ???nh</label>
                            <input type="file" id="formFile" class="form-control" name="hinhanh">
                            <img src="../uploads/<?php echo $row_capnhat['sanpham_image'] ?> " height="90" width="90" alt=""><br>
                            <label  for="" >Gi?? g???c </label>
                            <input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['sanpham_gia'] ?>"><br>
                            <label  for="" >Gi?? khuy???n m??i</label>
                            <input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>"><br>
                            <label  for="" >S??? l?????ng</label>
                            <input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br>
                        </div>
                        <div class="w-50">
                            <label  for="" >M?? t???</label>
                            <textarea type="text" class="form-control" rows="6"  name="mota"><?php echo $row_capnhat['sanpham_mota'] ?></textarea><br>
                            <label  for="" >Chi ti???t</label>
                            <textarea type="text" class="form-control" rows="6" name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea><br>
                            <label  for="" >Danh m???c</label>
                            <?php
                                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id ASC");
                            ?>
                            <select name="danhmuc" class="form-control" id="">
                                <option value="0">-----Ch???n Danh m???c-----</option>
                                <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                     if($id_category_1==$row_danhmuc['category_id']){   
                                ?>
                                <option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                <?php
                                    }else{
                                ?>
                                    <option  value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select><br>
                        </div>
                    </div>
                    <input type="submit" name="capnhatsanpham"  value="C???p nh???t s???n ph???m" class="btn btn-info">
                </form>
            </div>
            <?php
                }else{
            ?>
            <div class="my-3">
                <h4>Th??m s???n ph???m</h4>
                <br>
                <form  action="" method="post" enctype="multipart/form-data">
                    <div class="d-flex">
                        <div class="w-50 mr-5">
                            <label  for="" >T??n s???n ph???m</label>
                            <input type="text" class="form-control " name="tensanpham" placeholder="Nh???p s???n ph???m : "><br>
                            <label class="form-label"  for="formFile" >H??nh ???nh</label>
                            <input type="file" id="formFile" class="form-control" name="hinhanh"><br>
                            <label  for="" >Gi?? g???c </label>
                            <input type="text" class="form-control" name="giasanpham" placeholder="Gi?? s???n ph???m : "><br>
                            <label  for="" >Gi?? khuy???n m??i</label>
                            <input type="text" class="form-control" name="giakhuyenmai" placeholder="Gi?? khuy???n m??i : "><br>
                            <label  for="" >S??? l?????ng</label>
                            <input type="text" class="form-control" name="soluong" placeholder="S??? l?????ng : "><br>
                        </div>
                        <div class="w-50">
                            <label  for="" >M?? t???</label>
                            <textarea type="text" class="form-control" rows="6" name="mota"></textarea><br>
                            <label  for="" >Chi ti???t</label>
                            <textarea type="text" class="form-control" rows="6" name="chitiet"></textarea><br>
                            <label  for="" >Danh m???c</label>
                            <?php
                                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id ASC");
                            ?>
                            <select name="danhmuc" class="form-control" id="">
                                <option value="0">-----Ch???n Danh m???c-----</option>
                                <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                ?>
                                <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                <?php
                                    }
                                ?>
                            </select><br>
                        </div>
                    </div>
                    <input type="submit" name="themsanpham"  value="Th??m s???n ph???m" class="btn btn-info">
                </form>
            </div>
            <?php
                }
            ?>
            <div class="row my-5" >
                <h4>Danh s??ch s???n ph???m</h4>
                <?php
                    $sql_select_sp = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_category WHERE tbl_sanpham.category_id=tbl_category.category_id ORDER BY tbl_sanpham.sanpham_id ASC");
                ?>
                <table class="table table-bordered" style="width: 100%;">
                    <tr>
                        <th  class="">Th??? t???</th>
                        <th  class="">T??n s???n ph???m</th>
                        <th  class="">H??nh ???nh</th>
                        <th  class="">S??? l?????ng</th>
                        <th  class="">Danh m???c</th>
                        <th  class="">Gi?? s???n ph???m</th>
                        <th  class="">Gi?? khuy???n m??i</th>
                        <th >Qu???n l??</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row_sanpham = mysqli_fetch_array($sql_select_sp)){
                            $i++;                        
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_sanpham['sanpham_name'] ?></td>
                        <td><img src="../uploads/<?php echo $row_sanpham['sanpham_image'] ?>" alt="" height="90" width="90" ></td>
                        <td><?php echo $row_sanpham['sanpham_soluong'] ?></td>
                        <td><?php echo $row_sanpham['category_name'] ?></td>
                        <td><?php echo number_format($row_sanpham['sanpham_gia']).'vn??' ?></td>
                        <td><?php echo number_format($row_sanpham['sanpham_giakhuyenmai']).'vn??' ?></td>
                        <td><a class="text-decoration-none btn btn-outline-danger mr-4" href="?xoa=<?php echo $row_sanpham['sanpham_id'] ?>">X??a</a><a class="text-decoration-none btn btn-outline-success" href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sanpham['sanpham_id'] ?>">C???p nh???t</a></td>
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