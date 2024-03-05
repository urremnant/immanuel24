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

	$excel_korParishName	= trim($_REQUEST['excel_korParishName']);

	//로그기록
	$ipaddress = get_client_ip();
	$sql_log = "insert into logData(homepage_admin_idx, gubun, excelname, loginDate, ipaddress) values ('".$_SESSION['ss_homepage_admin_idx']."', 'excel', '".$excel_korParishName."', now(), '".$ipaddress."')";
	$result_log = mysqli_query($conn, $sql_log);

	header("Content-type: application/vnd.ms-excel;charset=UTF-8");
	header("Expires:0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Pragma:public");
	header("Content-Disposition: attachment; filename=".date('Ymd')."_".$excel_korParishName.".xls" );

	if ($excel_korParishName != "전체"){
		if ($excel_korParishName == "동북권역"){
			$churchareaCode = "('A00001','A00002','A00003')";
		}
		if ($excel_korParishName == "동남권역"){
			$churchareaCode = "('A00004','A00005','A00006','A00007','A00008','A00009')";
		}
		if ($excel_korParishName == "서남권역"){
			$churchareaCode = "('A00010','A00011','A00012','A00013')";
		}
		if ($excel_korParishName == "서북권역"){
			$churchareaCode = "('A00014','A00015','A00016')";
		}
		if ($excel_korParishName == "11교구"){
			$churchareaCode = "A00001";
		}
		if ($excel_korParishName == "12교구"){
			$churchareaCode = "A00002";
		}
		if ($excel_korParishName == "13교구"){
			$churchareaCode = "A00003";
		}
		if ($excel_korParishName == "21교구"){
			$churchareaCode = "A00004";
		}
		if ($excel_korParishName == "22교구"){
			$churchareaCode = "A00005";
		}
		if ($excel_korParishName == "23교구"){
			$churchareaCode = "A00006";
		}
		if ($excel_korParishName == "24교구"){
			$churchareaCode = "A00007";
		}
		if ($excel_korParishName == "25교구"){
			$churchareaCode = "A00008";
		}
		if ($excel_korParishName == "26교구"){
			$churchareaCode = "A00009";
		}
		if ($excel_korParishName == "31교구"){
			$churchareaCode = "A00010";
		}
		if ($excel_korParishName == "32교구"){
			$churchareaCode = "A00011";
		}
		if ($excel_korParishName == "33교구"){
			$churchareaCode = "A00012";
		}
		if ($excel_korParishName == "34교구"){
			$churchareaCode = "A00013";
		}
		if ($excel_korParishName == "41교구"){
			$churchareaCode = "A00014";
		}
		if ($excel_korParishName == "42교구"){
			$churchareaCode = "A00015";
		}
		if ($excel_korParishName == "43교구"){
			$churchareaCode = "A00016";
		}
	}

	$sql = "select a.*, b.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code), '') as rtdept2Name, a.korname, c.korChurchPosition, d.korChurchAreaName, d.korParishName, e.korProfessional, f.korCountryName, (case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID from member a, rtdept1 b, churchPosition c, churcharea d, expertMeeting e, country f where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode and a.expertMeetingCode = e.expertMeetingCode and a.countryCode = f.countryCode ";
	if ($excel_korParishName != "전체"){
		if (($excel_korParishName == "동북권역") || ($excel_korParishName == "동남권역") || ($excel_korParishName == "서남권역") || ($excel_korParishName == "서북권역")){
			$sql = $sql."and a.churchareaCode in ".$churchareaCode." "; 
		}else{
			$sql = $sql."and a.churchareaCode = '".$churchareaCode."' "; 
		}
	}
	$sql = $sql."ORDER BY d.korParishName, newMemberID, a.korname asc";
	$result = mysqli_query($conn, $sql);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.xl2225652{mso-font-charset:129;mso-number-format:"\@";white-space:nowrap;}
</style>

