<?php
	session_start();
	if ($_SESSION['ss_korname'] == ""){
		echo "<script>alert('세션이 끊겼습니다. 다시 로그인 하여 주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>댓글 수정</title>

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
            <h1>댓글 수정하기</h1>
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

			<script language = "javascript">
			<!--
			function sendit(){
				if (document.editReply.content.value == ""){
					alert("내용을 입력하여 주십시요.");
					return false;
				}
				return true;
			}
			//-->
			</script>

<?php
	include "../include/connect.php";

	$idx		= trim($_REQUEST['idx']);
	$board_idx	= trim($_REQUEST['board_idx']);

	$sql_replycheck = "select count(idx) as cnt from reply_board where board_idx = '".$board_idx."' and idx > '".$idx."'";
	$result_replycheck = mysqli_query($conn, $sql_replycheck);
	$row_replycheck = mysqli_fetch_assoc($result_replycheck);

	if ($row_replycheck['cnt'] > 0){
		mysqli_close($conn);
		echo '<script>alert("자신의 댓글 아래에 댓글이 있어 더이상 수정할 수 없습니다.");self.close();</script>';
	}

	$sql = "SELECT content FROM reply_board where idx = '".$idx."' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
			  <form class="form-horizontal" name="editReply" method="post" action="editReply_ok.php" onsubmit="return sendit()">
			  <input type="hidden" name="idx" value="<?php echo $idx?>">
                <div class="card-body">
                  <div class="form-group row">
				      <div class="col-sm-12">
						<div class="form-group">
							<textarea class="form-control" rows="5" name="content"><?php echo $row['content']?></textarea>
						</div>
					  </div>
                  </div>
                </div>
                <div class="card-footer">				  
				  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
			  </form>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
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
