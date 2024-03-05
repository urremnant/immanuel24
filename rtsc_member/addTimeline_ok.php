<?php
	session_start();
	if ($_SESSION['ss_korname'] == ""){
		echo "<script>alert('세션이 끊겼습니다. 다시 로그인 하여 주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
		exit;
	}

	include "../include/connect.php";
	
	$memberID		= mysqli_real_escape_string($conn, trim($_REQUEST['memberID']));
	$content	= mysqli_real_escape_string($conn, trim($_REQUEST['content']));

	$sql = "select homepage_admin_idx from homepage_admin where rtdept1code = '".$_SESSION['ss_rtdept1code']."' and rtdept2code = '".$_SESSION['ss_rtdept2code']."' and korname = '".$_SESSION['ss_korname']."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$homepage_admin_idx = $row['homepage_admin_idx'];

	$sql = "insert into member_timeline (memberID, homepage_admin_idx, content, inputDate) values ('".$memberID."', '".$homepage_admin_idx."','".$content."', now())";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>alert('입력되었습니다.');opener.location.reload();self.close();</script>";
?>