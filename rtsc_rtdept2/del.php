<?php

	include "../include/connect.php";

	$rtdept2Code	= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept2Code']));

	$sql_Member = "select count(memberID) as CNT from member where rtdept2Code = '".$rtdept2Code."'";

	$result_Member = mysqli_query($conn, $sql_Member);
	$row_Member = mysqli_fetch_assoc($result_Member);
	if ($row_Member['CNT'] != "0"){
		mysqli_close($conn);
		echo "<script>alert('해당 분반코드를 사용하고 있는 데이터가 있어서 삭제할 수가 없습니다.');history.back();</script>";
	}else{
		$sql_delete = "delete from rtdept2 where rtdept2Code = '".$rtdept2Code."'";
		$result_delete = mysqli_query($conn, $sql_delete);
		mysqli_close($conn);
		echo "<script>alert('삭제되었습니다.');</script>";
		echo "<script>location.replace('list.php');</script>";
	}
?>