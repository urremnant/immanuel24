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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->

<?php
	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$memberID		= trim($_REQUEST['memberID']);
	$churchareaCode = trim($_REQUEST['churchareaCode']);
	$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
	$deptMoveCode	= trim($_REQUEST['deptMoveCode']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$sql = "SELECT * FROM member where memberID = '".$memberID."' ";
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
	}
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	//echo $sql;
?>
			<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
			<script>
				function zipcode_daum() {
					new daum.Postcode({
						oncomplete: function(data) {
							// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

							// 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
							// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
							var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
							var extraRoadAddr = ''; // 도로명 조합형 주소 변수

							// 법정동명이 있을 경우 추가한다. (법정리는 제외)
							// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
							if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
								extraRoadAddr += data.bname;
							}
							// 건물명이 있고, 공동주택일 경우 추가한다.
							if(data.buildingName !== '' && data.apartment === 'Y'){
							   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
							}
							// 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
							if(extraRoadAddr !== ''){
								extraRoadAddr = ' (' + extraRoadAddr + ')';
							}
							// 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
							if(fullRoadAddr !== ''){
								fullRoadAddr += extraRoadAddr;
							}

							// 우편번호와 주소 정보를 해당 필드에 넣는다.
							document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
							document.getElementById('address').value = fullRoadAddr;
						}
					}).open();
				}
			</script>
			<script language = "javascript">
			<!--
			// 분반코드 AJAX
			function getCont(t)
			{
				var obj = window.event.srcElement;
				var tgt = document.getElementById(t);
				var xmlhttp     = fncGetHttpRequest();

				// 두번째 파라미터 데이터를 가져올 페이지 URL 파라미터로 지금 선택된 select 의 값을 넘겨줍니다.
				xmlhttp.open('GET', '../include/getRtdept2_editmember.php?rtdept1Code='+obj.value, false);
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
			function sendit(){
				var count_memberGubun = 0;
				for(i=0; i<3; i++){
					if(document.rtsc.memberGubun[i].checked == true){
						count_memberGubun += 1;
					}
				}
				if (count_memberGubun == 0 ){
					alert("구분을 선택하여 주십시요.");
					document.rtsc.memberGubun[0].focus();
					return false;
				}
				if (document.rtsc.change_rtdept1Code.value == ""){
						alert("부서를 선택하여 주십시요.");
						document.rtsc.change_rtdept1Code.focus();
						return false;
				}
				if (document.rtsc.korname.value == ""){
						alert("성명을 입력하여 주십시요.");
						document.rtsc.korname.focus();
						return false;
				}
				if (document.rtsc.churchPositionCode.value == ""){
						alert("직분을 선택하여 주십시요.");
						document.rtsc.churchPositionCode.focus();
						return false;
				}
				var count_gender = 0;
				for(i=0; i<2; i++){
					if(document.rtsc.gender[i].checked == true){
						count_gender += 1;
					}
				}
				if (count_gender == 0 ){
					alert("성별을 선택하여 주십시요.");
					document.rtsc.gender[0].focus();
					return false;
				}
//				if (document.rtsc.birthyear.value==""){
//					alert("출생년도를 선택하여 주십시요.");
//					document.rtsc.birthyear.focus();
//					return false;
//				}
//				if (document.rtsc.birthmonth.value==""){
//					alert("출생월을 선택하여 주십시요.");
//					document.rtsc.birthmonth.focus();
//					return false;
//				}
//				if (document.rtsc.birthday.value==""){
//					alert("출생일을 선택하여 주십시요.");
//					document.rtsc.birthday.focus();
//					return false;
//				}
//				if (document.rtsc.email.value == ""){
//					alert("E-mail 주소를 입력하여 주십시요.");
//					document.rtsc.email.focus();
//					return false;
//				}
				document.rtsc.submit();
			}
			function onlyNum(obj) {
				var val = obj.value;
				var re = /[^0-9]/gi;
				obj.value = val.replace(re, '');
			}
			function searchMember(gubun){
				window.open("searchMember.php?gubun="+gubun, "searchMember", "status=no, menubar=no, scrollbars=no, resizable=no, width=500, height=300");
			}
			function searchFamily(gubun){
				window.open("searchFamily.php?gubun="+gubun, "searchFamily", "status=no, menubar=no, scrollbars=no, resizable=no, width=500, height=300");
			}
			//-->
			</script>

			<form class="form-horizontal" method ="POST" name="rtsc" enctype="multipart/form-data" action="edit_ok.php" onsubmit="return sendit()">

				<input type="hidden" name="page" value="<?php echo $page ?>">
				<input type="hidden" name="memberID" value="<?php echo $memberID ?>">
				<input type="hidden" name="churchareaCode" value="<?php echo $churchareaCode ?>">
				<input type="hidden" name="rtdept1Code" value="<?php echo $rtdept1Code ?>">
				<input type="hidden" name="rtdept2Code" value="<?php echo $rtdept2Code ?>">
				<input type="hidden" name="deptMoveCode" value="<?php echo $deptMoveCode ?>">				
				<input type="hidden" name="mode" value="<?php echo $mode ?>">
				<input type="hidden" name="Search" value="<?php echo $Search ?>">
				<input type="hidden" name="SearchString" value="<?php echo $SearchString ?>">

				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 구분</label>
						<div class="col-sm-2">
							<input type="radio" name="memberGubun" value="R" <?php if (substr($memberID, 0, 1) == "R"){echo " checked";}?>>
							<label class="form-check-label">렘넌트</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="memberGubun" value="T" <?php if (substr($memberID, 0, 1) == "T"){echo " checked";}?>>
							<label class="form-check-label">임원/교사</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="memberGubun" value="P" <?php if (substr($memberID, 0, 1) == "P"){echo " checked";}?>>
							<label class="form-check-label">교역자</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 교사구분</label>
						<div class="col-sm-2">
							<input type="radio" name="teacherGubun" value="정교사"
							<?php
								if ($row['teacherGubun'] == "정교사"){
									echo "checked";
								}
							?>>
							<label class="form-check-label">정교사</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="teacherGubun" value="부교사"
							<?php
								if ($row['teacherGubun'] == "부교사"){
									echo "checked";
								}
							?>>
							<label class="form-check-label">부교사</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="teacherGubun" value="인턴십교사"
							<?php
								if ($row['teacherGubun'] == "인턴십교사"){
									echo "checked";
								}
							?>>
							<label class="form-check-label">인턴십교사</label>
						</div>
					<?php
						if ($row['teacherGubun'] <> ""){
					?>
						<div class="col-sm-2">
							<input type="radio" name="teacherGubun" value=""
							<?php
								if ($row['teacherGubun'] == ""){
									echo "checked";
								}
							?>>
							<label class="form-check-label">초기화</label>
						</div>
					<?php
						}
					?>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							※ 초기화를 선택하면 교사 구분값을 없앨 수 있습니다.
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"> TCK/PK/MK</label>
						<div class="col-sm-2">
							<input type="checkbox" name="tckYN" value="Y"
							<?php
								if ($row['tckYN'] == "Y"){
									echo "checked";
								}
							?>>
							<label class="form-check-label">TCK</label>
						</div>
						<div class="col-sm-2">
							<input type="checkbox" name="pkYN" value="Y"
							<?php
								if ($row['pkYN'] == "Y"){
									echo "checked";
								}
							?>>
							<label class="form-check-label">PK(목회자 자녀)</label>
						</div>
						<div class="col-sm-2">
							<input type="checkbox" name="mkYN" value="Y"
							<?php
								if ($row['mkYN'] == "Y"){
									echo "checked";
								}
							?>>
							<label class="form-check-label">MK(선교사 자녀)</label>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label"> 교구</label>
						<div class="col-sm-10">
						<?php
							$sql_churcharea = "select churchareaCode, korChurchAreaName, korParishName from churcharea where churchareaCode <> 'A99999' order by korChurchAreaName, korParishName";
							$result_churcharea = mysqli_query($conn, $sql_churcharea);
						?>
							<select class="custom-select rounded-0" name="change_churchareaCode">
								<option value="">선택하세요</option>
						<?php
							while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
						?>
								<option value="<?php echo $row_churcharea['churchareaCode'] ?>"
								<?php
									if ($row['churchareaCode'] == $row_churcharea['churchareaCode']){
										echo " selected";
									}
								?>><?php echo $row_churcharea['korChurchAreaName']." ".$row_churcharea['korParishName'] ?></option>
						<?php
							}
						?>
								<option value="A99999"<?php if ($row['churchareaCode']=="A99999"){echo " selected";}?>>미분류</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 부서</label>
						<div class="col-sm-10">
						<?php
							$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where parentsCode <> '' order by rtdept1Code";
							$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
							//$row = mysqli_fetch_assoc($result);
							//$cnt = mysqli_num_rows($result);
						?>
							<select class="custom-select rounded-0" id="change_rtdept1Code" name="change_rtdept1Code" onchange='javascript:getCont("sel_2");'>
								<option value="">선택하세요</option>
						<?php
							while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
						?>
								<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"
								<?php
									if ($row['rtdept1Code'] == $row_rtdept1['rtdept1Code']){
										echo "selected";
									}
								?>><?php echo $row_rtdept1['rtdept1Name'] ?></option>
						<?php
							}
						?>
								<option value="D99999">기타</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">분반</label>
						<div class="col-sm-10">
							<span id='sel_2'>
						<?php
								$sql_rtdept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode='".$row['rtdept1Code']."' order by rtdept2Name";
								$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
								//$row = mysqli_fetch_assoc($result);
								//$cnt = mysqli_num_rows($result);
						?>
								<select class="custom-select rounded-0" id="change_rtdept2Code" name="change_rtdept2Code">
									<option value="">선택하세요</option>
							<?php
								while ($row_rtdept2 = mysqli_fetch_assoc($result_rtdept2)) {
							?>
									<option value="<?php echo $row_rtdept2['rtdept2Code'] ?>"
									<?php
										if ($row['rtdept2Code'] == $row_rtdept2['rtdept2Code']){
											echo "selected";
										}
									?>><?php echo $row_rtdept2['rtdept2Name'] ?></option>
							<?php
								}
							?>
								</select>			
							</span>
						</div>
					</div>
	<?php
		if (($_SESSION['ss_korname']=="관리자")||($_SESSION['ss_korname']=="하영현")||($_SESSION['ss_korname']=="이혜림B")){
	?>	
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">교인번호</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="myNo" maxlength="20" value="<?php echo $row['myNo'] ?>">
						</div>
					</div>
	<?php
		}
	?>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성명</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korname" maxlength="50" value="<?php echo $row['korname'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">English Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="engname" maxlength="100" value="<?php echo $row['engname'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 직분</label>
						<div class="col-sm-10">
						<?php
							$sql_korChurchPosition = "select churchPositionCode, korChurchPosition from churchPosition where korChurchPosition not in ('강도사', '원로목사', '무임목사', '학생', '어린이', '조사', '기타') order by korChurchPosition";
							$result_korChurchPosition = mysqli_query($conn, $sql_korChurchPosition);
							//$row = mysqli_fetch_assoc($result);
							//$cnt = mysqli_num_rows($result);
						?>
							<select class="custom-select rounded-0" name="churchPositionCode">
								<option value="">선택하세요</option>
						<?php
							while ($row_korChurchPosition = mysqli_fetch_assoc($result_korChurchPosition)) {
						?>
								<option value="<?php echo $row_korChurchPosition['churchPositionCode'] ?>"
								<?php
									if ($row['churchPositionCode'] == $row_korChurchPosition['churchPositionCode']){
										echo "selected";
									}
								?>><?php echo $row_korChurchPosition['korChurchPosition'] ?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성별</label>
						<div class="col-sm-2">
							<input type="radio" name="gender" value="M" <?php if ($row['gender'] == "M"){echo " checked";}?>>
							<label class="form-check-label">남</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="gender" value="F" <?php if ($row['gender'] == "F"){echo " checked";}?>>
							<label class="form-check-label">여</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">사진</label>
						<div class="col-sm-10">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="photofilename" name="photofilename">
								<label class="custom-file-label" for="photofilename">Choose file</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">생년월일</label>
						<div class="col-sm-4">
							<select class="custom-select rounded-0" name="birthyear">
								<option value="">YYYY</option>
								<?php
									for($i=date("Y");$i>=1930;$i--){
								?>
									<option value="<?php echo $i;?>"
									<?php
										if (substr($row['birthday'], 0, 4) == $i){
											echo "selected";
										}
									?>><?php echo $i;?></option>
								<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="custom-select rounded-0" name="birthmonth">
								<option value="">MM</option>
								<?php
									for($i=1;$i<=9;$i++){
								?>
									<option value="<?php echo "0".$i;?>"
									<?php
										if (substr($row['birthday'], 4, 2) == "0".$i){
											echo "selected";
										}
									?>><?php echo $i;?></option>
								<?php
									}
								?>
								<?php
									for($i=10;$i<=12;$i++){
								?>
									<option value="<?php echo $i;?>"
									<?php
										if (substr($row['birthday'], 4, 2) == $i){
											echo "selected";
										}
									?>><?php echo $i;?></option>
								<?php
									}
								?>

							</select>
						</div>
						<div class="col-sm-3">
							<select class="custom-select rounded-0" name="birthday">
								<option value="">DD</option> 
								<?php
									for($i=1;$i<=9;$i++){
								?>
									<option value="<?php echo "0".$i;?>"
									<?php
										if (substr($row['birthday'],-2) == "0".$i){
											echo "selected";
										}
									?>><?php echo $i;?></option>
								<?php
									}
								?>
								<?php
									for($i=10;$i<=31;$i++){
								?>
									<option value="<?php echo $i;?>"
									<?php
										if (substr($row['birthday'],-2) == $i){
											echo "selected";
										}
									?>><?php echo $i;?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">핸드폰번호</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" maxlength="30" onkeyup="onlyNum(this);" value="<?php echo $row['mobile'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">이메일</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" maxlength="30" value="<?php echo $row['email'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">주소</label>
						<div class="col-sm-2">
							<div class="input-group">
							  <div class="custom-file">
								<input type="text" class="form-control" id="zipcode" name="zipcode" maxlength="10" value="<?php echo $row['zipcode'] ?>">
							  </div>
							  <div class="input-group-append">
								<span class="input-group-text" onclick="javascript:zipcode_daum();return false;">검색</span>
							  </div>
							</div>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">학교 유치원/전공</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="schoolinfo" maxlength="100" value="<?php echo $row['schoolinfo'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">학원 동아리 방과후교실</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="afterschool" maxlength="100" value="<?php echo $row['afterschool'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">직업</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="job" maxlength="50" value="<?php echo $row['job'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">직장</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="company" maxlength="50" value="<?php echo $row['company'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">나라</label>
						<div class="col-sm-10">
						<?php
							$sql_country = "select countryCode, korCountryName from country order by korCountryName";
							$result_country = mysqli_query($conn, $sql_country);
						?>
							<select class="custom-select rounded-0" name="countryCode">
								<option value="">선택하세요</option>
						<?php
							while ($row_country = mysqli_fetch_assoc($result_country)) {
						?>
								<option value="<?php echo $row_country['countryCode'] ?>"
								<?php
									if ($row['countryCode'] == $row_country['countryCode']){
										echo "selected";
									}
								?>><?php echo $row_country['korCountryName'] ?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">언어</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="language" value="<?php echo $row['language'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">비전</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="vision" value="<?php echo $row['vision'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">관심전문별</label>
						<div class="col-sm-10">
						<?php
							$sql_expertMeeting = "select expertMeetingCode, korProfessional from expertMeeting ORDER BY korProfessional;";
							$result_expertMeeting = mysqli_query($conn, $sql_expertMeeting);
						?>
							<select class="custom-select rounded-0" name="expertMeetingCode">
								<option value="">선택하세요</option>
						<?php
							while ($row_expertMeeting = mysqli_fetch_assoc($result_expertMeeting)) {
						?>
								<option value="<?php echo $row_expertMeeting['expertMeetingCode'] ?>"
								<?php
									if ($row['expertMeetingCode'] == $row_expertMeeting['expertMeetingCode']){
										echo "selected";
									}
								?>><?php echo $row_expertMeeting['korProfessional'] ?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">훈련</label>
						<div class="col-sm-10 form-group row">
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train1" value="Y" <?php if ($row['train1'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">초등합숙</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train2" value="Y" <?php if ($row['train2'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">중고합숙</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train3" value="Y" <?php if ($row['train3'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">일반합숙</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train4" value="Y" <?php if ($row['train4'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">순회팀합숙</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train5" value="Y" <?php if ($row['train5'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">70인1차</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train6" value="Y" <?php if ($row['train6'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">미션홈</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train7" value="Y" <?php if ($row['train7'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">전문별팀합숙</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train8" value="Y" <?php if ($row['train8'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">70인3차</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train9" value="Y" <?php if ($row['train9'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">전도합숙</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train10" value="Y" <?php if ($row['train10'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">초등신학원</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train11" value="Y" <?php if ($row['train11'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">청소년신학원</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train12" value="Y" <?php if ($row['train12'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">대학신학원</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train13" value="Y" <?php if ($row['train13'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">일반신학원</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train14" value="Y" <?php if ($row['train14'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">선교사훈련원</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train15" value="Y" <?php if ($row['train15'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">집중신학원</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train16" value="Y" <?php if ($row['train16'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">RTS</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train17" value="Y" <?php if ($row['train17'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">RU</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train18" value="Y" <?php if ($row['train18'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">전도전문훈련원</label>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="train19" value="Y" <?php if ($row['train19'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">중직자대학원</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">기도제목</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="3" name="prayertopic"><?php echo $row['prayertopic'] ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">담당교역자 아이디</label>
						<div class="col-sm-10">
							<div class="input-group">
							  <div class="custom-file">
								<input type="text" class="form-control" id="pastorID" name="pastorID" maxlength="6" value="<?php echo $row['pastorID'] ?>">
							  </div>
							  <div class="input-group-append">
								<span class="input-group-text" onclick="javascript:searchMember('pastorID');return false;">검색</span>
							  </div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">담당교사1 아이디</label>
						<div class="col-sm-10">
							<div class="input-group">
							  <div class="custom-file">
								<input type="text" class="form-control" id="teacher1ID" name="teacher1ID" maxlength="6" value="<?php echo $row['teacher1ID'] ?>">
							  </div>
							  <div class="input-group-append">
								<span class="input-group-text" onclick="javascript:searchMember('teacher1ID');return false;">검색</span>
							  </div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">담당교사2 아이디</label>
						<div class="col-sm-10">
							<div class="input-group">
							  <div class="custom-file">
								<input type="text" class="form-control" id="teacher2ID" name="teacher2ID" maxlength="6" value="<?php echo $row['teacher2ID'] ?>">
							  </div>
							  <div class="input-group-append">
								<span class="input-group-text" onclick="javascript:searchMember('teacher2ID');return false;">검색</span>
							  </div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">가족 아이디</label>
						<div class="col-sm-10">
							<div class="input-group">
							  <div class="custom-file">
								<input type="text" class="form-control" id="familyID" name="familyID" maxlength="6" value="<?php echo $row['familyID'] ?>">
							  </div>
							  <div class="input-group-append">
								<span class="input-group-text" onclick="javascript:searchFamily('familyID');return false;">검색</span>
							  </div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">가족관계</label>
						<div class="col-sm-10 form-group row">
							<table class="table table-hover text-nowrap">
							<thead>
								<tr class="text-center">
									<th>성명</th>
									<th>관계</th>
									<th>직분</th>
									<th>연락처</th>
									<th>교회</th>
									<th>직업/학교</th>
								</tr>
							</thead>
							<tbody>
							<tr>
								<td><input type="text" class="form-control" name="family1_korname" maxlength="50" value="<?php echo $row['family1_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family1_relation" maxlength="10" value="<?php echo $row['family1_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family1_korChurchPosition" maxlength="50" value="<?php echo $row['family1_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family1_mobile" maxlength="50" value="<?php echo $row['family1_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family1_churchname" maxlength="50" value="<?php echo $row['family1_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family1_job" maxlength="50" value="<?php echo $row['family1_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family2_korname" maxlength="50" value="<?php echo $row['family2_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family2_relation" maxlength="10" value="<?php echo $row['family2_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family2_korChurchPosition" maxlength="50" value="<?php echo $row['family2_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family2_mobile" maxlength="50" value="<?php echo $row['family2_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family2_churchname" maxlength="50" value="<?php echo $row['family2_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family2_job" maxlength="50" value="<?php echo $row['family2_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family3_korname" maxlength="50" value="<?php echo $row['family3_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family3_relation" maxlength="10" value="<?php echo $row['family3_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family3_korChurchPosition" maxlength="50" value="<?php echo $row['family3_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family3_mobile" maxlength="50" value="<?php echo $row['family3_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family3_churchname" maxlength="50" value="<?php echo $row['family3_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family3_job" maxlength="50" value="<?php echo $row['family3_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family4_korname" maxlength="50" value="<?php echo $row['family4_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family4_relation" maxlength="10" value="<?php echo $row['family4_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family4_korChurchPosition" maxlength="50" value="<?php echo $row['family4_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family4_mobile" maxlength="50" value="<?php echo $row['family4_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family4_churchname" maxlength="50" value="<?php echo $row['family4_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family4_job" maxlength="50" value="<?php echo $row['family4_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family5_korname" maxlength="50" value="<?php echo $row['family5_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family5_relation" maxlength="10" value="<?php echo $row['family5_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family5_korChurchPosition" maxlength="50" value="<?php echo $row['family5_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family5_mobile" maxlength="50" value="<?php echo $row['family5_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family5_churchname" maxlength="50" value="<?php echo $row['family5_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family5_job" maxlength="50" value="<?php echo $row['family5_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family6_korname" maxlength="50" value="<?php echo $row['family6_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family6_relation" maxlength="10" value="<?php echo $row['family6_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family6_korChurchPosition" maxlength="50" value="<?php echo $row['family6_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family6_mobile" maxlength="50" value="<?php echo $row['family6_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family6_churchname" maxlength="50" value="<?php echo $row['family6_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family6_job" maxlength="50" value="<?php echo $row['family6_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family7_korname" maxlength="50" value="<?php echo $row['family7_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family7_relation" maxlength="10" value="<?php echo $row['family7_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family7_korChurchPosition" maxlength="50" value="<?php echo $row['family7_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family7_mobile" maxlength="50" value="<?php echo $row['family7_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family7_churchname" maxlength="50" value="<?php echo $row['family7_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family7_job" maxlength="50" value="<?php echo $row['family7_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family8_korname" maxlength="50" value="<?php echo $row['family8_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family8_relation" maxlength="10" value="<?php echo $row['family8_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family8_korChurchPosition" maxlength="50" value="<?php echo $row['family8_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family8_mobile" maxlength="50" value="<?php echo $row['family8_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family8_churchname" maxlength="50" value="<?php echo $row['family8_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family8_job" maxlength="50" value="<?php echo $row['family8_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family9_korname" maxlength="50" value="<?php echo $row['family9_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family9_relation" maxlength="10" value="<?php echo $row['family9_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family9_korChurchPosition" maxlength="50" value="<?php echo $row['family9_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family9_mobile" maxlength="50" value="<?php echo $row['family9_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family9_churchname" maxlength="50" value="<?php echo $row['family9_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family9_job" maxlength="50" value="<?php echo $row['family9_job'] ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="family10_korname" maxlength="50" value="<?php echo $row['family10_korname'] ?>"></td>
								<td><input type="text" class="form-control" name="family10_relation" maxlength="10" value="<?php echo $row['family10_relation'] ?>"></td>
								<td><input type="text" class="form-control" name="family10_korChurchPosition" maxlength="50" value="<?php echo $row['family10_korChurchPosition'] ?>"></td>
								<td><input type="text" class="form-control" name="family10_mobile" maxlength="50" value="<?php echo $row['family10_mobile'] ?>"></td>
								<td><input type="text" class="form-control" name="family10_churchname" maxlength="50" value="<?php echo $row['family10_churchname'] ?>"></td>
								<td><input type="text" class="form-control" name="family10_job" maxlength="50" value="<?php echo $row['family10_job'] ?>"></td>
							</tr>
							</tfoot>
							</table>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">취미 특기 놀이</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="hobby" maxlength="100" value="<?php echo $row['hobby'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">CVDIP</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="3" name="cvdip"><?php echo $row['cvdip'] ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">특이경력(질병,상벌)</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="career" maxlength="100" value="<?php echo $row['career'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">현장시스템</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="fieldsystem1" maxlength="100" value="<?php echo $row['fieldsystem1'] ?>">
						</div>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="fieldsystem2" maxlength="100" value="<?php echo $row['fieldsystem2'] ?>">
						</div>
					</div>
				</div>
				
				<!-- /.card-body -->

				<div class="card-footer">
					<button type="submit" class="btn btn-primary btn-block">Submit</button>
				</div>
				<!-- /.card-footer -->
			</form>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
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
	include "../include/footer.php";
?>
