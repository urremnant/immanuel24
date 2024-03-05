<?php
	include "../include/connect.php";
	
	header("Content-type: application/vnd.ms-excel;charset=UTF-8");
	header("Expires:0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Pragma:public");
	header("Content-Disposition: attachment; filename=".date('Ymd')."_로그기록.xls" );

	$sql = "select a.idx, b.korname, c.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = b.rtdept2Code),'') as rtdept2Name, a.gubun, a.excelname, a.loginDate from logData a, homepage_admin b, rtdept1 c where a.homepage_admin_idx = b.homepage_admin_idx and b.rtdept1Code = c.rtdept1Code ORDER BY a.idx desc";
	$result = mysqli_query($conn, $sql);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.xl2225652{mso-font-charset:129;mso-number-format:"\@";white-space:nowrap;}
</style>
<table widtd="100%" border="1" cellspacing="1" cellpadding="3">
	<tr align="center">	
		<td>고유번호</td>
		<td>성명</td>
		<td>부서</td>
		<td>분반</td>
		<td>구분</td>
		<td>엑셀다운로드</td>
		<td>날짜</td>
	</tr>
<?php
	while ($row = mysqli_fetch_assoc($result)) {
?>
	<tr align="center">
		<td><?php echo $row['idx'] ?></td>
		<td><?php echo $row['korname']?></td>
		<td><?php echo $row['rtdept1Name']?></td>
		<td><?php echo $row['rtdept2Name']?></td>
		<td><?php echo $row['gubun'] ?></td>
		<td><?php echo $row['excelname'] ?></td>
		<td><?php echo $row['loginDate'] ?></td>
	</tr>
<?php
	}
?>
</table>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>