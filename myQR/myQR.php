<?php
	include "header.php";
	include "Navbar.php";
	include "leftMenu.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">나의 QR코드</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php
	include "../include/connect.php";
	$korname	= trim($_REQUEST['korname']);
	$birthday	= trim($_REQUEST['birthday']);
	# 교인들은 대부분 자기이름 뒤에 붙는 알파벳을 모른다.
	$sql = "select * from churchremnantsystem where korname like '".$korname."%' and replace(birthday, '-','') = '".$birthday."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
			  <div class="card-footer">
				<div class="text-center">
					<p class="text-center"><h4><b><?php echo $row['remnantDept'];?></b></h4></p>
				</div>
			  </div>
			  <div class="card-body">
				<div class="text-center">
					<?php
						if ($row['myNo'] != ""){
					?>
							<img src="http://chart.apis.google.com/chart?cht=qr&chs=177x177&chl=<?php echo $row['myNo']?>&choe=UTF-8&chld=H|0">
					<?php
						}
					?>
					<p class="text-center"><h3><b><?php echo $row['korname']." ".$row['korChurchPosition'];?></b></h3></p>
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
<?php
	include "footer.php";
	mysqli_close($conn);
?>
