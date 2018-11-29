<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nghe nhạc</title>
</head>
<body>
	<br /><br />
	<?php 
		$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_web_nhac') or die ("Lỗi kết nối");
		// Câu truy vấn
		$sql = 'Select * From baihat';
		// Thực hiện câu truy vấn, hàm này truyền hai tham số vào là biến kết nối và câu truy vấn
		$kq = mysqli_query($conn, $sql);
		// Nếu thực thi không được thì thông báo truy vấn bị sai
		if (!$kq){
		    die ('Câu truy vấn bị sai');
		}
		 
		while ($row = mysqli_fetch_array($kq)) {		
	?>
	<a href="play.php?mabh=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a> <br />
	<?php
		}	
	?>

	<?php
		// Xóa kết quả khỏi bộ nhớ
		mysqli_free_result($kq);
		 
		// Sau khi thực thi xong thì ngắt kết nối database
		mysqli_close($conn);
	?>
</body>
</html>