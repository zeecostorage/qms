<?php
session_start();
session_destroy();
header("Location: ../loginStaff/form.php");
?>