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

<?php
	include "./include/connect.php";
	$board_idx		= trim($_REQUEST['board_idx']);
	$boardCode		= trim($_REQUEST['boardCode']);
	$sql_visit = "Update board Set visit = visit + 1 where board_idx = '".$board_idx."'";
	$result_visit = mysqli_query($conn, $sql_visit);

	$sql = "select a.title, a.content, a.homepage_admin_idx, b.photofilename, b.korname, a.visit, a.inputDate from board a, homepage_admin b where a.homepage_admin_idx = b.homepage_admin_idx and a.board_idx = '".$board_idx."' and a.boardCode = '".$boardCode."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>
			<?php
				$sql_boardName = "SELECT boardName from boardinfo where boardCode = '".$boardCode."'";
				$result_boardName = mysqli_query($conn, $sql_boardName);
				$row_boardName = mysqli_fetch_assoc($result_boardName);
				echo $row_boardName['boardName'];			
			?>
			</h1>
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

				<div class="card-body">
					<span class="float-left"><h4><?php echo $row['title'];?></h4></span>
                    <div class="post">
                      <div class="user-block">
						  <?php
							If ($row['photofilename'] <> "") { 
								echo '<img src="/upload/'.$row['photofilename'].'" class="img-circle elevation-2" alt="User Image" width="128">';
							}else{
								echo '<img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="128">';
							}
						  ?>
							<span class="username"><?php echo $row['korname'];?></span>
							<span class="description"><?php echo $row['inputDate'];?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <?php echo $row['content'];?>
                      </p>
					<?php
						//첨부파일
						$sql_file = "select idx, filename from board_filename where board_idx = '".$board_idx."' order by idx";
						$result_file = mysqli_query($conn, $sql_file);
						while ($row_file = mysqli_fetch_assoc($result_file)) {
					?>
							<div class="form-group row text-center">
								<a href="/upload/<?php echo $row_file['filename'];?>" class="link-black text-sm"><button type="button" class="btn btn-outline-info"><i class="fas fa-paperclip"></i> <?php echo $row_file['filename'];?></button></a>
							</div>
					<?php
						}
					?>
                    </div>
				</div>
				<!-- /.card-body -->

				<div class="card-footer">
				<?php
					$sql_reply = "select a.idx, a.content, a.homepage_admin_idx, b.photofilename, b.korname, a.inputDate from reply_board a, homepage_admin b where a.homepage_admin_idx = b.homepage_admin_idx and a.board_idx = '".$board_idx."'";
					$result_reply = mysqli_query($conn, $sql_reply);
					while ($row_reply = mysqli_fetch_assoc($result_reply)){
				?>
							<div class="direct-chat-msg">
								<div class="direct-chat-infos clearfix">
									<span class="direct-chat-name float-left"><?php echo $row_reply['korname']?></span>
									<span class="float-right"><?php echo $row_reply['inputDate']?></span>
								</div>
					<?php
						If ($row_reply['photofilename'] <> "") {
					?>
								<img class="direct-chat-img" src="/upload/<?php echo $row_reply['photofilename'] ?>">
					<?php
						}else{
					?>
								<img src="/image/photox.jpg"  class="direct-chat-img" alt="User Image">
					<?php
						}
					?>
								<div class="direct-chat-text">
									<?php echo str_replace("\r\n", "<br>", $row_reply['content']) ?>
								</div>
								<!-- /.direct-chat-text -->
							</div>
							<!-- /.direct-chat-msg -->
				<?php
					}
				?>
				</div>
				<!-- /.card-footer -->

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
