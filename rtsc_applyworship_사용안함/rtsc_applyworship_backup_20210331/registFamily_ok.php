<?php
	include "connect.php";
	$familyCount		= mysqli_real_escape_string($conn, trim($_REQUEST['familyCount']));


//	$memberGubun - R : 렘넌트, T : 임원/교사, P : 교역자
	$sql_family = "select concat('F', right(concat('000000', ifnull(max(convert(right(familyID,5), UNSIGNED)),0) + 1),5)) as familyID from member_familyinfo";
	$result_family = mysqli_query($conn, $sql_family);
	$row_family = mysqli_fetch_assoc($result_family);
	$familyID = $row_family['familyID'];

	for($i=1;$i<=$familyCount;$i++){
		$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname'.$i]));
		$churchPositionCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode'.$i]));
		$gender					= mysqli_real_escape_string($conn, trim($_REQUEST['gender'.$i]));
		$birthyear				= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear'.$i]));
		$birthmonth				= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth'.$i]));
		$birthday				= mysqli_real_escape_string($conn, trim($_REQUEST['birthday'.$i]));
		$birthday				= $birthyear.$birthmonth.$birthday;			
		$mobile					= mysqli_real_escape_string($conn, trim($_REQUEST['mobile'.$i]));
		$churchareaCode			= mysqli_real_escape_string($conn, trim($_REQUEST['churchareaCode'.$i]));
		if ($churchareaCode == "") { $churchareaCode = "A99999";}
		$rtdept1Code			= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept1Code'.$i]));
		if ($rtdept1Code == "") { $rtdept1Code = "D99999";}

//		echo $korname."<br>";
//		echo $churchPositionCode."<br>";
//		echo $gender."<br>";
//		echo $birthyear."<br>";
//		echo $birthmonth."<br>";
//		echo $birthday."<br>";
//		echo $mobile."<br>";
//		echo $churchareaCode."<br>";
//		echo $rtdept1Code."<br>";

		$sql = "insert into member_familyinfo (familyID, churchareaCode, rtdept1Code, korname, birthday, churchPositionCode, mobile, gender) values ('".$familyID."','".$churchareaCode."','".$rtdept1Code."','".$korname."','".$birthday."','".$churchPositionCode."','".$mobile."','".$gender."')";
		//echo $sql."<br>";
		$result = mysqli_query($conn, $sql);
	}
	mysqli_close($conn);
	echo "<script>location.replace('viewFamily.php?familyID=$familyID');</script>";
?>