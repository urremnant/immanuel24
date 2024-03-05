<?php
	include "../include/connect.php";
	
	$idx		= mysqli_real_escape_string($conn, trim($_REQUEST['idx']));
	$content	= mysqli_real_escape_string($conn, trim($_REQUEST['content']));

//	echo $idx."<br>";
//	echo $content."<br>";
	$sql = "update member_timeline set content = '".$content."' where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>alert('수정되었습니다.');opener.location.reload();self.close();</script>";
?>