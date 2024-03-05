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
            <h1 class="m-0">홈페이지 관리자</h1>
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

	$page					= trim($_REQUEST['page']);
	$homepage_admin_idx		= trim($_REQUEST['homepage_admin_idx']);
	$mode					= trim($_REQUEST['mode']);
	$Search					= trim($_REQUEST['Search']);
	$SearchString			= trim($_REQUEST['SearchString']);

	$sql = "SELECT * FROM homepage_admin where homepage_admin_idx = '".$homepage_admin_idx."' ";
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
	}
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
?>
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
			function sendit(){
				if (document.rtsc.rtdept1Code.value == ""){
						alert("부서를 선택하여 주십시요.");
						document.rtsc.rtdept1Code.focus();
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
				if (document.rtsc.mobile.value == ""){
						alert("핸드폰번호를 입력하여 주십시요.");
						document.rtsc.mobile.focus();
						return false;
				}
				var count_dataAccessType = 0;
				for(i=0; i<2; i++){
					if(document.rtsc.dataAccessType[i].checked == true){
						count_dataAccessType += 1;
					}
				}
				if (count_dataAccessType == 0 ){
					alert("데이터 접근권한을 선택하여 주십시요.");
					document.rtsc.dataAccessType[0].focus();
					return false;
				}
				var count_timelineAccessType = 0;
				for(i=0; i<3; i++){
					if(document.rtsc.timelineAccessType[i].checked == true){
						count_timelineAccessType += 1;
					}
				}
				if (count_timelineAccessType == 0 ){
					alert("언약의 여정 권한을 선택하여 주십시요.");
					document.rtsc.timelineAccessType[0].focus();
					return false;
				}
				document.rtsc.submit();
			}
			function onlyNum(obj) {
				var val = obj.value;
				var re = /[^0-9]/gi;
				obj.value = val.replace(re, '');
			}
			//-->
			</script>

			<form class="form-horizontal" method ="POST" name="rtsc" enctype="multipart/form-data" action="edit_ok.php" onsubmit="return sendit()">

				<input type="hidden" name="page" value="<?php echo $page ?>">
				<input type="hidden" name="homepage_admin_idx" value="<?php echo $row['homepage_admin_idx'] ?>">
				<input type="hidden" name="mode" value="<?php echo $mode ?>">
				<input type="hidden" name="Search" value="<?php echo $Search ?>">
				<input type="hidden" name="SearchString" value="<?php echo $SearchString ?>">

				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 부서</label>
						<div class="col-sm-10">
						<?php
							$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 order by rtdept1Code";
							$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
							//$row = mysqli_fetch_assoc($result);
							//$cnt = mysqli_num_rows($result);
						?>
							<select class="custom-select rounded-0" name="rtdept1Code" onchange='javascript:getCont("sel_2");'>
								<option value="">선택하세요</option>
						<?php
							while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
						?>
								<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"
								<?php 
									if ($row['rtdept1Code'] == $row_rtdept1['rtdept1Code']){
										echo "selected";
									}
								?>><?php echo $row_rtdept1['rtdept1Name']?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">분반</label>
						<div class="col-sm-10">
							<span id='sel_2'>
						<?php
							if ($row['rtdept2Code'] == "") {
						?>
								<select class="custom-select rounded-0" name="rtdept2Code">
									<option value="">선택하세요</option>
								</select>
						<?php
							}else{
								$sql_rtdept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode='".$row['rtdept1Code']."' order by rtdept2Name";
								$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
							//$row = mysqli_fetch_assoc($result);
							//$cnt = mysqli_num_rows($result);
						?>
								<select class="custom-select rounded-0" name="rtdept2Code">
									<option value="">선택하세요</option>
							<?php
								while ($row_rtdept2 = mysqli_fetch_assoc($result_rtdept2)) {
							?>
									<option value="<?php echo $row_rtdept2['rtdept2Code'] ?>"
									<?php
										if ($row['rtdept2Code'] == $row_rtdept2['rtdept2Code']){
											echo "selected";
										}
									?>><?php echo $row_rtdept2['rtdept2Name']?></option>
							<?php
								}
							?>
								</select>
						<?php
							}
						?>						
							</span>		
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							※ 렘넌트서밋위원회, 미취학렘넌트국, 초등렘넌트국, 청소년렘넌트국, 대학국, 사랑부, 대학1부, 대학2부, 대학3부, 사랑부, 상임위원회, 인턴십국, 서밋기획국, 장학국은 분반이 없습니다.
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성명</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korname" maxlength="50" value="<?php echo $row['korname'] ?>">
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
								<option value="<?php echo $row_korChurchPosition['churchPositionCode'] ?>"<?php if ($row['churchPositionCode'] == $row_korChurchPosition['churchPositionCode']){echo " selected";}?>><?php echo $row_korChurchPosition['korChurchPosition']?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 핸드폰번호</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" maxlength="30" value="<?php echo $row['mobile'] ?>" onkeyup="onlyNum(this);">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"> 비밀번호</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="admin_pass" maxlength="50" value="<?php echo $row['admin_pass'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 사용여부</label>
						<div class="col-sm-10 form-check">
							<input type="radio" name="useYN" <?php if ($row['useYN'] == "Y"){echo " checked";}?> value="Y">
							<label class="form-check-label">사용</label>
							<input type="radio" name="useYN" <?php if ($row['useYN'] == "N"){echo " checked";}?> value="N">
							<label class="form-check-label">미사용</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 데이터접근 권한</label>
						<div class="col-sm-10 form-check">
							<input type="radio" name="dataAccessType" <?php if ($row['dataAccessType'] == "R"){echo " checked";}?> value="R">
							<label class="form-check-label">읽기</label>
							<input type="radio" name="dataAccessType" <?php if ($row['dataAccessType'] == "W"){echo " checked";}?> value="W">
							<label class="form-check-label">읽기/쓰기/수정/삭제</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 언약의여정 권한</label>
						<div class="col-sm-10 form-check">
							<input type="radio" name="timelineAccessType" <?php if ($row['timelineAccessType'] == "X"){echo " checked";}?> value="X">
							<label class="form-check-label">접근불가</label>
							<input type="radio" name="timelineAccessType" <?php if ($row['timelineAccessType'] == "R"){echo " checked";}?> value="R">
							<label class="form-check-label">읽기</label>
							<input type="radio" name="timelineAccessType" <?php if ($row['timelineAccessType'] == "W"){echo " checked";}?> value="W">
							<label class="form-check-label">읽기/쓰기/수정/삭제</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">등반 권한</label>
						<div class="col-sm-10 form-check">
							<input type="radio" name="deptMoveYN" value="Y" <?php if ($row['deptMoveYN'] == "Y"){echo " checked";}?> >
							<label class="form-check-label">Yes</label>
							<input type="radio" name="deptMoveYN" value="N" <?php if ($row['deptMoveYN'] == "N"){echo " checked";}?> >
							<label class="form-check-label">No</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">등반담당부서</label>
						<div class="col-sm-10">
						<?php
							$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code between 'D10001' and 'D10009' order by rtdept1Code";
							$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
							//$row = mysqli_fetch_assoc($result);
							//$cnt = mysqli_num_rows($result);
						?>
							<select class="custom-select rounded-0" id="from_rtdept1Code" name="from_rtdept1Code">
								<option value="">선택하세요</option>
						<?php
							while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
						?>
								<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"
								<?php 
									if ($row['from_rtdept1Code'] == $row_rtdept1['rtdept1Code']){
										echo "selected";
									}
								?>><?php echo $row_rtdept1['rtdept1Name']?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">사진</label>
						<div class="col-sm-10">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="photofilename" name="photofilename">
								<label class="custom-file-label" for="photofilename"></label>
							</div>
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
