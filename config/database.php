<?php

//Create database
$con = mysqli_connect("localhost", "root", "", "queue");

//Check connection
if(mysqli_connect_errno()){
	echo "Failed to connect MySQL:".mysqli_connect_errno();
}

?>