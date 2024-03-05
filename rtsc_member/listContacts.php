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
	$deptMoveCode	= trim($_REQUEST['deptMoveCode']);
	if ($deptMoveCode == ""){
		//권한체크
		include "../include/powerCheck.php";
	}

	# 등반관리 권한을 체크한다.
	$sql_deptMove = "select deptMoveYN, from_rtdept1Code from homepage_admin where homepage_admin_idx = '".$_SESSION['ss_homepage_admin_idx']."'";
	$result_deptMove = mysqli_query($conn, $sql_deptMove);
	$row_deptMove = mysqli_fetch_assoc($result_deptMove);
	$deptMoveYN = $row_deptMove['deptMoveYN'];
	$from_rtdept1Code = $row_deptMove['from_rtdept1Code'];
  
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$churchareaCode = trim($_REQUEST['churchareaCode']);
	$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
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
				echo "<script>alert('교사는 자신이 담당하는 분반만 열람가능합니다.');history.back();</script>";
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
//	D00006	미션렌넌트국	
//  D00019  글로벌렘넌트국

//	D10001	태영아부	D00002	
//	D10002	유아부		D00002	
//	D10003	유치부		D00002	
//	D10004	초등12부	D00003	
//	D10005	초등34부	D00003	
//	D10006	초등56부	D00003	
//	D10007	중등부		D00004	
//	D10008	고등부		D00004	
//	D10009	대학부		D00005
//	D10012  사랑부		D00006
//	D10014  농인부		D00006
//	D10015  TCK부	D00019
			

	$sql = "SELECT COUNT(memberID) AS cnt FROM member a, rtdept1 b, churchPosition c, churcharea d where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode and a.rtdept1Code not in ('D99999', 'D99998') "; // member 테이블에 등록되어있는 회원의 수를 구함
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
			case "D00006" :
				$sql = $sql."and a.rtdept1Code in ('D10012','D10014') ";
				break;
			default:
				$sql = $sql."and a.rtdept1Code='".$rtdept1Code."' ";
		}		
	}
	if ($rtdept2Code <> ""){
		$sql = $sql."and a.rtdept2Code='".$rtdept2Code."' ";
	}
	if ($deptMoveCode <> ""){
		$sql = $sql."and a.deptMoveCode='".$deptMoveCode."' ";
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

	$page_rows = 9; // 페이지당 목록 수
	$page = $_GET['page'];

	$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; }					// 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $page_rows;		// 시작 열을 구함

	$list = array(); // 회원 정보를 담을 배열 선언

	$sql = "select a.memberID, a.teacherGubun, a.photofilename, d.korParishName, b.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code), '') as rtdept2Name, a.korname, a.engname, c.korChurchPosition, a.mobile,(case when left(a.memberID,1) = 'P' then CONCAT('A', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '정교사' then CONCAT('B', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '부교사' then CONCAT('C', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '인턴십교사' then CONCAT('D', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '' then CONCAT('E', a.memberID) when left(a.memberID,1) = 'R' then CONCAT('F', a.memberID) end) as newMemberID, a.deptMoveCode from member a, rtdept1 b, churchPosition c, churcharea d where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode and a.rtdept1Code not in ('D99999', 'D99998') "; // 회원 정보를 조회
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
			case "D00006" :
				$sql = $sql."and a.rtdept1Code in ('D10012','D10014') ";
				break;
			default:
				$sql = $sql."and a.rtdept1Code='".$rtdept1Code."' ";
		}			
	}
	if ($rtdept2Code <> ""){
		$sql = $sql."and a.rtdept2Code='".$rtdept2Code."' ";
	}
	if ($deptMoveCode <> ""){
		$sql = $sql."and a.deptMoveCode='".$deptMoveCode."' ";
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
		$str .= '<li class="page-item"><a class="page-link"  href="listContacts.php?page=1&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&deptMoveCode='.$deptMoveCode.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="listContacts.php?page='.($start_page-1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&deptMoveCode='.$deptMoveCode.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="listContacts.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&deptMoveCode='.$deptMoveCode.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="listContacts.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&deptMoveCode='.$deptMoveCode.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="listContacts.php?page='.($end_page+1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&deptMoveCode='.$deptMoveCode.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="listContacts.php?page='.$total_page.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&churchareaCode='.$churchareaCode.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'&deptMoveCode='.$deptMoveCode.'">맨끝</a></li>';
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
function deptMoveToServer(deptMoveCode) {
	var checkdatalist="";
	for(i=0; i < document.datalist.elements.length; ++i){
		if(document.datalist.elements[i].checked == true){
			checkdatalist=checkdatalist+document.datalist.elements[i].value+",";
		}
	}
	if (checkdatalist == "" ){
		alert("등반대상자로 설정할 데이터를 선택하여 주십시요.");
		return;
	}else{
		var params = "deptMoveCode="+deptMoveCode+"&checkdatalist="+checkdatalist;
		//alert(params);
		sendRequest("deptMove.php", params, deptMoveFromServer, "POST");
	}
}
function deptMoveFromServer() {
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			window.location.reload();
		}
	}
}
function deptMoveCancelToServer() {
	var checkdatalist="";
	for(i=0; i < document.datalist.elements.length; ++i){
		if(document.datalist.elements[i].checked == true){
			checkdatalist=checkdatalist+document.datalist.elements[i].value+",";
		}
	}
	if (checkdatalist == "" ){
		alert("등반대상자 취소할 데이터를 선택하여 주십시요.");
		return;
	}else{
		var params = "checkdatalist="+checkdatalist;
		//alert(params);
		sendRequest("deptMove_cancle.php", params, deptMoveCancelFromServer, "POST");
	}
}
function deptMoveCancelFromServer() {
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			window.location.reload();
		}
	}
}


