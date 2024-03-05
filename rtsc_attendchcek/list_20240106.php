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

	$attendCheckDeptCode	= trim($_REQUEST['attendCheckDeptCode']);
	$worshipDate			= trim($_REQUEST['worshipDate']);
	$attendCheckValue		= trim($_REQUEST['attendCheckValue']);

	if ($worshipDate == "") {
		# 현재 날짜 주간의 일요일 날짜 구하기
		$sql_worshipDate = "SELECT DATE_ADD(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE())-1) * -1 DAY) as worshipDate";
		$result_worshipDate = mysqli_query($conn, $sql_worshipDate);
		$row_worshipDate = mysqli_fetch_assoc($result_worshipDate);
		$worshipDate = $row_worshipDate['worshipDate'];
	}

	# 구해온 일요일이 몇주차인지 DB에서 불러와서 출결관리에서 해당 칼럼의 값을 맞게 불러와야 한다.
	$sql_weekNum = "select weekNum from attendbasedate where worshipDate = '".$worshipDate."'";
	$result_weekNum = mysqli_query($conn, $sql_weekNum);
	$row_weekNum = mysqli_fetch_assoc($result_weekNum);
	$weekNum = $row_weekNum['weekNum'];

  
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$churchareaCode = trim($_REQUEST['churchareaCode']);
	# 출석체크할 부서코드를 $rtdept1Code 에 넣어준다.
	$rtdept1Code	= trim($_REQUEST['attendCheckDeptCode']);
	if ($rtdept1Code <> ""){
		$sql_rtdept1 = "SELECT rtdept1Name from rtdept1 where rtdept1Code = '".$rtdept1Code."'";
		$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
		$row_rtdept1 = mysqli_fetch_assoc($result_rtdept1);
		$rtdept1Name = $row_rtdept1['rtdept1Name'];
	}

	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
	//분반코드가 없는 경우 세션 분반 값을 넣어준다.
	if ($rtdept2Code == ""){
		$rtdept2Code = $_SESSION['ss_rtdept2code'];
		//echo "세션 분반를 적용하였습니다.";
	}else{
		//세션 분반 코드가 없는 사람은 렘넌트서밋위원회, 미취학렘넌트국, 초등렘넌트국, 청소년렘넌트국, 대학국, 사랑부 부장이다.
		//교사는 모두 세션 분반 코드가 있다. 교사는 자신이 담당하는 분반만 열람이 가능하다.
		if ($_SESSION['ss_rtdept2code'] != "") {
			if ($rtdept2Code <> $_SESSION['ss_rtdept2code']){
				echo "<script>alert('교사는 자신이 담당하는 분반만 열람가능합니다.');self.close();</script>";
			}
		}
	}

	if ($rtdept2Code <> ""){
		$sql_rtdept2 = "SELECT rtdept2Name from rtdept2 where rtdept2Code = '".$rtdept2Code."'";
		$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
		$row_rtdept2 = mysqli_fetch_assoc($result_rtdept2);
		$rtdept2Name = $row_rtdept2['rtdept2Name'];
	}


