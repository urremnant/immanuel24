<?php
	include "../include/connect.php";

	$worshipDate			= mysqli_real_escape_string($conn, trim($_REQUEST['worshipDate']));
	$weekNum				= mysqli_real_escape_string($conn, trim($_REQUEST['weekNum']));
	$checkdatalistTrue		= mysqli_real_escape_string($conn, trim($_REQUEST['checkdatalistTrue']));
	$checkdatalistFalse		= mysqli_real_escape_string($conn, trim($_REQUEST['checkdatalistFalse']));

	$checkdatalistTrue	= substr($checkdatalistTrue, 0, strlen($checkdatalistTrue)-1);
	$checkdatalistFalse	= substr($checkdatalistFalse, 0, strlen($checkdatalistFalse)-1);

	echo $worshipDate."<br>";
	echo $weekNum."<br>";
	echo $checkdatalistTrue."<br>";
	echo $checkdatalistFalse."<br>";

	$strCheckDataTrue = explode(',', $checkdatalistTrue);
	$cnt = count($strCheckDataTrue);
	for($i = 0 ; $i < $cnt ; $i++){
		$sql = "select COUNT(memberID) AS cnt FROM attendworshipcheck where memberID = '".$strCheckDataTrue[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
		# echo $sql."<br>";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$total_count = $row['cnt'];
		# echo $total_count."<br>";
		if ($total_count == 0){
			$sql = "insert into attendworshipcheck (memberID, baseYear) values ('".$strCheckDataTrue[$i]."', '".substr($worshipDate,0,4)."')";
			# echo $sql."<br>";
			$result = mysqli_query($conn, $sql);
			$sql = "update attendworshipcheck set week".$weekNum." = 'B' where  memberID = '".$strCheckDataTrue[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
			# echo $sql."<br>";
			$result = mysqli_query($conn, $sql);
		}else{
			$sql = "update attendworshipcheck set week".$weekNum." = 'B' where  memberID = '".$strCheckDataTrue[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
			$result = mysqli_query($conn, $sql);
			# echo $sql."<br>";
		}
	}

	$strCheckDataFalse = explode(',', $checkdatalistFalse);
	$cnt = count($strCheckDataFalse);
	for($i = 0 ; $i < $cnt ; $i++){
		$sql = "select COUNT(memberID) AS cnt FROM attendworshipcheck where memberID = '".$strCheckDataFalse[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
		# echo $sql."<br>";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$total_count = $row['cnt'];
		# echo $total_count."<br>";
		if ($total_count == 0){
			$sql = "insert into attendworshipcheck (memberID, baseYear) values ('".$strCheckDataFalse[$i]."', '".substr($worshipDate,0,4)."')";
			# echo $sql."<br>";
			$result = mysqli_query($conn, $sql);
			$sql = "update attendworshipcheck set week".$weekNum." = 'C' where  memberID = '".$strCheckDataFalse[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
			# echo $sql."<br>";
			$result = mysqli_query($conn, $sql);
		}else{
			$sql = "update attendworshipcheck set week".$weekNum." = 'C' where  memberID = '".$strCheckDataFalse[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
			$result = mysqli_query($conn, $sql);
			# echo $sql."<br>";
		}
	}
?>