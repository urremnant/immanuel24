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
	header("Content-Disposition: attachment; filename=".date('Ymd')."_예배신청관리자.xls" );

	$sql = "select a.*, b.korChurchPosition from homepage_admin_churcharea a, churchPosition b where a.churchPositionCode = b.churchPositionCode";
	$result = mysqli_query($conn, $sql);

	//로그기록
	$ipaddress = get_client_ip();
	$sql_log = "insert into logData(idx, gubun, loginDate, ipaddress) values ('".$_SESSION['ss_homepage_admin_idx']."', '교구교역자엑셀다운로드', now(), '".$ipaddress."')";
	$result_log = mysqli_query($conn, $sql_log);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.xl2225652{mso-font-charset:129;mso-number-format:"\@";white-space:nowrap;}
</style>
<table widtd="100%" border="1" cellspacing="1" cellpadding="3">
	<tr align="center">	
		<td>고유번호</td>
		<td>성명</td>
		<td>직분</td>
		<td>비밀번호</td>
		<td>권역</td>
		<td>교구</td>
		<td>핸드폰번호</td>
		<td>데이터접근권한</td>
		<td>언약의여정권한</td>
		<td>사용여부</td>
	</tr>
<?php
	while ($row = mysqli_fetch_assoc($result)) {
?>
	<tr align="center">
		<td><?php echo $row['homepage_admin_idx']?></td>
		<td><?php echo $row['korname'] ?></td>
		<td><?php echo $row['korChurchPosition'] ?></td>
		<td><?php echo $row['admin_pass'] ?></td>
		<td><?php echo $row['korChurchAreaName'] ?></td>
		<td><?php echo $row['korParishName'] ?></td>
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
		<td><?php echo $row['useYN'] ?></td>
	</tr>
<?php
	}
?>
</table>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>