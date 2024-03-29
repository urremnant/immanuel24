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
						<p>※ 예배 신청 체크를 하고 교인앱 설치 및 교인증 확인란과 셔틀버스란를 선택 후 선택한 데이터 예배신청하기(가족)를 클릭하면 예배신청이 완료됩니다.</p>
						<p>※ 가족 정보의 추가 수정 삭제는 좌측 나의 가족정보 메뉴를 이용하여 주세요.</p>
					</div>
				</div>
              </div>

              <div class="card-body">
				<div class="col-12">
					<form name="datalist" method="POST" action="registWorship_Family_ok.php">

						<input type="hidden" name="familyID" value="<?php echo $familyID;?>">
						<input type="hidden" name="worshipDate" value="<?php echo $worshipDate;?>">

						<a href="javascript:allcheck()"><button type="button" class="btn btn-info">전체선택</button></a>
						<a href="javascript:alldischeck()"><button type="button" class="btn btn-info">선택해제</button></a>
						<a href="javascript:apply_worship()"><button type="button" class="btn btn-primary">선택한 데이터 예배신청하기(가족)</button></a>
						<p></p>
				</div>
				<div class="row">
<?php
	while ($row_faimly = mysqli_fetch_assoc($result_faimly)) {
?>
				  <div class="col-md-4">
					<div class="card card-primary card-outline">
					  <div class="card-body box-profile">
						<h3 class="profile-username text-center"><?php echo $row_faimly['korname'] ?></h3>
						<p class="text-muted text-center">
							<?php
								$sql_korChurchPosition = "select korChurchPosition from churchPosition where churchPositionCode = '".$row_faimly['churchPositionCode']."'";
								$result_korChurchPosition = mysqli_query($conn, $sql_korChurchPosition);
								$row_korChurchPosition = mysqli_fetch_assoc($result_korChurchPosition);
								echo $row_korChurchPosition['korChurchPosition'];
							?>						
						</p>
						<ul class="list-group list-group-unbordered mb-3">
						  <li class="list-group-item">
							<i class="fas fa-birthday-cake"></i> <b>생년월일</b> 
							<a class="float-right">
							<?php 
								if ($row_faimly['birthday']<>""){
							?>
								<?php echo substr($row_faimly['birthday'], 0, 4)."년 ".substr($row_faimly['birthday'], 4, 2)."월 ".substr($row_faimly['birthday'],-2)."일" ?>
							<?php
								}
							?>
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-mobile-alt"></i> <b>핸드폰</b>
							<a class="float-right"><?php echo $row_faimly['mobile'] ?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-map-marker-alt"></i> <b>교구</b>
							<a class="float-right">
								<?php
									$sql_churcharea = "SELECT korChurchAreaName, korParishName from churcharea where churchareaCode = '".$row_faimly['churchareaCode']."'";
									$result_churcharea = mysqli_query($conn, $sql_churcharea);
									$row_churcharea = mysqli_fetch_assoc($result_churcharea);
									echo $row_churcharea['korChurchAreaName']." ".$row_churcharea['korParishName'];
								?>
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-heart"></i> <b>부서</b>
							<a class="float-right">
								<?php
									$sql_rtdept1 = "select rtdept1Name from rtdept1 where rtdept1Code = '".$row_faimly['rtdept1Code']."'";
									$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
									$row_rtdept1 = mysqli_fetch_assoc($result_rtdept1);
									echo $row_rtdept1['rtdept1Name'];
								?>								
							</a>
						  </li>
						  <li class="list-group-item">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input custom-control-input-danger" type="checkbox" id="registWorship<?php echo $row_faimly['idx']?>" name="registWorship<?php echo $row_faimly['idx']?>" value="<?php echo $row_faimly['idx']?>"> <label for="registWorship<?php echo $row_faimly['idx']?>" class="custom-control-label"><b><font color="red">예배 신청합니다.(※ 예배 신청하실 분은 반드시 체크해주세요.)</font></b></label>
							</div>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-edit"></i> <b>교인앱 설치 및 교인증 확인</b>
						  </li>
						  <li class="list-group-item">
									<select class="custom-select rounded-0" name="appYN<?php echo $row_faimly['idx']?>">
										<option value="">선택하세요</option>
										<option value="Y">예</option>
										<option value="N">아니오</option>
										<option value="X">핸드폰없음</option>
									</select>							
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-edit"></i> <b>셔틀버스/자차 이용여부</b>
						  </li>
						  <li class="list-group-item">
									<select class="custom-select rounded-0" name="busUse<?php echo $row_faimly['idx']?>">
										<option value="">선택하세요</option>
										<option value="모란역">모란역</option>
										<option value="장지역">장지역</option>
										<option value="이용안함">이용안함</option>
										<option value="자차운전">자차운전(*동승자제외)</option>
										<option value="자차동승">자차동승(*운전자제외)</option>
									</select>							
						  </li>

						</ul>
					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				  </div>

<?php
	}
?>
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