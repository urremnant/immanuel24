<?php

	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$idx			= trim($_REQUEST['idx']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$worshipDate	= mysqli_real_escape_string($conn, trim($_REQUEST['worshipDate']));
	$churchareaCode = mysqli_real_escape_string($conn, trim($_REQUEST['churchareaCode']));
	if ($churchareaCode == "") { $churchareaCode = "A99999";}
	$rtdept1Code	= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept1Code']));
	$korname		= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$churchPositionCode	= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$mobile = mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
	$birthyear			= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
	$birthmonth			= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
	$birthday			= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
	$birthday			= $birthyear.$birthmonth.$birthday;
	$appYN				= mysqli_real_escape_string($conn, trim($_REQUEST['appYN']));
	$busUse				= mysqli_real_escape_string($conn, trim($_REQUEST['busUse']));

	$sql = "update apply_worship set worshipDate = '".$worshipDate."', churchareaCode = '".$churchareaCode."', rtdept1Code = '".$rtdept1Code."', korname = '".$korname."', churchPositionCode = '".$churchPositionCode."', mobile = '".$mobile."', birthday = '".$birthday."', appYN = '".$appYN."', busUse = '".$busUse."' where idx = '".$idx."'";
//	echo $sql;
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('list.php?page=$page&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
?>