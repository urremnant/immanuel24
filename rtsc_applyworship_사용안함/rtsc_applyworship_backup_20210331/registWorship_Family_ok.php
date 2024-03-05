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
		$appYN			= mysqli_real_escape_string($conn, trim($_REQUEST['appYN'.$row['idx']]));
		$busUse			= mysqli_real_escape_string($conn, trim($_REQUEST['busUse'.$row['idx']]));
		
		if ($registWorship != ""){
			$churchareaCode = $row['churchareaCode'];
			if ($churchareaCode == "") { $churchareaCode = "A99999";}
			$rtdept1Code = $row['rtdept1Code'];
			if ($rtdept1Code == "") { $rtdept1Code = "D99999";}
			$korname = $row['korname'];
			$churchPositionCode = $row['churchPositionCode'];
			$mobile = $row['mobile'];
			$birthday = $row['birthday'];

			$sql_worship = "insert into apply_worship (worshipDate, churchareaCode, rtdept1Code, korname, churchPositionCode, mobile, birthday, inputDate, appYN, busUse, familyID)values('".$worshipDate."','".$churchareaCode."','".$rtdept1Code."','".$korname."','".$churchPositionCode."','".$mobile."','".$birthday."', now(),'".$appYN."','".$busUse."','".$familyID."')";
			$result_worship = mysqli_query($conn, $sql_worship);
		}
	}
	mysqli_close($conn);
	echo "<script>location.replace('list.php?worshipDate=$worshipDate');</script>";
?>