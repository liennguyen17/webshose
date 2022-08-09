<?php
    if(isset($_GET['huydon'])&& isset($_GET['magiaodich'])){
        $huydon = $_GET['huydon'];
        $magiaodich = $_GET['magiaodich'];
    }else{
        $huydon = '';
        $magiaodich = '';
    }
    $sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
    $sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
?>
<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>Xem đơn hàng</span></h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<!-- <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4"> -->
				    <div class="row">
								<?php
                                if(isset($_SESSION['dangnhap_home'])){
                                    echo '<h3>Đơn hàng : '.$_SESSION['dangnhap_home'].'</h3><br><br>';
                                }
                                ?>
                    <div class="row mx-3 my-4" >
                        <h5>Lịch sử đơn hàng </h5>
                        <br>
                        <br>
                        <?php
                        if(isset($_GET['khachhang'])){
                            $id_khachhang = $_GET['khachhang'];
                        }else{
                            $id_khachhang = '';
                        }
                            $sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich WHERE tbl_giaodich.khachhang_id='$id_khachhang' GROUP BY tbl_giaodich.magiaodich ");
                        ?>
                        <table class="table table-bordered" style="width: 100%;">
                            <tr>
                                <th  class="">Thứ tự</th>
                                <th  class="">Mã giao dịch</th>
                                <th  class="">Ngày đặt</th>
                                <th  class="">Tình trạng</th>
                                <th  class="">Quản lý</th>
                                <th  class="">Yêu cầu</th>
                            </tr>
                            <?php
                                $i = 0;
                                while($row_donhang = mysqli_fetch_array($sql_select)){
                                    $i++;                        
                            ?>
                            <tr>
                                <td><?php echo $i;  ?></td>
                                <td><?php echo $row_donhang['magiaodich']  ?></td>
                                <td><?php echo $row_donhang['ngaythang'] ?></td>
                                <td>
                                    <?php
                                    if($row_donhang['tinhtrangdon']==0){
                                        echo 'Đã đặt hàng';
                                    }else{
                                        echo 'Đơn hàng đã được xử lý ,đang tiến hành giao hàng';
                                    }
                                    ?>
                                </td>
                                <td><a class="text-decoration-none btn btn-outline-success" href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Xem chi tiết</a></td>
                                <td>
                                    <?php
                                    if($row_donhang['huydon']==0){
                                    ?>
                                <a class="text-decoration-none btn btn-outline-danger mr-4" href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>&huydon=1">Hủy đơn hàng</a>
                                    <?php
                                        }elseif($row_donhang['huydon']==1){
                                    ?>
                                        <p>Đang chờ hủy...</p>
                                    <?php
                                        }else{
                                            echo 'Đã hủy !';
                                        }
                                    ?>
                            </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                </div>
                    <div class="row mx-3 my-4" >
                    <h5>Chi tiết đơn hàng </h5>
                    <br>
                    <br>
                    <?php
                    if(isset($_GET['magiaodich'])){
                        $magiaodich = $_GET['magiaodich'];
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
                            <th  class="">Số lượng</th>
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
                            <td><?php echo $row_donhang['soluong']  ?></td>
                            <td><?php echo $row_donhang['ngaythang'] ?></td>
                            <!-- <td><a class="text-decoration-none btn btn-outline-danger mr-4" href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a><a class="text-decoration-none btn btn-outline-success" href="?quanly=?xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td> -->
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
			</div>
						<!-- </div> -->
						<!-- //first section -->
					</div>
				</div>
				<!-- //product left -->
				<!-- product right -->
				
			</div>
		</div>
	</div>
	<!-- //top products -->