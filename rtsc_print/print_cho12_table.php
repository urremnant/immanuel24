<?php
	include "../include/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>렘넌트서밋위원회</title>
  <Link rel="stylesheet" href="print.css" type="text/css">
  <style type="text/css" media="print">
	table.breakpoint{
		page-break-after: always;
		page-break-inside: avoid;
	}
  </style>
</head>
<body>
<?php
	$sql = "select (case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID, a.photofilename, a.korname, a.job, b.rtdept2Name, a.mobile, a.address, a.prayertopic, a.vision, a.schoolinfo, family1_korname, family1_korchurchPosition, family1_mobile, family2_korname, family2_korchurchPosition, family2_mobile from member a, rtdept2 b where a.rtdept2Code = b.rtdept2Code and a.rtdept1Code = 'D10004' and left(a.memberID,1) <> 'P' and a.rtdept2Code <> ''  order by a.rtdept2Code, newMemberID, a.korname";
	$result = mysqli_query($conn, $sql);
	
	$i = 0;
	while ($row = mysqli_fetch_assoc($result)) {
		switch(substr($row['newMemberID'],0,1)){
		case "B":
				$i=0;
				if ($rtdept2Name == ""){
						$rtdept2Name = $row['rtdept2Name'];
				}
				if ($rtdept2Name == $row['rtdept2Name']){
					echo "<table><tr><td></td></tr></table>";
				}else{
					echo "<table class='breakpoint'><tr><td></td></tr></table>";
					$rtdept2Name = $row['rtdept2Name'];
				}
?>
				<table border="1" cellpadding="3" cellspacing="0" style="border-collapse:collapse;" width="100%" bordercolor="#333333" align="center">
				  <tbody>
					<tr align="center">
					  <td rowspan="4" style="width:20%">
						<?php
							If ($row['photofilename'] <> "") {
								//파일이 존재하는지 체크
								$filePathCheck = "../upload/".$row['photofilename'];
								//echo $filePathCheck;
								if (file_exists($filePathCheck)){
						?>
									<img src="../upload/<?php echo $row['photofilename']?>" width="50">
						<?php
								}
							}
						?>
					  </td>
					  <td style="width:15%">이름</td>
					  <td style="width:25%"><b><?php echo $row['korname']?></b></td>
					  <td style="width:15%">담당</td>
					  <td style="width:25%"><?php echo $row['rtdept2Name']?> 담임</td>
					</tr>
					<tr align="center">
					  <td>직업</td>
					  <td><?php echo $row['job']?></td>
					  <td>연락처</td>
					  <td colspan="2"><?php echo $row['mobile']?></td>
					</tr>
					<tr align="center">
					  <td>주소</td>
					  <td colspan="3"><?php echo $row['address']?></td>
					</tr>
					<tr align="left">
					  <td colspan="4"><?php echo str_replace("\r\n", "<br>", $row['prayertopic']) ?></td>
					</tr>
				  </tbody>
				</table>
<?php
			$i = $i + 1;
			break;
		case "C":
?>
				<table class="table <?php If (($i%5)==0){echo "breakpoint";}?>"><tr><td></td></tr></table>
				<table border="1" cellpadding="3" cellspacing="0" style="border-collapse:collapse;" width="100%" bordercolor="#333333" align="center">
				  <tbody>
					<tr align="center">
					  <td rowspan="4" style="width:20%">
						<?php
							If ($row['photofilename'] <> "") {
								//파일이 존재하는지 체크
								$filePathCheck = "../upload/".$row['photofilename'];
								//echo $filePathCheck;
								if (file_exists($filePathCheck)){
						?>
									<img src="../upload/<?php echo $row['photofilename']?>" width="50">
						<?php
								}
							}
						?>
					  </td>
					  <td style="width:10%">이름</td>
					  <td style="width:15%"><b><?php echo $row['korname']?></b></td>
					  <td style="width:10%">학교</td>
					  <td style="width:15%"><?php echo $row['schoolinfo']?></td>
					  <td style="width:10%">비전</td>
					  <td style="width:20%"><?php echo $row['vision']?></td>
					</tr>
					<tr align="center">
					  <td>아빠</td>
					  <td colspan="2">
						<?php
							if ($row['family1_korname'] != ""){
								echo $row['family1_korname']." ".$row['family1_korchurchPosition']."<br>".$row['family1_mobile'];
							}
						?>
					  </td>
					  <td>엄마</td>
					  <td colspan="2">
						<?php
							if ($row['family2_korname'] != ""){
								echo $row['family2_korname']." ".$row['family2_korchurchPosition']."<br>".$row['family2_mobile'];
							}
						?>
					  </td>
					</tr>
					<tr align="center">
					  <td>주소</td>
					  <td colspan="5"><?php echo $row['address']?></td>
					</tr>
					<tr align="left">
					  <td colspan="6"><?php echo str_replace("\r\n", "<br>", $row['prayertopic']) ?></td>
					</tr>
				  </tbody>
				</table>

<?php
			$i = $i + 1;
			break;
		}
	}
?>
</body>
</html>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>