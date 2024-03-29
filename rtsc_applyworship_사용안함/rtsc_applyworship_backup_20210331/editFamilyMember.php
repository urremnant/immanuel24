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
						<p>1. 자신의 직계 가족만 등록합니다.(조부모, 부모, 자녀까지)</p>
						<p>2. 불신자일 경우 직분은 기타로 선택하여 주세요.</p>
						<p>3. 렘넌트의 경우 소속 부서를 반드시 선택하여 주세요.</p>
						<p>4. 본인이 속한 부서가 없는 경우 기타를 선택하여 주세요.</p>
						<p>5. <font color="red">*</font> 는 필수항목입니다.</p>
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
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성명</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korname" maxlength="50" value="<?php echo $row['korname']?>">
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
							<input type="radio" name="gender<?php echo $k?>" value="M" <?php if ($row['gender'] == "M"){echo " checked";}?>>
							<label class="form-check-label">남</label>
						</div>
						<div class="col-sm-2">
							<input type="radio" name="gender<?php echo $k?>" value="F" <?php if ($row['gender'] == "F"){echo " checked";}?>>
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