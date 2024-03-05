<?php

	include "connect.php";

//	$worshipDate			= mysqli_real_escape_string($conn, trim($_REQUEST['worshipDate']));
	$worshipDate			="2021-03-07";
	$churchareaCode			= mysqli_real_escape_string($conn, trim($_REQUEST['churchareaCode']));
	if ($churchareaCode == "") { $churchareaCode = "A99999";}
	$rtdept1Code			= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept1Code']));
	$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$churchPositionCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$mobile					= mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
	$birthyear				= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
	$birthmonth				= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
	$birthday				= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
	$birthday				= $birthyear.$birthmonth.$birthday;
	$appYN					= mysqli_real_escape_string($conn, trim($_REQUEST['appYN']));
	$busUse					= mysqli_real_escape_string($conn, trim($_REQUEST['busUse']));

	$sql = "insert into apply_worship (worshipDate, churchareaCode, rtdept1Code, korname, churchPositionCode, mobile, birthday, inputDate, appYN, busUse)values('".$worshipDate."','".$churchareaCode."','".$rtdept1Code."','".$korname."','".$churchPositionCode."','".$mobile."','".$birthday."', now(),'".$appYN."','".$busUse."')";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);

	echo "<script>location.replace('list.php');</script>";
?>