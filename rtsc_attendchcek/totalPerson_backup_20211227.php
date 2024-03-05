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
	$worshipDate = trim($_REQUEST['worshipDate']);
	$total_rtdept1Code = trim($_REQUEST['total_rtdept1Code']);

	if ($worshipDate == "") {
		# 현재 날짜 주간의 일요일 날짜 구하기
		$sql_weekSunday = "SELECT DATE_ADD(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE())-1) * -1 DAY) as weekSunday";
		$result_weekSunday = mysqli_query($conn, $sql_weekSunday);
		$row_weekSunday = mysqli_fetch_assoc($result_weekSunday);
		$worshipDate = $row_weekSunday['weekSunday'];
	}
	# 해당날짜가 몇주차인지 구하기
	# $sql_weekNum = "select weekNum from attendbasedate where worshipDate = '".$worshipDate."'";
	# $result_weekNum = mysqli_query($conn, $sql_weekNum);
	# $row_weekNum = mysqli_fetch_assoc($result_weekNum);
	# $weekNum = $row_weekNum['weekNum'];

?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
				<div class="card-header">
					<i class="fas fa-map-marker-alt"></i><b> 개인별 출석통계</b>
				</div>
				<script language = "javascript">
				<!--
					function sendit(){
						if (document.rtsc.total_rtdept1Code.value == ""){
							alert("부서를 선택하여 주십시요.");
							document.rtsc.total_rtdept1Code.focus();
							return false;
						}
						document.rtsc.submit();
					}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="totalPerson.php">
				<div class="card-body">
						<div class="form-group row">
								<div class="col-sm-2">
								<select id="total_rtdept1Code" name="total_rtdept1Code" class="form-control">
									<option value="">부서 선택</option>
								<?php
									$sql_dept = "select rtdept1Code, rtdept1Name from rtdept1 where parentsCode <> '' order by rtdept1Code";
									$result_dept = mysqli_query($conn, $sql_dept);
									while ($row_dept = mysqli_fetch_assoc($result_dept)) {
								?>
										<option value="<?php echo $row_dept['rtdept1Code'] ?>"
										<?php
											if ($row_dept['rtdept1Code'] == $total_rtdept1Code){
												echo " selected";
											}
										?>
										><?php echo $row_dept['rtdept1Name'] ?></option>
								<?php
									}
								?>
								</select>
								</div>
								<div class="col-sm-2">
									<a href="javascript:sendit();"><button type="button" class="btn btn-primary">통계보기</button></a>
								</div>
						</div>
				</div>
				</form>
<?php
	if ($total_rtdept1Code <> "") {

		# 현재 년도와 날짜를 구한다.
		$today = date("Y-m-d");
		$sql_worshipDate = "select weekNum, worshipDate from attendbasedate where baseYear = '".substr($today,0,4)."' and worshipDate <= '".$today."' order by worshipDate";
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

		$sql_deptPerson = "select a.memberID, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code), '') as rtdept2Name, a.korname, c.korChurchPosition,(case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID from member a, rtdept1 b, churchPosition c where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.rtdept1Code = '".$total_rtdept1Code."' ORDER BY newMemberID asc, a.churchPositionCode asc";
		# echo $sql_deptPerson;
		$result_deptPerson = mysqli_query($conn, $sql_deptPerson);		
?>
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"><?php echo $row_deptName['rtdept1Name'];?></h3>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
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
														echo "<span class='btn btn-sm btn-success'>".$row_typeName['typeName']."</span>";
														break;
													case "B" :
														echo "<span class='btn btn-sm btn-info'>".$row_typeName['typeName']."</span>";
														break;
													case "C" :
														echo "<span class='btn btn-sm btn-danger'>".$row_typeName['typeName']."</span>";
														break;
													case "D" :
														echo "<span class='btn btn-sm btn-warning'>".$row_typeName['typeName']."</span>";
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
						</div>

					</div>
				</div>
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
