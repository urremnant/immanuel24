<?php
	session_start();
	if ($_SESSION['ss_korname'] == ""){
		echo "<script>alert('세션이 끊겼습니다. 다시 로그인 하여 주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
		exit;
	}

	include "../include/connect.php";
	
	$memberID		= mysqli_real_escape_string($conn, trim($_REQUEST['memberID']));
	$worshipDate		= mysqli_real_escape_string($conn, trim($_REQUEST['worshipDate']));
	$absentReason	= mysqli_real_escape_string($conn, trim($_REQUEST['absentReason']));

	$sql = "insert into absentreason (memberID, worshipDate, absentReason) values ('".$memberID."', '".$worshipDate."','".$absentReason."')";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>alert('입력되었습니다.');opener.location.reload();self.close();</script>";
?>