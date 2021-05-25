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
$password 	= md5($_POST['password']);
// echo $_POST['password'];

$sql = "INSERT INTO customer(firstname, email, contact, password, lastname, street, street2, postcode, city, country, state)
		VALUES ('$firstname','$email','$contact','$password','$lastname','$street','$street2','$postcode','$city','$country','$state')";
// echo $sql;
$result = mysqli_query($con,$sql);

if($result > 0){
	echo "<script>alert ('Register successfully');</script>";
	echo "<script>window.location.href='../customer/login.php'; </script>";
}
else{
	echo "<script>alert ('Failed to Register');</script>";
	echo "<script>window.location.href='http://localhost/qms/qms/customer/register.php'; </script>";
}

mysqli_close($con);
?>