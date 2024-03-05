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
	$viewYear	= trim($_REQUEST['viewYear']);
	$viewMonth	= trim($_REQUEST['viewMonth']);
	if (($viewYear == "")&&($viewMonth == "")) {
		# 현재 날짜의 연도와 월을 넣어준다.
		$viewYear	= date("Y");
		$viewMonth	= date("m");
	}
	# echo $viewYear."<br>";
	# echo $viewMonth."<br>";

?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

<script language = "javascript">
<!--
	function viewMonthTotal(){
		if (document.rtsc.viewYear.value == ""){
			alert("연도를 선택하여 주십시요.");
			document.rtsc.viewYear.focus();
			return false;
		}
		if (document.rtsc.viewMonth.value == ""){
			alert("월을 선택하여 주십시요.");
			document.rtsc.viewMonth.focus();
			return false;
		}
		document.rtsc.submit();
	}
//-->
</script>
<form class="form-horizontal" method ="POST" name="rtsc" action="totalMonthAll.php">
				  <div class="card-header">
						<div class="col-12">
						  <div class="form-group row">
							<div class="col-sm-2">
							<?php
								$sql_year = "select distinct(baseYear) from attendworshipcheck order by baseYear";
								$result_year = mysqli_query($conn, $sql_year);
							?>
								<select class="custom-select rounded-0" name="viewYear">
									<option value="">연도 선택</option>
							<?php
								while ($row_year = mysqli_fetch_assoc($result_year)) {
							?>
									<option value="<?php echo $row_year['baseYear'] ?>"
									<?php
										if ($viewYear == $row_year['baseYear']){
											echo " selected";
										}
									?>
									><?php echo $row_year['baseYear'] ?></option>
							<?php
								}
							?>
								</select>
							</div>

							<div class="col-sm-2">
									<select class="custom-select rounded-0" name="viewMonth">
										<option value="">월 선택</option>
										<?php
											for($i=1;$i<=9;$i++){
										?>
											<option value="<?php echo "0".$i;?>"
											<?php
												if ($viewMonth == $i){
													echo " selected";
												}
											?>><?php echo $i;?></option>
										<?php
											}
										?>
										<?php
											for($i=10;$i<=12;$i++){
										?>
											<option value="<?php echo $i;?>"
											<?php
												if ($viewMonth == $i){
													echo " selected";
												}
											?>><?php echo $i;?></option>
										<?php
											}
										?>
									</select>

							</div>
							<div class="col-sm-6">
								<a href="javascript:viewMonthTotal();" class="btn btn-primary">선택항목보기</a>
							</div>
						  </div>
						</div>
				  </div>
</form>
<?php
	$sql = "select baseYear, weekNum, worshipDate from attendbasedate where left(worshipDate,7) = '".$viewYear."-".$viewMonth."' order by worshipDate";
	$result = mysqli_query($conn, $sql);
?>
				  <div class="card-body table-responsive p-0">
					<table class="table table-bordered text-nowrap">
					  <thead>
						<tr class="text-center">
							<th rowspan="2" class="align-middle">구분</th>
							<th rowspan="2" class="align-middle">재적</th>
						<?php
							while ($row = mysqli_fetch_assoc($result)) {
						?>
								<th colspan="7"><?php echo $row['worshipDate'];?></th>
						<?php
							}
							mysqli_data_seek($result, 0);
						?>
						</tr>
						<tr class="text-center">
						<?php
							while ($row = mysqli_fetch_assoc($result)) {
						?>
							<th>대면</th>
							<th>비대면</th> 
							<th>결석</th>
							<th>조퇴</th>
							<th>미체크</th>
							<th>출석율(대면+비대면)</th>
							<th>미체크율</th>
						<?php
							}
							mysqli_data_seek($result, 0);
						?>
						</tr>
					  </thead>
					  <tbody>
					<?php
						$today = date("Y-m-d");

						$sql_dept = "select rtdept1Code, rtdept1Name from rtdept1 where parentsCode <> '' order by rtdept1Code";
						$result_dept = mysqli_query($conn, $sql_dept);
						while ($row_dept = mysqli_fetch_assoc($result_dept)) {
					?>
						<tr class="text-center">
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
						<?php
							while ($row = mysqli_fetch_assoc($result)) {
						?>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$row['weekNum']." = 'A'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 대면출석을 저장한다.
									$attendA = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$row['weekNum']." = 'B'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 비대면출석을 저장한다.
									$attendB = $row_count['count'];
								?>							
							</td> 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$row['weekNum']." = 'C'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
								?>							
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$row['weekNum']." = 'D'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
								?>							
							</td>
							<td>
								<?php
									$sql_count = "select count(memberID) as count from member where memberID not in (select a.memberID from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$row['weekNum']." <> '') and rtdept1Code = '".$row_dept['rtdept1Code']."'";
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
						<?php
							}
							mysqli_data_seek($result, 0);
						?>
						</tr>
					<?php
						}
					?>
						<tr class="text-center">
							<td>합계</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.parentsCode <> '' and DATE_FORMAT(a.inputDate, '%Y-%m-%d') <= '".$today."'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 미체크율을 계산하기 위해 부서 재적을 저장한다.
									$deptTotal = $row_count['count'];
								?>
							</td>
						<?php
							mysqli_data_seek($result, 0);
							while ($row = mysqli_fetch_assoc($result)) {
						?>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b, rtdept1 c where a.memberID = b.memberID and a.rtdept1Code = c.rtdept1Code and c.parentsCode <> '' and b.week".$row['weekNum']." = 'A'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 대면출석을 저장한다.
									$attendA = $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b, rtdept1 c where a.memberID = b.memberID and a.rtdept1Code = c.rtdept1Code and c.parentsCode <> '' and b.week".$row['weekNum']." = 'B'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
									# 출석율을 계산하기 위해 대면출석을 저장한다.
									$attendB = $row_count['count'];
								?>
							</td> 
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b, rtdept1 c where a.memberID = b.memberID and a.rtdept1Code = c.rtdept1Code and c.parentsCode <> '' and b.week".$row['weekNum']." = 'C'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b, rtdept1 c where a.memberID = b.memberID and a.rtdept1Code = c.rtdept1Code and c.parentsCode <> '' and b.week".$row['weekNum']." = 'D'";
								    $result_count = mysqli_query($conn, $sql_count);
									$row_count = mysqli_fetch_assoc($result_count);
									echo $row_count['count'];
								?>
							</td>
							<td>
								<?php
									$sql_count = "select count(d.memberID) as count from member d, rtdept1 e  where memberID not in ( select a.memberID from member a, attendworshipcheck b, rtdept1 c where a.memberID = b.memberID and a.rtdept1Code = c.rtdept1Code and c.parentsCode <> '' and b.week".$row['weekNum']." <> '') and d.rtdept1Code = e.rtdept1Code and e.parentsCode <> ''";
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
						<?php
							}
						?>
						</tr>
					  </tbody>
					</table>
				  </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bar Chart content -->
    <section class="content">
      <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">월간 출석 통계</h3>
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
		#재적
		$sql_count = "select count(memberID) as count from member where rtdept1Code = '".$row_dept['rtdept1Code']."' and DATE_FORMAT(inputDate, '%Y-%m-%d') <= '".$today."'";
		$result_count = mysqli_query($conn, $sql_count);
		$row_count = mysqli_fetch_assoc($result_count);
		If ($data_deptTotal == "") {
			$data_deptTotal = "[".$row_count['count'];
		}else{
			$data_deptTotal = $data_deptTotal.", ".$row_count['count'];
		}
	}
	mysqli_data_seek($result_dept, 0);
	$label_dept			= $label_dept."']";
	$data_deptTotal		= $data_deptTotal."]";
