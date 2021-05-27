<?php 
	session_start();

	include '../../config/database.php';

	$email 		= $_POST['email'];
	$password 	= md5($_POST['password']);
	$exist = 0;
	$company_id = "";
	$firstname = "";
	$user_type = "";
	
	$sql = "SELECT count(staff.email) as exist, staff.company_id, staff.firstname, role_staff.role_id from staff join role_staff on staff.email = role_staff.staff_id where email = '$email' and password = '$password'";

	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_assoc($result)){
		$exist = $row['exist'];
		$company_id = $row['company_id'];
		$firstname = $row['firstname'];
		$user_type = $row['role_id'];

	}

	if($exist > 0){
		$_SESSION['staff_id'] = $_POST['email'];
		$_SESSION['staff_name'] = $firstname;
		$_SESSION['user_type'] = $user_type;
		$_SESSION['company_id'] = $company_id;
		
		if($user_type == 1){
			echo "<script>window.location.href='../event/main.php'; </script>";
		}else if($user_type == 2){
			echo "<script>window.location.href='../dashboardManager/index.php'; </script>";
		}else if($user_type == 3){
			echo "<script>window.location.href='../event/staffMain.php'; </script>";
		}
	}
	else{
		echo "<script>alert ('Failed to Login');</script>";
		echo "<script>window.location.href='../staff/login.php'; </script>";
	}

	mysqli_close($con);
?>