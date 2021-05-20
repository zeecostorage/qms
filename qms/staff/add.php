<?php
include '../../config/database.php';

$fullname 	= $_POST['fullname'];
$email 		= $_POST['email'];
$contact 	= $_POST['contact'];
$password 	= md5($_POST['password']);
$firstname	= $_POST['firstname'];
$lastname	= $_POST['lastname'];

$sql = "INSERT INTO client(fullname, email, contact, password)
		VALUES ('$fullname','$email','$contact','$password')";

$result = mysqli_query($con,$sql);

if($result > 0){

	$sql = "INSERT INTO staff(firstname, email, contact, password, company_id, lastname)
		VALUES ('$firstname','$email','$contact','$password','$email','$lastname')";

	$result = mysqli_query($con,$sql);

	if($result > 0){
		$sql = "INSERT INTO role_staff(staff_id, role_id)
				VALUES ('$email','1')";

		$result = mysqli_query($con,$sql);

		echo "<script>alert ('Register successfully');</script>";
		echo "<script>window.location.href='../staff/login.php'; </script>";
	}
	else{

		$sql = "DELETE FROM `client` WHERE email = '$email'";

		$result = mysqli_query($con,$sql);

		echo "<script>alert ('Failed to Register');</script>";
		echo "<script>window.location.href='http://localhost/zeestorage/qms/staff/register.php'; </script>";
	}
}
else{
	echo "<script>alert ('Failed to Register');</script>";
	echo "<script>window.location.href='http://localhost/zeestorage/qms/staff/register.php'; </script>";
}
?>