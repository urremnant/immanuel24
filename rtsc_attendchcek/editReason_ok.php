<?php
	include "../include/connect.php";
	
	$idx			= mysqli_real_escape_string($conn, trim($_REQUEST['idx']));
	$absentReason	= mysqli_real_escape_string($conn, trim($_REQUEST['absentReason']));

//	echo $idx."<br>";
//	echo $content."<br>";
	$sql = "update absentreason set absentReason = '".$absentReason."' where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>alert('수정되었습니다.');opener.location.reload();self.close();</script>";
?>