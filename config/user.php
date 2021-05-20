<?php 
	include 'database.php';

	session_start();
	
	function getUser($con){

		$email = $_SESSION['email'];
		$role_id = "";

		$sql = "SELECT staff.*,role_id from role_staff join staff on role_staff.staff_id = staff.email where staff_id = '$email'";

		$result = mysqli_query($con,$sql);

		$row = mysqli_fetch_assoc($result);

		return $row;
	}

	function getUserType(){
		return $_SESSION['user_type'];
	}
	
?>