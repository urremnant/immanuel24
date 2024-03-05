<?php
	include "../include/header.php";
	include "../include/Navbar.php";
	include "../include/leftMenu.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">렘넌트서밋위원회</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php
	include "../include/connect.php";
	$total_rtdept1Code	= "D10015";
	$worshipStartDate	= trim($_REQUEST['worshipStartDate']);
	$worshipEndDate		= trim($_REQUEST['worshipEndDate']);

	if ($worshipDate == "") {
		# 현재 날짜 주간의 일요일 날짜 구하기
		$sql_weekSunday = "SELECT DATE_ADD(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE())-1) * -1 DAY) as weekSunday";
		$result_weekSunday = mysqli_query($conn, $sql_weekSunday);
		$row_weekSunday = mysqli_fetch_assoc($result_weekSunday);
		$worshipDate = $row_weekSunday['weekSunday'];
	}
	# 해당날짜가 몇주차인지 구하기
	$sql_weekNum = "select weekNum from attendbasedate where worshipDate = '".$worshipDate."'";
	$result_weekNum = mysqli_query($conn, $sql_weekNum);
	$row_weekNum = mysqli_fetch_assoc($result_weekNum);
	$weekNum = $row_weekNum['weekNum'];

?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<i class="fas fa-map-marker-alt"></i><b> 부서별/반별 통계</b>
				</div>
				<script language = "javascript">
				<!--
					function sendit(){
						if (document.rtsc.worshipStartDate.value == ""){
							alert("시작일을 선택하여 주십시요.");
							document.rtsc.worshipStartDate.focus();
							return false;
						}
						if (document.rtsc.worshipEndDate.value == ""){
							alert("종료일을 선택하여 주십시요.");
							document.rtsc.worshipEndDate.focus();
							return false;
						}
						document.rtsc.submit();
					}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="totalDept_TCK.php">
				<div class="card-body">
						<div class="form-group row">
								<div class="col-sm-2">
								<select id="total_rtdept1Code" name="total_rtdept1Code" class="form-control">
									<option value="">부서 선택</option>
									<option value="D10015" selected>TCK부</option>
								</select>
								</div>
								<div class="col-sm-2">
								<?php
									# 현재 년도와 날짜를 구한다.
									$today = date("Y-m-d");
									# $sql_worshipDate = "select worshipDate from attendbasedate where baseYear = '".substr($today,0,4)."' and worshipDate <= '".$today."' order by worshipDate";
									$sql_worshipDate = "select worshipDate from attendbasedate where worshipDate <= '".$today."' order by worshipDate desc";
									# echo $sql_worshipDate;
									$result_worshipDate = mysqli_query($conn, $sql_worshipDate);
								?>
								<select id="worshipStartDate" name="worshipStartDate" class="form-control">
									<option value="">시작일</option>
									<?php
										while ($row_worshipDate = mysqli_fetch_assoc($result_worshipDate)) {
									?>
										<option value="<?php echo $row_worshipDate['worshipDate'] ?>"
										<?php
											if ($row_worshipDate['worshipDate'] == $worshipStartDate){
												echo " selected";
											}
										?>
										><?php echo $row_worshipDate['worshipDate'] ?></option>
									<?php
										}
										mysqli_data_seek($result_worshipDate, 0);
									?>
								</select>
								</div>~
								<div class="col-sm-2">
								<select id="worshipEndDate" name="worshipEndDate" class="form-control">
									<option value="">종료일</option>
									<?php
										while ($row_worshipDate = mysqli_fetch_assoc($result_worshipDate)) {
									?>
										<option value="<?php echo $row_worshipDate['worshipDate'] ?>"
										<?php
											if ($row_worshipDate['worshipDate'] == $worshipEndDate){
												echo " selected";
											}
										?>
										><?php echo $row_worshipDate['worshipDate'] ?></option>
									<?php
										}
									?>
								</select>
								</div>
								<div class="col-sm-2">
									<a href="javascript:sendit();"><button type="button" class="btn btn-primary">출석통계보기</button></a>
								</div>
						</div>
				</div>
				</form>
