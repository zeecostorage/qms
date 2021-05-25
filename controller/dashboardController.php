<?php

	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		if($action == "getEventDetail"){
			getEventDetail();
		}else{
			echo '0';
		}
	}

	function status(){
		$arr[] = [
				'id' => '1',
				'name' => 'Active'
				];

		$arr[] = [
				'id' => '2',
				'name' => 'Inactive'
				];

		$arr[] = [
				'id' => '3',
				'name' => 'Pending'
				];

		return $arr;
	}

	function getCardData($con){

		$company_id = $_SESSION['company_id'];

		$sql = "SELECT 
					count(*) total_event
				from 
					event
				where company_id = '$company_id'";

		$result = mysqli_query($con,$sql);

		while($row=mysqli_fetch_array($result)){   

			$arr[] = $row;

		}

		$sql = "SELECT 
					count(*) total_event
				from 
					event
				where company_id = '$company_id' and status = '1'";

		$result = mysqli_query($con,$sql);

		while($row=mysqli_fetch_array($result)){   

			$arr[] = $row;

		}

		$sql = "SELECT 
					count(*) total_event
				from 
					event
				where company_id = '$company_id' and status = '2'";

		$result = mysqli_query($con,$sql);

		while($row=mysqli_fetch_array($result)){   

			$arr[] = $row;

		}

		$sql = "SELECT 
					count(*) total_event
				from 
					event
				where company_id = '$company_id' and status = '3'";

		$result = mysqli_query($con,$sql);

		while($row=mysqli_fetch_array($result)){   

			$arr[] = $row;

		}

		return json_encode($arr);
	}

	function getEventPending($con){

		$company_id = $_SESSION['company_id'];

		$sql = "SELECT 
					*
				from 
					event
				where company_id = '$company_id' and status = '3'";

		$result = mysqli_query($con,$sql);

		return $result;
	}

	function getEventDetail(){
		include '../config/database.php';

		$id = $_POST['id'];

		$sql = "SELECT * FROM `event` WHERE id = '$id'";

		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($result);

		// print_r($row);

		echo json_encode($row);
	}
	
?>