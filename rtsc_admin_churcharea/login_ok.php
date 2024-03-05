<?php
	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	include "../include/connect.php";

	$korname = mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$admin_pass = mysqli_real_escape_string($conn, trim($_REQUEST['admin_pass']));

	$sql = "SELECT COUNT(*) AS cnt FROM homepage_admin_churcharea where korname = '".$korname."' and admin_pass = '".$admin_pass."' and useYN ='Y'";
	$result = mysqli_query($conn, $sql);
	$rowCnt = mysqli_fetch_assoc($result);
	
//	echo $sql;
	if ($rowCnt['cnt'] == 0){
		echo "<script>alert('입력하신 정보를 다시 확인해주세요.');</script>";
		echo "<script>location.replace('index.php');</script>";
	}

	$sql = "SELECT idx, korChurchAreaName, korParishName, korname, mobile, photofilename FROM homepage_admin_churcharea where korname = '". $korname . "' and admin_pass = '" . $admin_pass ."' and useYN ='Y'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

//	echo $row['korParishName']."<br>";
//	echo $row['korname']."<br>";
//	echo $row['mobile']."<br>";
//	echo $row['birthday']."<br>";
	$_SESSION['ss_korChurchAreaName']	= $row['korChurchAreaName'];
	$_SESSION['ss_korParishName']		= $row['korParishName'];
	$_SESSION['ss_idx']					= $row['idx'];
	$_SESSION['ss_korname']				= $row['korname'];
	$_SESSION['ss_photofilename']		= $row['photofilename'];

//	echo $_SESSION['ss_korname']."(으)로 로그인되었습니다.";

	//로그기록
//	$ipaddress = get_client_ip();
//	$sql_log = "insert into logData(homepage_admin_idx, gubun, loginDate, ipaddress) values ('".$_SESSION['ss_homepage_admin_idx']."', '교구교역자로그인', now(), '".$ipaddress."')";
//	$result_log = mysqli_query($conn, $sql_log);

	mysqli_close($conn);

	echo "<script>location.replace('main.php');</script>";
?>