<?php
	if ($total_rtdept1Code <> "") {

		# 현재 년도와 날짜를 구한다.
		$today = date("Y-m-d");
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

		$sql_deptName = "select rtdept1Name from rtdept1 where rtdept1Code = '".$total_rtdept1Code."'";
		$result_deptName = mysqli_query($conn, $sql_deptName);
		$row_deptName = mysqli_fetch_assoc($result_deptName);

		# 분반
		$sql_dept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode = '".$total_rtdept1Code."' order by rtdept2Code";
		$result_dept2 = mysqli_query($conn, $sql_dept2);
		$rowcount = mysqli_num_rows($result_dept2);
		# echo $rowcount;
?>
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"><?php echo $row_deptName['rtdept1Name'];?></h3>
						</div>
						<div class="card-body table-responsive p-0">
						<!-- 교역자/교사/렘넌트 통계 -->
							<table class="table table-bordered text-nowrap">
							  <thead>
								<tr class="text-center">
									<th rowspan="3" class="align-middle">구분</th>
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<th colspan="12"><?php echo $arrayWorshipDate[$i] ?></th>
							<?php
								}
							?>
								</tr>
								<tr class="text-center">
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<th colspan="2">재적</th>
									<th colspan="2">대면</th>
									<th colspan="2">비대면</th>
									<th colspan="2">결석</th>
									<th colspan="2">조퇴</th>
									<th colspan="2">미체크</th>
							<?php
								}
							?>
								</tr>
								<tr class="text-center">
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
							<?php
								}
							?>
								</tr>


							  </thead>
							  <tbody>
								<tr class="text-center">
									<td>교역자</td>
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<td>
									<?php
										# 재적 일반
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and memberID like 'P%' and tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 재적 TCK
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and memberID like 'P%' and tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 일반
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and memberID like 'P%' and tckYN <> 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 TCK
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and memberID like 'P%' and tckYN = 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>						
							<?php
								}
							?>
								</tr>
								<tr class="text-center">
									<td>교사</td>
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<td>
									<?php
										# 재적 일반
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and memberID like 'T%' and tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 재적 TCK
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and memberID like 'T%' and tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 일반
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and memberID like 'T%' and tckYN <> 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 TCK
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and memberID like 'T%' and tckYN = 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>						
							<?php
								}
							?>
								</tr>
								<tr class="text-center">
									<td>렘넌트</td>
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<td>
									<?php
										# 재적 일반
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and memberID like 'R%' and tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 재적 TCK
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and memberID like 'R%' and tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 일반
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and memberID like 'R%' and tckYN <> 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 TCK
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and memberID like 'R%' and tckYN = 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>						
							<?php
								}
							?>
								</tr>
								<tr class="text-center">
									<td>합계</td>
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<td>
									<?php
										# 재적 일반
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 재적 TCK
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 비대면 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 결석 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 일반
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 조퇴 TCK
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 일반
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and tckYN <> 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# 미체크 TCK
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and tckYN = 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>						
							<?php
								}
							?>
								</tr>
							  </tbody>
							</table>
						</div>
					</div>
				</div>
			<?php
				# 분반 통계 시작
				if ($rowcount != 0){
			?>
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"><?php echo $row_deptName['rtdept1Name'];?> 분반 통계</h3>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-bordered text-nowrap">
							  <thead>
								<tr class="text-center">
									<th rowspan="3" class="align-middle">분반</th>
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<th colspan="12"><?php echo $arrayWorshipDate[$i] ?></th>
							<?php
								}
							?>
								</tr>
								<tr class="text-center">
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<th colspan="2">재적</th>
									<th colspan="2">대면</th>
									<th colspan="2">비대면</th>
									<th colspan="2">결석</th>
									<th colspan="2">조퇴</th>
									<th colspan="2">미체크</th>
							<?php
								}
							?>
								</tr>

								<tr class="text-center">
							<?php
								for($i=0 ; $i<$total_worshipDate_rows; $i++){
							?>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
									<th>일반</th>
									<th>TCK</th>
							<?php
								}
							?>
								</tr>

							  </thead>
							  <tbody>
							<?php
								while ($row_dept2 = mysqli_fetch_assoc($result_dept2)) {
							?>
								<tr class="text-center">
									<td>
										<a href="totalPerson.php?total_rtdept1Code=<?php echo $total_rtdept1Code;?>&total_rtdept2Code=<?php echo $row_dept2['rtdept2Code'];?>&worshipStartDate=<?php echo $worshipStartDate;?>&worshipEndDate=<?php echo $worshipEndDate;?>" target="_blank"><?php echo $row_dept2['rtdept2Name'] ?></a>
									</td>
								<?php
									for($i=0 ; $i<$total_worshipDate_rows; $i++){
								?>
									<td>
									<?php
										# $sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '".$row_dept2['rtdept2Code']."' and DATE_FORMAT(inputDate, '%Y-%m-%d') <= '".$worshipDate."'";
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '".$row_dept2['rtdept2Code']."' and tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# $sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '".$row_dept2['rtdept2Code']."' and DATE_FORMAT(inputDate, '%Y-%m-%d') <= '".$worshipDate."'";
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '".$row_dept2['rtdept2Code']."' and tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>

									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '".$row_dept2['rtdept2Code']."' and tckYN <> 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '".$row_dept2['rtdept2Code']."' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '".$row_dept2['rtdept2Code']."' and tckYN = 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
								<?php
									}
								?>
								</tr>
							<?php
								}
							?>
								<tr class="text-center">
									<td><a href="totalPerson.php?total_rtdept1Code=<?php echo $total_rtdept1Code;?>&total_rtdept2Code=분반없음&worshipStartDate=<?php echo $worshipStartDate;?>&worshipEndDate=<?php echo $worshipEndDate;?>" target="_blank">분반없음</a></td>
								<?php
									for($i=0 ; $i<$total_worshipDate_rows; $i++){
								?>

									<td>
									<?php
										# $sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '' and DATE_FORMAT(inputDate, '%Y-%m-%d') <= '".$worshipDate."'";
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '' and tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										# $sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '' and DATE_FORMAT(inputDate, '%Y-%m-%d') <= '".$worshipDate."'";
										$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '' and tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'A' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'B' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>

									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'C' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN <> 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." = 'D' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."' and a.tckYN = 'Y'";
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '' and tckYN <> 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
									<td>
									<?php
										$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.rtdept2Code = '' and b.week".$arrayWeekNum[$i]." <> '' and baseYear = '".substr($arrayWorshipDate[$i],0,4)."') and rtdept1Code = '".$total_rtdept1Code."' and rtdept2Code = '' and tckYN = 'Y'";
										# echo $sql_count;
										$result_count = mysqli_query($conn, $sql_count);
										$row_count = mysqli_fetch_assoc($result_count);
										echo $row_count['count'];
									?>
									</td>
								<?php
									}
								?>
								</tr>
							  </tbody>
							</table>
						</div>
					</div>
				</div>
				<?php
					}
				?>
<?php
	}
?>
            </div>
            <!-- /.card -->
          </div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>