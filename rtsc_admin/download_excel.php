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
	
	header("Content-type: application/vnd.ms-excel;charset=UTF-8");
	header("Expires:0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Pragma:public");
	header("Content-Disposition: attachment; filename=".date('Ymd')."_홈페이지사용자.xls" );

	$sql = "select a.homepage_admin_idx, c.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code),'') as rtdept2Name, a.korname, b.korChurchPosition, a.mobile, a.useYN, a.dataAccessType, a.timelineAccessType, ifnull(a.vowDate,'') as vowDate, a.deptMoveYN, ifnull((select rtdept1Name from rtdept1 where rtdept1Code = a.from_rtdept1Code),'') as from_rtdept1Name from homepage_admin a, churchPosition b, rtdept1 c where a.churchPositionCode = b.churchPositionCode and a.rtdept1Code = c.rtdept1Code";
	$result = mysqli_query($conn, $sql);

	//로그기록
	$ipaddress = get_client_ip();
	$sql_log = "insert into logData(homepage_admin_idx, gubun, loginDate, ipaddress) values ('".$_SESSION['ss_homepage_admin_idx']."', 'login', now(), '".$ipaddress."')";
	$result_log = mysqli_query($conn, $sql_log);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.xl2225652{mso-font-charset:129;mso-number-format:"\@";white-space:nowrap;}
</style>
<table widtd="100%" border="1" cellspacing="1" cellpadding="3">
	<tr align="center">	
		<td>고유번호</td>
		<td>부서</td>
		<td>분반</td>
		<td>성명</td>
		<td>직분</td>
		<td>핸드폰번호</td>
		<td>데이터접근권한</td>
		<td>언약의여정권한</td>
		<td>등반권한</td>
		<td>등반담당부서</td>
		<td>사용여부</td>
		<td>개인정보보호서약일</td>
	</tr>
<?php
	while ($row = mysqli_fetch_assoc($result)) {
?>
	<tr align="center">
		<td><?php echo $row['homepage_admin_idx']?></td>
		<td><?php echo $row['rtdept1Name'] ?></td>
		<td><?php echo $row['rtdept2Name'] ?></td>
		<td><?php echo $row['korname'] ?></td>
		<td><?php echo $row['korChurchPosition'] ?></td>
		<td class="xl2225652"><?php echo $row['mobile'] ?></td>
		<td>
			<?php
				switch ($row['dataAccessType']){
					case "R" : 
						echo "읽기";
						break;
					case "W" :
						echo "읽기/쓰기/수정/삭제";
						break;
					default :
				}
			?>
		</td>
		<td>
			<?php
				switch ($row['timelineAccessType']){
					case "X" : 
						echo "접근불가";
						break;
					case "R" : 
						echo "읽기";
						break;
					case "W" :
						echo "읽기/쓰기/수정/삭제";
						break;
					default :
				}
			?>
		</td>
		<td><?php echo $row['deptMoveYN'] ?></td>
		<td><?php echo $row['from_rtdept1Name'] ?></td>		
		<td><?php echo $row['useYN'] ?></td>
		<td><?php echo $row['vowDate'] ?></td>
	</tr>
<?php
	}
?>
</table>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>