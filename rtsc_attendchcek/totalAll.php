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
            <h1 class="m-0">렘넌트서밋위원회</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Bar Chart content -->
    <section class="content">
      <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">출석 통계</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
		  </div>
		</div>
      </div><!-- /.container-fluid -->
    </section>
	<!-- Bar Chart content -->

<?php
	include "../include/connect.php";
	
	$worshipDate = trim($_REQUEST['worshipDate']);

	if ($worshipDate == "") {
		# 현재 날짜 주간의 일요일 날짜 구하기
		$sql_weekSunday = "SELECT DATE_ADD(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE())-1) * -1 DAY) as weekSunday";
		$result_weekSunday = mysqli_query($conn, $sql_weekSunday);
		$row_weekSunday = mysqli_fetch_assoc($result_weekSunday);
		$worshipDate = $row_weekSunday['weekSunday'];
	}
	# 해당날짜가 몇주차인지 구하기
	$sql_weekNum = "select weekNum from attendbasedate where worshipDate = '".$worshipDate."'";
	$result_weekNum = mysqli_query($conn, $sql_weekNum);
	$row_weekNum = mysqli_fetch_assoc($result_weekNum);
	$weekNum = $row_weekNum['weekNum'];	
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
				<div class="card-header">
					<i class="fas fa-map-marker-alt"></i><b> 전체출석통계</b>
				</div>
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
				<form class="form-horizontal" method ="POST" name="rtsc" action="totalAll.php">
				<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-1 col-form-label">예배날짜</label>
								<div class="col-sm-2">
								<?php
									# 현재 년도와 날짜를 구한다.
									$today = date("Y-m-d");
									# $sql_worshipDate = "select worshipDate from attendbasedate where baseYear = '".substr($today,0,4)."' and worshipDate <= '".$today."' order by worshipDate";
									$sql_worshipDate = "select worshipDate from attendbasedate where worshipDate <= '".$today."' order by worshipDate desc";
									# echo $sql_worshipDate;
									$result_worshipDate = mysqli_query($conn, $sql_worshipDate);
								?>
								<select id="worshipDate" name="worshipDate" class="form-control">
									<option value="">날짜 선택</option>
									<?php
										while ($row_worshipDate = mysqli_fetch_assoc($result_worshipDate)) {
									?>
										<option value="<?php echo $row_worshipDate['worshipDate'] ?>"
										<?php
											if ($row_worshipDate['worshipDate'] == $worshipDate){
												echo " selected";
											}
										?>
										><?php echo $row_worshipDate['worshipDate'] ?></option>
									<?php
										}
									?>
								</select>
								</div>
								<div class="col-sm-2">
									<a href="javascript:sendit();"><button type="button" class="btn btn-primary">출석통계보기</button></a>
								</div>
						</div>
				</div>
				</form>

				<div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					  <thead>
						<tr>
							<th>부서</th>
							<th>재적</th>	 
							<th>대면</th>
							<th>비대면</th> 
							<th>결석</th>
							<th>조퇴</th>
							<th>미체크</th>
							<th>출석율(대면+비대면)</th>
							<th>미체크율</th>
						</tr>
					  </thead>
					  <tbody>
					  <?php
						$sql_dept = "select rtdept1Code, rtdept1Name from rtdept1 where parentsCode <> '' order by rtdept1Code";
						$result_dept = mysqli_query($conn, $sql_dept);
						while ($row_dept = mysqli_fetch_assoc($result_dept)) {
					  ?>
						<tr>
							<td><?php echo $row_dept['rtdept1Name'];?></td>
							<td>
								<?php
									$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$row_dept['rtdept1Code']."' and DATE_FORMAT(inputDate, '%Y-%m-%d') <= '".$today."'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 미체크율을 계산하기 위해 부서 재적을 저장한다.
									$deptTotal = $row_count['count'];
								?>
							</td>	 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'A'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 대면출석을 저장한다.
									$attendA = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'B'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 비대면출석을 저장한다.
									$attendB = $row_count['count'];
								?>
							</td> 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'C'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
								?>							
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'D'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." <> '') and rtdept1Code = '".$row_dept['rtdept1Code']."'";
									# echo $sql_count;
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 미체크율을 저장하기 위해 미체크숫자를 저장한다.
									$notCheck = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$attendAB = $attendA + $attendB;
									if ($attendAB == 0){
										echo "(0%)";
									}else{
										$attendABPercent = round(($attendAB / $deptTotal)*100, 2);
										echo "<button class='btn btn-sm btn-success'>".$attendABPercent."%</button>";
									}
								?>
							</td>
							<td>
								<?php
									if ($notCheck == 0){
										echo "(0%)";
									}else{
										$notCheckPercent = round(($notCheck / $deptTotal)*100, 2);
										echo "<button class='btn btn-sm btn-danger'>".$notCheckPercent."%</button>";
									}
								?>
							</td>
						</tr>
					  <?php
						}
					  ?>
						<tr>
							<td><b>합계</b></td>
							<td>
								<?php
									$sql_count = "select count(memberID) as count from member where rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and DATE_FORMAT(inputDate, '%Y-%m-%d') <= '".$today."'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
									# 미체크율을 계산하기 위해 부서 재적을 저장한다.
									$deptAllTotal = $row_count['count'];
								?>
							</td>	 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'A'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
									# 출석율을 계산하기 위해 대면출석을 저장한다.
									$attendAall = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'B'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
									# 출석율을 계산하기 위해 비대면출석을 저장한다.
									$attendBall = $row_count['count'];
								?>
							</td> 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'C'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
								?>							
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'D'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." <> '') and rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '')";
									# echo $sql_count;
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
									# 미체크율을 저장하기 위해 미체크숫자를 저장한다.
									$notAllCheck = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$attendABall = $attendAall + $attendBall;
									if ($attendABall == 0){
										echo "(0%)";
									}else{
										$attendABallPercent = round(($attendABall / $deptAllTotal)*100, 2);
										echo "<button class='btn btn-sm btn-success'>".$attendABallPercent."%</button>";
									}
								?>
							</td>
							<td>
								<?php
									if ($notAllCheck == 0){
										echo "(0%)";
									}else{
										$notAllCheckPercent = round(($notAllCheck / $deptAllTotal)*100, 2);
										echo "<button class='btn btn-sm btn-danger'><b>".$notAllCheckPercent."%</b></button>";
									}
								?>
							</td>
						</tr>
					  </tbody>
					</table>
				</div>
            </div>
            <!-- /.card -->
          </div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->
