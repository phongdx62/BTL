<?php 
	session_start();//Dòng lệnh session_start() sẽ đăng ký phiên làm việc của người dùng trên Server, từ đó Server sẽ tạo ra một ID riêng không trùng lặp để nhận diện cho client hiện tại. Dòng này bắt buộc có.
	if($_SESSION["level"]==2)
	{
		header("location: list_user.php");
		exit();
	}
	else
	{
		header("location: ../index/php");
		exit();
	}
?>