-->
</script>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
<?php
	# 등반관리 메뉴일경우 타이틀
	if (($rtdept1Code == "") && ($deptMoveCode <> "")){
		$sql_deptMove_title ="select (select rtdept1Name from rtdept1 where rtdept1Code = from_rtdept1Code) as from_rtdept1Name, (select rtdept1Name from rtdept1 where rtdept1Code = to_rtdept1Code) as to_rtdept1Name from deptMove where deptMoveCode = '".$deptMoveCode."'";
		$result_deptMove_title = mysqli_query($conn, $sql_deptMove_title);
		$row_deptMove_title = mysqli_fetch_assoc($result_deptMove_title);		
?>
<script language="javascript">
<!--
function downloadExceldeptMove(deptMoveCode){
	location.href="download_excel_deptMove.php?deptMoveCode="+deptMoveCode;
}

//-->
</script>
              <div class="card-header">
                <h3 class="card-title">
					<i class="fas fa-map-marker-alt"></i>
					<b><?php echo $row_deptMove_title['from_rtdept1Name']." → ".$row_deptMove_title['to_rtdept1Name'] ?></b>
					<a href="javascript:downloadExceldeptMove('<?php echo $deptMoveCode; ?>');"><button type="button" class="btn btn-info">엑셀다운로드</button></a>
				</h3>
			  </div>
<?php
	}else{
?>
              <div class="card-header">
                <h3 class="card-title">
					<i class="fas fa-map-marker-alt"></i>
					<b>
					<?php echo $rtdept1Name ?>
					<?php
						if ($rtdept2Name <> ""){
							echo " > ".$rtdept2Name;
						}
					?>
					</b>&nbsp;&nbsp;&nbsp;<a href="write.php?rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>"><button type="submit" class="btn btn-primary">등록하기</button></a>&nbsp; 
					&nbsp;&nbsp;※ 교사는 자신의 분반만 볼 수 있으며 엑셀다운로드시 보안을 위해 언약의 여정 항목은 제외됩니다.
				</h3>
				<div class="card-tools">
					<a href="list.php?page=<?php echo $cpage ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search ?>&SearchString=<?php echo $SearchString ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&deptMoveCode=<?php echo $deptMoveCode ?>" class="btn btn-info"><i class="fa-solid fa-list"></i> List</a>
					<a href="listContacts.php?page=<?php echo $cpage ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search ?>&SearchString=<?php echo $SearchString ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&deptMoveCode=<?php echo $deptMoveCode ?>" class="btn btn-info"><i class="fa-solid fa-id-card"></i> Card</a>
				</div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
			<?php
				//교사가 아니라면 부서, 분반별로 볼 수 있도록 한다.
				if ($_SESSION['ss_rtdept2code'] == ""){
			?>
				  <div class="card-header">
						<div class="col-12">
						  <div class="form-group row">
							<script language = "javascript">
							<!--
							// 분반코드 AJAX
							function getCont(t)
							{
								var obj = window.event.srcElement;
								var tgt = document.getElementById(t);
								var xmlhttp     = fncGetHttpRequest();

								// 두번째 파라미터 데이터를 가져올 페이지 URL 파라미터로 지금 선택된 select 의 값을 넘겨줍니다.
								xmlhttp.open('GET', '../include/getRtdept2.php?rtdept1Code='+obj.value, false);
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
							function viewDept(){
								if (document.getElementById('rtdept1Code').value == ""){
									alert("부서를 선택하여 주세요.");
									return;
								}
								var churchareaCode = document.getElementById('churchareaCode').value;
								var rtdept1Code = document.getElementById('rtdept1Code').value;
								var rtdept2Code = document.getElementById('rtdept2Code').value;
//								alert(rtdept1Code);
//								alert(rtdept2Code);
								location.href="listContacts.php?churchareaCode="+churchareaCode+"&rtdept1Code="+rtdept1Code+"&rtdept2Code="+rtdept2Code;
							}
							function downloadExcel(){
								if (document.getElementById('rtdept1Code').value == ""){
									alert("부서를 선택하여 주세요.");
									return;
								}
								var churchareaCode = document.getElementById('churchareaCode').value;
								var rtdept1Code = document.getElementById('rtdept1Code').value;
								var rtdept2Code = document.getElementById('rtdept2Code').value;
//								alert(rtdept1Code);
//								alert(rtdept2Code);
								location.href="download_excel.php?churchareaCode="+churchareaCode+"&rtdept1Code="+rtdept1Code+"&rtdept2Code="+rtdept2Code;
							}

							//-->
							</script>
							<div class="col-sm-2">
							<?php
								$sql_churcharea = "select churchareaCode, korParishName from churcharea where churchareaCode <> 'A99999' order by korChurchAreaName, korParishName";
								$result_churcharea = mysqli_query($conn, $sql_churcharea);
							?>
								<select class="custom-select rounded-0" Id="churchareaCode" name="churchareaCode">
									<option value="">교구 선택</option>
							<?php
								while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
							?>
									<option value="<?php echo $row_churcharea['churchareaCode'] ?>"
									<?php
										if ($churchareaCode == $row_churcharea['churchareaCode']){
											echo "selected";
										}
									?>
									><?php echo $row_churcharea['korParishName'] ?></option>
							<?php
								}
							?>
									<option value="A99999" <?php if ($churchareaCode =="A99999"){echo "selected";}?>>미분류</option>
								</select>
							</div>

							<div class="col-sm-2">
								<?php
									//$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
									$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 order by rtdept1Code";
									$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
									//$row = mysqli_fetch_assoc($result);
									//$cnt = mysqli_num_rows($result);
								?>
									<select class="custom-select rounded-0" Id="rtdept1Code" name="rtdept1Code" onchange='javascript:getCont("sel_2");'>
										<option value="">부서 선택</option>
								<?php
									while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
								?>
										<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"
										<?php
											if ($rtdept1Code == $row_rtdept1['rtdept1Code']){
												echo "selected";
											}
										?>><?php echo $row_rtdept1['rtdept1Name'] ?></option>
								<?php
									}
								?>
									</select>
							</div>
							<div class="col-sm-2">
								<span id='sel_2'>
								<?php
									$sql_rtdept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode = '".$rtdept1Code."' order by rtdept2Code";
									$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
									//$row = mysqli_fetch_assoc($result);
									//$cnt = mysqli_num_rows($result);
								?>
									<select class="custom-select rounded-0" Id="rtdept2Code" name="rtdept2Code">
										<option value="">분반 선택</option>
								<?php
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
								</span>
							</div>
							<div class="col-sm-6">
								<a href="javascript:viewDept();"><button type="button" class="btn btn-primary">선택항목보기</button></a>
								<a href="javascript:downloadExcel();"><button type="button" class="btn btn-info">엑셀다운로드</button></a>
							</div>
						  </div>
						</div>
				  </div>
			<?php
				}
				
				# echo "deptMoveYN : ".$deptMoveYN."<br>";
				# echo "rtdept1Code : ".$rtdept1Code."<br>";
				# echo "from_rtdept1Code : ".$from_rtdept1Code;

				# 부서가 태영아, 유아부, 유치부, 초등12, 34, 56, 중등부, 고등부이며 등반관리자일때만 등반관련 메뉴 버튼을 보여준다.
				if (($rtdept1Code=="D10001") || ($rtdept1Code=="D10002") || ($rtdept1Code=="D10003") || ($rtdept1Code=="D10004") || ($rtdept1Code=="D10005") || ($rtdept1Code=="D10006") || ($rtdept1Code=="D10007") || ($rtdept1Code=="D10008")) {
					# 해당부서의 등반 관리 권한이 있다면...
					if (($deptMoveYN == "Y")&&($rtdept1Code == $from_rtdept1Code)){
			?>
				  <div class="card-header">
						<div class="col-12">
							<?php
								if ($rtdept1Code == "D10001"){
									$member_deptMoveCode = "M00001";
								}
								if ($rtdept1Code == "D10002"){
									$member_deptMoveCode = "M00002";
								}
								if ($rtdept1Code == "D10003"){
									$member_deptMoveCode = "M00003";
								}
								if ($rtdept1Code == "D10004"){
									$member_deptMoveCode = "M00004";
								}
								if ($rtdept1Code == "D10005"){
									$member_deptMoveCode = "M00005";
								}
								if ($rtdept1Code == "D10006"){
									$member_deptMoveCode = "M00006";
								}
								if ($rtdept1Code == "D10007"){
									$member_deptMoveCode = "M00007";
								}
								if ($rtdept1Code == "D10008"){
									$member_deptMoveCode = "M00008";
								}
							?>
							<a href="javascript:allcheck()" class="btn btn-info">전체선택</a>
							<a href="javascript:alldischeck()" class="btn btn-info">선택해제</a>
							<a href="javascript:deptMoveToServer('<?php echo $member_deptMoveCode;?>');" class="btn btn-primary">등반대상자로 설정하기</a>
							<a href="javascript:deptMoveCancelToServer();" class="btn btn-primary">등반대상자 취소하기</a>
						</div>
				  </div>
			<?php
					}
				}
			?>