<?php
	include "../include/footer.php";

	$sql_dept = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
	$result_dept = mysqli_query($conn, $sql_dept);
	while ($row_dept = mysqli_fetch_assoc($result_dept)) {
		If ($label_dept == "") {
			$label_dept = "['".$row_dept['rtdept1Name'];
		}else{
			$label_dept = $label_dept."', '".$row_dept['rtdept1Name'];
		}

		# 대면
		$sql_A = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'A'";	
		$result_A = mysqli_query($conn, $sql_A);
		$row_A = mysqli_fetch_assoc($result_A);
		If ($data_A == "") {
			$data_A = "[".$row_A['count'];
		}else{
			$data_A = $data_A.", ".$row_A['count'];
		}

		# 비대면
		$sql_B = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'B'";
		$result_B = mysqli_query($conn, $sql_B);
		$row_B = mysqli_fetch_assoc($result_B);
		If ($data_B == "") {
			$data_B = "[".$row_B['count'];
		}else{
			$data_B = $data_B.", ".$row_B['count'];
		}
		
		# 결석
		$sql_C = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'C'";	
		$result_C = mysqli_query($conn, $sql_C);
		$row_C = mysqli_fetch_assoc($result_C);
		If ($data_C == "") {
			$data_C = "[".$row_C['count'];
		}else{
			$data_C = $data_C.", ".$row_C['count'];
		}

		# 조퇴
		$sql_D = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'D'";
		$result_D = mysqli_query($conn, $sql_D);
		$row_D = mysqli_fetch_assoc($result_D);
		If ($data_D == "") {
			$data_D = "[".$row_D['count'];
		}else{
			$data_D = $data_D.", ".$row_D['count'];
		}

		# 미체크
		$sql_notCheck = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." <> '') and rtdept1Code = '".$row_dept['rtdept1Code']."'";
		$result_notCheck = mysqli_query($conn, $sql_notCheck);
		$row_notCheck = mysqli_fetch_assoc($result_notCheck);
		If ($data_notCheck == "") {
			$data_notCheck = "[".$row_notCheck['count'];
		}else{
			$data_notCheck = $data_notCheck.", ".$row_notCheck['count'];
		}

	}
	$label_dept		= $label_dept."']";
	$data_A			= $data_A."]";
	$data_B			= $data_B."]";
	$data_C			= $data_C."]";
	$data_D			= $data_D."]";
	$data_notCheck	= $data_notCheck."]";
	# echo $label_dept."<br>";
	# echo $data_A."<br>";
	# echo $data_B."<br>";
	# echo $data_C."<br>";
	# echo $data_D."<br>";
	# echo $data_notCheck."<br>";
?>
<script>
  $(function () {
    var areaChartData = {
	  labels  : <?php echo $label_dept; ?>,
      datasets: [
        {
          label               : '대면예배',
          backgroundColor     : 'rgba(40, 167, 69, 1)',
          borderColor         : 'rgba(40, 167, 69, 1)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(40, 167, 69, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(40, 167, 69, 1)',
		  data				  : <?php echo $data_A; ?>
        },
        {
          label               : '비대면예배',
          backgroundColor     : 'rgba(23, 162, 184, 1)',
          borderColor         : 'rgba(23, 162, 184, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(23, 162, 184, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(23, 162, ,1)',
		  data				  : <?php echo $data_B; ?>
        },
        {
          label               : '결석',
          backgroundColor     : 'rgba(220, 53, 69, 1)',
          borderColor         : 'rgba(220, 53, 69, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(220, 53, 69, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220, 53, 69, 1)',
		  data				  : <?php echo $data_C; ?>
        },
        {
          label               : '조퇴',
          backgroundColor     : 'rgba(255, 193, 7, 1)',
          borderColor         : 'rgba(255, 193, 7, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(255, 193, 7, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 193, 7, 1)',
		  data				  : <?php echo $data_D; ?>
        },
        {
          label               : '미체크',
          backgroundColor     : 'rgba(108, 117, 125, 1)',
          borderColor         : 'rgba(108, 117, 125, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(108, 117, 125, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(108, 117, 125, 1)',
		  data				  : <?php echo $data_notCheck; ?>
        },
      ]
    }
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    var temp2 = areaChartData.datasets[2]
    var temp3 = areaChartData.datasets[3]
    var temp4 = areaChartData.datasets[4]
    barChartData.datasets[0] = temp0
    barChartData.datasets[1] = temp1
    barChartData.datasets[2] = temp2
    barChartData.datasets[3] = temp3
    barChartData.datasets[4] = temp4

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
  })

</script>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>