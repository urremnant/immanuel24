<?php
	include "header.php";
	include "menu_worship.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">예배신청 관리자</h1>
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

	$sql = "SELECT * FROM apply_worship where idx = '".$idx."' ";
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
	}
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
			<script language = "javascript">
			<!--
			function sendit(){
				if (document.rtsc.worshipDate.value == ""){
						alert("예배 신청날짜를 선택하여 주십시요.");
						document.rtsc.worshipDate.focus();
						return false;
				}
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
				if (document.rtsc.birthyear.value==""){
					alert("출생년도를 선택하여 주십시요.");
					document.rtsc.birthyear.focus();
					return false;
				}
				if (document.rtsc.birthmonth.value==""){
					alert("출생월을 선택하여 주십시요.");
					document.rtsc.birthmonth.focus();
					return false;
				}
				if (document.rtsc.birthday.value==""){
					alert("출생일을 선택하여 주십시요.");
					document.rtsc.birthday.focus();
					return false;
				}
				var count_appYN = 0;
				for(i=0; i<3; i++){
					if(document.rtsc.appYN[i].checked == true){
						count_appYN += 1;
					}
				}
				if (count_appYN == 0 ){
					alert("교인앱 설치 및 교인증 확인 여부를 선택하여 주십시요.");
					document.rtsc.appYN[0].focus();
					return false;
				}
				var count_busUse = 0;
				for(i=0; i<5; i++){
					if(document.rtsc.busUse[i].checked == true){
						count_busUse += 1;
					}
				}
				if (count_busUse == 0 ){
					alert("셔틀버스/자차운전 여부를 선택하여 주십시요.");
					document.rtsc.busUse[0].focus();
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

			<form class="form-horizontal" method ="POST" name="rtsc" action="edit_ok.php" onsubmit="return sendit()">

				<input type="hidden" name="page" value="<?php echo $page;?>">
				<input type="hidden" name="idx" value="<?php echo $idx;?>">
				<input type="hidden" name="mode" value="<?php echo $mode;?>">
				<input type="hidden" name="Search" value="<?php echo $Search;?>">
				<input type="hidden" name="SearchString" value="<?php echo $SearchString;?>">

				<div class="card-body">
					<!--div class="form-group row">
						<label class="col-sm-12 col-form-label"><h5 class="m-0">※ 방역지침 사항에 <font color="red">태영아부~초등34부 렘넌트</font>는 대면예배에 참여할 수 없습니다. 당일, zoom 으로 함께 참여해주세요.</h5></label>
					</div-->
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 예배 신청날짜</label>
						<div class="col-sm-10">
							<div class="input-group date" id="worshipDate" data-target-input="nearest">
								<div class="input-group-append" data-target="#worshipDate" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
								<input type="text" name="worshipDate" class="form-control datetimepicker-input" data-target="#worshipDate" value="<?php echo $row['worshipDate'] ?>"/>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">교구</label>
						<div class="col-sm-10">
						<?php
							$sql_churcharea = "select churchareaCode, korChurchAreaName, korParishName from churcharea where churchareaCode <> 'A99999' order by korChurchAreaName, korParishName";
							$result_churcharea = mysqli_query($conn, $sql_churcharea);
						?>
							<select class="custom-select rounded-0" name="churchareaCode">
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
							<select class="custom-select rounded-0" name="rtdept1Code">
								<option value="">선택하세요</option>
								<option value="D10001"<?php if ($row['rtdept1Code']=="D10001"){echo " selected";}?>>태영아부</option>
								<option value="D10002"<?php if ($row['rtdept1Code']=="D10002"){echo " selected";}?>>유아부</option>
								<option value="D10003"<?php if ($row['rtdept1Code']=="D10003"){echo " selected";}?>>유치부</option>
								<option value="D10004"<?php if ($row['rtdept1Code']=="D10004"){echo " selected";}?>>초등12부</option>
								<option value="D10005"<?php if ($row['rtdept1Code']=="D10005"){echo " selected";}?>>초등34부</option>
								<option value="D10006"<?php if ($row['rtdept1Code']=="D10006"){echo " selected";}?>>초등56부</option>
								<option value="D10007"<?php if ($row['rtdept1Code']=="D10007"){echo " selected";}?>>중등부</option>
								<option value="D10008"<?php if ($row['rtdept1Code']=="D10008"){echo " selected";}?>>고등부</option>
								<option value="D10009"<?php if ($row['rtdept1Code']=="D10009"){echo " selected";}?>>대학1부</option>
								<option value="D10010"<?php if ($row['rtdept1Code']=="D10010"){echo " selected";}?>>대학2부</option>
								<option value="D10011"<?php if ($row['rtdept1Code']=="D10011"){echo " selected";}?>>대학3부</option>
								<option value="D10012"<?php if ($row['rtdept1Code']=="D10012"){echo " selected";}?>>사랑부</option>
								<option value="D00008"<?php if ($row['rtdept1Code']=="D00008"){echo " selected";}?>>인턴십국</option>
								<option value="D00010"<?php if ($row['rtdept1Code']=="D00010"){echo " selected";}?>>장학국</option>
								<option value="D00011"<?php if ($row['rtdept1Code']=="D00011"){echo " selected";}?>>해외유학생부</option>
								<option value="D00013"<?php if ($row['rtdept1Code']=="D00013"){echo " selected";}?>>문화예술체육국</option>
								<option value="D00012"<?php if ($row['rtdept1Code']=="D00012"){echo " selected";}?>>서밋RUTC어린이집</option>
								<option value="D00009"<?php if ($row['rtdept1Code']=="D00009"){echo " selected";}?>>서밋기획국</option>
								<option value="D00001"<?php if ($row['rtdept1Code']=="D00001"){echo " selected";}?>>렘넌트서밋위원회</option>
								<option value="D99999"<?php if ($row['rtdept1Code']=="D99999"){echo " selected";}?>>기타(부모포함)</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성명</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korname" maxlength="50" value="<?php echo $row['korname'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							※ 동명이인 구분을 위해 알파벳도 정확하게 기재해주세요. ex)이혜림B
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
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 핸드폰번호</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" maxlength="30" onkeyup="onlyNum(this);" value="<?php echo $row['mobile'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 생년월일</label>
						<div class="col-sm-4">
							<select class="custom-select rounded-0" name="birthyear">
								<option value="">YYYY</option>
								<?php
									for($i=2021;$i>=1930;$i--){
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
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							※ 생년월일은 동명이인 파악을 위해 필요합니다.
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 교인앱 설치 및 교인증 확인</label>
						<div class="col-sm-10 form-check">
							<input type="radio" name="appYN" value="Y" <?php if ($row['appYN'] == "Y"){echo " checked";}?>>
							<label class="form-check-label">예</label>
							<input type="radio" name="appYN" value="N" <?php if ($row['appYN'] == "N"){echo " checked";}?>>
							<label class="form-check-label">아니오</label>
							<input type="radio" name="appYN" value="X" <?php if ($row['appYN'] == "X"){echo " checked";}?>>
							<label class="form-check-label">핸드폰 없음</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							※ 원활한 교인 바코드 사용을 위해 교입앱 사전 설치 및 update를 부탁드립니다.
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 셔틀버스 이용여부</label>
						<div class="col-sm-10 form-check">
							<input type="radio" name="busUse" value="모란역" <?php if ($row['busUse'] == "모란역"){echo " checked";}?>>
							<label class="form-check-label">셔틀-모란역</label>
							<input type="radio" name="busUse" value="장지역" <?php if ($row['busUse'] == "장지역"){echo " checked";}?>>
							<label class="form-check-label">셔틀-장지역</label>
							<input type="radio" name="busUse" value="이용안함" <?php if ($row['busUse'] == "이용안함"){echo " checked";}?>>
							<label class="form-check-label">셔틀이용안함</label>
							<input type="radio" name="busUse" value="자차운전" <?php if ($row['busUse'] == "자차운전"){echo " checked";}?>>
							<label class="form-check-label">자차운전(*직접운전자만)</label>
							<input type="radio" name="busUse" value="자차동승" <?php if ($row['busUse'] == "자차동승"){echo " checked";}?>>
							<label class="form-check-label">자차동승(*운전자제외)</label>
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
