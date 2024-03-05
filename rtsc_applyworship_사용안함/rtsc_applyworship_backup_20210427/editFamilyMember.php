<?php
	include "header.php";
	include "Navbar.php";
	include "menu_worship.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">가족 등록하기</h1>
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
              <div class="card-header">
				<div class="row">
					<div class="col-12">
						<p><h5><b>※ 가족 등록하기 유의사항</b></h5></P>
						<p>1. <font color="red">*</font> 는 필수항목입니다.</p>
						<p>2. 자신의 직계 가족만 등록합니다.(조부모, 부모, 자녀까지)</p>
						<p>3. 렘넌트의 경우 소속 부서를 반드시 선택하여 주세요.</p>
						<p>4. 아래 작성한 내용은 나의 가족정보메뉴에서 언제든 추가, 수정, 삭제가 가능합니다.</p>
					</div>
				</div>
              </div>
              <div class="card-body">
				<?php
					include "connect.php";
					$familyID	= trim($_REQUEST['familyID']);
					$idx		= trim($_REQUEST['idx']);
					$sql = "select * from member_familyinfo where idx = '".$idx."'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
				?>
				<script language = "javascript">
				<!--
				function sendit(){
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
					if (document.rtsc.familyPosition.value == ""){
						alert("관계를 입력하여 주십시요.");
						document.rtsc.familyPosition.focus();
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
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="editFamilyMember_ok.php">
					<input type="hidden" name="familyID" value="<?php echo $familyID?>">
					<input type="hidden" name="idx" value="<?php echo $idx?>">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<font color="red">※ 성명은 동명이인 구분을 위해 알파벳도 정확하게 기재해주세요. ex)이혜림B</font>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성명</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korname" maxlength="50" value="<?php echo $row['korname']?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<font color="red">※ 불신자일 경우 직분은 기타로 선택하여 주세요.</font>
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
								<option value="CP9999" <?php if ($row['churchPositionCode'] == "C99999"){echo "selected";}?>>기타</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<font color="red">※ 관계는 렘넌트를 기준으로 작성하며 렘넌트는 렘넌트로 기록해주세요. 렘넌트의 아빠일 경우 부, 엄마일 경우 모, 할아버지는 조부, 할머니는 조모로 기록합니다.</font>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 관계</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="familyPosition" maxlength="20" value="<?php echo $row['familyPosition']?>">
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
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 생년월일</label>
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
						<label class="col-sm-2 col-form-label">휴대폰</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" maxlength="30" placeholder="'-' 없이 숫자만 기록하세요. 예) 01012345678" onkeyup="onlyNum(this);" value="<?php echo $row['mobile']?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 교구</label>
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
						<label class="col-sm-2 col-form-label">부서</label>
						<div class="col-sm-10">
						<?php
							$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
							$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
							//$row = mysqli_fetch_assoc($result);
							//$cnt = mysqli_num_rows($result);
						?>
							<select class="custom-select rounded-0" id="rtdept1Code" name="rtdept1Code">
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
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">교인앱 설치 및 교인증 확인</label>
						<div class="col-sm-10">
							<select class="custom-select rounded-0" name="appYN">
								<option value="">선택하세요</option>
								<option value="Y" <?php if ($row['appYN'] == "Y"){echo " selected";}?>>예</option>
								<option value="N" <?php if ($row['appYN'] == "N"){echo " selected";}?>>아니오</option>
								<option value="X" <?php if ($row['appYN'] == "X"){echo " selected";}?>>핸드폰없음</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">셔틀버스/자차 이용여부</label>
						<div class="col-sm-10">
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
							<font color="red">※ 예배신청시 아래 선택한 예배장소를 기본적으로 불러옵니다.</font>
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
				</form>
				<div class="card-footer">
					<a href="javascript:sendit();"><button type="button" class="btn btn-primary btn-block">Submit</button></a>
				</div>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
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
	include "footer.php";
?>