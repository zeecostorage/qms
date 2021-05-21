<?php 
	session_start();

	include '../../config/database.php';

	$email 		= $_POST['email'];
	$password 	= md5($_POST['password']);
	$exist = 0;
	
	$sql = "SELECT count(email) as exist from client where email = '$email' and password = '$password'";

	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_assoc($result)){
		$exist = $row['exist'];
	}

	if($exist > 0){
		$_SESSION['staff_id'] = $_POST['email'];
		$_SESSION['user_type'] = "1";
		$_SESSION['company_id'] = $_POST['email'];
		
		echo "<script>window.location.href='../dashboardStaff/index.php'; </script>";
	}
	else{
		echo "<script>alert ('Failed to Login');</script>";
		echo "<script>window.location.href='../staff/login.php'; </script>";
	}

	mysqli_close($con);
?>