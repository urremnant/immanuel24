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
	$worshipDate		= trim($_REQUEST['worshipDate']);
	$total_rtdept1Code	= trim($_REQUEST['total_rtdept1Code']);
	$total_rtdept2Code	= trim($_REQUEST['total_rtdept2Code']);
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
	# $sql_weekNum = "select weekNum from attendbasedate where worshipDate = '".$worshipDate."'";
	# $result_weekNum = mysqli_query($conn, $sql_weekNum);
	# $row_weekNum = mysqli_fetch_assoc($result_weekNum);
	# $weekNum = $row_weekNum['weekNum'];

?>
<script language ="javascript">
<!--
function getXMLHttpRequest() {
	if (window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e1) { return null; }
		}
	} else if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else {
		return null;
	}
}
var httpRequest = null;

function sendRequest(url, params, callback, method) {
	httpRequest = getXMLHttpRequest();
	var httpMethod = method ? method : 'GET';
	if (httpMethod != 'GET' && httpMethod != 'POST') {
		httpMethod = 'GET';
	}
	var httpParams = (params == null || params == '') ? null : params;
	var httpUrl = url;
	if (httpMethod == 'GET' && httpParams != null) {
		httpUrl = httpUrl + "?" + httpParams;
	}
	httpRequest.open(httpMethod, httpUrl, true);
	httpRequest.setRequestHeader(
		'Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.onreadystatechange = callback;
	httpRequest.send(httpMethod == 'POST' ? httpParams : null);
}
// 분반코드 AJAX
function getCont(t)
{
	var obj = window.event.srcElement;
	var tgt = document.getElementById(t);
	var xmlhttp     = fncGetHttpRequest();

	// 두번째 파라미터 데이터를 가져올 페이지 URL 파라미터로 지금 선택된 select 의 값을 넘겨줍니다.
	xmlhttp.open('GET', '../include/getRtdept3.php?total_rtdept1Code='+obj.value, false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
	xmlhttp.onreadystatechange = function ()
	{
		if( xmlhttp.readyState=='4' )
		{
			// xmlhttp.status 값이 200 인경우 성공, 컴파일 오류 500, 페이지를 찾을수 없을경우 404, 접근권한 없는경우403
			tgt.innerHTML    = xmlhttp.responseText; // select 된 하위 객체에 값을 입력
		}
	}
	xmlhttp.send();
}
function fncGetHttpRequest()
{
	var caller;
	try {
		caller = new XMLHttpRequest();	// IE 7 or none IE
	}
	catch (e) {
		try	{
			caller = new ActiveXObject("Msxml2.XMLHTTP");	// IE 5, 6
		}
		catch (e) {
			try {
				caller = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {
				caller = null; // can't instantiate caller
			}
		}
	}
	return caller;
}
-->
</script>
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
						if ((document.rtsc.worshipStartDate.value != "")&&(document.rtsc.worshipEndDate.value != "")){
							if (document.rtsc.worshipStartDate.value > document.rtsc.worshipEndDate.value) {
								alert("시작일이 종료일보다 이후입니다.");
								document.rtsc.worshipStartDate.focus();
								return false;
							}
						}
						document.rtsc.submit();
					}
					function downloadExcel(){
						if (document.rtsc.total_rtdept1Code.value == ""){
							alert("부서를 선택하여 주십시요.");
							document.rtsc.total_rtdept1Code.focus();
							return false;
						}
						if ((document.rtsc.worshipStartDate.value != "")&&(document.rtsc.worshipEndDate.value != "")){
							if (document.rtsc.worshipStartDate.value > document.rtsc.worshipEndDate.value) {
								alert("시작일이 종료일보다 이후입니다.");
								document.rtsc.worshipStartDate.focus();
								return false;
							}
						}
						var total_rtdept1Code = document.getElementById('total_rtdept1Code').value;
						var total_rtdept2Code = document.getElementById('total_rtdept2Code').value;
						var worshipStartDate = document.getElementById('worshipStartDate').value;
						var worshipEndDate = document.getElementById('worshipEndDate').value;
						location.href="totalPerson_exceldownload.php?total_rtdept1Code="+total_rtdept1Code+"&total_rtdept2Code="+total_rtdept2Code+"&worshipStartDate="+worshipStartDate+"&worshipEndDate="+worshipEndDate;
					}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="totalPerson.php">
				<div class="card-body">
						<div class="form-group row">
								<div class="col-sm-2">
								<select id="total_rtdept1Code" name="total_rtdept1Code" class="form-control" onchange='javascript:getCont("sel_2");'>
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
									<span id='sel_2'>
									<?php
										$sql_rtdept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode = '".$total_rtdept1Code."' order by rtdept2Code";
										$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
										//$row = mysqli_fetch_assoc($result);
										//$cnt = mysqli_num_rows($result);
									?>
										<select class="custom-select rounded-0" Id="total_rtdept2Code" name="total_rtdept2Code">
											<option value="">분반 선택</option>
									<?php
										while ($row_rtdept2 = mysqli_fetch_assoc($result_rtdept2)) {
									?>
											<option value="<?php echo $row_rtdept2['rtdept2Code'] ?>"
											<?php
												if ($row_rtdept2['rtdept2Code'] == $total_rtdept2Code){
													echo " selected";
												}
											?>><?php echo $row_rtdept2['rtdept2Name'] ?></option>
									<?php
										}
									?>
											</select>
									</span>
								</div>
								<div class="col-sm-2">
								<?php
									# 현재 년도와 날짜를 구한다.
									$today = date("Y-m-d");
									$sql_worshipDate = "select worshipDate from attendbasedate where worshipDate <= '".$today."' order by worshipDate desc";
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
									<a href="javascript:sendit();"><button type="button" class="btn btn-primary">통계보기</button></a>
									<a href="javascript:downloadExcel();"><button type="button" class="btn btn-info">엑셀다운로드</button></a>
								</div>
						</div>
				</div>
				</form>
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

		$sql_deptName = "select rtdept1Name from rtdept1 where rtdept1Code = '".$total_rtdept1Code."'";
		$result_deptName = mysqli_query($conn, $sql_deptName);
		$row_deptName = mysqli_fetch_assoc($result_deptName);

		$sql_deptName2 = "select rtdept2Name from rtdept2 where rtdept2Code = '".$total_rtdept2Code."'";
		$result_deptName2 = mysqli_query($conn, $sql_deptName2);
		$row_deptName2 = mysqli_fetch_assoc($result_deptName2);		

		$sql_deptPerson = "select a.memberID, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code), '') as rtdept2Name, a.korname, c.korChurchPosition,(case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID from member a, rtdept1 b, churchPosition c where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.rtdept1Code = '".$total_rtdept1Code."' ";
		if ($total_rtdept2Code <> ""){
			if ($total_rtdept2Code == "분반없음"){
				$sql_deptPerson = $sql_deptPerson."and a.rtdept2Code='' ";
			}else{
				$sql_deptPerson = $sql_deptPerson."and a.rtdept2Code='".$total_rtdept2Code."' ";
			}
		}
		$sql_deptPerson = $sql_deptPerson."order by newMemberID asc, a.churchPositionCode asc";
		# echo $sql_deptPerson;
		$result_deptPerson = mysqli_query($conn, $sql_deptPerson);		
?>
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title">
								<?php 
									echo $row_deptName['rtdept1Name'];
									if ($row_deptName2['rtdept2Name'] <> ""){
										echo " > ".$row_deptName2['rtdept2Name'];;
									}
								?>
							</h3>
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
														$sql_absentReason = "select * from absentreason where memberID = '".$row_deptPerson['memberID']."' and worshipDate = '".$arrayWorshipDate[$i]."'";
														# echo $sql_absentreason;
														$result_absentReason = mysqli_query($conn, $sql_absentReason);
														$row_absentReason = mysqli_fetch_assoc($result_absentReason);
														if ($row_absentReason['absentReason'] <> ""){
															echo "<span class='btn btn-sm btn-danger'>".$row_typeName['typeName']."(".$row_absentReason['absentReason'].")</span>";
														}else{
															echo "<span class='btn btn-sm btn-danger'>".$row_typeName['typeName']."</span>";
														}
														break;
													case "D" :
														$sql_absentReason = "select * from absentreason where memberID = '".$row_deptPerson['memberID']."' and worshipDate = '".$arrayWorshipDate[$i]."'";
														$result_absentReason = mysqli_query($conn, $sql_absentReason);
														$row_absentReason = mysqli_fetch_assoc($result_absentReason);
														if ($row_absentReason['absentReason']<>""){
															echo "<span class='btn btn-sm btn-warning'>".$row_typeName['typeName']."(".$row_absentReason['absentReason'].")</span>";
														}else{
															echo "<span class='btn btn-sm btn-warning'>".$row_typeName['typeName']."</span>";
														}
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
