<?php
	include "connect.php";

	$familyID		= mysqli_real_escape_string($conn, trim($_REQUEST['familyID']));
	$idx			= mysqli_real_escape_string($conn, trim($_REQUEST['idx']));

	$sql = "delete from member_familyinfo where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('viewFamily.php?familyID=$familyID');</script>";
?>