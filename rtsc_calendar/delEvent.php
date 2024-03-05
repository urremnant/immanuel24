<?php
	include "../include/connect.php";

	$idx = trim($_REQUEST['delModalidx']);

	$sql = "select startYear, startMonth, startDay from calendar where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$viewDate = $row['startYear']."-". $row['startMonth']."-".$row['startDay'];

	$sql_delete = "delete from calendar where idx = '".$idx."'";
	$result_delete = mysqli_query($conn, $sql_delete);

	echo "<script>location.href='calendar.php?viewDate=$viewDate';</script>";
	mysqli_close($conn);
?>