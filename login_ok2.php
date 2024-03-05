<?php

	include "./include/connect.php";
	$korname = mysqli_real_escape_string($conn, trim($_POST['korname']));
	$mobile = mysqli_real_escape_string($conn, trim($_POST['mobile']));

	$sql = "SELECT COUNT(*) AS cnt FROM homepage_admin where korname = '". $korname . "' and mobile = '" . $mobile ."' and useYN ='Y'";
	$result = mysqli_query($conn, $sql);
	$rowCnt = mysqli_fetch_assoc($result);

	if ($rowCnt['cnt'] == 0){
		echo "<script>alert('아이디와 비번을 확인해주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
	}
	
	$sql = "SELECT homepage_admin_idx, rtdept1code, rtdept2code, korname, mobile, photofilename FROM homepage_admin where korname = '". $korname . "' and mobile = '" . $mobile ."' and useYN ='Y'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

//	echo $row['rtdept1code']."<br>";
//	echo $row['rtdept2code']."<br>";
//	echo $row['korname']."<br>";
//	echo $row['mobile']."<br>";
//	echo $row['birthday']."<br>";
	$_SESSION['ss_rtdept1code'] = $row['rtdept1code'];
	$_SESSION['ss_rtdept2code'] = $row['rtdept2code'];
	$_SESSION['ss_homepage_admin_idx'] = $row['homepage_admin_idx'];
	$_SESSION['ss_korname'] = $row['korname'];
	$_SESSION['ss_photofilename'] = $row['photofilename'];
//	echo $_SESSION['ss_admin_name']."(으)로 로그인되었습니다.";

	mysqli_close($conn);
	echo "<script>location.replace('/rtsc_member/main2.php');</script>";
?>