<?php
	include "../include/header.php";
	include "../include/Navbar.php";
	include "../include/leftMenu.php";
?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

<?php
	include "../include/connect.php";

	$today = date("Y-m-d");
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

   <!-- Main content-->
    <section class="content" style="padding-top:10px">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

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
            <!-- /.card --> 

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">지난주(<?php echo $worshipDate;?>) 출석 통계</h3>
              </div>
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
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'A' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 대면출석을 저장한다.
									$attendA = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'B' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 비대면출석을 저장한다.
									$attendB = $row_count['count'];
								?>
							</td> 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'C' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
								?>							
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$weekNum." = 'D' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
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
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'A' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
									# 출석율을 계산하기 위해 대면출석을 저장한다.
									$attendAall = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'B' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
									# 출석율을 계산하기 위해 비대면출석을 저장한다.
									$attendBall = $row_count['count'];
								?>
							</td> 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'C' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
								?>							
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." = 'D' and b.baseYear = DATE_FORMAT('".$today."', '%Y')";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo "<b>".$row_count['count']."</b>";
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') and b.week".$weekNum." <> '') and rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <> '') ";
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
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 



            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">부서별 통계</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart_dept" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 
 
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">교구별 통계</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart_churcharea" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 




          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content 2 -->

    
    

  </div>
  <!-- /.content-wrapper -->
<?php
	include "../include/footer.php";

//======================
// 출석 통계
//======================

	$sql_dept = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' and rtdept1Code not in ('D10009') order by rtdept1Code";
