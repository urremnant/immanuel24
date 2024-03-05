<?php
	include "../include/connect.php";
	
	$idx		= mysqli_real_escape_string($conn, trim($_REQUEST['idx']));

	$sql = "delete from member_timeline where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>alert('삭제되었습니다.');opener.location.reload();self.close();</script>";
?>