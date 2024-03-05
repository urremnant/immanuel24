<?php

	include "./include/connect.php";
	$korname	= mysqli_real_escape_string($conn, trim($_POST['korname']));
	$admin_pass		= mysqli_real_escape_string($conn, trim($_POST['admin_pass']));

	$sql = "SELECT COUNT(*) AS cnt FROM homepage_admin where korname = '".$korname."' and admin_pass = '".$admin_pass."' and useYN ='Y'";
	$result = mysqli_query($conn, $sql);
	$rowCnt = mysqli_fetch_assoc($result);

	if ($rowCnt['cnt'] == 0){
		echo "<script>alert('입력하신 정보를 다시 확인해주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
	}

	$sql = "SELECT homepage_admin_idx, rtdept1code, rtdept2code, korname, mobile, photofilename FROM homepage_admin where korname = '". $korname . "' and admin_pass = '" . $admin_pass ."' and useYN ='Y'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

//	echo $row['rtdept1code']."<br>";
//	echo $row['rtdept2code']."<br>";
//	echo $row['korname']."<br>";
//	echo $row['mobile']."<br>";
//	echo $row['birthday']."<br>";
	$_SESSION['ss_rtdept1code']			= $row['rtdept1code'];
	$_SESSION['ss_rtdept2code']			= $row['rtdept2code'];
	$_SESSION['ss_homepage_admin_idx']	= $row['homepage_admin_idx'];
	$_SESSION['ss_korname']				= $row['korname'];
	$_SESSION['ss_photofilename']		= $row['photofilename'];
//	echo $_SESSION['ss_admin_name']."(으)로 로그인되었습니다.";

	//로그기록
	$sql_log = "insert into logData(homepage_admin_idx, gubun, loginDate) values ('".$_SESSION['ss_homepage_admin_idx']."', 'login', now())";
	$result_log = mysqli_query($conn, $sql_log);

	//개인정보보호서약 동의여부를 체크한다.
	$sql_vow = "select vowYN from homepage_admin where homepage_admin_idx = '".$_SESSION['ss_homepage_admin_idx']."'";
	$result_vow = mysqli_query($conn, $sql_vow);
	$row_vow = mysqli_fetch_assoc($result_vow);

	mysqli_close($conn);

	if ($row_vow['vowYN'] == "Y"){
		echo "<script>location.replace('/rtsc_member/main2.php');</script>";
	}else{
		echo "<script>location.replace('/vow.php');</script>";
	}
?>