// 대학국 제외( 2024.02.09 )
	$result_dept = mysqli_query($conn, $sql_dept);
	while ($row_dept = mysqli_fetch_assoc($result_dept)) {
		If ($label_dept_attendCheck == "") {
			$label_dept_attendCheck = "['".$row_dept['rtdept1Name'];
		}else{
			$label_dept_attendCheck = $label_dept_attendCheck."', '".$row_dept['rtdept1Name'];
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
	$label_dept_attendCheck		= $label_dept_attendCheck."']";
	$data_A						= $data_A."]";
	$data_B						= $data_B."]";
	$data_C						= $data_C."]";
	$data_D						= $data_D."]";
	$data_notCheck				= $data_notCheck."]";

//======================
// 교구별 통계
//======================
	$sql_churcharea = "select churchareaCode, korChurchAreaName, korParishName from churcharea order by korParishName";
	$result_churcharea = mysqli_query($conn, $sql_churcharea);
	while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
		If ($label_churcharea == "") {
			$label_churcharea = "['".$row_churcharea['korParishName'];
		}else{
			$label_churcharea = $label_churcharea."', '".$row_churcharea['korParishName'];
		}
	}
	$label_churcharea = $label_churcharea."']";
//	echo $label_churcharea;

	$sql_churcharea_group_teacher = "select b.korParishName, count(a.memberID) as memberID_count from member a, churcharea b where a.churchareaCode = b.churchareaCode and memberID like 'T%' and rtdept1Code not in ('D99998', 'D99999') group by korParishName";
	$result_churcharea_group_teacher = mysqli_query($conn, $sql_churcharea_group_teacher);
	while ($row_churcharea_group_teacher = mysqli_fetch_assoc($result_churcharea_group_teacher)) {
		If ($data_churcharea_group_teacher == "") {
			$data_churcharea_group_teacher = "[".$row_churcharea_group_teacher['memberID_count'];
		}else{
			$data_churcharea_group_teacher = $data_churcharea_group_teacher.", ".$row_churcharea_group_teacher['memberID_count'];
		}
	}
	$data_churcharea_group_teacher = $data_churcharea_group_teacher."]";
//	echo $data_churcharea_group_teacher;

	$sql_churcharea_group_remnant = "select b.korParishName, count(a.memberID) as memberID_count from member a, churcharea b where a.churchareaCode = b.churchareaCode and memberID like 'R%' and rtdept1Code not in ('D99998', 'D99999') group by korParishName";
	$result_churcharea_group_remnant = mysqli_query($conn, $sql_churcharea_group_remnant);
	while ($row_churcharea_group_remnant = mysqli_fetch_assoc($result_churcharea_group_remnant)) {
		If ($data_churcharea_group_remnant == "") {
			$data_churcharea_group_remnant = "[".$row_churcharea_group_remnant['memberID_count'];
		}else{
			$data_churcharea_group_remnant = $data_churcharea_group_remnant.", ".$row_churcharea_group_remnant['memberID_count'];
		}
	}
	$data_churcharea_group_remnant = $data_churcharea_group_remnant."]";
//	echo $data_churcharea_group_remnant;

	$sql_churcharea_group_pastor = "select a.korParishName, count(b.memberID) as memberID_count from churcharea a left outer join member b on a.churchareaCode = b.churchareaCode and b.rtdept1Code not in ('D99998', 'D99999') and b.memberID like 'P%' group by a.korParishName";
	$result_churcharea_group_pastor = mysqli_query($conn, $sql_churcharea_group_pastor);
	while ($row_churcharea_group_pastor = mysqli_fetch_assoc($result_churcharea_group_pastor)) {
		If ($data_churcharea_group_pastor == "") {
			$data_churcharea_group_pastor = "[".$row_churcharea_group_pastor['memberID_count'];
		}else{
			$data_churcharea_group_pastor = $data_churcharea_group_pastor.", ".$row_churcharea_group_pastor['memberID_count'];
		}
	}
	$data_churcharea_group_pastor = $data_churcharea_group_pastor."]";
//	echo $data_churcharea_group_pastor;

//======================
// 부서별 통계
//======================
	$sql_dept = "select rtdept1Name from rtdept1 where rtdept1Code like 'D1%' and rtdept1Code not in ('D10009') order by rtdept1Code";
// 대학국 제외( 2024.02.09 )
	$result_dept = mysqli_query($conn, $sql_dept);
	while ($row_dept = mysqli_fetch_assoc($result_dept)) {
		If ($label_dept == "") {
			$label_dept = "['".$row_dept['rtdept1Name'];
		}else{
			$label_dept = $label_dept."', '".$row_dept['rtdept1Name'];
		}
		$sql_dept_group_teacher = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'T%'";
		$result_dept_group_teacher = mysqli_query($conn, $sql_dept_group_teacher);
		$row_dept_group_teacher = mysqli_fetch_assoc($result_dept_group_teacher);
		If ($data_dept_group_teacher == "") {
			$data_dept_group_teacher = "[".$row_dept_group_teacher['cnt'];
		}else{
			$data_dept_group_teacher = $data_dept_group_teacher.", ".$row_dept_group_teacher['cnt'];
		}
		$sql_dept_group_remnant = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'R%'";
		$result_dept_group_remnant = mysqli_query($conn, $sql_dept_group_remnant);
		$row_dept_group_remnant = mysqli_fetch_assoc($result_dept_group_remnant);
		If ($data_dept_group_remnant == "") {
			$data_dept_group_remnant = "[".$row_dept_group_remnant['cnt'];
		}else{
			$data_dept_group_remnant = $data_dept_group_remnant.", ".$row_dept_group_remnant['cnt'];
		}
		$sql_dept_group_pastor = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'P%'";
		$result_dept_group_pastor = mysqli_query($conn, $sql_dept_group_pastor);
		$row_dept_group_pastor = mysqli_fetch_assoc($result_dept_group_pastor);
		If ($data_dept_group_pastor == "") {
			$data_dept_group_pastor = "[".$row_dept_group_pastor['cnt'];
		}else{
			$data_dept_group_pastor = $data_dept_group_pastor.", ".$row_dept_group_pastor['cnt'];
		}
	}
	$label_dept = $label_dept."']";
	$data_dept_group_teacher = $data_dept_group_teacher."]";
	$data_dept_group_remnant = $data_dept_group_remnant."]";
	$data_dept_group_pastor = $data_dept_group_pastor."]";

//	echo $data_dept_group_pastor;
?>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    var areaChartData = {
	  labels  : <?php echo $label_dept_attendCheck; ?>,
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


    var areaChartData_churcharea = {
 //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	  labels  : <?php echo $label_churcharea?>,
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
		  data                : <?php echo $data_churcharea_group_teacher?>
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
		  data                : <?php echo $data_churcharea_group_remnant?>
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
		  data                : <?php echo $data_churcharea_group_pastor?>
        },
      ]
    }

    var areaChartData_dept = {
 //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	  labels  : <?php echo $label_dept?>,
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
		  data                : <?php echo $data_dept_group_teacher?>
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
		  data                : <?php echo $data_dept_group_remnant?>
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
		  data                : <?php echo $data_dept_group_pastor?>
        },
      ]
    }

	var barChartData_churcharea = $.extend(true, {}, areaChartData_churcharea)
    var stackedBarChartCanvas_churcharea = $('#stackedBarChart_churcharea').get(0).getContext('2d')
    var stackedBarChartData_churcharea = $.extend(true, {}, barChartData_churcharea)

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

    var stackedBarChart_churcharea = new Chart(stackedBarChartCanvas_churcharea, {
      type: 'bar',
      data: stackedBarChartData_churcharea,
      options: stackedBarChartOptions
    })

    var stackedBarChart_dept = new Chart(stackedBarChartCanvas_dept, {
      type: 'bar',
      data: stackedBarChartData_dept,
      options: stackedBarChartOptions
    })
  })
</script>