//	D00001	렘넌트서밋위원회		
//	D00002	미취학렘넌트국		
//	D00003	초등렘넌트국		
//	D00004	청소년렘넌트국		
//	D00005	대학국		
//	D10001	태영아부	D00002	
//	D10002	유아부	D00002	
//	D10003	유치부	D00002	
//	D10004	초등12부	D00003	
//	D10005	초등34부	D00003	
//	D10006	초등56부	D00003	
//	D10007	중등부	D00004	
//	D10008	고등부	D00004	
//	D10009	대학1부	D00005	
//	D10010	대학2부	D00005	
//	D10011	대학3부	D00005	
//	D10012	사랑부		
			

	$sql = "SELECT COUNT(memberID) AS cnt FROM member a, rtdept1 b, churchPosition c, churcharea d where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode "; // member 테이블에 등록되어있는 회원의 수를 구함
	if ($churchareaCode <> ""){
		$sql = $sql."and a.churchareaCode = '".$churchareaCode."' "; 
	}
	if ($rtdept1Code <> ""){
		switch ($rtdept1Code) {
			case "D00001" :
				break;
			case "D00002" :
				$sql = $sql."and a.rtdept1Code in ('D10001','D10002','D10003') ";
				break;
			case "D00003" :
				$sql = $sql."and a.rtdept1Code in ('D10004','D10005','D10006') ";
				break;
			case "D00004" :
				$sql = $sql."and a.rtdept1Code in ('D10007','D10008') ";
				break;
			default:
				$sql = $sql."and a.rtdept1Code='".$rtdept1Code."' ";
		}		
	}
	if ($rtdept2Code <> ""){
		$sql = $sql."and a.rtdept2Code='".$rtdept2Code."' ";
	}
	if ($attendCheckValue <> ""){
		$sql = $sql."and a.memberID in (select a.memberID from attendworshipcheck a, member b where a.memberID  = b.memberID  and b.rtdept1Code = '".$attendCheckDeptCode."' and a.week".$weekNum." ='".$attendCheckValue."' and baseYear = '".substr($worshipDate,0,4)."') ";
	}
	if ($mode == "Find"){
		if ($Search =="parentsName"){
			$sql = $sql."and CONCAT(family1_korname, family2_korname,family3_korname, family4_korname,family5_korname, family6_korname,family7_korname, family8_korname,family9_korname, family10_korname) like '%".$SearchString."%'";
		}else{
			$sql = $sql."and ".$Search." like '%".$SearchString."%'";
		}
	}
	# echo $sql;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$total_count = $row['cnt'];

	$page_rows = 20; // 페이지당 목록 수
	$page = $_GET['page'];

	$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; }					// 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $page_rows;		// 시작 열을 구함

	$list = array(); // 회원 정보를 담을 배열 선언

	$sql = "select a.memberID, a.photofilename, d.korParishName, b.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code), '') as rtdept2Name, a.korname, a.engname, c.korChurchPosition, a.mobile,(case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID from member a, rtdept1 b, churchPosition c, churcharea d where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode "; // 회원 정보를 조회
	if ($churchareaCode <> ""){
		$sql = $sql."and a.churchareaCode = '".$churchareaCode."' "; 
	}
	if ($rtdept1Code <> ""){
		switch ($rtdept1Code) {
			case "D00001" :
				break;
			case "D00002" :
				$sql = $sql."and a.rtdept1Code in ('D10001','D10002','D10003') ";
				break;
			case "D00003" :
				$sql = $sql."and a.rtdept1Code in ('D10004','D10005','D10006') ";
				break;
			case "D00004" :
				$sql = $sql."and a.rtdept1Code in ('D10007','D10008') ";
				break;
			default:
				$sql = $sql."and a.rtdept1Code='".$rtdept1Code."' ";
		}			
	}
	if ($rtdept2Code <> ""){
		$sql = $sql."and a.rtdept2Code='".$rtdept2Code."' ";
	}
	if ($attendCheckValue <> ""){
		$sql = $sql."and a.memberID in (select a.memberID from attendworshipcheck a, member b where a.memberID  = b.memberID  and b.rtdept1Code = '".$attendCheckDeptCode."' and a.week".$weekNum." ='".$attendCheckValue."' and baseYear = '".substr($worshipDate,0,4)."') ";
	}
	if ($mode == "Find"){
		if ($Search =="parentsName"){
			$sql = $sql."and CONCAT(family1_korname, family2_korname,family3_korname, family4_korname,family5_korname, family6_korname,family7_korname, family8_korname,family9_korname, family10_korname) like '%".$SearchString."%'";
		}else{
			$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
		}
	}
//	$sql = $sql."ORDER BY a.rtdept2Code, c.korChurchPosition desc LIMIT {$from_record}, {$page_rows}";
	$sql = $sql."ORDER BY newMemberID asc, a.churchPositionCode asc LIMIT {$from_record}, {$page_rows}";
