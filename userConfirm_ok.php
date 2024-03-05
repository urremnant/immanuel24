<?php

	include "./include/connect.php";
	$korname	= mysqli_real_escape_string($conn, trim($_POST['korname']));
	$mobile		= mysqli_real_escape_string($conn, trim($_POST['mobile']));
	$randomNum	= mysqli_real_escape_string($conn, trim($_POST['checkSMSNo']));
	$admin_pass	= mysqli_real_escape_string($conn, trim($_POST['admin_pass']));

	$sql = "SELECT COUNT(*) AS cnt FROM homepage_admin where korname = '".$korname."' and mobile = '".$mobile."' and randomNum = '".$randomNum."' and useYN ='Y'";
	$result = mysqli_query($conn, $sql);
	$rowCnt = mysqli_fetch_assoc($result);

	if ($rowCnt['cnt'] == 0){
		echo "<script>alert('입력하신 정보를 다시 확인해주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
	}
	
	//비밀번호 업데이트
	$sql_pass = "update homepage_admin set admin_pass = '".$admin_pass."' where korname = '".$korname."' and mobile = '".$mobile."' and randomNum = '".$randomNum."' and useYN ='Y'";
	$result_pass = mysqli_query($conn, $sql_pass);

	$sql = "SELECT homepage_admin_idx, rtdept1code, rtdept2code, korname, mobile, photofilename FROM homepage_admin where korname = '". $korname . "' and mobile = '" . $mobile ."' and useYN ='Y'";
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

	//인증숫자 초기화
	$sql_randomNum = "Update homepage_admin Set randomNum = '' where korname = '".$korname."' and mobile = '".$mobile."' and randomNum = '".$randomNum."' and useYN ='Y'";
	$result_randomNum = mysqli_query($conn, $sql_randomNum);

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