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

<?php
	include "../include/connect.php";

	$worshipDate = trim($_REQUEST['worshipDate']);
	$total_rtdept1Code = trim($_REQUEST['total_rtdept1Code']);
	if ($worshipDate == "") {
		# 현재 날짜 주간의 일요일 날짜 구하기
		$sql_weekSunday = "SELECT DATE_ADD(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE())-1) * -1 DAY) as weekSunday";
		$result_weekSunday = mysqli_query($conn, $sql_weekSunday);
		$row_weekSunday = mysqli_fetch_assoc($result_weekSunday);
		$worshipDate = $row_weekSunday['weekSunday'];
	}
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
				<div class="card-header">
					<i class="fas fa-map-marker-alt"></i><b> 부서별 출석 Bar Chart</b>
				</div>
				<script language = "javascript">
				<!--
					function sendit(){
						if (document.rtsc.total_rtdept1Code.value == ""){
							alert("부서를 선택하여 주십시요.");
							document.rtsc.total_rtdept1Code.focus();
							return false;
						}
						document.rtsc.submit();
					}
				//-->
				</script>
				<form class="form-horizontal" method ="POST" name="rtsc" action="totalBarChart.php">
				<div class="card-body">
						<div class="form-group row">
								<div class="col-sm-2">
								<select id="total_rtdept1Code" name="total_rtdept1Code" class="form-control">
									<option value="">부서 선택</option>
								<?php
									$sql_dept = "select rtdept1Code, rtdept1Name from rtdept1 where parentsCode <> '' order by rtdept1Code";
									$result_dept = mysqli_query($conn, $sql_dept);
									while ($row_dept = mysqli_fetch_assoc($result_dept)) {
								?>
										<option value="<?php echo $row_dept['rtdept1Code'] ?>"
										<?php
											if ($row_dept['rtdept1Code'] == $total_rtdept1Code){
												echo " selected";
											}
										?>
										><?php echo $row_dept['rtdept1Name'] ?></option>
								<?php
									}
								?>
								</select>
								</div>
								<div class="col-sm-2">
									<a href="javascript:sendit();"><button type="button" class="btn btn-primary">Bar Chart 보기</button></a>
								</div>
						</div>
				</div>
				</form>
<?php
	if ($total_rtdept1Code <> "") {
		# 부서명 셋팅
		$sql_deptName = "select rtdept1Name from rtdept1 where rtdept1Code = '".$total_rtdept1Code."'";
		$result_deptName = mysqli_query($conn, $sql_deptName);
		$row_deptName = mysqli_fetch_assoc($result_deptName);
?>
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"><?php echo $row_deptName['rtdept1Name'];?></h3>
						</div>
						<div class="card-body">
							<div class="chart">
							  <canvas id="stackedBarChart_dept" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
							</div>
						</div>
					</div>
				</div>
<?php
	}
?>
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
	if ($total_rtdept1Code <> "") {
		# 현재 년도와 날짜를 구한다.
		$today = date("Y-m-d");
		$sql_worshipDate = "select weekNum, worshipDate from attendbasedate where baseYear = '".substr($today,0,4)."' and worshipDate <= '".$today."' order by worshipDate";
		# echo $sql_worshipDate;
		$result_worshipDate = mysqli_query($conn, $sql_worshipDate);
		while ($row_worshipDate = mysqli_fetch_assoc($result_worshipDate)){
			If ($label_worshipDate == "") {
				$label_worshipDate = "['".$row_worshipDate['worshipDate'];
			}else{
				$label_worshipDate = $label_worshipDate."', '".$row_worshipDate['worshipDate'];
			}
		}
		$label_worshipDate = $label_worshipDate."']";
		# echo $label_worshipDate;
		mysqli_data_seek($result_worshipDate, 0);


		while ($row_worshipDate = mysqli_fetch_assoc($result_worshipDate)){
			# 교역자 출석인원
			$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'P%' and b.week".$row_worshipDate['weekNum']." in ('A','B')";
			$result_count = mysqli_query($conn, $sql_count);
			$row_count = mysqli_fetch_assoc($result_count);
			If ($data_pastor == "") {
				$data_pastor = "[".$row_count['count'];
			}else{
				$data_pastor = $data_pastor.", ".$row_count['count'];
			}

			# 교사 출석인원
			$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'T%' and b.week".$row_worshipDate['weekNum']." in ('A','B')";
			$result_count = mysqli_query($conn, $sql_count);
			$row_count = mysqli_fetch_assoc($result_count);
			If ($data_teacher == "") {
				$data_teacher = "[".$row_count['count'];
			}else{
				$data_teacher = $data_teacher.", ".$row_count['count'];
			}

			# 렘넌트 출석인원
			$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$total_rtdept1Code."' and a.memberID like 'R%' and b.week".$row_worshipDate['weekNum']." in ('A','B')";
			$result_count = mysqli_query($conn, $sql_count);
			$row_count = mysqli_fetch_assoc($result_count);
			If ($data_remnant == "") {
				$data_remnant = "[".$row_count['count'];
			}else{
				$data_remnant = $data_remnant.", ".$row_count['count'];
			}
		}
		$data_pastor	= $data_pastor."]";
		$data_teacher	= $data_teacher."]";
		$data_remnant	= $data_remnant."]";
	}
	# echo $data_pastor."<br>";
	# echo $data_teacher."<br>";
	# echo $data_remnant."<br>";
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>
<script>
  $(function () {
    var areaChartData_dept = {
	  labels  : <?php echo $label_worshipDate?>,
      datasets: [
        {
          label               : '교사',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_teacher?>
        },
        {
          label               : '렘넌트',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
//        data                : [65, 59, 80, 81, 56, 55, 40]
		  data                : <?php echo $data_remnant?>
        },
        {
          label               : '교역자',
          backgroundColor     : 'rgba(255, 0, 127, 0.9)',
          borderColor         : 'rgba(255, 0, 127, 0.8)',
          pointRadius          : false,
          pointColor          : '#FF007F',
          pointStrokeColor    : 'rgba(255, 0, 127,,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 0, 127,,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_pastor?>
        },
      ]
    }

	var barChartData_dept = $.extend(true, {}, areaChartData_dept)
    var stackedBarChartCanvas_dept = $('#stackedBarChart_dept').get(0).getContext('2d')
    var stackedBarChartData_dept = $.extend(true, {}, barChartData_dept)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }
    var stackedBarChart_dept = new Chart(stackedBarChartCanvas_dept, {
      type: 'bar',
      data: stackedBarChartData_dept,
      options: stackedBarChartOptions
    })
  })
</script>