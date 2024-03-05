<?php
	include "./include/connect.php";
	
	$sql = "update homepage_admin set vowDate = now(), vowYN = 'Y' where homepage_admin_idx = '".$_SESSION['ss_homepage_admin_idx']."'";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn); // 데이터베이스 접속 종료
	echo "<script>location.replace('/rtsc_member/main2.php');</script>";
?>