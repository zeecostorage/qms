<?php
	// session_start();

	include '../../config/database.php';

	function getUserList($con){

		$company_id = $_SESSION['company_id'];

		$sql = "SELECT 
					staff.*, role.name as role_name
				from 
					staff 
						join role_staff on staff.email = role_staff.staff_id 
						join role on role.id = role_staff.role_id 
				where company_id = '$company_id'";

		$result = mysqli_query($con,$sql);

		return $result;
	}
?>