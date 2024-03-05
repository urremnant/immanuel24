<?php

	include "../include/connect.php";

	$change_useYN			= trim($_REQUEST['change_useYN']);
	$page					= trim($_REQUEST['page']);
	$homepage_admin_idx		= trim($_REQUEST['homepage_admin_idx']);
	$mode					= trim($_REQUEST['mode']);
	$Search					= trim($_REQUEST['Search']);
	$SearchString			= trim($_REQUEST['SearchString']);


	$sql = "update homepage_admin set useYN='".$change_useYN."' where homepage_admin_idx = '".$homepage_admin_idx."'";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);

//	echo $sql;

	echo "<script>location.replace('list.php?page=$page&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
?>