<?php
	include "header.php";
	include "Navbar.php";
	include "leftMenu.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">교구교역자 관리</h1>
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
	$idx					= trim($_REQUEST['idx']);
	$mode					= trim($_REQUEST['mode']);
	$Search					= trim($_REQUEST['Search']);
	$SearchString			= trim($_REQUEST['SearchString']);

	$sql = "SELECT * FROM homepage_admin_churcharea where idx = '".$idx."' ";
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
	}
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
			<script language = "javascript">
			<!--
			function sendit(){
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
				if (document.rtsc.admin_pass.value == ""){
						alert("비밀번호를 입력하여 주십시요.");
						document.rtsc.admin_pass.focus();
						return false;
				}
				if (document.rtsc.korChurchAreaName.value == ""){
						alert("권역을 입력하여 주십시요.");
						document.rtsc.korChurchAreaName.focus();
						return false;
				}
				if (document.rtsc.mobile.value == ""){
						alert("핸드폰번호를 입력하여 주십시요.");
						document.rtsc.mobile.focus();
						return false;
				}
				var count_useYN = 0;
				for(i=0; i<2; i++){
					if(document.rtsc.useYN[i].checked == true){
						count_useYN += 1;
					}
				}
				if (count_useYN == 0 ){
					alert("사용여부를 선택하여 주십시요.");
					document.rtsc.useYN[0].focus();
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

			<form class="form-horizontal" method ="POST" name="rtsc" enctype="multipart/form-data" action="homepage_admin_churcharea_edit_ok.php" onsubmit="return sendit()">

				<input type="hidden" name="page" value="<?php echo $page ?>">
				<input type="hidden" name="idx" value="<?php echo $row['idx'] ?>">
				<input type="hidden" name="mode" value="<?php echo $mode ?>">
				<input type="hidden" name="Search" value="<?php echo $Search ?>">
				<input type="hidden" name="SearchString" value="<?php echo $SearchString ?>">

				<div class="card-body">
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
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 비밀번호</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="admin_pass" maxlength="20" value="<?php echo $row['admin_pass'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 권역</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korChurchAreaName" maxlength="50" value="<?php echo $row['korChurchAreaName'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">교구</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korParishName" maxlength="50" value="<?php echo $row['korParishName'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 핸드폰번호</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" maxlength="30" value="<?php echo $row['mobile'] ?>" onkeyup="onlyNum(this);">
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