//	echo $sql;
	$result = mysqli_query($conn, $sql);
	for ($i=0; $row=mysqli_fetch_assoc($result); $i++) {
		$list[$i] = $row;
		$list_num = $total_count - ($page - 1) * $page_rows; // 회원 순번
		$list[$i]['num'] = $list_num - $i;
	}

	// 페이징 시작
	$str = ''; 
	if ($page > 1) {
		$str .= '<li class="page-item"><a class="page-link"  href="list.php?page=1&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&attendCheckDeptCode='.$attendCheckDeptCode.'&worshipDate='.$worshipDate.'&attendCheckValue='.$attendCheckValue.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($start_page-1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&attendCheckDeptCode='.$attendCheckDeptCode.'&worshipDate='.$worshipDate.'&attendCheckValue='.$attendCheckValue.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&attendCheckDeptCode='.$attendCheckDeptCode.'&worshipDate='.$worshipDate.'&attendCheckValue='.$attendCheckValue.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&attendCheckDeptCode='.$attendCheckDeptCode.'&worshipDate='.$worshipDate.'&attendCheckValue='.$attendCheckValue.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($end_page+1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&attendCheckDeptCode='.$attendCheckDeptCode.'&worshipDate='.$worshipDate.'&attendCheckValue='.$attendCheckValue.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$total_page.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&attendCheckDeptCode='.$attendCheckDeptCode.'&worshipDate='.$worshipDate.'&attendCheckValue='.$attendCheckValue.'">맨끝</a></li>';
	}

	if ($str) // 페이지가 있다면 생성
		$write_page = $str;
	else
		$write_page = "";
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

function search(){
	if (document.list.SearchString.value == ""){
		alert("검색어를 입력하여 주십시요.");
		document.list.SearchString.focus();
	 }
	 else{
		document.list.submit()
	}
}
function allcheck(){
	for( var i=0; i < document.datalist.elements.length; i++){
		var check = document.datalist.elements[i];
		check.checked = true;
	}
	return;
}
function alldischeck(){
	for( var i=0; i < document.datalist.elements.length; i++){
		var check = document.datalist.elements[i];
		check.checked = false;
	}
	return;
}
function attendCheckToServer(attendType, worshipDate, weekNum) {
	var checkdatalist="";
	for(i=0; i < document.datalist.elements.length; ++i){
		if(document.datalist.elements[i].checked == true){
			checkdatalist=checkdatalist+document.datalist.elements[i].value+",";
		}
	}
	if (checkdatalist == "" ){
		alert("출결체크할 데이터를 선택하여 주십시요.");
		return;
	}else{
		var params = "attendType="+attendType+"&worshipDate="+worshipDate+"&weekNum="+weekNum+"&checkdatalist="+checkdatalist;
		//alert(params);
		sendRequest("attendCheck.php", params, attendCheckFromServer, "POST");
	}
}
function attendCheckFromServer() {
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			//window.location.reload();
			location.href="list.php?attendCheckDeptCode=<?php echo $attendCheckDeptCode;?>&worshipDate="+document.rtsc.worshipDate.value+"&rtdept2Code="+document.rtsc.rtdept2Code.value+"&attendCheckValue="+document.rtsc.attendCheckValue.value;
		}
	}
}
function attendCheckPageAToServer(worshipDate, weekNum) {
	var checkdatalistTrue="";
	var checkdatalistFalse="";
	for(i=0; i < document.datalist.elements.length; ++i){
		if(document.datalist.elements[i].checked == true){
			checkdatalistTrue=checkdatalistTrue+document.datalist.elements[i].value+",";
		}else{
			checkdatalistFalse=checkdatalistFalse+document.datalist.elements[i].value+",";
		}
	}
	var params = "worshipDate="+worshipDate+"&weekNum="+weekNum+"&checkdatalistTrue="+checkdatalistTrue+"&checkdatalistFalse="+checkdatalistFalse;
	//alert(params);
	sendRequest("attendCheckPageA.php", params, attendCheckFromServer, "POST");
}
function attendCheckPageBToServer(worshipDate, weekNum) {
	var checkdatalistTrue="";
	var checkdatalistFalse="";
	for(i=0; i < document.datalist.elements.length; ++i){
		if(document.datalist.elements[i].checked == true){
			checkdatalistTrue=checkdatalistTrue+document.datalist.elements[i].value+",";
		}else{
			checkdatalistFalse=checkdatalistFalse+document.datalist.elements[i].value+",";
		}
	}
	var params = "worshipDate="+worshipDate+"&weekNum="+weekNum+"&checkdatalistTrue="+checkdatalistTrue+"&checkdatalistFalse="+checkdatalistFalse;
	//alert(params);
	sendRequest("attendCheckPageB.php", params, attendCheckFromServer, "POST");
}
function addReason(memberID, worshipDate){
	window.open("addReason.php?memberID="+memberID+"&worshipDate="+worshipDate, "addReason", "status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=400");
}
function editReason(idx){
	window.open("editReason.php?idx="+idx, "editReason", "status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=400");
}
function delReason(idx){
	window.open("delReason.php?idx="+idx, "delReason", "status=no, menubar=no, scrollbars=no, resizable=no, width=400, height=300");
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
					<h3 class="card-title">
						<i class="fas fa-map-marker-alt"></i>
						<b>
						<?php echo $rtdept1Name ?>
						<?php
							if ($rtdept2Name <> ""){
								echo " > ".$rtdept2Name;
							}
						?> 출석체크</b>
					</h3>
				  </div>
				  <script language = "javascript">
				  <!--
					function sendit(){
						if (document.rtsc.worshipDate.value == ""){
							alert("예배 날짜를 선택하여 주십시요.");
							document.rtsc.worshipDate.focus();
							return false;
						}
						document.rtsc.submit();
					}
				  //-->
				  </script>
				  <form class="form-horizontal" method ="POST" name="rtsc" action="list.php">
				  
				  <input type="hidden" name="attendCheckDeptCode" value="<?php echo $attendCheckDeptCode;?>">

				  <div class="card-body">
						<div class="form-group row">
							<label class="col-sm-1 col-form-label">예배날짜</label>
								<div class="col-sm-2">
								<?php
									# 현재 년도와 날짜를 구한다.
									$today = date("Y-m-d");
									$sql_worshipDate2 = "select worshipDate from attendbasedate where baseYear = '".substr($today,0,4)."' and worshipDate <= '".$today."' order by worshipDate";
									# echo $sql_worshipDate2;
									$result_worshipDate2 = mysqli_query($conn, $sql_worshipDate2);
								?>
								<select id="worshipDate" name="worshipDate" class="form-control">
									<option value="">날짜 선택</option>
									<?php
										while ($row_worshipDate2 = mysqli_fetch_assoc($result_worshipDate2)) {
									?>
										<option value="<?php echo $row_worshipDate2['worshipDate'] ?>"
										<?php
											if ($row_worshipDate2['worshipDate'] == $worshipDate){
												echo " selected";
											}
										?>
										><?php echo $row_worshipDate2['worshipDate'] ?></option>
									<?php
										}
									?>
								  </select>
							</div>
			<?php
				//교사가 아니라면 부서, 분반별로 볼 수 있도록 한다.
				if ($_SESSION['ss_rtdept2code'] == ""){
					// 대학부, 사랑부, 농인부, TCK부는 분반이 없다.
					if ((($rtdept1Code == "D10009") || ($rtdept1Code == "D10012") || ($rtdept1Code == "D10014") || ($rtdept1Code == "D10015")) == false){
			?>
							<label class="col-sm-1 col-form-label">분반</label>
							<div class="col-sm-2">
								<select class="custom-select rounded-0" Id="rtdept2Code" name="rtdept2Code">
									<option value="">전체</option>
								<?php
									$sql_rtdept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode = '".$rtdept1Code."' order by rtdept2Code";
									$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
									while ($row_rtdept2 = mysqli_fetch_assoc($result_rtdept2)) {
								?>
										<option value="<?php echo $row_rtdept2['rtdept2Code'] ?>"
										<?php
											if ($rtdept2Code == $row_rtdept2['rtdept2Code']){
												echo "selected";
											}
										?>><?php echo $row_rtdept2['rtdept2Name'] ?></option>
								<?php
									}
								?>
								</select>
							</div>

			<?php
					}
				}
			?>
							<label class="col-sm-1 col-form-label">출결</label>
							<div class="col-sm-2">
								<select id="attendCheckValue" name="attendCheckValue" class="form-control">
									<option value="">전체</option>
									<option value="A"
									<?php
										if ($attendCheckValue == "A"){
											echo " selected";
										}
									?>
									>대면출석</option>
									<option value="B"
									<?php
										if ($attendCheckValue == "B"){
											echo " selected";
										}
									?>
									>비대면출석</option>
									<option value="C"
									<?php
										if ($attendCheckValue == "C"){
											echo " selected";
										}
									?>
									>결석</option>
									<option value="D"
									<?php
										if ($attendCheckValue == "D"){
											echo " selected";
										}
									?>
									>조퇴</option>
								</select>
							</div>
							<div class="col-sm-2">
								<a href="javascript:sendit();"><button type="button" class="btn btn-primary">선택한 날짜보기</button></a>
							</div>
						</div>
					</div>
				  </form>

				  <div class="card-body">
					<div class="col-12">
						<p>
						<a href="javascript:allcheck()" class="btn btn-default" style='margin:2px;'>전체선택</a>
						<a href="javascript:alldischeck()" class="btn btn-default" style='margin:2px;'>선택해제</a>
						<a href="javascript:attendCheckToServer('', '<?php echo $worshipDate;?>', '<?php echo $weekNum;?>');" class="btn btn-secondary" style='margin:2px;'>출결기록삭제</a>
						<a href="javascript:attendCheckToServer('A', '<?php echo $worshipDate;?>', '<?php echo $weekNum;?>');" class="btn btn-success" style='margin:2px;'>대면출석</a>
						<a href="javascript:attendCheckToServer('B', '<?php echo $worshipDate;?>', '<?php echo $weekNum;?>');" class="btn btn-info" style='margin:2px;'>비대면출석</a>
						<a href="javascript:attendCheckToServer('C', '<?php echo $worshipDate;?>', '<?php echo $weekNum;?>');" class="btn btn-danger" style='margin:2px;'>결석</a>
						<a href="javascript:attendCheckToServer('D', '<?php echo $worshipDate;?>', '<?php echo $weekNum;?>');" class="btn btn-warning" style='margin:2px;'>조퇴</a>
						<a href="javascript:attendCheckPageAToServer('<?php echo $worshipDate;?>', '<?php echo $weekNum;?>');" class="btn btn-primary" style='margin:2px;'>(체크) 대면출석, (그 외) 결석</a>
						<a href="javascript:attendCheckPageBToServer('<?php echo $worshipDate;?>', '<?php echo $weekNum;?>');" class="btn btn-primary" style='margin:2px;'>(체크) 비대면출석, (그 외) 결석</a>
						</p>
						<!--p><font color="red">● <a class="btn btn-primary btn-sm">(체크) 대면출석, (그 외) 결석</a> : <u><b>해당 페이지에서만</b></u> 동작하며 <u><b>체크</b>한 데이터는 <b>대면출석</b>으로, <b>미체크</b>한 데이터는 <b>결석</b>으로 처리하는 기능</u>입니다.</font></p>
						<p><font color="red">● <a class="btn btn-primary btn-sm">(체크) 비대면출석, (그 외) 결석</a> : <u><b>해당 페이지에서만</b></u> 동작하며 <u><b>체크</b>한 데이터는 <b>비대면출석</b>으로, <b>미체크</b>한 데이터는 <b>결석</b>으로 처리하는 기능</u>입니다.</font></p-->
					</div>
				  </div>
				  <div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					  <thead>
						<tr>
							<th>번호</th>
							<th>사진</th>	 
							<th>교구</th>
							<th>부서</th> 
							<th>분반</th>
							<th>성명</th>
							<th>직분</th>
							<th>핸드폰번호</th>
							<th>출결</th>
							<th>결석/조퇴사유</th>
						</tr>
					  </thead>
					  <tbody>
<form name="datalist">
<?php
	for ($i=0; $i<count($list); $i++) {
?>
						<tr>
							<td>
								<input type="checkbox" name="memberID" value="<?php echo $list[$i]['memberID'] ?>">
								<?php echo $list[$i]['num'] ?>
							</td>
							<td>
							  <?php
								If ($list[$i]['photofilename'] <> "") {
									//파일이 존재하는지 체크
									$filePathCheck = "../upload/".$list[$i]['photofilename'];
									//echo $filePathCheck;
									if (file_exists($filePathCheck)){
							  ?>
										<img src="../upload/<?php echo $list[$i]['photofilename']?>" class="img-circle elevation-2" alt="User Image" width="60">
								  <?php
									}else{
								  ?>
										<img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="60">
							  <?php
									}
								}else{
							  ?>
									<img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="60">
							  <?php
								}
							  ?>
							</td>
							<td><?php echo $list[$i]['korParishName'] ?></td>
							<td><?php echo $list[$i]['rtdept1Name'] ?></td>
							<td><?php echo $list[$i]['rtdept2Name'] ?></td>
							<td>
								<?php echo $list[$i]['korname'] ?>
								<?php
									if ($list[$i]['engname']<>""){
										echo "<br>".$list[$i]['engname'];
									}
								?>							
							</td>
							<td><?php echo $list[$i]['korChurchPosition'] ?></td>
							<td>
								<?php
									if ($list[$i]['mobile']<>""){
								?>
										<a href="tel:<?php echo $list[$i]['mobile']?>"><?php echo $list[$i]['mobile']?></a>
								<?php
									}
								?>
							</td>
							<td>
								<?php
									$sql_attend = "select week".$weekNum." from attendworshipcheck where memberID = '".$list[$i]['memberID']."' and baseYear = '".substr($worshipDate,0,4)."'";
									# echo $sql_attend;
									$result_attend = mysqli_query($conn, $sql_attend);
									$row_attend = mysqli_fetch_assoc($result_attend);
									# echo $row_attend['week'.$weekNum];
									if ($row_attend['week'.$weekNum] <> "") {
										$sql_typeName = "select typeName from attendType where typeCode = '".$row_attend['week'.$weekNum]."'";
										# echo $sql_typeName;
										$result_typeName = mysqli_query($conn, $sql_typeName);
										$row_typeName = mysqli_fetch_assoc($result_typeName);
										switch ($row_attend['week'.$weekNum]) {
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
							<td>
								<?php
									# echo $row_attend['week'.$weekNum];
									if (($row_attend['week'.$weekNum]=="C")||($row_attend['week'.$weekNum]=="D")){
										$sql_reason = "select count(idx) as cnt from absentreason where memberID = '".$list[$i]['memberID']."' and worshipDate = '".$worshipDate."'";
										# echo $sql_reason;
										$result_reason = mysqli_query($conn, $sql_reason);
										$row_reason = mysqli_fetch_assoc($result_reason);
										if ($row_reason['cnt'] == 0){
								?>
											<a href="javascript:addReason('<?php echo $list[$i]['memberID']?>', '<?php echo $worshipDate?>')" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> 사유기록하기</a>
								<?php
										}else{
											$sql_reasonContent = "select idx, absentreason from absentreason where memberID = '".$list[$i]['memberID']."' and worshipDate = '".$worshipDate."'";
											$result_reasonContent = mysqli_query($conn, $sql_reasonContent);
											$row_reasonContent = mysqli_fetch_assoc($result_reasonContent);
											echo $row_reasonContent['absentreason'];
								?>
											<a class="btn btn-info btn-sm" href="javascript:editReason('<?php echo $row_reasonContent['idx'] ?>');"><i class="fas fa-pencil-alt"></i>Edit</a>
											<a class="btn btn-danger btn-sm" href="javascript:delReason('<?php echo $row_reasonContent['idx'] ?>');">
											<i class="fas fa-trash"></i>Delete</a>
								<?php
										}
									}
								?>
							</td>
						</tr>
<?php
	} 
?>
</form>
<?php if (count($list) == 0) { echo '<tr class="text-center"><td colspan="10"><font color="blue">해당 데이터가 없습니다.</font></td></tr>'; } ?>
					  </tfoot>
					</table>
				  </div>
				  <!-- /.card-body -->
				  <!-- /.card-footer -->
				  <div class="card-footer clearfix">
					<ul class="pagination pagination-sm m-0 float-left">
						<?php echo $write_page; ?>
					</ul>
				  </div>
				  <div class="card-footer">
					<div class="col-12 text-center">
						<form method ="POST" name="list" action="list.php" onsubmit="return search()">
							<div class="form-group row text-center">
								<input type="hidden" name="mode" value="Find">
								<input type="hidden" name="churchareaCode" value="<?php echo $churchareaCode;?>">
								<input type="hidden" name="rtdept1Code" value="<?php echo $rtdept1Code;?>">
								<input type="hidden" name="rtdept2Code" value="<?php echo $rtdept2Code;?>">
								<input type="hidden" name="attendCheckDeptCode" value="<?php echo $attendCheckDeptCode;?>">
								<input type="hidden" name="worshipDate" value="<?php echo $worshipDate;?>">
								<input type="hidden" name="attendCheckValue" value="<?php echo $attendCheckValue;?>">

								<select name="Search" class="form-control col-sm-2">
									<option value="korname">성명</option>
									<option value="c.rtdept1Name">부서</option>
									<option value="schoolinfo">학교</option>
									<option value="parentsName">부모성명</option>
								</select>
								<input type="text" class="form-control col-sm-2" name="SearchString">
								<button type="submit" class="btn btn-primary">Search</button>
							</div>
						</form>
					</div>
				  </div>
				  <!-- /.card-footer -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
  </div>
  <!-- /.content-wrapper -->
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>