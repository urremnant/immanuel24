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
            <h1 class="m-0">분반코드 관리</h1>
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
              <!-- /.card-header -->
              <div class="card-body">

<?php
	include "../include/connect.php";
?>
              <div class="card-header">
				<div class="row">
					<div class="col-12">
						<a href="write.php"><button type="submit" class="btn btn-primary">분반 추가하기</button></a>
					</div>
				</div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
					<tr class="text-center">
						<th>부서코드</th>
						<th>국</th>
						<th>부서</th>
						<th>분반</th>
						<th>관리</th>
					</tr>
				  </thead>
				  <tbody>
<?php
	$sql = "select a.rtdept2Code, b.rtdept1Name, a.rtdept2Name  from rtdept2 a, rtdept1 b where a.parentsCode = b.rtdept1Code order by b.rtdept1Code, b.rtdept1Name, a.rtdept2Code";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
?>
					<tr align="center">
						<td><?php echo $row['rtdept2Code'];?></td>  
						<td>
						<?php
							if (($row['rtdept1Name']=="태영아부") || ($row['rtdept1Name']=="유아부") || ($row['rtdept1Name']=="유치부")){
								echo "미취학렘넌트국";
							}
							if (($row['rtdept1Name']=="초등12부") || ($row['rtdept1Name']=="초등34부") || ($row['rtdept1Name']=="초등56부")){
								echo "초등렘넌트국";
							}
							if (($row['rtdept1Name']=="중등부") || ($row['rtdept1Name']=="고등부")){
								echo "청소년렘넌트국";
							}
							if ($row['rtdept1Name']=="대학부"){
								echo "대학국";
							}
							if (($row['rtdept1Name']=="사랑부") || ($row['rtdept1Name']=="농인부")){
								echo "미션렘넌트국";
							}
							if (($row['rtdept1Name']=="TCK부") || ($row['rtdept1Name']=="해외유학생부")){
								echo "글로벌렘넌트국";
							}
						?>
						</td>
						<td><?php echo $row['rtdept1Name'];?></td>      
						<td><?php echo $row['rtdept2Name'];?></td>
						<td>
							<?php echo  '<a class="btn btn-info btn-sm" href="edit.php?rtdept2Code='.$row['rtdept2Code'].'"><i class="fas fa-pencil-alt"></i>Edit</a>'; ?>
							<?php echo  '<a class="btn btn-danger btn-sm" href="del.php?rtdept2Code='.$row['rtdept2Code'].'"><i class="fas fa-trash"></i>Delete</a>'; ?>
						</td>
					</tr>
<?php
	}
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
				  </tfoot>
				</table>
			  </div>
              <!-- /.card-body -->
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
	include "../include/footer.php";
?>
