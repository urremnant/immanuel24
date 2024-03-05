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

	$excel_worshipDate	= trim($_REQUEST['excel_worshipDate']);
	
	header("Content-type: application/vnd.ms-excel;charset=UTF-8");
	header("Expires:0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Pragma:public");
	header("Content-Disposition: attachment; filename=".$excel_worshipDate.".xls" );

	$sql = "select a.*, b.korParishName, c.rtdept1Name from apply_worship a, churcharea b, rtdept1 c, churchPosition d where a.churchareaCode = b.churchareaCode and a.rtdept1Code = c.rtdept1Code and a.churchPositionCode = d.churchPositionCode and worshipDate = '".$excel_worshipDate."'";
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
		<td>번호</td>
		<td>교인번호</td>
		<td>예배 날짜</td>
		<td>참석 예배</td>
		<td>성명</td>
		<td>직분</td>
		<td>성별</td>
		<td>생년월일</td>
		<td>핸드폰</td>
		<td>교구</td>
		<td>부서</td>
		<td>교인앱/교인증</td>
		<td>셔틀버스</td>
		<td>유모차</td>
		<td>휠체어</td>
		<td>차량번호</td>
		<td>예배장소</td>
		<td>통역어</td>
		<td>가족아이디</td>
	</tr>
<?php
	$count = 1 ;
	while ($row = mysqli_fetch_assoc($result)) {
?>
	<tr align="center">
		<td><?php echo $count?></td>
		<td><?php echo $row['myNo']?></td>
		<td><?php echo $row['worshipDate']?></td>
		<td><?php echo $row['worshipGubun']?></td>
		<td><?php echo $row['korname']?></td>
		<td><?php echo $row['korChurchPosition']?></td>
		<td>
			<?php
				switch($row['gender']){
					case "M" :
						echo "남";
						break;
					case "F" :
						echo "여";
						break;
					default:
				}
			?>
		</td>
		<td>
			<?php 
				if ($row['birtdday']<>""){
			?>
				<a class="float-right"><?php echo substr($row['birtdday'], 0, 4)."년 ".substr($row['birtdday'], 4, 2)."월 ".substr($row['birtdday'],-2)."일" ?></a>
			<?php
				}
			?>
		</td>
		<td class="xl2225652"><?php echo $row['mobile']?></td>
		<td><?php echo $row['korParishName']?></td>
		<td><?php echo $row['rtdept1Name']?></td>
		<td><?php echo $row['appYN']?></td>
		<td><?php echo $row['busUse']?></td>
		<td><?php echo $row['strollerYN']?></td>		
		<td><?php echo $row['wheelchairYN']?></td>
		<td><?php echo $row['carNo']?></td>
		<td><?php echo $row['worshipPlace']?></td>
		<td><?php echo $row['useLanguage']?></td>
		<td><?php echo $row['familyID']?></td>
	</tr>
<?php
		$count = $count + 1;
	}
?>
</table>

<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>