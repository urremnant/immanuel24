<?php

	include "../include/connect.php";

	$rtdept2Code	= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept2Code']));
	$parentsCode	= mysqli_real_escape_string($conn, trim($_REQUEST['parentsCode']));
	$rtdept2Name	= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept2Name']));

	$sql = "insert into rtdept2 (rtdept2Code, rtdept2Name, parentsCode)values('".$rtdept2Code."','".$rtdept2Name."','".$parentsCode."')";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('list.php');</script>";
?>