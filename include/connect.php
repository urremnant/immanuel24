<?php
	$mysql_host = "localhost";
	# $mysql_host = "rtsummit.cqebf6co3wjz.ap-northeast-2.rds.amazonaws.com:3306";
	$mysql_user = "rutc24rtsummit";
	# $mysql_password = "rutc242500@@";
	$mysql_password = "rutc24!rtsummit";
	$mysql_db = "rutc24rtsummit";

	$conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	if ($conn->connect_error) {
		die("연결실패 : " .  $conn->connect_error());
	}
	session_start();
?>