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
            <h1 class="m-0">렘넌트서밋위원회</h1>
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
              <div class="card-header">
				<h3 class="card-title">※ 성명에 알파벳이 붙으면 알파벳까지 넣어야 합니다</h3>
              </div>
<script language = "javascript">
<!--
	function sendit(){
		if (document.immanuelRemnantCheck.korname.value == ""){
			alert("성명을 입력하여 주십시요.");
			document.immanuelRemnantCheck.korname.focus();
			return;
		}
		if (document.immanuelRemnantCheck.birthyear.value==""){
			alert("출생년도를 선택하여 주십시요.");
			document.immanuelRemnantCheck.birthyear.focus();
			return;
		}
		if (document.immanuelRemnantCheck.birthmonth.value==""){
			alert("출생월을 선택하여 주십시요.");
			document.immanuelRemnantCheck.birthmonth.focus();
			return;
		}
		if (document.immanuelRemnantCheck.birthday.value==""){
			alert("출생일을 선택하여 주십시요.");
			document.immanuelRemnantCheck.birthday.focus();
			return;
		}
		document.immanuelRemnantCheck.submit();
	}
//-->
</script>
<form class="form-horizontal" method ="POST" name="immanuelRemnantCheck" action="immanuelRemnantCheck_ok.php">

			  <div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 성명</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="korname" maxlength="50">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 생년월일</label>
						<div class="col-sm-4">
							<select class="custom-select rounded-0" name="birthyear">
								<option value="">YYYY</option>
								<?php
									for($i=2022;$i>=1920;$i--){
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
			  </div>
</form>
			  <div class="card-footer">
					<a href="javascript:sendit();"><button type="button" class="btn btn-primary btn-block">제출</button></a>
			  </div>
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
