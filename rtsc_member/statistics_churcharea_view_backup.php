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

	$churchareaCode = trim($_REQUEST['churchareaCode']);
	$gubun			= trim($_REQUEST['gubun']);

	$sql_churcharea = "select churchareaCode, korParishName from churcharea where churchareaCode = '".$churchareaCode."'";
	$result_churcharea = mysqli_query($conn, $sql_churcharea);
	$row_churcharea = mysqli_fetch_assoc($result_churcharea);
?>
            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">
					<?php
						switch ($gubun){
							case "R":
								echo $row_churcharea['korParishName']." 렘넌트 명단";
								break;
							case "T":
								echo $row_churcharea['korParishName']." 교사 명단";
								break;
							case "P":
								echo $row_churcharea['korParishName']." 교역자 명단";
								break;
						}
					?>				
				</h3>
              </div>
			  <div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
				  <thead>
					<tr class="text-center">
						<th>태영아부</th>
						<th>유아부</th>
						<th>유치부</th>
						<th>초등12부</th>
						<th>초등34부</th>
						<th>초등56부</th>
						<th>중등부</th>
						<th>고등부</th>
						<th>대학부</th>
						<th>사랑부</th>
					</tr>
				  </thead>
				  <tbody>
					<tr align="center" bgcolor="#ffffff">
						<td>
							<?php
								# 태영아부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10001' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								//echo $sql_korname;
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 유아부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10002' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 유치부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10003' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 초등12부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10004' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 초등34부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10005' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 초등56부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10006' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 중등부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10007' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 고등부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10008' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 대학부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code in ('D10009', 'D10010', 'D10011') and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
						<td>
							<?php
								# 사랑부
								$sql_korname = "select memberID, korname from member where left(memberID, 1) = '".$gubun."' and rtdept1Code = 'D10012' and churchareaCode = '".$row_churcharea['churchareaCode']."' order by korname";
								$result_korname = mysqli_query($conn, $sql_korname);
								while ($row_korname = mysqli_fetch_assoc($result_korname)) {
									echo "<a href='/rtsc_member/content.php?memberID=".$row_korname['memberID']."'>".$row_korname['korname']."</a><br style='mso-data-placement:same-cell;'>";
								}
							?>
						</td>
					</tr>
				  </tfoot>
				</table>
              </div>
            </div>
            <!-- /.card -->

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