<table width="100%" border="1" cellspacing="1" cellpadding="3">
	<tr align="center">	
		<td>번호</td>
		<td>아이디</td>
		<td>교구</td>
		<td>부서</td>
		<td>분반</td>
		<td>성명</td>
		<td>직분</td>
		<td>성별</td>
		<td>생년월일</td>
		<td>핸드폰</td>
		<td>이메일</td>
		<td>우편번호</td>
		<td>주소</td>
		<td>직업</td>
		<td>직장</td>
		<td>비전</td>
		<td>나라</td>
		<td>언어</td>
		<td>관심전문별</td>
		<td>기도제목</td>
		<td>담당교역자</td>
		<td>담당교사1</td>
		<td>담당교사2</td>
		<td>학교 유치원/전공</td>
		<td>학원 동아리 방과후교실</td>
		<td>취미 특기 놀이</td>
		<td>CVDIP</td>
		<td>특이경력(질병,상벌)</td>
		<td>현장시스템1</td>
		<td>현장시스템2</td>
		<td>훈련</td>
		<td>가족관계</td>
	</tr>
<?php
	$count = 1 ;
	while ($row = mysqli_fetch_assoc($result)) {
?>
	<tr align="center">
		<td><?php echo $count?></td>
		<td><?php echo $row['memberID']?></td>
		<td><?php echo $row['korChurchAreaName']." ".$row['korParishName']?></td>
		<td><?php echo $row['rtdept1Name']?></td>
		<td><?php echo $row['rtdept2Name']?></td>
		<td><?php echo $row['korname']?></td>
		<td><?php echo $row['korChurchPosition']?></td>
		<td>
			<?php
				if ($row['gender'] <> "") {
					switch ($row['gender']){
						case "M" :
							echo "남";
							break;
						case "F" :
							echo "여";
							break;
						default :
					}
				}
			?>
		</td>
		<td>
			<?php 
				if ($row['birthday']<>""){
			?>
				<a class="float-right"><?php echo substr($row['birthday'], 0, 4)."년 ".substr($row['birthday'], 4, 2)."월 ".substr($row['birthday'],-2)."일" ?></a>
			<?php
				}
			?>
		</td>
		<td class="xl2225652"><?php echo $row['mobile']?></td>
		<td><?php echo $row['email']?></td>
		<td><?php echo $row['zipcode']?></td>
		<td><?php echo $row['address']?></td>
		<td><?php echo $row['job']?></td>
		<td><?php echo $row['company']?></td>
		<td><?php echo $row['vision']?></td>
		<td><?php echo $row['korCountryName']?></td>
		<td><?php echo $row['language']?></td>
		<td><?php echo $row['korProfessional']?></td>
		<td><?php echo $row['prayertopic']?></td>
		<td>
			<?php
				if ($row['pastorID']<>""){
					$sql_pastor = "select a.korname, b.korChurchPosition, a.mobile from member a, churchPosition b where a.churchPositionCode = b.churchPositionCode and a.memberID = '".$row['pastorID']."'";
					$result_pastor = mysqli_query($conn, $sql_pastor);
					$row_pastor = mysqli_fetch_assoc($result_pastor);
					echo $row_pastor['korname'].$row_pastor['korChurchPosition']."/".$row_pastor['mobile'];
				}
			?>
		</td>
		<td>
			<?php
				if ($row['teacher1ID']<>""){
					$sql_teacher1 = "select a.korname, b.korChurchPosition, a.mobile, a.train1, a.train2, a.train3, a.train4, a.train5, a.train6, a.train7, a.train8, a.train9, a.train10, a.train11, a.train12, a.train13, a.train14, a.train15, a.train16, a.train17, a.train18, a.train19, a.job, a.zipcode, a.address from member a, churchPosition b where a.churchPositionCode = b.churchPositionCode and a.memberID = '".$row['teacher1ID']."'";
					$result_teacher1 = mysqli_query($conn, $sql_teacher1);
					$row_teacher1 = mysqli_fetch_assoc($result_teacher1);
					echo $row_teacher1['korname'].$row_teacher1['korChurchPosition']."/".$row_teacher1['mobile']."<br style='mso-data-placement:same-cell;'>";
					if ($row_teacher1['train1'] == "Y"){
						$train_teacher1 = $train_teacher1."초등합숙/";
					}
					if ($row_teacher1['train2'] == "Y"){
						$train_teacher1 = $train_teacher1."중고합숙/";
					}
					if ($row_teacher1['train3'] == "Y"){
						$train_teacher1 = $train_teacher1."일반합숙/";
					}
					if ($row_teacher1['train4'] == "Y"){
						$train_teacher1 = $train_teacher1."순회팀합숙/";
					}
					if ($row_teacher1['train5'] == "Y"){
						$train_teacher1 = $train_teacher1."70인1차/";
					}
					if ($row_teacher1['train6'] == "Y"){
						$train_teacher1 = $train_teacher1."미션홈/";
					}
					if ($row_teacher1['train7'] == "Y"){
						$train_teacher1 = $train_teacher1."전문별팀합숙/";
					}
					if ($row_teacher1['train8'] == "Y"){
						$train_teacher1 = $train_teacher1."70인3차/";
					}
					if ($row_teacher1['train9'] == "Y"){
						$train_teacher1 = $train_teacher1."전도합숙/";
					}
					if ($row_teacher1['train10'] == "Y"){
						$train_teacher1 = $train_teacher1."초등신학원/";
					}
					if ($row_teacher1['train11'] == "Y"){
						$train_teacher1 = $train_teacher1."청소년신학원/";
					}
					if ($row_teacher1['train12'] == "Y"){
						$train_teacher1 = $train_teacher1."대학신학원/";
					}
					if ($row_teacher1['train13'] == "Y"){
						$train_teacher1 = $train_teacher1."일반신학원/";
					}
					if ($row_teacher1['train14'] == "Y"){
						$train_teacher1 = $train_teacher1."선교사훈련원/";
					}
					if ($row_teacher1['train15'] == "Y"){
						$train_teacher1 = $train_teacher1."집중신학원/";
					}
					if ($row_teacher1['train16'] == "Y"){
						$train_teacher1 = $train_teacher1."RTS/";
					}
					if ($row_teacher1['train17'] == "Y"){
						$train_teacher1 = $train_teacher1."RU/";
					}
					if ($row_teacher1['train18'] == "Y"){
						$train_teacher1 = $train_teacher1."전도전문훈련원/";
					}
					if ($row_teacher1['train19'] == "Y"){
						$train_teacher1 = $train_teacher1."중직자대학원";
					}
					$str_cut_teacher1 = substr($train_teacher1,-1);
					if ($str_cut_teacher1 === '/') {
						$train_teacher1 = substr($train_teacher1,0,-1);
					}
					echo $train_teacher1."<br style='mso-data-placement:same-cell;'>";
					if ($row_teacher1['job']<>""){
						echo $row_teacher1['job']."/".$row_teacher1['company']."<br style='mso-data-placement:same-cell;'>";
					}
					if ($row_teacher1['zipcode']<>""){
						echo $row_teacher1['zipcode']." ";
					}
					if ($row_teacher1['address']<>""){
						echo $row_teacher1['address']."<br style='mso-data-placement:same-cell;'>";;
					}
				}
			?>		
		</td>
		<td>
			<?php
				if ($row['teacher2ID']<>""){
					$sql_teacher2 = "select a.korname, b.korChurchPosition, a.mobile, a.train1, a.train2, a.train3, a.train4, a.train5, a.train6, a.train7, a.train8, a.train9, a.train10, a.train11, a.train12, a.train13, a.train14, a.train15, a.train16, a.train17, a.train18, a.train19, a.job, a.company, a.zipcode, a.address from member a, churchPosition b where a.churchPositionCode = b.churchPositionCode and a.memberID = '".$row['teacher2ID']."'";
					$result_teacher2 = mysqli_query($conn, $sql_teacher2);
					$row_teacher2 = mysqli_fetch_assoc($result_teacher2);
					echo $row_teacher2['korname'].$row_teacher2['korChurchPosition']."/".$row_teacher2['mobile']."<br style='mso-data-placement:same-cell;'>";
					if ($row_teacher2['train1'] == "Y"){
						$train_teacher2 = $train_teacher2."초등합숙/";
					}
					if ($row_teacher2['train2'] == "Y"){
						$train_teacher2 = $train_teacher2."중고합숙/";
					}
					if ($row_teacher2['train3'] == "Y"){
						$train_teacher2 = $train_teacher2."일반합숙/";
					}
					if ($row_teacher2['train4'] == "Y"){
						$train_teacher2 = $train_teacher2."순회팀합숙/";
					}
					if ($row_teacher2['train5'] == "Y"){
						$train_teacher2 = $train_teacher2."70인1차/";
					}
					if ($row_teacher2['train6'] == "Y"){
						$train_teacher2 = $train_teacher2."미션홈/";
					}
					if ($row_teacher2['train7'] == "Y"){
						$train_teacher2 = $train_teacher2."전문별팀합숙/";
					}
					if ($row_teacher2['train8'] == "Y"){
						$train_teacher2 = $train_teacher2."70인3차/";
					}
					if ($row_teacher2['train9'] == "Y"){
						$train_teacher2 = $train_teacher2."전도합숙/";
					}
					if ($row_teacher2['train10'] == "Y"){
						$train_teacher2 = $train_teacher2."초등신학원/";
					}
					if ($row_teacher2['train11'] == "Y"){
						$train_teacher2 = $train_teacher2."청소년신학원/";
					}
					if ($row_teacher2['train12'] == "Y"){
						$train_teacher2 = $train_teacher2."대학신학원/";
					}
					if ($row_teacher2['train13'] == "Y"){
						$train_teacher2 = $train_teacher2."일반신학원/";
					}
					if ($row_teacher2['train14'] == "Y"){
						$train_teacher2 = $train_teacher2."선교사훈련원/";
					}
					if ($row_teacher2['train15'] == "Y"){
						$train_teacher2 = $train_teacher2."집중신학원/";
					}
					if ($row_teacher2['train16'] == "Y"){
						$train_teacher2 = $train_teacher2."RTS/";
					}
					if ($row_teacher2['train17'] == "Y"){
						$train_teacher2 = $train_teacher2."RU/";
					}
					if ($row_teacher2['train18'] == "Y"){
						$train_teacher2 = $train_teacher2."전도전문훈련원/";
					}
					if ($row_teacher2['train19'] == "Y"){
						$train_teacher2 = $train_teacher2."중직자대학원";
					}
					$str_cut_teacher2 = substr($train_teacher2,-1);
					if ($str_cut_teacher2 === '/') {
						$train_teacher2 = substr($train_teacher2,0,-1);
					}
					echo $train_teacher2."<br style='mso-data-placement:same-cell;'>";
					if ($row_teacher2['job']<>""){
						echo $row_teacher2['job']."/".$row_teacher2['company']."<br style='mso-data-placement:same-cell;'>";
					}
					if ($row_teacher2['zipcode']<>""){
						echo $row_teacher2['zipcode']." ";
					}
					if ($row_teacher2['address']<>""){
						echo $row_teacher2['address']."<br style='mso-data-placement:same-cell;'>";;
					}
				}
			?>
		</td>
		<td><?php echo $row['schoolinfo']?></td>
		<td><?php echo $row['afterschool']?></td>
		<td><?php echo $row['hobby']?></td>
		<td><?php echo $row['cvdip']?></td>
		<td><?php echo $row['career']?></td>
		<td><?php echo $row['fieldsystem1']?></td>
		<td><?php echo $row['fieldsystem2']?></td>
		<td>
			<?php
				if ($row['train1'] == "Y"){
					$train = $train."초등합숙/";
				}
				if ($row['train2'] == "Y"){
					$train = $train."중고합숙/";
				}
				if ($row['train3'] == "Y"){
					$train = $train."일반합숙/";
				}
				if ($row['train4'] == "Y"){
					$train = $train."순회팀합숙/";
				}
				if ($row['train5'] == "Y"){
					$train = $train."70인1차/";
				}
				if ($row['train6'] == "Y"){
					$train = $train."미션홈/";
				}
				if ($row['train7'] == "Y"){
					$train = $train."전문별팀합숙/";
				}
				if ($row['train8'] == "Y"){
					$train = $train."70인3차/";
				}
				if ($row['train9'] == "Y"){
					$train = $train."전도합숙/";
				}
				if ($row['train10'] == "Y"){
					$train = $train."초등신학원/";
				}
				if ($row['train11'] == "Y"){
					$train = $train."청소년신학원/";
				}
				if ($row['train12'] == "Y"){
					$train = $train."대학신학원/";
				}
				if ($row['train13'] == "Y"){
					$train = $train."일반신학원/";
				}
				if ($row['train14'] == "Y"){
					$train = $train."선교사훈련원/";
				}
				if ($row['train15'] == "Y"){
					$train = $train."집중신학원/";
				}
				if ($row['train16'] == "Y"){
					$train = $train."RTS/";
				}
				if ($row['train17'] == "Y"){
					$train = $train."RU/";
				}
				if ($row['train18'] == "Y"){
					$train = $train."전도전문훈련원/";
				}
				if ($row['train19'] == "Y"){
					$train = $train."중직자대학원";
				}
				$str_cut = substr($train,-1);
				if ($str_cut === '/') {
					$train = substr($train,0,-1);
				}
				echo $train;
			?>		
		</td>
		<td>
			<?php 
				if ($row['family1_relation']<>""){
					echo $row['family1_relation']."/".$row['family1_korname']."/".$row['family1_korChurchPosition']."/".$row['family1_mobile']."/".$row['family1_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family2_relation']<>""){
					echo $row['family2_relation']."/".$row['family2_korname']."/".$row['family2_korChurchPosition']."/".$row['family2_mobile']."/".$row['family2_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family3_relation']<>""){
					echo $row['family3_relation']."/".$row['family3_korname']."/".$row['family3_korChurchPosition']."/".$row['family3_mobile']."/".$row['family3_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family4_relation']<>""){
					echo $row['family4_relation']."/".$row['family4_korname']."/".$row['family4_korChurchPosition']."/".$row['family4_mobile']."/".$row['family4_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family5_relation']<>""){
					echo $row['family5_relation']."/".$row['family5_korname']."/".$row['family5_korChurchPosition']."/".$row['family5_mobile']."/".$row['family5_job']."<br style='mso-data-placement:same-cell;'>";
				}				
				if ($row['family6_relation']<>""){
					echo $row['family6_relation']."/".$row['family6_korname']."/".$row['family6_korChurchPosition']."/".$row['family6_mobile']."/".$row['family6_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family7_relation']<>""){
					echo $row['family7_relation']."/".$row['family7_korname']."/".$row['family7_korChurchPosition']."/".$row['family7_mobile']."/".$row['family7_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family8_relation']<>""){
					echo $row['family8_relation']."/".$row['family8_korname']."/".$row['family8_korChurchPosition']."/".$row['family8_mobile']."/".$row['family8_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family9_relation']<>""){
					echo $row['family9_relation']."/".$row['family9_korname']."/".$row['family9_korChurchPosition']."/".$row['family9_mobile']."/".$row['family9_job']."<br style='mso-data-placement:same-cell;'>";
				}
				if ($row['family10_relation']<>""){
					echo $row['family10_relation']."/".$row['family10_korname']."/".$row['family10_korChurchPosition']."/".$row['family10_mobile']."/".$row['family10_job']."<br style='mso-data-placement:same-cell;'>";
				}
			?>		
		</td>
	</tr>
<?php
		$count = $count + 1;
	}
?>
</table>

<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>