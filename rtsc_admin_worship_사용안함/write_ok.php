<?php

	include "../include/connect.php";

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

	# 중복체크
	$sql_double_check = "select count(idx) as cnt from apply_worship where worshipDate = '".$worshipDate."' and korname = '".$korname."' and birthday = '".$birthday."'";
	$result_double_check = mysqli_query($conn, $sql_double_check);
	$row_double_check = mysqli_fetch_assoc($result_double_check);
	$total_count = $row_double_check['cnt'];
	# 해당 예배날짜에 신청한 기록이 없으면 insert, 있으면 update
	if ($total_count == 0){
		$sql_worship = "insert into apply_worship (myNo, worshipDate, worshipGubun, orname, churchPositionCode, gender, birthday, mobile, churchareaCode, rtdept1Code, familyID, appYN, busUse, strollerYN, wheelchairYN, carNo, worshipPlace, useLanguage, inputDate) values ('".$myNo."', '".$worshipDate."', '".$worshipGubun."', '".$korname."', '".$churchPositionCode."', '".$gender."', '".$birthday."', '".$mobile."', '".$churchareaCode."', '".$rtdept1Code."', '', '".$appYN."', '".$busUse."', '".$strollerYN."', '".$wheelchairYN."', '".$carNo."', '".$worshipPlace."', '".$useLanguage."', now())";
	}else{
		# 가족등록으로 예배신청을 했을 수가 있으므로 가족ID는 업데이트 하지 않도록 한다. familyID = '".$familyID."'
		$sql_worship = "update apply_worship set myNo = '".$myNo."', worshipDate='".$worshipDate."', worshipGubun = '".$worshipGubun."',  korname='".$korname."', churchPositionCode='".$churchPositionCode."', gender='".$gender."', birthday='".$birthday."', mobile='".$mobile."', churchareaCode='".$churchareaCode."', rtdept1Code='".$rtdept1Code."', appYN='".$appYN."', busUse='".$busUse."', strollerYN='".$strollerYN."', wheelchairYN='".$wheelchairYN."', carNo='".$carNo."', worshipPlace='".$worshipPlace."', useLanguage = '".$useLanguage."', inputDate = now() where worshipDate = '".$worshipDate."' and korname = '".$korname."' and birthday = '".$birthday."'";
	}
	$result_worship = mysqli_query($conn, $sql_worship);

	echo "<script>location.replace('list.php');</script>";
?>