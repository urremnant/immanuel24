<?php
	include "../include/connect.php";

	$attendType			= mysqli_real_escape_string($conn, trim($_REQUEST['attendType']));
	$worshipDate		= mysqli_real_escape_string($conn, trim($_REQUEST['worshipDate']));
	$weekNum			= mysqli_real_escape_string($conn, trim($_REQUEST['weekNum']));
	$checkdatalist		= mysqli_real_escape_string($conn, trim($_REQUEST['checkdatalist']));

	$checkdatalist	= substr($checkdatalist, 0, strlen($checkdatalist)-1);

	# echo $attendType."<br>";
	# echo $worshipDate."<br>";
	# echo $weekNum."<br>";
	# echo $checkdatalist."<br>";

	$strCheckData = explode(',', $checkdatalist);
	$cnt = count($strCheckData);
	for($i = 0 ; $i < $cnt ; $i++){
		$sql = "select COUNT(memberID) AS cnt FROM attendworshipcheck305 where memberID = '".$strCheckData[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
		 echo $sql."<br>";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$total_count = $row['cnt'];
		 echo $total_count."<br>";
		if ($total_count == 0){
			$sql = "insert into attendworshipcheck305 (memberID, baseYear) values ('".$strCheckData[$i]."', '".substr($worshipDate,0,4)."')";
			 echo $sql."<br>";
			$result = mysqli_query($conn, $sql);
			$sql = "update attendworshipcheck305 set week".$weekNum." = '".$attendType."' where  memberID = '".$strCheckData[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
			 echo $sql."<br>";
			$result = mysqli_query($conn, $sql);
		}else{
			$sql = "update attendworshipcheck305 set week".$weekNum." = '".$attendType."' where  memberID = '".$strCheckData[$i]."' and baseYear = '".substr($worshipDate,0,4)."'";
			$result = mysqli_query($conn, $sql);
			 echo $sql."<br>";
		}
		# 초기화하기(출결기록지우기)의 경우 결석.조퇴사유까지 삭제한다.
		if ($attendType==""){
			$sql = "delete from absentreason305 where memberID = '".$strCheckData[$i]."' and worshipDate = '".$worshipDate."'";
			$result = mysqli_query($conn, $sql);
			 echo $sql."<br>";
		}
	}
?>