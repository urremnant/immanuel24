<?php
	include "connect.php";
	
	$worshipDate	= trim($_REQUEST['worshipDate']);
	
	$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$churchPositionCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	//$gender				= mysqli_real_escape_string($conn, trim($_REQUEST['gender']));
	$birthyear				= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
	$birthmonth				= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
	$birthday				= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
	$birthday				= $birthyear.$birthmonth.$birthday;	
	$mobile					= mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));		
	$churchareaCode			= mysqli_real_escape_string($conn, trim($_REQUEST['churchareaCode']));
	if ($churchareaCode == "") { $churchareaCode = "A99999";}
	$rtdept1Code			= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept1Code']));
	if ($rtdept1Code == "") { $rtdept1Code = "D99999";}
	
	$sql_worship = "insert into apply_worship (worshipDate, korname, churchPositionCode, birthday, mobile, churchareaCode, rtdept1Code, appYN, busUse, familyID, inputDate) values ('".$worshipDate."', '".$korname."', '".$churchPositionCode."', '".$birthday."', '".$mobile."', '".$churchareaCode."', '".$rtdept1Code."', '".$appYN."', '".$busUse."', '', now())";
	$result_worship = mysqli_query($conn, $sql_worship);
	//echo $sql_worship;
	mysqli_close($conn);
	echo "<script>location.replace('list.php?worshipDate=$worshipDate');</script>";
?>