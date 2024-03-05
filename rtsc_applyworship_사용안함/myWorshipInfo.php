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
            <h1 class="m-0">나의 예배신청정보</h1>
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
						<h5>※ 예배 날짜, 성명, 생년월일을 입력하시고 나의 예배신청정보보기 버튼을 클릭해 주세요.</h5>
					</div>
				</div>
              </div>
              <div class="card-body">
				<script language = "javascript">
				<!--
				function sendit(){
					if (document.rtsc.worshipDate.value == ""){
						alert("예배날짜를 선택하여 주십시요.");
						document.rtsc.worshipDate.focus();
						return;
					}
					if (document.rtsc.korname.value == ""){
						alert("성명를 입력하여 주십시요.");
						document.rtsc.korname.focus();
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
					document.rtsc.submit();
				}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="viewMyWorshipInfo.php">
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">예배날짜</label>
							<div class="col-sm-10">
								<div class="form-group">
									<div class="input-group date" id="worshipDate" data-target-input="nearest">
										<div class="input-group-append" data-target="#worshipDate" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
										<input type="text" name="worshipDate" class="form-control datetimepicker-input" data-target="#worshipDate"/>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">성명</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="korname" placeholder="성명" maxlength="50">
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
										<option value="<?php echo $i;?>"><?php echo $i;?></option>
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
							</div>
							<div class="col-sm-3">
								<select class="custom-select rounded-0" name="birthday">
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
							</div>
						</div>
						<div class="card-footer">
							<a href="javascript:sendit();"><button type="button" class="btn btn-primary btn-block">나의 예배신청정보보기</button></a>
						</div>
					</div>
				</form>
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
