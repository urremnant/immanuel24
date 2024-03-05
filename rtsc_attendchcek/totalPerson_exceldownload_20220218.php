<?php
	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	include "../include/connect.php";

	// $worshipDate		= trim($_REQUEST['worshipDate']);
	$total_rtdept1Code	= trim($_REQUEST['total_rtdept1Code']);
	$worshipStartDate	= trim($_REQUEST['worshipStartDate']);
	$worshipEndDate		= trim($_REQUEST['worshipEndDate']);

	$sql_deptName = "select rtdept1Name from rtdept1 where rtdept1Code = '".$total_rtdept1Code."'";
	$result_deptName = mysqli_query($conn, $sql_deptName);
	$row_deptName = mysqli_fetch_assoc($result_deptName);
	$excelname = $row_deptName['rtdept1Name'];

	//로그기록
	$ipaddress = get_client_ip();
	$sql_log = "insert into logData(homepage_admin_idx, gubun, excelname, loginDate, ipaddress) values ('".$_SESSION['ss_homepage_admin_idx']."', 'excel_출석', '".$excelname."', now(), '".$ipaddress."')";
	$result_log = mysqli_query($conn, $sql_log);

	header("Content-type: application/vnd.ms-excel;charset=UTF-8");
	header("Expires:0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Pragma:public");
	header("Content-Disposition: attachment; filename=".date('Ymd')."_".$excelname.".xls" );

	# if ($worshipDate == "") {
		# 현재 날짜 주간의 일요일 날짜 구하기
	# 	$sql_weekSunday = "SELECT DATE_ADD(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE())-1) * -1 DAY) as weekSunday";
	# 	$result_weekSunday = mysqli_query($conn, $sql_weekSunday);
	# 	$row_weekSunday = mysqli_fetch_assoc($result_weekSunday);
	# 	$worshipDate = $row_weekSunday['weekSunday'];
	# }
	# 해당날짜가 몇주차인지 구하기
	# $sql_weekNum = "select weekNum from attendbasedate where worshipDate = '".$worshipDate."'";
	# $result_weekNum = mysqli_query($conn, $sql_weekNum);
	# $row_weekNum = mysqli_fetch_assoc($result_weekNum);
	# $weekNum = $row_weekNum['weekNum'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.xl2225652{mso-font-charset:129;mso-number-format:"\@";white-space:nowrap;}
</style>
<?php
	if ($total_rtdept1Code <> "") {

		# 현재 년도와 날짜를 구한다.
		$today = date("Y-m-d");
		# $sql_worshipDate = "select weekNum, worshipDate from attendbasedate where baseYear = '".substr($today,0,4)."' and worshipDate <= '".$today."' order by worshipDate";
		$sql_worshipDate = "select weekNum, worshipDate from attendbasedate ";

		if (($worshipStartDate <> "")&&($worshipEndDate <> "")){
			$sql_worshipDate = $sql_worshipDate."where worshipDate between '".$worshipStartDate."' and '".$worshipEndDate."'";
		}
		if (($worshipStartDate <> "")&&($worshipEndDate == "")){
			$sql_worshipDate = $sql_worshipDate."where worshipDate between '".$worshipStartDate."' and '".$today."'";
		}
		if (($worshipStartDate == "")&&($worshipEndDate <> "")){
			$sql_worshipDate = $sql_worshipDate."where worshipDate <= '".$worshipEndDate."'";
		}
		if (($worshipStartDate == "")&&($worshipEndDate == "")){
			$sql_worshipDate = $sql_worshipDate."where worshipDate <= '".$today."'";
		}
		# echo $sql_worshipDate;
		$result_worshipDate = mysqli_query($conn, $sql_worshipDate);
		# row 수를 구한다. 아래 테이블에서 날짜를 반복할 숫자이다.
		$total_worshipDate_rows = mysqli_num_rows($result_worshipDate);
		# 주차수와 예배날짜를 배열에 넣는다. 배열의 크기는 $total_worshipDate_rows 이다.
		$arrayWeekNum = array();
		$arrayWorshipDate = array();
		while ($row_worshipDate = mysqli_fetch_assoc($result_worshipDate)) {
			$arrayWeekNum[]		= $row_worshipDate['weekNum'];
			$arrayWorshipDate[]	= $row_worshipDate['worshipDate'];
		}

		$sql_deptPerson = "select a.memberID, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code), '') as rtdept2Name, a.korname, c.korChurchPosition,(case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID from member a, rtdept1 b, churchPosition c where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.rtdept1Code = '".$total_rtdept1Code."' ORDER BY newMemberID asc, a.churchPositionCode asc";
		# echo $sql_deptPerson;
		$result_deptPerson = mysqli_query($conn, $sql_deptPerson);		
?>
		<table width="100%" border="1" cellspacing="1" cellpadding="3">
		  <thead>
			<tr>
				<th>번호</th>
				<th>성명</th>
				<th>직분</th>
				<th>분반</th>
			<?php
				for($i=0 ; $i<$total_worshipDate_rows; $i++){
			?>
					<th><?php echo $arrayWorshipDate[$i] ?></th>
			<?php
				}
			?>
			</tr>
		  </thead>
		  <tbody>
<?php
	$count = 1;
	while ($row_deptPerson = mysqli_fetch_assoc($result_deptPerson)) {
?>
			<tr>
				<td><?php echo $count;?></td>
				<td><?php echo $row_deptPerson['korname'] ?></td>
				<td><?php echo $row_deptPerson['korChurchPosition'] ?></td>
				<td><?php echo $row_deptPerson['rtdept2Name'] ?></td>
			<?php
				for($i=0 ; $i<$total_worshipDate_rows; $i++){
			?>
				<td>
					<?php
						$sql_attend = "select week".$arrayWeekNum[$i]." as weekNum from attendworshipcheck where memberID = '".$row_deptPerson['memberID']."' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."'";
						# echo $sql_attend;
						$result_attend = mysqli_query($conn, $sql_attend);
						$row_attend = mysqli_fetch_assoc($result_attend);
						if ($row_attend['weekNum'] <> "") {
							$sql_typeName = "select typeName from attendType where typeCode = '".$row_attend['weekNum']."'";
							# echo $sql_typeName;
							$result_typeName = mysqli_query($conn, $sql_typeName);
							$row_typeName = mysqli_fetch_assoc($result_typeName);
							switch ($row_attend['weekNum']) {
								case "A" :
									echo "대면예배";
									break;
								case "B" :
									echo "비대면예배";
									break;
								case "C" :
									echo "결석";
									break;
								case "D" :
									echo "조퇴";
									break;
							}
						}
					?>
				</td>
			<?php
				}
			?>
			</tr>
<?php
		$count += 1;
	}
?>
		  </tfoot>
		</table>
<?php
}
	mysqli_close($conn); // 데이터베이스 접속 종료
?>