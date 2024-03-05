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
						<p>4. <font color="red">*</font> 는 필수항목입니다.</p>
					</div>
				</div>
              </div>
              <div class="card-body table-responsive p-0">
				<?php
					include "connect.php";
					$familyCount	= trim($_REQUEST['familyCount']);
				?>
				<script language = "javascript">
				<!--
				function sendit(){
				<?php
					for($j=1;$j<=$familyCount;$j++){
				?>
						if (document.rtsc.korname<?php echo $j?>.value == ""){
							alert("성명을 입력하여 주십시요.");
							document.rtsc.korname<?php echo $j?>.focus();
							return;
						}
						if (document.rtsc.churchPositionCode<?php echo $j?>.value==""){
							alert("직분을 선택하여 주십시요.");
							document.rtsc.churchPositionCode<?php echo $j?>.focus();
							return;
						}							
						if (count_gender<?php echo $j?> == 0 ){
							alert("성별을 선택하여 주십시요.");
							document.rtsc.gender<?php echo $j?>[0].focus();
							return;
						}
						var count_gender<?php echo $j?> = 0;
						for(l=0; l<2; l++){
							if(document.rtsc.gender<?php echo $j?>[l].checked == true){
								count_gender<?php echo $j?> += 1;
							}
						}
						if (count_gender<?php echo $j?> == 0 ){
							alert("성별을 선택하여 주십시요.");
							document.rtsc.gender<?php echo $j?>[0].focus();
							return;
						}
						if (document.rtsc.birthyear<?php echo $j?>.value==""){
							alert("출생년도를 선택하여 주십시요.");
							document.rtsc.birthyear<?php echo $j?>.focus();
							return;
						}
						if (document.rtsc.birthmonth<?php echo $j?>.value==""){
							alert("출생월을 선택하여 주십시요.");
							document.rtsc.birthmonth<?php echo $j?>.focus();
							return;
						}
						if (document.rtsc.birthday<?php echo $j?>.value==""){
							alert("출생일을 선택하여 주십시요.");
							document.rtsc.birthday<?php echo $j?>.focus();
							return;
						}
						if (document.rtsc.churchareaCode<?php echo $j?>.value==""){
							alert("교구를 선택하여 주십시요.");
							document.rtsc.churchareaCode<?php echo $j?>.focus();
							return;
						}
						if (document.rtsc.churchPositionCode<?php echo $j?>.value == "CP0017"){
							if (document.rtsc.rtdept1Code<?php echo $j?>.value==""){
								alert("렘넌트가 소속된 부서를 선택하여 주십시요.");
								document.rtsc.rtdept1Code<?php echo $j?>.focus();
								return;
							}
						}
				<?php
					}
				?>
					document.rtsc.submit();
				}
				function onlyNum(obj) {
					var val = obj.value;
					var re = /[^0-9]/gi;
					obj.value = val.replace(re, '');
				}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="registFamily_ok.php">
					<input type="hidden" name="familyCount" value="<?php echo $familyCount?>">
						
							<table class="table table-hover text-nowrap">
							<thead>
								<tr class="text-center">
									<th><font color="red">*</font>성명</th>
									<th><font color="red">*</font>직분</th>
									<th><font color="red">*</font>성별</th>
									<th><font color="red">*</font>생년월일</th>
									<th>휴대폰</th>
									<th><font color="red">*</font>교구</th>
									<th>부서</th>
								</tr>
							</thead>
							<tbody>
						<?php
							for($k=1;$k<=$familyCount;$k++){
						?>
								<tr>
									<td><input type="text" class="form-control" name="korname<?php echo $k?>" placeholder="성명" maxlength="50"></td>
									<td>
										<?php
											$sql_korChurchPosition = "select churchPositionCode, korChurchPosition from churchPosition where korChurchPosition not in ('강도사', '원로목사', '무임목사', '학생', '어린이', '조사', '기타') order by korChurchPosition";
											$result_korChurchPosition = mysqli_query($conn, $sql_korChurchPosition);
										?>
											<select class="custom-select rounded-0" name="churchPositionCode<?php echo $k?>">
												<option value="">선택하세요</option>
										<?php
											while ($row_korChurchPosition = mysqli_fetch_assoc($result_korChurchPosition)) {
										?>
												<option value="<?php echo $row_korChurchPosition['churchPositionCode'] ?>"><?php echo $row_korChurchPosition['korChurchPosition'] ?></option>
										<?php
											}
										?>
												<option value="CP9999">기타</option>
											</select>									
									</td>
									<td>
										<input type="radio" name="gender<?php echo $k?>" value="M">남 <input type="radio" name="gender<?php echo $k?>" value="F">여
									</td>
									<td>
										<select class="custom-select rounded-0 col-sm-5" name="birthyear<?php echo $k?>">
											<option value="">YYYY</option>
											<?php
												for($i=date("Y");$i>=1930;$i--){
											?>
												<option value="<?php echo $i;?>"><?php echo $i;?></option>
											<?php
												}
											?>
										</select>
										<select class="custom-select rounded-0 col-sm-3" name="birthmonth<?php echo $k?>">
											<option value="">MM</option>
											<?php
												for($i=1;$i<=9;$i++){
											?>
												<option value="<?php echo "0".$i;?>"><?php echo $i;?></option>
											<?php
												}
											?>
											<?php
												for($i=10;$i<=12;$i++){
											?>
												<option value="<?php echo $i;?>"><?php echo $i;?></option>
											<?php
												}
											?>
										</select>
										<select class="custom-select rounded-0 col-sm-3" name="birthday<?php echo $k?>">
											<option value="">DD</option>
											<?php
												for($i=1;$i<=9;$i++){
											?>
												<option value="<?php echo "0".$i;?>"><?php echo $i;?></option>
											<?php
												}
											?>
											<?php
												for($i=10;$i<=31;$i++){
											?>
												<option value="<?php echo $i;?>"><?php echo $i;?></option>
											<?php
												}
											?>
										</select>
									</td>
									<td><input type="text" class="form-control" name="mobile<?php echo $k?>" maxlength="30" placeholder="'-'없이 숫자만 기록. 예)01012345678" onkeyup="onlyNum(this);"></td>
									<td>
										<?php
											$sql_churcharea = "select churchareaCode, korChurchAreaName, korParishName from churcharea where churchareaCode <> 'A99999' order by korChurchAreaName, korParishName";
											$result_churcharea = mysqli_query($conn, $sql_churcharea);
										?>
											<select class="custom-select rounded-0" name="churchareaCode<?php echo $k?>">
												<option value="">선택하세요</option>
										<?php
											while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
										?>
												<option value="<?php echo $row_churcharea['churchareaCode'] ?>"><?php echo $row_churcharea['korChurchAreaName']." ".$row_churcharea['korParishName'] ?></option>
										<?php
											}
										?>
											</select>
									</td>
									<td>
										<?php
											$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
											//$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 order by rtdept1Code";
											$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
											//$row = mysqli_fetch_assoc($result);
											//$cnt = mysqli_num_rows($result);
										?>
											<select class="custom-select rounded-0" id="rtdept1Code" name="rtdept1Code<?php echo $k?>">
												<option value="">선택하세요</option>
										<?php
											while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
										?>
												<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"><?php echo $row_rtdept1['rtdept1Name'] ?></option>
										<?php
											}
										?>
											</select>									
									</td>
								</tr>
						<?php
							}
						?>
							</tfoot>
							</table>
				</form>
				<!-- /.card-body -->
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
			  </div>
              <!-- /.card-body -->
				<div class="card-footer">
					<a href="javascript:sendit();"><button type="button" class="btn btn-primary btn-block">Submit</button></a>
				</div>
				<!-- /.card-footer -->
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