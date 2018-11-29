<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng ký</title>
</head>
<body>
	<?php
		//Khai báo biến và mảng lỗi
		$loi = array();
		$taikhoan=$matkhau=$email=$ngaysinh=NULL;
		$loi["taikhoan"]=$loi["matkhau"]=$loi["email"]=$loi["ngaysinh"]=$loi["dangky"]=NULL;
		if(isset($_POST["ok"])) 
		{
  			//lấy thông tin từ các form bằng phương thức POST		  			
  			$gioitinh = $_POST["gioitinh"]; 			 			

  			//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống 			
			if(empty($_POST["taikhoan"]))
			{
				$loi["taikhoan"] = "* Vui lòng nhập vào tài khoản<br />";
			}
			else
			{
				$taikhoan = $_POST["taikhoan"];
			} 
			if(empty($_POST["matkhau"]))
			{
				$loi["matkhau"] = "* Vui lòng nhập vào mật khẩu<br />";
			}
			else
			{
				$matkhau = $_POST["matkhau"];
			}
			if(empty($_POST["email"]))
			{
				$loi["email"] = "* Xin vui lòng nhập vào email   <br />";
			}
			else
			{
				$email = $_POST["email"];
			}
			if($_POST["ngay"] == "date" || $_POST["thang"] == "month" || $_POST["nam"] == "year")
			{
				$loi["ngaysinh"] = "* Vui lòng nhập vào ngày sinh<br />";
			}
			else
			{
				$ngay = $_POST["ngay"];
				$thang = $_POST["thang"];
				$nam = $_POST["nam"];
			}
		}		
	  	if(isset($taikhoan) && isset($matkhau) && isset($email) && isset($ngay) && isset($thang) && isset($nam))
	  	{
	  		$server_username = "root";
			$server_password = "";
			$server_host = "localhost";
			$database = 'quan_ly_web_nhac';
			 
			$conn = mysqli_connect($server_host,$server_username,$server_password,$database) or die("không thể kết nối tới database");
			//mysqli_query($conn,"SET NAMES 'UTF8'");
	  		// Kiểm tra tài khoản đã tồn tại chưa
	  		$sql="SELECT * FROM thanhvien WHERE taikhoan='$taikhoan'";
			$kt=mysqli_query($conn, $sql);
	 
			if(mysqli_num_rows($kt) > 0)
			{
				$loi["dangky"] = "* Tài khoản đã tồn tại";
			}
			else
			{
				//thực hiện việc lưu trữ dữ liệu vào db
		    	$sql = "INSERT INTO thanhvien(
		    				taikhoan,
		    				matkhau,
		    				email,
							gioitinh,
							ngaysinh							
		    				) VALUES (
		    				'$taikhoan',
		    				'$matkhau',
							'$email',
		    				'$gioitinh',
		    				'$nam-$thang-$ngay'		    				
		    				)";
				
	   			mysqli_query($conn,$sql);
				$loi["dangky"] = "* Đăng kí thành công, <a href='dangnhap.php'>Đăng nhập</a> để vào website<br />";	
			}			
			// Sau khi thực thi xong thì ngắt kết nối database
			mysqli_close($conn);											    
		}				 					
	?>	
	<fieldset style="width: 280px;margin: 140px auto 0px;height: 200px;">
		<legend style="margin-left: 10px;">Đăng ký tài khoản</legend>
		<form action="../project/login.html" method="post">
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
					<td>Email</td>
					<td><input type="text" size="30" name="email"></td>
				</tr>
				<tr>
					<td>Giới tính</td>
					<td>
						<input type="radio" name="gioitinh" value="1" checked="checked">Nam
						<input type="radio" name="gioitinh" value="0">Nữ
					</td>			
				</tr>
				<tr>
					<td>Ngày sinh</td>
					<td>
						<select name="ngay">
							<option value="date">Ngày</option>
							<?php  
								for($i=1;$i<=31;$i++)
								{
									echo "<option value='$i'>$i</option>";
								}
							?>			
						</select>
						<select name="thang">
							<option value="month">Tháng</option>
							<?php  
								for($i=1;$i<=12;$i++)
								{
									echo "<option value='$i'>$i</option>";
								}
							?>			
							</select>
						<select name="nam">
							<option value="year">Năm</option>
							<?php  
								for($i=1900;$i<=date("Y");$i++)
								{
									echo "<option value='$i'>$i</option>";
								}
							?>			
						</select>
					</td>
				</tr>						
				<tr>
					<td></td>
					<td><input type="submit" name="ok" value="Đăng ký"></td>
				</tr>
			</table>
		</form>
	</fieldset>
	<div style="width: 290px;height: 170px;margin: 10px auto;text-align:center;color:red;">
		<?php
			echo $loi["taikhoan"];
			echo $loi["matkhau"];
			echo $loi["email"];
			echo $loi["ngaysinh"];
			echo $loi["dangky"];
		?>
	</div>		
</body>
</html>