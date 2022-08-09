<?php
if(isset($_GET['id_tin'])){
    $id_danhmuc = $_GET['id_tin'];
}else{
    $id_danhmuc = '';
}
?>
<!-- page -->
<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">TRANG CHỦ</a>
						<i>|</i>
					</li>
                    <?php
                    $sql_tendanhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tintuc WHERE danhmuctin_id='$id_danhmuc'");
                    $row_danhmuc = mysqli_fetch_array($sql_tendanhmuc);
                    ?>
					<li><?php echo $row_danhmuc['tendanhmuc'] ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
            <?php
                $sql_tendanhmuc1 = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tintuc WHERE danhmuctin_id='$id_danhmuc'");
                $row_danhmuc1 = mysqli_fetch_array($sql_tendanhmuc1);
                ?>
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3" style="color: red;">
				<span><?php echo $row_danhmuc1['tendanhmuc'] ?></span></h3>
			<!-- //tittle heading -->
			<?php 
			$sql_baiviet = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tintuc,tbl_baiviet WHERE tbl_danhmuc_tintuc.danhmuctin_id = tbl_baiviet.danhmuctin_id AND tbl_danhmuc_tintuc.danhmuctin_id='$id_danhmuc'");
			while($row_baiviet = mysqli_fetch_array($sql_baiviet)){
			?>
			<div class="row">
				<div class="col-lg-6 welcome-left">
					<h3><a href="index.php?quanly=chitiettin&id_tin=<?php echo $row_baiviet['baiviet_id'] ?>"><?php echo $row_baiviet['tenbaiviet'] ?></a></h3>
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet['tomtat'] ?></h4>
					<p></p>
				</div>
				<div class="col-lg-6 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
					<img src="images/<?php echo $row_baiviet['baiviet_image'] ?>" class="img-fluid" alt=" ">
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>
	<!-- //about -->