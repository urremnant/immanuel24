<?php
	include "connect.php";

	$familyID		= mysqli_real_escape_string($conn, trim($_REQUEST['familyID']));

	$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$churchPositionCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$gender					= mysqli_real_escape_string($conn, trim($_REQUEST['gender']));
	$birthyear				= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
	$birthmonth				= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
	$birthday				= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
	$birthday				= $birthyear.$birthmonth.$birthday;			
	$mobile					= mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
	$churchareaCode			= mysqli_real_escape_string($conn, trim($_REQUEST['churchareaCode']));
	if ($churchareaCode == "") { $churchareaCode = "A99999";}
	$rtdept1Code			= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept1Code']));
	if ($rtdept1Code == "") { $rtdept1Code = "D99999";}

	$sql = "insert into member_familyinfo (familyID, churchareaCode, rtdept1Code, korname, birthday, churchPositionCode, mobile, gender) values ('".$familyID."','".$churchareaCode."','".$rtdept1Code."','".$korname."','".$birthday."','".$churchPositionCode."','".$mobile."','".$gender."')";
	//echo $sql."<br>";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('viewFamily.php?familyID=$familyID');</script>";
?>
