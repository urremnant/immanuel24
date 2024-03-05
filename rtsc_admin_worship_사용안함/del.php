<?php
	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$idx			= trim($_REQUEST['idx']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$sql = "delete from apply_worship where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('list.php?page=$page&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
?>