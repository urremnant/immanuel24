<?php
	include "../include/connect.php";

	$checkdatalist		= mysqli_real_escape_string($conn, trim($_REQUEST['checkdatalist']));

	$checkdatalist	= substr($checkdatalist, 0, strlen($checkdatalist)-1);
	//echo $checkdatalist;

	$strCheckData = explode(',', $checkdatalist);
	$cnt = count($strCheckData);
	for($i = 0 ; $i < $cnt ; $i++){
		$sql = "update member set deptMoveCode = '' where memberID = '".$strCheckData[$i]."'";
		$result = mysqli_query($conn, $sql);
	}
?>
<script language="javascript">
<!--
	opener.location.reload();
	self.close()
//-->
</script>