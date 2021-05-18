<?php 
	include 'database.php';

	function getLkpState($con){

		$sql = "SELECT id, c_name from lkp_state where c_status = 1";

		$result = mysqli_query($con,$sql);

		$arr = array();

		while($row = mysqli_fetch_assoc($result)){
			$state = array();

			$state['id'] = $row['id'];
			$state['name'] = $row['c_name'];

			array_push($arr,$state);
		}

		return $arr;
	}

	function getLkpCountry($con){

		$sql = "SELECT id, c_name from lkp_country";

		$result = mysqli_query($con,$sql);

		$arr = array();

		while($row = mysqli_fetch_assoc($result)){
			$country = array();

			$country['id'] = $row['id'];
			$country['name'] = $row['c_name'];

			array_push($arr,$country);
		}

		return $arr;
	}

	function getClient($con){

		$sql = "SELECT email, fullname from client";

		$result = mysqli_query($con,$sql);

		$arr = array();

		while($row = mysqli_fetch_assoc($result)){
			$country = array();

			$country['id'] = $row['email'];
			$country['name'] = $row['fullname'];

			array_push($arr,$country);
		}

		return $arr;
	}

?>