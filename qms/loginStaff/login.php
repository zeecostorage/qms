<?php 
	session_start();

	include '../../config/database.php';

	$email 	= $_POST['email'];
	$password 	= md5($_POST['password']);
	$exist = 0;
	
	$sql = "SELECT count(firstname) as exist from staff where email = '$email' and password = '$password'";

	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_assoc($result)){
		$exist = $row['exist'];
	}

	if($exist > 0){
		$_SESSION['email'] = $_POST['email'];
		
		echo "<script>window.location.href='../dashboard/index.php'; </script>";
	}
	else{
		echo "<script>alert ('Failed to Login');</script>";
		echo "<script>window.location.href='../loginStaff/form.php'; </script>";
	}

	mysqli_close($con);
?>