#	echo $label_dept."<br>";
#	echo $data_deptTotal."<br>";

#	echo mysqli_num_rows($result)."<br>";
	mysqli_data_seek($result, 0);
	while ($row = mysqli_fetch_assoc($result)) {
		If ($datasets_label == "") {
			$datasets_label = $row['worshipDate'];
		}else{
			$datasets_label = $datasets_label.",".$row['worshipDate'];
		}
	}
	mysqli_data_seek($result, 0);
	$datasets_label_array = explode(",", $datasets_label);

	while ($row = mysqli_fetch_assoc($result)) {
		while ($row_dept = mysqli_fetch_assoc($result_dept)) {
			# 대면 + 비대면
			$sql_count = "select count(a.memberID) as count from member a, attendworshipcheck b where a.memberID = b.memberID and a.rtdept1Code = '".$row_dept['rtdept1Code']."' and b.week".$row['weekNum']." in ('A', 'B')";
			$result_count = mysqli_query($conn, $sql_count);
			$row_count = mysqli_fetch_assoc($result_count);
			$attendTotal = $row_count['count'];
			If ($data_attendTotal == "") {
				$data_attendTotal = "[".$attendTotal;
			}else{
				$data_attendTotal = $data_attendTotal.",".$attendTotal;
			}
		}
		mysqli_data_seek($result_dept, 0);
		$data_attendTotal = $data_attendTotal."],";
		# echo $data_attendTotal."<br>";
	}
	# echo $data_attendTotal."<br>";
	$data_attendTotal = substr(str_replace("],,","]*[",$data_attendTotal), 0, strlen($data_attendTotal)-2)."]";
	# echo $data_attendTotal."<br>";

	$data_attendTotal_array = explode("*", $data_attendTotal);
/*
	for ($i=0; $i<count($data_attendTotal_array);$i++){
		echo $data_attendTotal_array[$i]."<br>";
	}
*/
	$color_array = array('rgba(255, 193, 7, 1)', 'rgba(255, 171, 103, 1)', 'rgba(105, 195, 209, 1)', 'rgba(162, 133, 215, 1)', 'rgba(160, 166, 171, 1)');
	$pointcolor_array = array('#ffc107', '#feab67','#69c3d1','#a285d7','a0a6ab');

?>
<script>
  $(function () {
    var areaChartData = {
	  labels  : <?php echo $label_dept; ?>,
      datasets: [
        {
          label               : '재적',
          backgroundColor     : 'rgba(40, 167, 69, 1)',
          borderColor         : 'rgba(40, 167, 69, 1)',
          pointRadius          : false,
          pointColor          : '#28A745',
          pointStrokeColor    : 'rgba(40, 167, 69, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(40, 167, 69, 1)',
		  data				  : <?php echo $data_deptTotal; ?>
        },
<?php	
	for ($i=0; $i<count($data_attendTotal_array);$i++){
?>
	    {
          label               : <?php echo "'".$datasets_label_array[$i]."'"; ?>,
          backgroundColor     : <?php echo "'".$color_array[$i]."'"; ?>,
          borderColor         : <?php echo "'".$color_array[$i]."'"; ?>,
          pointRadius          : false,
          pointColor          : <?php echo "'".$pointcolor_array[$i]."'"; ?>,
          pointStrokeColor    : <?php echo "'".$color_array[$i]."'"; ?>,
          pointHighlightFill  : '#fff',
          pointHighlightStroke: <?php echo "'".$color_array[$i]."'"; ?>,
		  data				  : <?php echo $data_attendTotal_array[$i]; ?>
        },
<?php
	}
?>
      ]
    }
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0

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