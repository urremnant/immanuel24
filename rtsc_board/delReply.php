<?php
	session_start();
	if ($_SESSION['ss_korname'] == ""){
		echo "<script>alert('세션이 끊겼습니다. 다시 로그인 하여 주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
		exit;
	}

	include "../include/connect.php";

	$idx		= trim($_REQUEST['idx']);
	$board_idx	= trim($_REQUEST['board_idx']);

	$sql_replycheck = "select count(idx) as cnt from reply_board where board_idx = '".$board_idx."' and idx > '".$idx."'";
	$result_replycheck = mysqli_query($conn, $sql_replycheck);
	$row_replycheck = mysqli_fetch_assoc($result_replycheck);

	if ($row_replycheck['cnt'] > 0){
		mysqli_close($conn);
		echo '<script>alert("자신의 댓글 아래에 댓글이 있어 삭제할 수 없습니다.");self.close();</script>';
	}else{
		$sql = "delete from reply_board where idx = '".$idx."'";
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn); // 데이터베이스 접속 종료
		echo '<script>alert("삭제되었습니다.");opener.location.reload();self.close();</script>';
	}
?>