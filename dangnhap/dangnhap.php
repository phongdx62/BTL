<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
</head>
<body>
	<?php
	$loi = array();
	$taikhoan = $matkhau = NULL;
	$loi["taikhoan"] = $loi["matkhau"] = $loi["dangnhap"] = NULL;
	if(isset($_POST["ok"]))  
	{
		//Kiểm tra nhập tài khoản chưa
		if(empty($_POST["taikhoan"]))
		{
			$loi["taikhoan"] = "* Vui lòng nhập tài khoản<br />";
		}
		else
		{
			$taikhoan = $_POST["taikhoan"];
		}
		//Kiểm tra nhập mật khẩu chưa
		if(empty($_POST["matkhau"]))
		{
			$loi["matkhau"] = "* Vui lòng nhập mật khẩu<br />";
		}
		else
		{
			$matkhau = $_POST["matkhau"];
		}
		//Xử lý đăng nhập
		if(isset($taikhoan) && isset($matkhau))
		{
			//Mở kết nối với CSDL
			$server_username = "root";
			$server_password = "";
			$server_host = "localhost";
			$database = 'quan_ly_web_nhac';
			 
			$conn = mysqli_connect($server_host,$server_username,$server_password,$database) or die("không thể kết nối tới database");
			//Thực hiện câu truy vấn
			$sql = "SELECT * FROM thanhvien WHERE taikhoan = '$taikhoan' AND matkhau = '$matkhau'";
			$kq = mysqli_query($conn,$sql);
			if(mysqli_num_rows($kq) == 1)
			{
				//$_SESSION["taikhoan"] = $taikhoan;
				header("location : index.php");
				exit();
			}
			else
			{
				$loi["dangnhap"] = "* Bạn nhập sai tài khoản hoặc mật khẩu";
			}
			//Đóng kết nối
			mysqli_close($conn);
		}
	}		
	?>
	<form action="dangnhap.php" method="post">
	<fieldset style="width: 340px;margin: 140px auto 0px;height: 120px;">
	    <legend>Đăng nhập</legend>
			<table>
				<tr>
					<td>Tài khoản</td>
					<td><input type="text" size="30" name="taikhoan"></td>
				</tr>
				<tr>
					<td>Mật khẩu</td>
					<td><input type="password" size="30" name="matkhau"></td>
				</tr>
				<tr>
					<td></td>
					<td align="center"><input type="submit" name="ok" value="Đăng nhập"></td>
				</tr>		
			</table>
	</form>
	</fieldset>
	<div style="width: 340px;height: 120px;margin: 10px auto;text-align: center;;color: red;">
		<?php
			echo $loi["taikhoan"];
			echo $loi["matkhau"];
			echo $loi["dangnhap"];  
		?>
	</div>
</body>
</html>