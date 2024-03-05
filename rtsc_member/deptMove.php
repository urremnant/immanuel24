<?php
	include "../include/connect.php";

	$deptMoveCode		= mysqli_real_escape_string($conn, trim($_REQUEST['deptMoveCode']));
	$checkdatalist		= mysqli_real_escape_string($conn, trim($_REQUEST['checkdatalist']));

	$checkdatalist	= substr($checkdatalist, 0, strlen($checkdatalist)-1);
	//echo $checkdatalist;

	$strCheckData = explode(',', $checkdatalist);
	$cnt = count($strCheckData);
	for($i = 0 ; $i < $cnt ; $i++){
		$sql = "update member set deptMoveCode = '".$deptMoveCode."' where memberID = '".$strCheckData[$i]."'";
		$result = mysqli_query($conn, $sql);
	}
?>