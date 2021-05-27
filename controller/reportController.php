<?php

	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		if($action == "getData"){
			getData();
		}
		else{
			echo '0';
		}
	}

	function getYear(){

		for ($i=2000; $i < 2025; $i++) { 
			$arr[] = [
				'id' => $i,
				'name' => $i
				];
		}

		return $arr;
	}

	function getMonth(){
		$month_arr = array("January","February","March","April","May","June","July","August","September","October","November","December");

		for ($i=1; $i < 13; $i++) { 
			$arr[] = [
				'id' => $i,
				'name' => $month_arr[$i-1]
				];
		}

		return $arr;
	}

	function getData(){
		session_start();

		include '../config/database.php';

		$main = array();
		$event = array();
		$appointment = array();
		$waiting = array();;

		$company_id = $_SESSION['company_id'];

		$year 	= $_POST['h_year'];
		$month 	= $_POST['h_month'];

		$date = $month.'-'.$year;

		$sql = "SELECT count(id) as exist FROM queue.event where date_format(start_date, '%m-%Y') like '%$date' and company_id = 'syalinda@gmail.com'";
// echo $sql;
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);

		if($row['exist'] > 0){

			$sql = "SELECT id as event_id, name as event_name, start_date, end_date FROM queue.event where date_format(start_date, '%m-%Y') like '%$date' and company_id = 'syalinda@gmail.com'";

			$result = mysqli_query($con,$sql);

			while($row=mysqli_fetch_assoc($result)){   

				$event[] = $row;

				$event_id = $row['event_id'];

				$sql2 = "SELECT id as appointment_id, name as appointment_name, event_id FROM queue.appointment where event_id = '$event_id'";

				$result2 = mysqli_query($con,$sql2);
				
				while($row2=mysqli_fetch_assoc($result2)){   
					$appointment[] = $row2;

					$appointment_id = $row2['appointment_id'];

					$sql3 = "SELECT id,appointment_id,queuename,wait_date,TIME_FORMAT(time, '%H:%i %p') as `time`,counterNum FROM queue.waitings where appointment_id = '$appointment_id'  order by time asc";

					$result3 = mysqli_query($con,$sql3);
					while($row3=mysqli_fetch_assoc($result3)){   

						$waiting[] = $row3;

					}

				}

			}

			$main[] = $event;
			$main[] = $appointment;
			$main[] = $waiting;

			echo json_encode($main);
		}
	}

?>