<?php

	include "../include/connect.php";

	$change_useYN			= trim($_REQUEST['change_useYN']);
	$page					= trim($_REQUEST['page']);
	$idx					= trim($_REQUEST['idx']);
	$mode					= trim($_REQUEST['mode']);
	$Search					= trim($_REQUEST['Search']);
	$SearchString			= trim($_REQUEST['SearchString']);


	$sql = "update homepage_admin_churcharea set useYN='".$change_useYN."' where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);

//	echo $sql;

	echo "<script>location.replace('homepage_admin_churcharea_list.php?page=$page&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
?>