<?php
	// session_start();

	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		if($action == "saveUser"){
			// echo "masuk";
			saveUser();
		}else if($action == "checkingEmail"){
			checkingEmail();
		}else if($action == "getUserDetail"){
			getUserDetail();
		}else if($action == "editUser"){
			editUser();
		}else{
			echo '0';
		}
	}

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

	function getUserDetail(){
		include '../config/database.php';

		$email = $_POST['email'];

		$sql = "SELECT * FROM `staff` WHERE email = '$email'";

		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($result);

		echo json_encode($row);
	}

	function editUser(){
		session_start();
		include '../config/database.php';

		$firstname 		= $_POST['firstname'];
		$lastname 		= $_POST['lastname'];
		$email 			= $_POST['email'];
		$contact		= $_POST['contact'];
		$street 		= $_POST['street'];
		$street2 		= $_POST['street2'];
		$postcode 		= $_POST['postcode'];
		$city 			= $_POST['city'];
		$state			= $_POST['state'];
		$country 		= $_POST['country'];
		$company_id 	= $_SESSION['company_id'];

		if (isset($_POST['action'])) {

			$password 		= md5($_POST['password']);

			$sql = "UPDATE `queue`.`staff`
					SET
					`firstname` = '$firstname',
					`lastname` = '$lastname',
					`contact` = '$contact',
					`street` = '$street',
					`street2` = '$street2',
					`postcode` = '$postcode',
					`city` = '$city',
					`state` = '$state',
					`country` = '$country',
					`company_id` = '$company_id',
					password = '$password'
					WHERE `email` = '$email'";
		}else{

			$sql = "UPDATE `queue`.`staff`
					SET
					`firstname` = '$firstname',
					`lastname` = '$lastname',
					`contact` = '$contact',
					`street` = '$street',
					`street2` = '$street2',
					`postcode` = '$postcode',
					`city` = '$city',
					`state` = '$state',
					`country` = '$country',
					`company_id` = '$company_id'
					WHERE `email` = '$email'";
		}

		$result = mysqli_query($con,$sql);

		if($result > 0){
			echo "1";	

		}else{
			echo "0";
		}
	}

	function saveUser(){
		session_start();
		include '../config/database.php';

		$firstname 		= $_POST['firstname'];
		$lastname 		= $_POST['lastname'];
		$email 			= $_POST['email'];
		$contact		= $_POST['contact'];
		$street 		= $_POST['street'];
		$street2 		= $_POST['street2'];
		$postcode 		= $_POST['postcode'];
		$city 			= $_POST['city'];
		$state			= $_POST['state'];
		$country 		= $_POST['country'];
		$company_id 	= $_SESSION['company_id'];
		$password 		= md5($_POST['password']);

		$sql = "INSERT INTO `queue`.`staff`
				(`firstname`,
				`lastname`,
				`email`,
				`contact`,
				`street`,
				`street2`,
				`postcode`,
				`city`,
				`state`,
				`country`,
				`company_id`,
				`password`)
				VALUES ('$firstname','$lastname','$email','$contact','$street','$street2','$postcode','$city','$state','$country','$company_id','$password')";

		$result = mysqli_query($con,$sql);

		if($result > 0){

			$sql = "INSERT INTO role_staff(staff_id, role_id)
					VALUES ('$email','3')";

			$result = mysqli_query($con,$sql);

			echo "1";	

		}else{
			echo "0";
		}
	}

	function checkingEmail(){
		session_start();
		include '../config/database.php';

		$email = $_POST['email'];

		$sql = "SELECT count(email) as exist from staff where email = '$email'";

		$result = mysqli_query($con,$sql);

		while($row = mysqli_fetch_assoc($result)){
			$exist = $row['exist'];
		}

		if($exist > 0){
			echo "1";
		}
		else{
			echo "0";
		}
	}
?>