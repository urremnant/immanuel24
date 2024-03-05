<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>렘넌트서밋위원회</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>아이디 검색하기</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<?php
	include "../include/connect.php";

	$gubun = trim($_REQUEST['gubun']);
	$korname = trim($_REQUEST['korname']);
//	echo $gubun."<br>";
//	echo $korname;

	$sql = "select a.memberID, a.korname, b.korChurchPosition from member a, churchPosition b where a.churchPositionCode = b.churchPositionCode and a.korname like '%".$korname."%'";
//	echo $sql;
	$result = mysqli_query($conn, $sql);
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

				<script language = "javascript">
				<!--
				function searchMemberID(memberID){
					window.parent.opener.document.rtsc.<?php echo $gubun;?>.value = memberID;
					this.close();
				}
				-->
				</script>

                <div class="card-body">
                  <div class="form-group row">
				      <div class="col-sm-12">
					  <div class="form-group">
                        <label>※ 성함을 클릭하면 자동으로 아이디가 입력됩니다.</label>
						<p></p>
						<?php
							while ($row = mysqli_fetch_assoc($result)) {
						?>
								<a href="javascript:searchMemberID('<?php echo $row['memberID'] ?>')">
								<?php echo $row['korname']." ".$row['korChurchPosition']."(".$row['memberID'].")" ?></a><br>
						<?php
							}
							$count = mysqli_num_rows($result);
							if ($count == 0){
								echo "<br><br><font color='blue'>데이터가 없습니다.</font><br><br>";
							}
						?>
                      </div>
					  </div>
                  </div>
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

<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>

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
