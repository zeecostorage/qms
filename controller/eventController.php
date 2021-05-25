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
		}else if($action == "saveAppointment"){
			saveAppointment();
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


	function getEvent($con){

		$company_id = $_SESSION['company_id'];

		$sql = "SELECT 
					*
				from 
					event
				where company_id = '$company_id'";

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

	function saveEvent(){
		session_start();
		include '../config/database.php';
		$company_id = $_SESSION['company_id'];

		$name 			= $_POST['name'];
		$description 	= $_POST['description'];
		$start_date 	= $_POST['start_date'];
		$end_date		= $_POST['end_date'];
		$status 		= $_POST['status'];

		$sql = "INSERT INTO `queue`.`event`
				(`name`,
				`description`,
				`start_date`,
				`end_date`,
				`status`,
				company_id)
				VALUES ('$name','$description','$start_date','$end_date','$status','$company_id')";

		$result = mysqli_query($con,$sql);

		if($result > 0){

			$to_email = "hazimahrahman98@gmail.com";
			$subject = "Request for Event Approval";
			$body = "Dear Sir/ Madam, \n\nRequesting Approval for Event ".$name.". Event will start on ".$start_date."\n\nThank You";

			mailSender($to_email, $subject, $body);

			echo "1";	

		}else{
			echo "0";
		}
	}

	function editEvent(){
		session_start();
		include '../config/database.php';

		$id 			= $_POST['id'];
		$name 			= $_POST['name'];
		$description 	= $_POST['description'];
		$start_date 	= $_POST['start_date'];
		$end_date		= $_POST['end_date'];
		$status 		= $_POST['status'];

		$sql = "UPDATE `queue`.`event`
				SET
				`name` = '$name',
				`description` = '$description',
				`start_date` = '$start_date',
				`end_date` = '$end_date',
				`status` = '$status'
				WHERE `id` = '$id'";

		$result = mysqli_query($con,$sql);

		if($result > 0){
			echo "1";	

		}else{
			echo "0";
		}
	}

	function getAppointment(){
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
				    b.id = '$event_id'";

		$result = mysqli_query($con,$sql);

		// $row = mysqli_free_result($result);

		while($row=mysqli_fetch_array($result)){   

			$arr[] = $row;

		}

		echo json_encode($arr);
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

	function saveAppointment(){
		session_start();
		include '../config/database.php';
		$company_id = $_SESSION['company_id'];

		$event_id 		= $_POST['event_id'];
		$name 			= $_POST['name'];
		$description 	= $_POST['description'];
		$status 		= $_POST['status'];
		$timeMonday		= $_POST['timeMonday'];
		$timeTuesday	= $_POST['timeTuesday'];
		$timeWednesday 	= $_POST['timeWednesday'];
		$timeThursday 	= $_POST['timeThursday'];
		$timeFriday		= $_POST['timeFriday'];

		$sql = "INSERT INTO `queue`.`appointment`
				(`name`,
				`description`,
				`status`,
				event_id)
				VALUES ('$name','$description','$status','$event_id')";

		$result = mysqli_query($con,$sql);

		if($result > 0){
			$app_id = $con->insert_id;

			if($timeMonday){
				
				$sql = "INSERT INTO `queue`.`appointment_detail`
						(`appointment_id`,
						`day`,
						`start_time`)
						VALUES ('$app_id','1','$timeMonday')";

				$result = mysqli_query($con,$sql);
			}
			if($timeTuesday){
				
				$sql = "INSERT INTO `queue`.`appointment_detail`
						(`appointment_id`,
						`day`,
						`start_time`)
						VALUES ('$app_id','2','$timeTuesday')";

				$result = mysqli_query($con,$sql);
			}
			if($timeWednesday){
				
				$sql = "INSERT INTO `queue`.`appointment_detail`
						(`appointment_id`,
						`day`,
						`start_time`)
						VALUES ('$app_id','3','$timeWednesday')";

				$result = mysqli_query($con,$sql);
			}
			if($timeThursday){
				
				$sql = "INSERT INTO `queue`.`appointment_detail`
						(`appointment_id`,
						`day`,
						`start_time`)
						VALUES ('$app_id','4','$timeThursday')";

				$result = mysqli_query($con,$sql);
			}
			if($timeFriday){
				
				$sql = "INSERT INTO `queue`.`appointment_detail`
						(`appointment_id`,
						`day`,
						`start_time`)
						VALUES ('$app_id','5','$timeFriday')";

				$result = mysqli_query($con,$sql);
			}		

		}else{
			echo "0";
		}
	}

	function editAppointment(){
		session_start();
		include '../config/database.php';
		$company_id = $_SESSION['company_id'];

		$id 			= $_POST['id'];
		$name 			= $_POST['name'];
		$description 	= $_POST['description'];
		$status 		= $_POST['status'];
		$timeMonday		= $_POST['timeMonday'];
		$timeTuesday	= $_POST['timeTuesday'];
		$timeWednesday 	= $_POST['timeWednesday'];
		$timeThursday 	= $_POST['timeThursday'];
		$timeFriday		= $_POST['timeFriday'];

		$sql = "UPDATE `queue`.`appointment`
				SET
				`description` = '$description',
				`status` = '$status',
				`name` = '$name'
				WHERE `id` = '$id'";

		$result = mysqli_query($con,$sql);

		if($result > 0){

			if($timeMonday != ""){

				$sql = "SELECT count(id) as exist FROM `appointment_detail` WHERE `appointment_id` = '$id' and day = '1'";

				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);

				if($row['exist'] == "0"){

					$sql = "INSERT INTO `queue`.`appointment_detail`
							(`appointment_id`,
							`day`,
							`start_time`)
							VALUES ('$id','1','$timeMonday')";

					$result = mysqli_query($con,$sql);
				}else{
					
					$sql = "UPDATE `queue`.`appointment_detail`
							SET
							`start_time` = '$timeMonday'
							WHERE `appointment_id` = '$id' and day = '1'";

					$result = mysqli_query($con,$sql);
				}
			}else{
				
				$sql = "DELETE FROM `queue`.`appointment_detail`
						WHERE `appointment_id` = '$id' and day = '1'";

				$result = mysqli_query($con,$sql);

			}
			if($timeTuesday != ""){
				
				$sql = "SELECT count(id) as exist FROM `appointment_detail` WHERE `appointment_id` = '$id' and day = '2'";

				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);

				if($row['exist'] == "0"){

					$sql = "INSERT INTO `queue`.`appointment_detail`
							(`appointment_id`,
							`day`,
							`start_time`)
							VALUES ('$id','2','$timeTuesday')";

					$result = mysqli_query($con,$sql);
				}else{
						
					$sql = "UPDATE `queue`.`appointment_detail`
							SET
							`start_time` = '$timeTuesday'
							WHERE `appointment_id` = '$id' and day =  '2'";

					$result = mysqli_query($con,$sql);
				}
			}else{
				
				$sql = "DELETE FROM `queue`.`appointment_detail`
						WHERE `appointment_id` = '$id' and day = '2'";

				$result = mysqli_query($con,$sql);
				
			}
			if($timeWednesday != ""){
				
				$sql = "SELECT count(id) as exist FROM `appointment_detail` WHERE `appointment_id` = '$id' and day = '3'";

				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);

				if($row['exist'] == "0"){

					$sql = "INSERT INTO `queue`.`appointment_detail`
							(`appointment_id`,
							`day`,
							`start_time`)
							VALUES ('$id','3','$timeWednesday')";

					$result = mysqli_query($con,$sql);
				}else{
							
					$sql = "UPDATE `queue`.`appointment_detail`
							SET
							`start_time` = '$timeWednesday'
							WHERE `appointment_id` = '$id' and day =  '3'";

					$result = mysqli_query($con,$sql);
				}
			}else{
				
				$sql = "DELETE FROM `queue`.`appointment_detail`
						WHERE `appointment_id` = '$id' and day = '3'";

				$result = mysqli_query($con,$sql);
				
			}
			if($timeThursday != ""){
				
				$sql = "SELECT count(id) as exist FROM `appointment_detail` WHERE `appointment_id` = '$id' and day = '4'";

				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);

				if($row['exist'] == "0"){

					$sql = "INSERT INTO `queue`.`appointment_detail`
							(`appointment_id`,
							`day`,
							`start_time`)
							VALUES ('$id','4','$timeThursday')";

					$result = mysqli_query($con,$sql);
				}else{
							
					$sql = "UPDATE `queue`.`appointment_detail`
							SET
							`start_time` = '$timeThursday'
							WHERE `appointment_id` = '$id' and day =  '4'";

					$result = mysqli_query($con,$sql);
				}
			}else{
				
				$sql = "DELETE FROM `queue`.`appointment_detail`
						WHERE `appointment_id` = '$id' and day = '4'";

				$result = mysqli_query($con,$sql);
				
			}
			if($timeFriday != ""){
				
				$sql = "SELECT count(id) as exist FROM `appointment_detail` WHERE `appointment_id` = '$id' and day = '5'";

				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);

				if($row['exist'] == "0"){

					$sql = "INSERT INTO `queue`.`appointment_detail`
							(`appointment_id`,
							`day`,
							`start_time`)
							VALUES ('$id','5','$timeFriday')";

					$result = mysqli_query($con,$sql);
				}else{
							
					$sql = "UPDATE `queue`.`appointment_detail`
							SET
							`start_time` = '$timeFriday'
							WHERE `appointment_id` = '$id' and day =  '5'";

					$result = mysqli_query($con,$sql);
				}
			}else{
				
				$sql = "DELETE FROM `queue`.`appointment_detail`
						WHERE `appointment_id` = '$id' and day = '5'";

				$result = mysqli_query($con,$sql);
				
			}

		}else{
			echo "0";
		}
	}

	function getAppointmentDetail(){
		include '../config/database.php';

		$id = $_POST['id'];

		$sql = "SELECT * FROM queue.appointment where id = '$id'";

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

	// customer

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


	function mailSender($to_email, $subject, $body){
		$headers = "From: izzatjohari94@gmail.com";

		mail($to_email, $subject, $body, $headers);
	}
?>