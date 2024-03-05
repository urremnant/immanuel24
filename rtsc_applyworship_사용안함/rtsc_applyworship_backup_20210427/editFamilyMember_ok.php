<?php
	include "connect.php";

	$familyID		= mysqli_real_escape_string($conn, trim($_REQUEST['familyID']));
	$idx			= mysqli_real_escape_string($conn, trim($_REQUEST['idx']));

	$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$churchPositionCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$familyPosition			= mysqli_real_escape_string($conn, trim($_REQUEST['familyPosition']));
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
	$appYN					= mysqli_real_escape_string($conn, trim($_REQUEST['appYN']));
	$busUse					= mysqli_real_escape_string($conn, trim($_REQUEST['busUse']));
	$strollerYN				= mysqli_real_escape_string($conn, trim($_REQUEST['strollerYN']));
	$wheelchairYN			= mysqli_real_escape_string($conn, trim($_REQUEST['wheelchairYN']));
	$worshipPlace			= mysqli_real_escape_string($conn, trim($_REQUEST['worshipPlace']));
	$useLanguage			= mysqli_real_escape_string($conn, trim($_REQUEST['useLanguage']));
	
	$sql = "update member_familyinfo set churchareaCode = '".$churchareaCode. "', rtdept1Code = '".$rtdept1Code. "', korname = '".$korname. "', birthday = '".$birthday. "', churchPositionCode = '".$churchPositionCode. "', mobile = '".$mobile. "', gender = '".$gender. "', familyPosition = '".$familyPosition."', appYN = '".$appYN."', busUse = '".$busUse."', strollerYN = '".$strollerYN."', wheelchairYN = '".$wheelchairYN."', worshipPlace = '".$worshipPlace."', useLanguage = '".$useLanguage."' where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('viewFamily.php?familyID=$familyID');</script>";
?>
