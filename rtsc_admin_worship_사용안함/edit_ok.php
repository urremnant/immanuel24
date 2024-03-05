<?php

	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$idx			= trim($_REQUEST['idx']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$myNo					= mysqli_real_escape_string($conn, trim($_REQUEST['myNo']));
	$worshipDate			= mysqli_real_escape_string($conn, trim($_REQUEST['worshipDate']));
	$worshipGubun			= mysqli_real_escape_string($conn, trim($_REQUEST['worshipGubun']));
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
	$appYN					= mysqli_real_escape_string($conn, trim($_REQUEST['appYN']));
	$busUse					= mysqli_real_escape_string($conn, trim($_REQUEST['busUse']));
	$strollerYN				= mysqli_real_escape_string($conn, trim($_REQUEST['strollerYN']));
	$wheelchairYN			= mysqli_real_escape_string($conn, trim($_REQUEST['wheelchairYN']));
	$carNo					= mysqli_real_escape_string($conn, trim($_REQUEST['carNo']));
	$worshipPlace			= mysqli_real_escape_string($conn, trim($_REQUEST['worshipPlace']));
	$useLanguage			= mysqli_real_escape_string($conn, trim($_REQUEST['useLanguage']));

	# 가족등록으로 예배신청을 했을 수가 있으므로 가족ID는 업데이트 하지 않도록 한다. familyID = '".$familyID."'
	$sql = "update apply_worship set myNo='".$myNo."', worshipDate='".$worshipDate."', worshipGubun = '".$worshipGubun."', korname='".$korname."', churchPositionCode='".$churchPositionCode."', gender='".$gender."', birthday='".$birthday."', mobile='".$mobile."', churchareaCode='".$churchareaCode."', rtdept1Code='".$rtdept1Code."', appYN='".$appYN."', busUse='".$busUse."', strollerYN='".$strollerYN."', wheelchairYN='".$wheelchairYN."', carNo='".$carNo."', worshipPlace='".$worshipPlace."', useLanguage = '".$useLanguage."', inputDate = now()  where idx = '".$idx."'";
//	echo $sql;
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('list.php?page=$page&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
?>