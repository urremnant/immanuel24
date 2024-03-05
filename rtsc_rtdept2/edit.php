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
            <h1 class="m-0">분반코드 관리</h1>
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

	$rtdept2Code			= trim($_REQUEST['rtdept2Code']);

	$sql = "SELECT * FROM rtdept2 where rtdept2Code = '".$rtdept2Code."' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
			<script language = "javascript">
			<!--
			function sendit(){
				if (document.rtsc.parentsCode.value == ""){
						alert("부서를 선택하여 주십시요.");
						document.rtsc.parentsCode.focus();
						return false;
				}
				if (document.rtsc.rtdept2Name.value == ""){
						alert("분반명을 입력하여 주십시요.");
						document.rtsc.rtdept2Name.focus();
						return false;
				}
				document.rtsc.submit();
			}
			//-->
			</script>

			<form class="form-horizontal" method ="POST" name="rtsc" action="edit_ok.php" onsubmit="return sendit()">

				<input type="hidden" name="rtdept2Code" value="<?php echo $rtdept2Code ?>">

				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 부서</label>
						<div class="col-sm-10">
						<?php
							$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
							$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
							//$row = mysqli_fetch_assoc($result);
							//$cnt = mysqli_num_rows($result);
						?>
							<select class="custom-select rounded-0" name="parentsCode">
								<option value="">선택하세요</option>
						<?php
							while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
						?>
								<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"
								<?php 
									if ($row['parentsCode'] == $row_rtdept1['rtdept1Code']){
										echo "selected";
									}
								?>><?php echo $row_rtdept1['rtdept1Name']?></option>
						<?php
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 분반</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="rtdept2Name" maxlength="50" value="<?php echo $row['rtdept2Name'] ?>">
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
