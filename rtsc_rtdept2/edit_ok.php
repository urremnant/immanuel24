<?php

	include "../include/connect.php";

	$rtdept2Code	= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept2Code']));
	$parentsCode	= mysqli_real_escape_string($conn, trim($_REQUEST['parentsCode']));
	$rtdept2Name	= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept2Name']));

	$sql = "update rtdept2 set parentsCode = '".$parentsCode."', rtdept2Name = '".$rtdept2Name."' where rtdept2Code = '".$rtdept2Code."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('list.php');</script>";
?>