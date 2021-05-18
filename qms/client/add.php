<?php
include '../../config/database.php';

$fullname 	= $_POST['fullname'];
$email 		= $_POST['email'];
$contact 	= $_POST['contact'];
$password 	= md5($_POST['password']);

$sql = "INSERT INTO client(fullname, email, contact, password)
		VALUES ('$fullname','$email','$contact','$password')";

$result = mysqli_query($con,$sql);

if($result > 0){
	echo "<script>alert ('Register successfully');</script>";
	echo "<script>window.location.href='../login/form.php'; </script>";
}
else{
	echo "<script>alert ('Failed to Register');</script>";
	echo "<script>window.location.href='http://localhost/zeestorage/qms/clent/add.php'; </script>";
}
?>