<?php
	}
?>
				  <div class="card-body">

<form name="datalist">
<section class="content">
	<div class="card-body pb-0">
		<div class="row">
<?php
	for ($i=0; $i<count($list); $i++) {
?>

		<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
			<div class="card bg-light d-flex flex-fill">
				<div class="card-header text-muted border-bottom-0">
					<?php
						# 부서가 태영아, 유아부, 유치부, 초등12, 34, 56, 중등부, 고등부이며 등반관리자일때만 체크박스를 보여준다.
						if (($rtdept1Code=="D10001") || ($rtdept1Code=="D10002") || ($rtdept1Code=="D10003") || ($rtdept1Code=="D10004") || ($rtdept1Code=="D10005") || ($rtdept1Code=="D10006") || ($rtdept1Code=="D10007") || ($rtdept1Code=="D10008")) {
							# 해당부서의 등반 관리 권한이 있다면 체크박스를 보여준다.(렘넌트만, 교역자와 교사는 등반과 상관없음)
							if (($deptMoveYN == "Y")&&($rtdept1Code == $from_rtdept1Code)){
								if (substr($list[$i]['memberID'], 0, 1) =="R"){
					?>
								<input type="checkbox" name="memberID" value="<?php echo $list[$i]['memberID'] ?>">
					<?php
								}
							}
						}
					?>
					<?php echo $list[$i]['num'] ?>
				</div>
				<div class="card-body pt-0">
					<div class="row">
						<div class="col-7">
							<p>
								<?php 
									echo $list[$i]['korParishName'];
									if ($list[$i]['rtdept1Name'] != ""){
										echo " / ".$list[$i]['rtdept1Name'];
									} 
									if ($list[$i]['rtdept2Name'] != ""){
										echo " / ".$list[$i]['rtdept2Name'];
									}
								?>
							</p>
							<h2 class="lead"><b>
								<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&deptMoveCode=<?php echo $deptMoveCode ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>">
									<?php 
										echo $list[$i]['korname'];
									?>
									<?php
										if ($list[$i]['engname']<>""){
											echo " / ".$list[$i]['engname'];
										}
									?>
								</a></b>
								<?php 
									echo $list[$i]['korChurchPosition'];
								?>	
							</h2>
							<p>
								<i class="fas fa-mobile-alt"></i>
								<b>
								<?php
									if ($list[$i]['mobile']<>""){
								?>
										<a href="tel:<?php echo $list[$i]['mobile']?>"><?php echo $list[$i]['mobile']?></a>
								<?php
									}
								?>
								</b>
							</p>
							<p>
								<?php
									if ($list[$i]['teacherGubun']=="정교사"){
										echo " <span class='btn btn-success btn-sm'>".$list[$i]['teacherGubun']."</span>";
									}
									if ($list[$i]['teacherGubun']=="부교사"){
										echo " <span class='btn btn-warning btn-sm'>".$list[$i]['teacherGubun']."</span>";
									}
									if ($list[$i]['teacherGubun']=="인턴십교사"){
										echo " <span class='btn btn-info btn-sm'>".$list[$i]['teacherGubun']."</span>";
									}
								?>
							</p>
							<p>
								<?php
									# 부서가 태영아, 유아부, 유치부, 초등12, 34, 56, 중등부, 고등부이며 등반관리자일때만 체크박스를 보여준다.
									if (($rtdept1Code=="D10001") || ($rtdept1Code=="D10002") || ($rtdept1Code=="D10003") || ($rtdept1Code=="D10004") || ($rtdept1Code=="D10005") || ($rtdept1Code=="D10006") || ($rtdept1Code=="D10007") || ($rtdept1Code=="D10008")) {
										# 해당부서의 등반 관리 권한이 있다면...
										if (($deptMoveYN == "Y")&&($rtdept1Code == $from_rtdept1Code)){
											if ($list[$i]['deptMoveCode']<>""){
												echo "<span class='btn btn-warning btn-sm'>등반대상자입니다.</span>";
											}
										}
									}
								?>
							</p>
						</div>
						<div class="col-5 text-center">
							  <?php
								If ($list[$i]['photofilename'] <> "") {
									//파일이 존재하는지 체크
									$filePathCheck = "../upload/".$list[$i]['photofilename'];
									//echo $filePathCheck;
									if (file_exists($filePathCheck)){
							  ?>
										<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&deptMoveCode=<?php echo $deptMoveCode ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><img src="../upload/<?php echo $list[$i]['photofilename']?>" class="img-circle img-fluid" alt="User Image" width="128"></a>
								  <?php
									}else{
								  ?>
										<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&deptMoveCode=<?php echo $deptMoveCode ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><img src="/image/photox.jpg" class="img-circle img-fluid" alt="User Image" width="128"></a>
							  <?php
									}
								}else{
							  ?>
									<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&deptMoveCode=<?php echo $deptMoveCode ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><img src="/image/photox.jpg" class="img-circle img-fluid" alt="User Image" width="128"></a>

							  <?php
								}
							  ?>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="text-right">
						<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&deptMoveCode=<?php echo $deptMoveCode ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>" class="btn btn-sm btn-primary">
						<i class="fas fa-user"></i> View Profile
						</a>
					</div>
				</div>
			</div>
		</div>
<?php
	} 
?>
		</div>
	</div>
</section>				
</form>
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
						<form method ="POST" name="list" action="listContacts.php" onsubmit="return search()">
							<div class="form-group row text-center">
								<input type="hidden" name="mode" value="Find">
								<input type="hidden" name="churchareaCode" value="<?php echo $churchareaCode;?>">
								<input type="hidden" name="rtdept1Code" value="<?php echo $rtdept1Code;?>">
								<input type="hidden" name="rtdept2Code" value="<?php echo $rtdept2Code;?>">
								<input type="hidden" name="deptMoveCode" value="<?php echo $deptMoveCode;?>">

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