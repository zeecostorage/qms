<?php
include '../../config/database.php';

$firstname 	= $_POST['firstname'];
$lastname 	= $_POST['lastname'];
$email 		= $_POST['email'];
$street 	= $_POST['street'];
$street2 	= $_POST['street2'];
$postcode 	= $_POST['postcode'];
$city 		= $_POST['city'];
$state 		= $_POST['state'];
$country 	= $_POST['country'];
$contact 	= $_POST['contact'];
$company 	= $_POST['company'];
$password 	= md5($_POST['password']);

$sql = "INSERT INTO staff(firstname, email, contact, password, company_id, lastname, street, street2, postcode, city, country, state)
		VALUES ('$firstname','$email','$contact','$password','$company','$lastname','$street','$street2','$postcode','$city','$country','$state')";

$result = mysqli_query($con,$sql);

if($result > 0){
	echo "<script>alert ('Register successfully');</script>";
	echo "<script>window.location.href='../login/form.php'; </script>";
}
else{
	echo "<script>alert ('Failed to Register');</script>";
	echo "<script>window.location.href='http://localhost/zeestorage/qms/registerStaff/form.php'; </script>";
}

mysqli_close($con);
?>