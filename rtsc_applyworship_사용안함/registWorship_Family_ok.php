<?php
	include "connect.php";
	$familyID		= trim($_REQUEST['familyID']);
	$worshipDate	= trim($_REQUEST['worshipDate']);

	//echo $familyID."<br>";
	//echo $worshipDate."<br>";

	$sql		= "select * from member_familyinfo where familyID = '".$familyID."'";
	$result	= mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)){

		$registWorship	= mysqli_real_escape_string($conn, trim($_REQUEST['registWorship'.$row['idx']]));
		$worshipGubun	= mysqli_real_escape_string($conn, trim($_REQUEST['worshipGubun'.$row['idx']]));
		$appYN			= mysqli_real_escape_string($conn, trim($_REQUEST['appYN'.$row['idx']]));
		$busUse			= mysqli_real_escape_string($conn, trim($_REQUEST['busUse'.$row['idx']]));
		$strollerYN		= mysqli_real_escape_string($conn, trim($_REQUEST['strollerYN'.$row['idx']]));
		$wheelchairYN	= mysqli_real_escape_string($conn, trim($_REQUEST['wheelchairYN'.$row['idx']]));
		$worshipPlace	= mysqli_real_escape_string($conn, trim($_REQUEST['worshipPlace'.$row['idx']]));
		$useLanguage	= mysqli_real_escape_string($conn, trim($_REQUEST['useLanguage'.$row['idx']]));
		$carNo			= mysqli_real_escape_string($conn, trim($_REQUEST['carNo'.$row['idx']]));

		if ($registWorship != ""){
			$myNo	= $row['myNo'];
			$gender = $row['gender'];
			$churchareaCode = $row['churchareaCode'];
			if ($churchareaCode == "") { $churchareaCode = "A99999";}
			$rtdept1Code = $row['rtdept1Code'];
			if ($rtdept1Code == "") { $rtdept1Code = "D99999";}
			$korname = $row['korname'];
			$churchPositionCode = $row['churchPositionCode'];
			$mobile = $row['mobile'];
			$birthday = $row['birthday'];
			
			# 중복체크
			$sql_double_check = "select count(idx) as cnt from apply_worship where worshipDate = '".$worshipDate."' and korname = '".$korname."' and birthday = '".$birthday."'";
			$result_double_check = mysqli_query($conn, $sql_double_check);
			$row_double_check = mysqli_fetch_assoc($result_double_check);
			$total_count = $row_double_check['cnt'];
			# 해당 예배날짜에 신청한 기록이 없으면 insert, 있으면 update
			if ($total_count == 0){
				$sql_worship = "insert into apply_worship (myNo, worshipDate, worshipGubun, churchareaCode, rtdept1Code, korname, gender, churchPositionCode, mobile, birthday, inputDate, appYN, busUse, familyID, strollerYN, wheelchairYN, worshipPlace, useLanguage, carNo)values('".$myNo."', '".$worshipDate."','".$worshipGubun."','".$churchareaCode."','".$rtdept1Code."','".$korname."','".$gender."','".$churchPositionCode."','".$mobile."','".$birthday."', now(),'".$appYN."','".$busUse."','".$familyID."','".$strollerYN."','".$wheelchairYN."','".$worshipPlace."','".$useLanguage."','".$carNo."')";
			}else{
				$sql_worship = "update apply_worship set myNo = '".$myNo."', worshipGubun = '".$worshipGubun."', churchareaCode = '".$churchareaCode."', rtdept1Code = '".$rtdept1Code."', korname = '".$korname."', gender = '".$gender."', churchPositionCode = '".$churchPositionCode."', mobile = '".$mobile."', birthday = '".$birthday."', appYN = '".$appYN."', busUse = '".$busUse."', familyID = '".$familyID."', strollerYN = '".$strollerYN."', wheelchairYN = '".$wheelchairYN."', worshipPlace = '".$worshipPlace."', useLanguage = '".$useLanguage."', carNo = '".$carNo."', inputDate = now() where worshipDate = '".$worshipDate."' and korname = '".$korname."' and birthday = '".$birthday."'";
			}
			$result_worship = mysqli_query($conn, $sql_worship);
//			echo $total_count."<br>";
//			echo $sql_worship."<br>";
		}
	}
	mysqli_close($conn);
	echo "<script>location.replace('list.php?worshipDate=$worshipDate');</script>";
?>