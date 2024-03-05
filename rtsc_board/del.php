<?php
	session_start();
	if ($_SESSION['ss_korname'] == ""){
		echo "<script>alert('세션이 끊겼습니다. 다시 로그인 하여 주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
		exit;
	}

	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$board_idx		= trim($_REQUEST['board_idx']);
	$boardCode		= trim($_REQUEST['boardCode']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

//	echo "page : ".$page."<br>";
//	echo "board_idx : ".$board_idx."<br>";
//	echo "boardCode : ".$boardCode."<br>";
//	echo "mode : ".$mode."<br>";
//	echo "Search : ".$Search."<br>";
//	echo "SearchString : ".$SearchString."<br>";

	$sql_replycheck = "select count(idx) as cnt from reply_board where board_idx = '".$board_idx."'";
	$result_replycheck = mysqli_query($conn, $sql_replycheck);
	$row_replycheck = mysqli_fetch_assoc($result_replycheck);
	if ($row_replycheck['cnt'] > 0){
		mysqli_close($conn);
		echo '<script>alert("댓글이 있어 삭제할 수 없습니다.");history.back();</script>';
	}else{
		//첨부파일이 있는지 체크하고 첨부파일부터 삭제해준다.
		$sql_del_file = "select filename from board_filename where board_idx = '".$board_idx."'";
		$result_del_file = mysqli_query($conn, $sql_del_file);
		while ($row_del_file = mysqli_fetch_assoc($result_del_file)) {
			if ($row_del_file['filename'] != ''){
				unlink("../upload/".$row_del_file['filename']);
			}
		}
		$sql_del_board_filename = "delete from board_filename where board_idx = '".$board_idx."'";
		$result_del_board_filename = mysqli_query($conn, $sql_del_board_filename);

		$sql_del_board = "delete from board where board_idx = '".$board_idx."'";
		$result_del_board = mysqli_query($conn, $sql_del_board);

		mysqli_close($conn); // 데이터베이스 접속 종료
		echo '<script>alert("삭제하였습니다.");</script>';
		echo "<script>location.replace('list.php?page=$page&boardCode=$boardCode&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
	}
?>