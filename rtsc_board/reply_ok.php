<?php
	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$board_idx		= trim($_REQUEST['board_idx']);
	$boardCode		= trim($_REQUEST['boardCode']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);
	
	$content		= mysqli_real_escape_string($conn, trim($_REQUEST['content']));

	$sql = "insert into reply_board (board_idx, content, homepage_admin_idx, inputDate) values ('".$board_idx."', '".$content."', '".$_SESSION['ss_homepage_admin_idx']."', now())";
	echo $sql;

	$result = mysqli_query($conn, $sql);
	
	mysqli_close($conn);

	echo '<script>location.replace("content.php?page='.$page.'&board_idx='.$board_idx.'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'");</script>';
?>