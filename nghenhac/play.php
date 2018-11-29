<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Play music</title>
</head>
<body>
	<br /><br />
	<?php 
		$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_web_nhac') or die ("Lỗi kết nối");
		$mabh = $_GET['mabh'];
		// Câu truy vấn
		$sql = "Select * From baihat Where mabh = '". $mabh ."'";
		// Thực hiện câu truy vấn, hàm này truyền hai tham số vào là biến kết nối và câu truy vấn
		$kq = mysqli_query($conn, $sql);
		// Nếu thực thi không được thì thông báo truy vấn bị sai		
		if (!$kq){
		    die ('Câu truy vấn bị sai');
		}
				
		$bhhientai = mysqli_fetch_array($kq);
	?>	
	
	<label>Tên bài hát : <?php echo $bhhientai[1]; ?></label> <br />

	<audio controls>
    	<source src="<?php echo $bhhientai[4]; ?>" type="audio/mpeg">
	</audio>
	<br />

	<?php
		// Xóa kết quả khỏi bộ nhớ
		mysqli_free_result($kq);
		 
		// Sau khi thực thi xong thì ngắt kết nối database
		mysqli_close($conn);
	?>		
</body>
</html>