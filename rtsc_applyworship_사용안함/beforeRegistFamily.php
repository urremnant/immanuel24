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
						<h5><b>가족 등록시 유의사항</b></h5>
					</div>
				</div>
              </div>
              <div class="card-body">
				<p><b>1. <font color="blue">가족 등록은 최초 1회만 하시면 됩니다.</font></p>
				<p>본인 포함 가족 전체 인원수를 선택하신 후 가족등록을 진행하여 주세요.</p>
				<script language = "javascript">
				<!--
				function sendit(){
					if (document.rtsc.familyCount.value == ""){
							alert("등록할 가족 인원수를 선택하여 주십시요.");
							document.rtsc.familyCount.focus();
							return false;
					}
					document.rtsc.submit();
				}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="registFamily.php">
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-1 col-form-label">인원</label>
							<div class="col-sm-2">
								<select class="custom-select rounded-0" name="familyCount">
									<option value="">선택하세요</option>
									<?php
										for($i=2;$i<=15;$i++){
									?>
										<option value="<?php echo $i;?>"><?php echo $i;?></option>
									<?php
										}
									?>
								</select>
							</div>
							<label class="col-sm-1 col-form-label">명</label>
							<div class="col-sm-2">
								<a href="javascript:sendit();"><button type="button" class="btn btn-primary">가족 등록 시작하기</button></a>
							</div>
						</div>
					</div>
				</form>
				<p>2. 가족 정보의 조회, 추가, 수정, 삭제는 좌측 '<i class="fas fa-info-circle"></i> 나의 가족정보' 메뉴를 이용하여 주세요.</p>
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
