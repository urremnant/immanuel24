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
            <h1 class="m-0">통계</h1>
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
						<h5><b>※ 예배 날짜를 선택하시고 통계보기를 클릭하시면 해당 날짜의 통계를 보실 수 있습니다.</b></h5>
					</div>
				</div>
              </div>
              <div class="card-body">
				<?php
					include "connect.php";
					$worshipDate	= trim($_REQUEST['worshipDate']);
					if ($worshipDate == ""){
						$sql_defaultWorshipDate = "select distinct(worshipDate) from apply_worship order by worshipDate desc limit 1";
						$result_defaultWorshipDate = mysqli_query($conn, $sql_defaultWorshipDate);
						$row_defaultWorshipDate = mysqli_fetch_assoc($result_defaultWorshipDate);
						$worshipDate = $row_defaultWorshipDate['worshipDate'];
					}
				?>
				<script language = "javascript">
				<!--
				function sendit(){
					if (document.rtsc.worshipDate.value == ""){
							alert("예배 날짜를 선택하여 주십시요.");
							document.rtsc.worshipDate.focus();
							return false;
					}
					document.rtsc.submit();
				}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="totalStatistic.php">
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-1 col-form-label">예배날짜</label>
							<div class="col-sm-2">
							<?php
								$sql_worshipDate = "select distinct(worshipDate) from apply_worship order by worshipDate desc";
								$result_worshipDate = mysqli_query($conn, $sql_worshipDate);
							?>
								<select class="custom-select rounded-0" name="worshipDate">
									<option value="">선택하세요</option>
							<?php
								while ($row_worshipDate = mysqli_fetch_assoc($result_worshipDate)) {
							?>
									<option value="<?php echo $row_worshipDate['worshipDate'] ?>"
									<?php
										if ($worshipDate == $row_worshipDate['worshipDate']){
											echo "selected";
										}
									?>><?php echo $row_worshipDate['worshipDate'] ?></option>
							<?php
								}
							?>
								</select>
							</div>
							<div class="col-sm-2">
								<a href="javascript:sendit();"><button type="button" class="btn btn-primary">통계보기</button></a>
							</div>
						</div>
					</div>
				</form>
				<?php
					$sql_totalcount =  "select count(idx) as totalcount from apply_worship where worshipDate = '".$worshipDate."'";
					$result_totalcount = mysqli_query($conn, $sql_totalcount);
					$row_totalcount = mysqli_fetch_assoc($result_totalcount);
//======================
// 교구별 통계
//======================
					$sql_churcharea = "select b.korParishName, count(a.idx) as churchareaCount from apply_worship a, churcharea b where a.churchareaCode = b.churchareaCode and a.worshipDate = '".$worshipDate."' group by korParishName order by b.korParishName";
					$result_churcharea = mysqli_query($conn, $sql_churcharea);
				?>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">교구별 통계</h3>
								</div>
								<div class="card-body">
									<table class="table">
									  <thead>
										<tr>
										  <th>교구</th>
										  <th>인원</th>
										  <th>그래프</th>
										  <th style="width: 100px">백분율</th>
										</tr>
									  </thead>
									  <tbody>
							<?php
								while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)){
									$width = round(($row_churcharea['churchareaCount'] / $row_totalcount['totalcount'])*100, 2);
							?>
										<tr>
										  <td><?php echo $row_churcharea['korParishName']?></td>
										  <td><?php echo $row_churcharea['churchareaCount']?></td>
										  <td>
											<div class="progress progress-xs">
											  <div class="progress-bar progress-bar-danger" style="width: <?php echo $width?>%"></div>
											</div>
										  </td>
										  <td>
											<span class="badge bg-primary"><?php echo $width?></td>
										</tr>
							<?php
								}
							?>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
				<?php
//======================
// 부서별 통계
//======================
					$sql_rtdept1 = "select b.rtdept1Name, count(a.idx) as rtdept1Count from apply_worship a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and a.worshipDate = '".$worshipDate."' group by rtdept1Name order by b.rtdept1Code";
					$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
				?>
						<div class="col-md-6">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">부서별 통계</h3>
								</div>
								<div class="card-body">
									<table class="table">
									  <thead>
										<tr>
										  <th>부서</th>
										  <th>인원</th>
										  <th>그래프</th>
										  <th style="width: 100px">백분율</th>
										</tr>
									  </thead>
									  <tbody>
							<?php
								while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)){
									$width = round(($row_rtdept1['rtdept1Count'] / $row_totalcount['totalcount'])*100, 2);
							?>
										<tr>
										  <td><?php echo $row_rtdept1['rtdept1Name']?></td>
										  <td><?php echo $row_rtdept1['rtdept1Count']?></td>
										  <td>
											<div class="progress progress-xs">
											  <div class="progress-bar progress-bar-danger" style="width: <?php echo $width?>%"></div>
											</div>
										  </td>
										  <td>
											<span class="badge bg-primary"><?php echo $width?></td>
										</tr>
							<?php
								}
							?>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
					






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
	mysqli_close($conn);
	include "footer.php";
?>
