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
	$sql = "select memberID, a.photofilename, a.korname, a.gender, a.job, b.rtdept2Name, a.mobile, a.email, a.address, a.prayertopic, d.korParishName from member a, rtdept2 b, churchPosition c, churcharea d, country e where a.rtdept2Code = b.rtdept2Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode and a.countryCode = e.countryCode and a.rtdept1Code = 'D10006' and left(a.memberID,1) = 'T' and a.rtdept2Code <> '' order by a.rtdept2Code, a.korname";
	$result = mysqli_query($conn, $sql);
	
	$i = 0;
	$firstCheck = "Y";
	while ($row = mysqli_fetch_assoc($result)) {
			if ($firstCheck == "Y"){
				echo "<table><tr><td></td></tr></table>";
				$firstCheck = "N";
			}else{
				If (($i%4)==0){
					echo "<table class='breakpoint'><tr><td></td></tr></table>";
				}else{
					echo "<table><tr><td></td></tr></table>";
				}
			}
?>
				<div class="card card-primary card-outline">
				  <div class="card-body">
					<table class="table">
					  <tbody>
						<tr>
						  <td rowspan="5" style="width:30%">
							<?php
								If ($row['photofilename'] <> "") {
									//파일이 존재하는지 체크
									$filePathCheck = "../upload/".$row['photofilename'];
									//echo $filePathCheck;
									if (file_exists($filePathCheck)){
							?>
										<img src="../upload/<?php echo $row['photofilename']?>" width="200">
							<?php
									}
								}
							?>
						  </td>
						  <td style="width:10%">이름</td>
						  <td style="width:15%"><b><?php echo $row['korname']?></b></td>
						  <td style="width:10%">성별</td>
						  <td style="width:10%">
							<?php
								switch ($row['gender']){
								case "M":
									echo "남";
									break;
								case "F":
									echo "여";
									break;
								}
							?>
						  </td>
						  <td style="width:10%">교구</td>
						  <td style="width:15%"><?php echo $row['korParishName']?></td>
						</tr>
						<tr>
						  <td>주소</td>
						  <td colspan="5"><?php echo $row['address']?></td>
						</tr>
						<tr>
						  <td>직업</td>
						  <td colspan="2"><?php echo $row['job']?></td>
						  <td>직분</td>
						  <td colspan="2"><?php echo $row['korChurchPosition']?></td>
						</tr>
						<tr>
						  <td>연락처</td>
						  <td colspan="2"><?php echo $row['mobile']?></td>
						  <td>이메일</td>
						  <td colspan="2"><?php echo $row['email']?></td>
						</tr>
						<tr>
						  <td colspan="6"><?php echo str_replace("\r\n", "<br>", $row['prayertopic']) ?></td>
						</tr>
					  </tbody>
					</table>
				  </div>
				</div>
<?php
			$i = $i + 1;
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