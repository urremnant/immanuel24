<?php
	include "../include/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>렘넌트서밋위원회</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="/plugins/fullcalendar/main.css">

  <style type="text/css" media="print">
	table.breakpoint{
		page-break-after: always;
		page-break-inside: avoid;
	}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
<?php
	$sql = "select (case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID, a.photofilename, a.korname, a.job, b.rtdept2Name, a.mobile, a.address, a.prayertopic, a.vision, a.schoolinfo, family1_korname, family1_korchurchPosition, family1_mobile, family2_korname, family2_korchurchPosition, family2_mobile from member a, rtdept2 b where a.rtdept2Code = b.rtdept2Code and a.rtdept1Code = 'D10004' and left(a.memberID,1) <> 'P' and a.rtdept2Code <> ''  order by a.rtdept2Code, newMemberID, a.korname";
	$result = mysqli_query($conn, $sql);
	
	$i = 0;
	$firstCheck = "";
	while ($row = mysqli_fetch_assoc($result)) {
		switch(substr($row['newMemberID'],0,1)){
		case "B":
				if ($firstCheck == ""){
					$i=0;
					$firstCheck = "Y";
					echo "<table><tr><td></td></tr></table>";
					$rtdept2Name = $row['rtdept2Name'];
				}else{
					$i=0;
					if ($rtdept2Name == ""){
						$rtdept2Name = $row['rtdept2Name'];
					}
					if ($rtdept2Name == $row['rtdept2Name']){
						echo "<table><tr><td></td></tr></table>";
						$i=1;
					}else{
						echo "<table class='breakpoint'><tr><td></td></tr></table>";
						$rtdept2Name = $row['rtdept2Name'];
					}
				}

?>
				<div class="card card-primary card-outline">
					<table class="table">
						<tr>
						  <td rowspan="4" style="width:20%">
							<?php
								If ($row['photofilename'] <> "") {
									//파일이 존재하는지 체크
									$filePathCheck = "../upload/".$row['photofilename'];
									//echo $filePathCheck;
									if (file_exists($filePathCheck)){
							?>
										<img src="../upload/<?php echo $row['photofilename']?>" width="100">
							<?php
									}
								}
							?>
						  </td>
						  <td style="width:15%">이름</td>
						  <td style="width:25%"><b><?php echo $row['korname']?></b></td>
						  <td style="width:15%">담당</td>
						  <td style="width:25%"><?php echo $row['rtdept2Name']?> 담임</td>
						</tr>
						<tr>
						  <td>직업</td>
						  <td><?php echo $row['job']?></td>
						  <td>연락처</td>
						  <td colspan="2"><?php echo $row['mobile']?></td>
						</tr>
						<tr>
						  <td>주소</td>
						  <td colspan="3"><?php echo $row['address']?></td>
						</tr>
						<tr>
						  <td colspan="4"><?php echo str_replace("\r\n", "<br>", $row['prayertopic']) ?></td>
						</tr>
					</table>
				</div>
<?php
			$i = $i + 1;
			break;
		case "C":
			If (($i%5)==0){
					echo "<table class='breakpoint'><tr><td></td></tr></table>";
			}
?>
				<div class="card card-primary card-outline">
					<table class="table">
						<tr>
						  <td rowspan="4" style="width:20%">
							<?php
								If ($row['photofilename'] <> "") {
									//파일이 존재하는지 체크
									$filePathCheck = "../upload/".$row['photofilename'];
									//echo $filePathCheck;
									if (file_exists($filePathCheck)){
							?>
										<img src="../upload/<?php echo $row['photofilename']?>" width="100">
							<?php
									}
								}
							?>
						  </td>
						  <td style="width:10%">이름</td>
						  <td style="width:10%"><b><?php echo $row['korname']?></b></td>
						  <td style="width:10%">학교</td>
						  <td style="width:20%"><?php echo $row['schoolinfo']?></td>
						  <td style="width:10%">비전</td>
						  <td style="width:20%"><?php echo $row['vision']?></td>
						</tr>
						<tr>
						  <td>부모</td>
						  <td colspan="5">
							<?php
								if ($row['family1_korname'] != ""){
									echo $row['family1_korname']." ".$row['family1_korchurchPosition']." ".$row['family1_mobile'];
								}
								if ($row['family2_korname'] != ""){
									echo " / ".$row['family2_korname']." ".$row['family2_korchurchPosition']." ".$row['family2_mobile'];
								}
							?>
						  </td>
						</tr>
						<tr>
						  <td>주소</td>
						  <td colspan="5"><?php echo $row['address']?></td>
						</tr>
						<tr>
						  <td colspan="6"><?php echo str_replace("\r\n", "<br>", $row['prayertopic']) ?></td>
						</tr>
					</table>
				</div>
<?php
			$i = $i + 1;
			break;
		}
	}
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

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js//pages/dashboard.js"></script>
<!-- bs-custom-file-input -->
<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- date-range-picker -->
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/fullcalendar/main.js"></script>
<script>
$(function () {
	bsCustomFileInput.init();
	$('#worshipDate').datetimepicker({
		format: 'YYYY-MM-DD'
	});
});
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
</body>
</html>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>