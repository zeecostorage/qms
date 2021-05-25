<?php
	// session_start();

	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		if($action == "getEvent"){
			getEvent();
		}else if($action == "getEventDetail"){
			getEventDetail();
		}else if($action == "saveEvent"){
			saveEvent();
		}else if($action == "editEvent"){
			editEvent();
		}else if($action == "getAppointment"){
			getAppointment();
		}else if($action == "getAppointmentCustomer"){
			getAppointmentCustomer();
		}else if($action == "saveWaiting"){
			echo "sini";
			saveWaiting();
		}else if($action == "editAppointment"){
			editAppointment();
		}else if($action == "getAppointmentDetail"){
			getAppointmentDetail();
		}else if($action == "getAppointmentForBooking"){
			getAppointmentForBooking();
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

	function schedule(){
		$arr[] = [
				'id' => '1',
				'name' => '8.00 AM'
				];

		$arr[] = [
				'id' => '2',
				'name' => '9.00 AM'
				];

		$arr[] = [
				'id' => '3',
				'name' => '10.00 AM'
				];
		$arr[] = [
				'id' => '4',
				'name' => '11.00 AM'
				];

		$arr[] = [
				'id' => '5',
				'name' => '12.00 PM'
				];

		$arr[] = [
				'id' => '6',
				'name' => '1.00 PM'
				];

		return $arr;
	}

	function day(){
		$arr[] = [
				'id' => '1',
				'name' => 'Monday'
				];

		$arr[] = [
				'id' => '2',
				'name' => 'Tuesday'
				];

		$arr[] = [
				'id' => '3',
				'name' => 'Wednesday'
				];
		$arr[] = [
				'id' => '4',
				'name' => 'Thursday'
				];

		$arr[] = [
				'id' => '5',
				'name' => 'Friday'
				];

		return $arr;
	}

	function getWaitingCustomer($con){

		$customer_id = $_SESSION['email'];

		$sql = "SELECT 
				    event.id AS event_id,
				    event.name AS event_name,
				    appointment.id AS appointment_id,
				    appointment.name AS appointment_name,
				    client.fullname as client_name,
				    waitings.wait_date AS waiting_date,
				    waitings.time AS waiting_time
				FROM
				    waitings
				        JOIN
				    appointment ON waitings.appointment_id = appointment.id
				        JOIN
				    event ON event.id = appointment.event_id
				        JOIN
				    client ON event.company_id = client.email
				WHERE
				    waitings.customer_id = '$customer_id'";

		$result = mysqli_query($con,$sql);

		return $result;
	}

	function getEventCustomer($con){

		$sql = "SELECT 
					*
				from 
					event
				where status = '1'";

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

	function getAppointmentCustomer(){
		include '../config/database.php';

		$event_id = $_POST['event_id'];

		$sql = "SELECT 
				    b.id AS event_id, 
				    b.name AS event_name,
    				b.status AS event_status,
				    a.id as appointment_id,
    				a.name as appointment_name,
				    a.description as appointment_desc,
				    if(a.status = '1', 'Active', if(a.status = '2', 'Inactive', 'Pending')) as appointment_status
				FROM
				    `appointment` a
				        RIGHT JOIN
				    `event` b ON a.event_id = b.id
				WHERE
				    b.id = '$event_id' and a.status = '1'";

		$result = mysqli_query($con,$sql);

		// $row = mysqli_free_result($result);

		while($row=mysqli_fetch_array($result)){   

			$arr[] = $row;

		}

		echo json_encode($arr);
	}

	function saveWaiting(){
		session_start();
		include '../config/database.php';
		$customer_id = $_SESSION['email'];
		$queuename = $_SESSION['staff_name'];

		$appointment_id = $_POST['appointment_id'];
		$wait_date 		= $_POST['wait_date'];
		$time 			= $_POST['time'];

		$sql = "INSERT INTO `queue`.`waitings`
				(`appointment_id`, queuename,
				`wait_date`,
				`time`,
				customer_id)
				VALUES ('$appointment_id','$queuename','$wait_date','$time','$customer_id')";

				echo $sql;

		$result = mysqli_query($con,$sql);

		if($result > 0){
			echo "1";	

		}else{
			echo "0";
		}
	}

	function getAppointmentForBooking(){
		include '../config/database.php';

		$id = $_POST['id'];

		$sql = "SELECT * FROM queue.appointment where id = '$id'";

		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($result);
		$arr[] = $row;

		$event_id = $row['event_id'];

		$sql = "SELECT * FROM queue.event where id = '$event_id'";

		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($result);
		$arr[] = $row;

		$sql_detail = "SELECT * FROM queue.appointment_detail where appointment_id = '$id'";

		$result = mysqli_query($con,$sql_detail);
		while($row_detail=mysqli_fetch_array($result)){   

			$arr[] = $row_detail;

		}

		// print_r($arr);

		echo json_encode($arr);
	}

	function mailSender($to_email, $subject, $body){
		$headers = "From: izzatjohari94@gmail.com";

		mail($to_email, $subject, $body, $headers);
	}
?>