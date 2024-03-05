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
          <div class="col-sm-6">
            <h1 class="m-0">렘넌트서밋위원회</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
			  <div class="card-body">
				<div class="col-12">
					<p>※ 교구 교역자 사이트입니다.</p>
					<p>※ 교구 교역자는 자신의 담당 교구의 렘넌트서밋위원회 산하 교사와 렘넌트 자료를 열람 하실 수 있습니다.</p>
					<p>※ 데이터의 열람만 가능하며 데이터의 수정과 삭제는 불가합니다.</p>
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
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>