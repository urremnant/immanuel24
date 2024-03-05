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
				if (document.rtsc.myNo.value == ""){
						alert("검색기능을 사용하여 교인번호를 입력하여 주십시요.");
						document.rtsc.myNo.focus();
						return false;
				}
				if (document.rtsc.worshipDate.value == ""){
						alert("예배 신청날짜를 선택하여 주십시요.");
						document.rtsc.worshipDate.focus();
						return false;
				}
				var count_worshipGubun = 0;
				for(l=0; l<2; l++){
					if(document.rtsc.worshipGubun[l].checked == true){
						count_worshipGubun += 1;
					}
				}
				if (count_worshipGubun == 0 ){
					alert("참석하실 예배를 선택하여 주십시요.");
					document.rtsc.worshipGubun[0].focus();
					return;
				}
				if (document.rtsc.korname.value == ""){
					alert("성명을 입력하여 주십시요.");
					document.rtsc.korname.focus();
					return;
				}
				if (document.rtsc.churchPositionCode.value==""){
					alert("직분을 선택하여 주십시요.");
					document.rtsc.churchPositionCode.focus();
					return;
				}
				var count_gender = 0;
				for(l=0; l<2; l++){
					if(document.rtsc.gender[l].checked == true){
						count_gender += 1;
					}
				}
				if (count_gender == 0 ){
					alert("성별을 선택하여 주십시요.");
					document.rtsc.gender[0].focus();
					return;
				}
				if (document.rtsc.birthyear.value==""){
					alert("출생년도를 선택하여 주십시요.");
					document.rtsc.birthyear.focus();
					return;
				}
				if (document.rtsc.birthmonth.value==""){
					alert("출생월을 선택하여 주십시요.");
					document.rtsc.birthmonth.focus();
					return;
				}
				if (document.rtsc.birthday.value==""){
					alert("출생일을 선택하여 주십시요.");
					document.rtsc.birthday.focus();
					return;
				}
				if (document.rtsc.churchareaCode.value==""){
					alert("교구를 선택하여 주십시요.");
					document.rtsc.churchareaCode.focus();
					return;
				}
				if (document.rtsc.churchPositionCode.value == "CP0017"){
					if (document.rtsc.rtdept1Code.value==""){
						alert("렘넌트가 소속된 부서를 선택하여 주십시요.");
						document.rtsc.rtdept1Code.focus();
						return;
					}
				}
				if (document.rtsc.appYN.value==""){
					alert("교인앱 설치 및 교인증 확인란을 선택하여 주십시요.");
					document.rtsc.appYN.focus();
					return;
				}
				if (document.rtsc.busUse.value==""){
					alert("셔틀버스/자차 이용여부를 선택하여 주십시요.");
					document.rtsc.busUse.focus();
					return;
				}
				if ((document.rtsc.strollerYN.checked == true) || (document.rtsc.wheelchairYN.checked == true)){
					if (document.rtsc.carNo.value == "" ){
						alert("차량번호를 입력하여 주세요.");
						return;
					}
				}
				if (document.rtsc.worshipPlace.value==""){
					alert("예배장소를 선택하여 주십시요.");
					document.rtsc.worshipPlace.focus();
					return;
				}
				document.rtsc.submit();
			}
			function onlyNum(obj) {
				var val = obj.value;
				var re = /[^0-9]/gi;
				obj.value = val.replace(re, '');
			}
			function findMyNo(){
				window.open('findMyNo.php', 'findMyNo',  'scrollbars=yes,toolbar=no,location=no,directories=no,width=600,height=350,resizable=no,mebar=no,left=200,top=250');
			}
			//-->
			</script>

			<form class="form-horizontal" method ="POST" name="rtsc" action="edit_ok.php">

				<input type="hidden" name="page" value="<?php echo $page;?>">
				<input type="hidden" name="idx" value="<?php echo $idx;?>">
				<input type="hidden" name="mode" value="<?php echo $mode;?>">
				<input type="hidden" name="Search" value="<?php echo $Search;?>">
				<input type="hidden" name="SearchString" value="<?php echo $SearchString;?>">

				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<font color="red">※ 검색버튼을 클릭하여 교인번호를 검색하여 주세요.</font>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 교인번호(QR번호)</label>
						<div class="col-sm-2">
							<div class="input-group">
							  <div class="custom-file">
								<input type="text" class="form-control" id="myNo" name="myNo" maxlength="20" value="<?php echo $row['myNo'] ?>">
							  </div>
							  <div class="input-group-append">
								<span class="input-group-text" onclick="javascript:findMyNo();return false;">검색</span>
							  </div>
							</div>
						</div>
					</div>
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
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 참석 예배</label>
						<div class="col-sm-2">
							<input type="radio" name="worshipGubun" value="1부" <?php if ($row['worshipGubun'] == "1부"){echo "checked";}?>>
							<label class="form-check-label">1부 예배</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="worshipGubun" value="2부" <?php if ($row['worshipGubun'] == "2부"){echo "checked";}?>>
							<label class="form-check-label">2부 예배</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<font color="red">※ 성명은 동명이인 구분을 위해 알파벳도 정확하게 기재해주세요. ex)이혜림B</font>
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
								<option value="<?php echo $row_korChurchPosition['churchPositionCode'] ?>"
								<?php
									if ($row['churchPositionCode'] == $row_korChurchPosition['churchPositionCode']){
										echo "selected";
									}
								?>><?php echo $row_korChurchPosition['korChurchPosition'] ?></option>
						<?php
							}
						?>
								<option value="CP9999" <?php if ($row['churchPositionCode'] == "CP9999"){echo "selected";}?>>기타</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성별</label>
						<div class="col-sm-2">
							<input type="radio" name="gender" value="M" <?php if ($row['gender'] == "M"){echo "checked";}?>>
							<label class="form-check-label">남</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="gender" value="F" <?php if ($row['gender'] == "F"){echo "checked";}?>>
							<label class="form-check-label">여</label>
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
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 핸드폰번호</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" maxlength="30" onkeyup="onlyNum(this);" value="<?php echo $row['mobile'] ?>">
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
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 교인앱 설치 및 교인증 확인</label>
						<div class="col-sm-10 form-check">
							<select class="custom-select rounded-0" name="appYN">
								<option value="">선택하세요</option>
								<option value="Y" <?php if ($row['appYN'] == "Y"){echo " selected";}?>>예</option>
								<option value="N" <?php if ($row['appYN'] == "N"){echo " selected";}?>>아니오</option>
								<option value="X" <?php if ($row['appYN'] == "X"){echo " selected";}?>>핸드폰없음</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 셔틀버스 이용여부</label>
						<div class="col-sm-10 form-check">
							<select class="custom-select rounded-0" name="busUse">
								<option value="">선택하세요</option>
								<option value="모란역" <?php if ($row['busUse'] == "모란역"){echo " selected";}?>>모란역</option>
								<option value="장지역" <?php if ($row['busUse'] == "장지역"){echo " selected";}?>>장지역</option>
								<option value="이용안함" <?php if ($row['busUse'] == "이용안함"){echo " selected";}?>>이용안함</option>
								<option value="자차운전" <?php if ($row['busUse'] == "자차운전"){echo " selected";}?>>자차운전(*동승자제외)</option>
								<option value="자차동승" <?php if ($row['busUse'] == "자차동승"){echo " selected";}?>>자차동승(*운전자제외)</option>
								<option value="카풀" <?php if ($row['busUse'] == "카풀"){echo " selected";}?>>카풀</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<font color="red">※ 교회에서 유모차나 휠체어를 이용하는 경우 체크해 주세요.</font>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"> 기타</label>
						<div class="col-sm-2">
							<input type="checkbox" name="strollerYN" value="Y" <?php if ($row['strollerYN'] == "Y"){echo " checked";}?>>
							<label class="form-check-label">유모차 이용</label>
						</div>
						<div class="col-sm-2">
							<input type="checkbox" name="wheelchairYN" value="Y" <?php if ($row['wheelchairYN'] == "Y"){echo " checked";}?>>
							<label class="form-check-label">휠체어 이용</label>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<font color="red">※ 교회에서 유모차나 휠체어를 이용하는 경우 차량번호를 입력해 주세요.</font>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"> 차량번호</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="carNo" maxlength="30" value="<?php echo $row['carNo'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 예배장소</label>
						<div class="col-sm-10">
							<select class="custom-select rounded-0" name="worshipPlace">
								<option value="">선택하세요</option>
								<option value="본당"<?php if ($row['worshipPlace'] == "본당"){echo " selected";} ?>>본당</option>
								<option value="태영아부실"<?php if ($row['worshipPlace'] == "태영아부실"){echo " selected";} ?>>태영아부실</option>
								<option value="유아부실"<?php if ($row['worshipPlace'] == "유아부실"){echo " selected";} ?>>유아부실</option>
								<option value="유치부실"<?php if ($row['worshipPlace'] == "유치부실"){echo " selected";} ?>>유치부실</option>
								<option value="초등12부실"<?php if ($row['worshipPlace'] == "초등12부실"){echo " selected";} ?>>초등12부실</option>
								<option value="초등34부실"<?php if ($row['worshipPlace'] == "초등34부실"){echo " selected";} ?>>초등34부실</option>
								<option value="초등56부실"<?php if ($row['worshipPlace'] == "초등56부실"){echo " selected";} ?>>초등56부실</option>
								<option value="중등부실"<?php if ($row['worshipPlace'] == "중등부실"){echo " selected";} ?>>중등부실</option>
								<option value="고등부실"<?php if ($row['worshipPlace'] == "고등부실"){echo " selected";} ?>>고등부실</option>
								<option value="대학국실"<?php if ($row['worshipPlace'] == "대학국실"){echo " selected";} ?>>대학국실</option>
								<option value="사랑부실"<?php if ($row['worshipPlace'] == "사랑부실"){echo " selected";} ?>>사랑부실</option>
								<option value="농인부실"<?php if ($row['worshipPlace'] == "농인부실"){echo " selected";} ?>>농인부실</option>
								<option value="TCK부실"<?php if ($row['worshipPlace'] == "TCK부실"){echo " selected";} ?>>TCK부실</option>
								<option value="청년부실"<?php if ($row['worshipPlace'] == "청년부실"){echo " selected";} ?>>청년부실</option>
								<option value="영어예배부실"<?php if ($row['worshipPlace'] == "영어예배부실"){echo " selected";} ?>>영어예배부실</option>
								<option value="중국어예배부실"<?php if ($row['worshipPlace'] == "중국어예배부실"){echo " selected";} ?>>중국어예배부실</option>
								<option value="일본어예배부실"<?php if ($row['worshipPlace'] == "일본어예배부실"){echo " selected";} ?>>일본어예배부실</option>
								<option value="스페인어예배부실"<?php if ($row['worshipPlace'] == "스페인어예배부실"){echo " selected";} ?>>스페인어예배부실</option>
								<option value="러시아어예배부실"<?php if ($row['worshipPlace'] == "러시아어예배부실"){echo " selected";} ?>>러시아어예배부실</option>
								<option value="북한선교부실"<?php if ($row['worshipPlace'] == "북한선교부실"){echo " selected";} ?>>북한선교부실</option>
								<option value="위원회실"<?php if ($row['worshipPlace'] == "위원회실"){echo " selected";} ?>>위원회실</option>
							</select>	
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">통역어</label>
						<div class="col-sm-10">
							<select class="custom-select rounded-0" name="useLanguage">
								<option value="">필요없음</option>
								<option value="영어"<?php if ($row['useLanguage'] == "영어"){echo " selected";} ?>>영어</option>
								<option value="일본어"<?php if ($row['useLanguage'] == "일본어"){echo " selected";} ?>>일본어</option>
								<option value="중국어(한어)"<?php if ($row['useLanguage'] == "중국어(한어)"){echo " selected";} ?>>중국어(한어)</option>
								<option value="중국어(화어)"<?php if ($row['useLanguage'] == "중국어(화어)"){echo " selected";} ?>>중국어(화어)</option>
								<option value="러시아어"<?php if ($row['useLanguage'] == "러시아어"){echo " selected";} ?>>러시아어</option>
								<option value="프랑스어"<?php if ($row['useLanguage'] == "프랑스어"){echo " selected";} ?>>프랑스어</option>
								<option value="스페인어"<?php if ($row['useLanguage'] == "스페인어"){echo " selected";} ?>>스페인어</option>
							</select>	
						</div>
					</div>
				</div>
				<!-- /.card-body -->

				<div class="card-footer">
					<a href="javascript:sendit();"><button type="button" class="btn btn-primary btn-block">Submit</button></a>
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
