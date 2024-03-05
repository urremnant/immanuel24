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
            <h1 class="m-0">예배신청하기(가족)</h1>
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
						<p>1. 먼저 예배 신청할 가족을 선택합니다.</p>
						<p>2. 선택한 가족의 교인앱 설치 및 교인증 확인란과 셔틀버스란를 선택합니다.</p>
						<p>3. 선택한 데이터 예배신청하기(가족)를 클릭하면 예배신청이 완료됩니다.</p>
					</div>
				</div>
              </div>
              <div class="card-body">
				<?php
					include "connect.php";
					$familyID		= trim($_REQUEST['familyID']);
					$worshipDate	= trim($_REQUEST['worshipDate']);
					$sql_faimly		= "select * from member_familyinfo where familyID = '".$familyID."'";
					$result_faimly	= mysqli_query($conn, $sql_faimly);
					$count_faimly	= mysqli_num_rows($result_faimly);

					$sql_script		= "select idx from member_familyinfo where familyID = '".$familyID."'";
					$result_script	= mysqli_query($conn, $sql_script);
				?>
				<script language = "javascript">
				<!--
					function recordcheck(){
						var count = <?php echo $count_faimly?>;
						if (count <= 0){
							alert("데이터가 없습니다.");
							return false;
						}
						return;
					}
					function select_check(operation){
						var count = 0;
						for (var i = 0; i < document.datalist.elements.length; i++){
							var check = document.datalist.elements[i];
							if (check.checked == true)
								++count;
						}
						if (count <= 0){
							if (operation == "alldischeck")
								alert("데이터를 선택해 주십시요.");
							return false;
						}
						return;
					}
					function allcheck(){
						recordcheck();
						for( var i=0; i < document.datalist.elements.length; i++){
							var check = document.datalist.elements[i];
							check.checked = true;
						}
						return;
					}
					function alldischeck(){
						var value = recordcheck();
						if (value == false)
							return false;
						var check_value = select_check(document.datalist, "alldischeck");
						if (check_value == false)
							return false;
						for( var i=0; i < document.datalist.elements.length; i++){
							var check = document.datalist.elements[i];
							check.checked = false;
						}
						return;
					}
					function apply_worship(){
						var checkdatalist="";
						for(i=0; i < document.datalist.elements.length; ++i){
							if(document.datalist.elements[i].checked == true){
								checkdatalist=checkdatalist+document.datalist.elements[i].value+",";
							}
						}
						if (checkdatalist == "" ){
							alert("예배신청할 데이터를 선택하여 주십시요.");
							return;
						}else{
							<?php
								while($row_script = mysqli_fetch_assoc($result_script)){
							?>
								if (document.datalist.registWorship<?php echo $row_script['idx']?>.checked == true){
									if (document.datalist.appYN<?php echo $row_script['idx']?>.value == "" ){
										alert("교인앱 설치 및 교인증 확인란을 선택하여 주세요.");
										return;
									}
									if (document.datalist.busUse<?php echo $row_script['idx']?>.value == "" ){
										alert("셔틀버스/자차 이용여부란을 선택하여 주세요.");
										return;
									}										
								}
							<?php
								}
							?>
							document.datalist.submit();
						}
					}
				//-->
				</script>
                  <div class="col-12">
					<form name="datalist" method="POST" action="registWorship_Family_ok.php">

						<input type="hidden" name="familyID" value="<?php echo $familyID;?>">
						<input type="hidden" name="worshipDate" value="<?php echo $worshipDate;?>">

						<a href="javascript:allcheck()"><button type="button" class="btn btn-info">전체선택</button></a>
						<a href="javascript:alldischeck()"><button type="button" class="btn btn-info">선택해제</button></a>
						<a href="javascript:apply_worship()"><button type="button" class="btn btn-primary">선택한 데이터 예배신청하기(가족)</button></a>
						<p></p>
						<table class="table table-hover text-nowrap">
						<thead>
							<tr class="text-center">
								<th>예배신청 체크</th>
								<th>성명</th>
								<th>직분</th>
								<th>성별</th>
								<th>생년월일</th>
								<th>휴대폰</th>
								<th>교구</th>
								<th>부서</th>
								<th>교인앱 설치 및 교인증 확인</th>
								<th>셔틀버스/자차 이용여부</th>
							</tr>
						</thead>
						<tbody>
					<?php
						while($row_faimly = mysqli_fetch_assoc($result_faimly)) {
					?>
							<tr class="text-center">
								<td><input type="checkbox" name="registWorship<?php echo $row_faimly['idx']?>" value="<?php echo $row_faimly['idx']?>"></td>
								<td><?php echo $row_faimly['korname']?></td>
								<td>
									<?php
										$sql_korChurchPosition = "select korChurchPosition from churchPosition where churchPositionCode = '".$row_faimly['churchPositionCode']."'";
										$result_korChurchPosition = mysqli_query($conn, $sql_korChurchPosition);
										$row_korChurchPosition = mysqli_fetch_assoc($result_korChurchPosition);
										echo $row_korChurchPosition['korChurchPosition'];
									?>
								</td>
								<td>
									<?php
										switch ($row_faimly['gender']){
											case "M":
												echo "남";
												break;
											case "F":
												echo "여";
												break;
										}
									?>
								</td>
								<td>
									<?php
										if ($row_faimly['birtdday']<>""){
									?>
										<?php echo substr($row_faimly['birtdday'], 0, 4)."년 ".substr($row_faimly['birtdday'], 4, 2)."월 ".substr($row_faimly['birtdday'],-2)."일" ?>
									<?php
										}
									?>
								</td>
								<td><?php echo $row_faimly['mobile'] ?></td>
								<td>
									<?php
										$sql_churcharea = "SELECT korChurchAreaName, korParishName from churcharea where churchareaCode = '".$row_faimly['churchareaCode']."'";
										$result_churcharea = mysqli_query($conn, $sql_churcharea);
										$row_churcharea = mysqli_fetch_assoc($result_churcharea);
										echo $row_churcharea['korChurchAreaName']." ".$row_churcharea['korParishName'];
									?>
								</td>
								<td>
									<?php
										$sql_rtdept1 = "select rtdept1Name from rtdept1 where rtdept1Code = '".$row_faimly['rtdept1Code']."'";
										$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
										$row_rtdept1 = mysqli_fetch_assoc($result_rtdept1);
										echo $row_rtdept1['rtdept1Name'];
									?>
								</td>
								<td>
									<select class="custom-select rounded-0" name="appYN<?php echo $row_faimly['idx']?>">
										<option value="">선택하세요</option>
										<option value="Y">예</option>
										<option value="N">아니오</option>
										<option value="X">핸드폰없음</option>
									</select>
								</td>
								<td>
									<select class="custom-select rounded-0" name="busUse<?php echo $row_faimly['idx']?>">
										<option value="">선택하세요</option>
										<option value="모란역">모란역</option>
										<option value="장지역">장지역</option>
										<option value="이용안함">이용안함</option>
										<option value="자차운전">자차운전(*동승자제외)</option>
										<option value="자차동승">자차동승(*운전자제외)</option>
									</select>
								</td>
							</tr>
					<?php
						}
					?>
						</tfoot>
						</table>
					</form>
				  </div>
				<?php
					mysqli_close($conn);
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
