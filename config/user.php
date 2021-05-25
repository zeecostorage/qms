<?php 
	include 'database.php';

	
	function getUser($con){

		if(isset($_SESSION['staff_id'])){

			$email = $_SESSION['staff_id'];
			$role_id = "";

			$sql = "SELECT staff.*,role_id from role_staff join staff on role_staff.staff_id = staff.email where staff_id = '$email'";

			$result = mysqli_query($con,$sql);

			$row = mysqli_fetch_assoc($result);

			return $row;
		}else{

			$email = $_SESSION['email'];
			$role_id = "";

			$sql = "SELECT * from customer where email = '$email'";

			$result = mysqli_query($con,$sql);

			$row = mysqli_fetch_assoc($result);

			return $row;
		}
	}

	function getUserType(){
		return $_SESSION['user_type'];
	}
	
?>