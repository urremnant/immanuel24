<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>언약의 여정 입력</title>

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
</head>
<body>

<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>교인번호 찾기</h1>※ 성명을 클릭하면 자동으로 값이 들어갑니다.
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
				<div class="form-group">
				

<?php
	include "../include/connect.php";

	$korname	= trim($_REQUEST['korname']);
	$sql = "select myNo, korname, birthday, mobile, korChurcharea, korChurchposition, gender, churchareaCode, churchPositionCode from churchregistsystem where korname like '%".$korname."%'";
	$result = mysqli_query($conn, $sql);
	$total_rows = mysqli_num_rows($result);
  	if ($total_rows == 0) {
?>
		<script language = "javascript">
		<!--
			alert("해당 자료가 없습니다.");
			self.close();
		-->
		</script>
<?php
	}else{
?>
		<script language = "javascript">
		<!--
		function selectMyNo(myNo, korname, birthday, mobile, gender, churchareaCode, churchPositionCode){
			window.parent.opener.document.rtsc.myNo.value = myNo;
			window.parent.opener.document.rtsc.korname.value = korname;
			if (birthday != ""){
				var birthyear	= birthday.substring(0,4);
				var birthmonth	= birthday.substring(5,7);
				var birthday	= birthday.substring(8,10);
				window.parent.opener.document.rtsc.birthyear.value	= birthyear;
				window.parent.opener.document.rtsc.birthmonth.value	= birthmonth;
				window.parent.opener.document.rtsc.birthday.value	= birthday;
			}
			mobile = mobile.replaceAll('-','');
			window.parent.opener.document.rtsc.mobile.value = mobile;
			if (gender == "M"){
				window.parent.opener.document.rtsc.gender[0].checked=true;
			}else if (gender == "F"){
				window.parent.opener.document.rtsc.gender[1].checked=true;
			}
			window.parent.opener.document.rtsc.churchareaCode.value = churchareaCode;
			window.parent.opener.document.rtsc.churchPositionCode.value = churchPositionCode;
			this.close();
		}
		-->
		</script>
	  <div class="box">
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>성명</th>
			  <th>생년월일</th>
			  <th>핸드폰</th>
			  <th>교구</th>
			</tr>
		<?php
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>
			  <td><a href="javascript:selectMyNo('<?php echo $row['myNo'];?>', '<?php echo $row['korname'];?>', '<?php echo $row['birthday'];?>', '<?php echo $row['mobile'];?>', '<?php echo $row['gender'];?>', '<?php echo $row['churchareaCode'];?>', '<?php echo $row['churchPositionCode'];?>')"><?php echo $row['korname'];?></a></td>
			  <td><?php echo $row['birthday'];?></td>
			  <td><?php echo $row['mobile'];?></td>
			  <td><?php echo $row['korChurcharea'];?></td>
			</tr>
		<?php
			}
		?>

		  </table>
		</div>
	  </div>
<?php
	}
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
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
</div>

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
<!-- bs-custom-file-input -->
<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
 
</body>
</html>
