<?php
	session_start();
	if ($_SESSION['ss_korname'] == ""){
		echo "<script>alert('세션이 끊겼습니다. 다시 로그인 하여 주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
		exit;
	}

	include "../include/connect.php";

	$idx		= trim($_REQUEST['idx']);

	$sql = "select filename from board_filename where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if ($row['filename'] != ''){
		# echo "첨부파일이 있습니다.<br>";
		# echo $row['mb_filename'];
		unlink("../upload/".$row['filename']);
	}

	$sql = "delete from board_filename where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn); // 데이터베이스 접속 종료
	echo '<script>alert("첨부파일이 삭제되었습니다.");opener.location.reload();self.close();</script>';
?>