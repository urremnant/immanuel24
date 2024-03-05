<?php
	include "../include/header.php";
	include "../include/Navbar.php";
	include "../include/leftMenu.php";
?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">통계</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
<?php
	include "../include/connect.php";
	$sql_churcharea = "select churchareaCode, korParishName from churcharea order by churchareaCode";
	$result_churcharea = mysqli_query($conn, $sql_churcharea);
?>
            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">교구별 렘넌트 통계</h3>
              </div>
			  <div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
				  <thead>
					<tr class="text-center">
						<th>교구</th> 
						<th>태영아부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10001'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>유아부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10002'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>유치부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10003'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등12부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10004'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등34부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10005'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등56부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10006'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>중등부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10007'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>고등부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10008'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>대학부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10009'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>사랑부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10012'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>농인부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10014'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>TCK부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10015'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>해외유학생부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10016'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>합계
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <>'') and left(memberID, 1) = 'R'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
					</tr>
				  </thead>
				  <tbody>
				<?php
					# $total_count = 0;
					while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
				?>
					<tr align="center">
						<td><a href="statistics_churcharea_view.php?gubun=R&churchareaCode=<?php echo $row_churcharea['churchareaCode']?>"><?php echo $row_churcharea['korParishName'] ?></a></td> 
						<td>
							<?php
								# 태영아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10001' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								//echo $sql_deptCount;
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10002' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유치부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10003' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등12부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10004' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등34부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10005' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등56부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10006' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 중등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10007' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 고등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10008' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 대학부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10009' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 사랑부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10012' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 농인부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10014' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# TCK부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10015' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 해외유학생부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10016' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <>'') and left(memberID, 1) = 'R' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
								$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
								echo "(".$row_deptCount_total['memberID_count_total'].")";
							?>
						</td>
					</tr>
				<?php
						$total_count = 0;
					}
				?>
				  </tfoot>
				</table>
              </div>
            </div>
            <!-- /.card --> 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">교구별 교사 통계</h3>
              </div>
			  <div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
				  <thead>
					<tr class="text-center">
						<th>교구</th>
						<th>태영아부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10001'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>유아부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10002'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>유치부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10003'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등12부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10004'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등34부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10005'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등56부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10006'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>중등부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10007'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>고등부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10008'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>대학부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10009'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>사랑부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10012'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>농인부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10014'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>TCK부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10015'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>해외유학생부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10016'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>합계
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <>'') and left(memberID, 1) = 'T'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
					</tr>
				  </thead>
				  <tbody>
				<?php
					mysqli_data_seek($result_churcharea, 0);
					while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
				?>
					<tr align="center">
						<td><a href="statistics_churcharea_view.php?gubun=T&churchareaCode=<?php echo $row_churcharea['churchareaCode']?>"><?php echo $row_churcharea['korParishName'] ?></a></td> 
						<td>
							<?php
								# 태영아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10001' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								//echo $sql_deptCount;
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10002' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유치부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10003' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등12부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10004' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등34부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10005' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등56부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10006' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 중등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10007' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 고등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10008' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 대학부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10009' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 사랑부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10012' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 농인부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10014' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# TCK부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10015' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 대학부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10016' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <>'') and left(memberID, 1) = 'T' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
								$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
								echo "(".$row_deptCount_total['memberID_count_total'].")";
							?>						
						</td>
					</tr>
				<?php
						$total_count = 0;	
					}
				?>
				  </tfoot>
				</table>
              </div>
            </div>

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">교구별 교역자 통계</h3>
              </div>
			  <div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
				  <thead>
					<tr class="text-center">
						<th>교구</th>
						<th>태영아부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10001'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>유아부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10002'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>유치부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10003'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등12부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10004'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등34부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10005'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>초등56부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10006'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>중등부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10007'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>고등부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10008'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>대학부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10009'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>사랑부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10012'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>농인부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10014'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>TCK부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10015'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>해외유학생부
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10016'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
						<th>합계
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <>'') and left(memberID, 1) = 'P'";
							$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
							$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
							echo "(".$row_deptCount_total['memberID_count_total'].")";
						?>
						</th>
					</tr>
				  </thead>
				  <tbody>
				<?php
					mysqli_data_seek($result_churcharea, 0);
					while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
				?>
					<tr align="center">
						<td><a href="statistics_churcharea_view.php?gubun=P&churchareaCode=<?php echo $row_churcharea['churchareaCode']?>"><?php echo $row_churcharea['korParishName'] ?></a></td> 
						<td>
							<?php
								# 태영아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10001' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								//echo $sql_deptCount;
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10002' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유치부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10003' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등12부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10004' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등34부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10005' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등56부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10006' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 중등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10007' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 고등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10008' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 대학부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10009' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 사랑부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10012' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 농인부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10014' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# TCK부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10015' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 해외유학생부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code = 'D10016' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where rtdept1Code in (select rtdept1Code from rtdept1 where parentsCode <>'') and left(memberID, 1) = 'P' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount_total = mysqli_query($conn, $sql_deptCount_total);
								$row_deptCount_total = mysqli_fetch_assoc($result_deptCount_total);
								echo "(".$row_deptCount_total['memberID_count_total'].")";
							?>
						</td>
					</tr>
				<?php
						$total_count = 0;
					}
				?>
				  </tfoot>
				</table>
              </div>
            </div>











          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
 

<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>