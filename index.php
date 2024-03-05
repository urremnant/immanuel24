<?php
	session_start();
	include "./include/connect.php";

	if ($_SESSION['ss_korname'] != ""){
		echo "<script>location.replace('/rtsc_member/main2.php');</script>";
	}
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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <script language = "javascript">
  <!--
	function loginchk(){
		if (document.login.korname.value == ""){
			alert("성명을 입력하여 주십시요.");
			document.login.korname.focus();
			return false;
		}
		if (document.login.admin_pass.value == ""){
			alert("비밀번호를 입력하여 주십시요.");
			document.login.admin_pass.focus();
			return false;
		}
		return true;
	}
	function viewBoard(board_idx, boardCode){
		window.open("viewBoard.php?board_idx="+board_idx+"&boardCode="+boardCode, "viewBoard", "status=no, menubar=no, scrollbars=no, resizable=no, width=600, height=700");
	}
  -->
  </script>

</head>
<!--body class="hold-transition login-page"-->
<body style="background-image: url('/image/login-bg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-color: rgba(255,255,255,0.6); " class="hold-transition login-page">

<div class="row mb-4">
  <div class="col-sm-12">
	<p class="card-text">
	<a href="/index.php"><h1><b><font color="#ffffff">렘넌트서밋위원회</font></b></h1></a>
	</p>
  </div>
</div>

<div class="col-lg-9">
	<div class="row">
	  <div class="col-lg-4">
		<div class="card">
			<div class="card-body">
<?php
	if ($_SESSION['ss_korname'] == ""){
?>
			  <p class="login-box-msg">※ 최초 로그인시 사용자 인증을 통해 개인비밀번호를 설정하셔야 합니다.</p>
			  <p class="login-box-msg">
				<a href="userConfirm.php"><button type="button" class="btn btn-info btn-block">사용자 인증 및 비밀번호 설정하기</button></a>
			  </p>
			  <form name="login" action="/login_ok.php" method="post" onsubmit="return loginchk()">
				<div class="input-group mb-3">
				  <input type="text" class="form-control" placeholder="성명" name="korname">
				  <div class="input-group-append">
					<div class="input-group-text">
					  <span class="fas fa-user"></span>
					</div>
				  </div>
				</div>
				<div class="input-group mb-3">
				  <input type="password" class="form-control" placeholder="비밀번호" name="admin_pass" maxlength="15">
				  <div class="input-group-append">
					<div class="input-group-text">
					  <span class="fas fa-key"></span>
					</div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-12">
					<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					<p></p>
				  </div>
				</div>
				<!--div class="row">
				  <div class="col-12 text-center">
					<a href="/guide.php"><p>개인정보처리방침</p></a>
				  </div>
				</div-->
			  </form>
<?php
	}else{
				  /*
  	unset($_SESSION['ss_rtdept1code']);
	unset($_SESSION['ss_rtdept2code']);
	unset($_SESSION['ss_homepage_admin_idx']);
	unset($_SESSION['ss_korname']);
	unset($_SESSION['ss_photofilename']);
	*/
		$sql_member = "select c.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code),'') as rtdept2Name, a.korname, b.korChurchPosition from homepage_admin a, churchPosition b, rtdept1 c where a.churchPositionCode = b.churchPositionCode and a.rtdept1Code = c.rtdept1Code and a.homepage_admin_idx = '".$_SESSION['ss_homepage_admin_idx']."'";
		$result_member = mysqli_query($conn, $sql_member);
		$row_member = mysqli_fetch_assoc($result_member)
?>
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?php echo $_SESSION['ss_korname'];?></h3>
                <h5 class="widget-user-desc"><?php echo $row_member['korChurchPosition'];?></h5>
              </div>
              <div class="widget-user-image">
				  <?php
					If ($_SESSION['ss_photofilename'] <> "") { 
						echo '<img src="/upload/'.$_SESSION['ss_photofilename'].'" class="img-circle img-fluid" alt="User Image" width="160">';
					}else{
						echo '<img src="/image/photox.jpg" class="img-circle img-fluid" alt="User Image">';
					}
				  ?>  
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">부서</h5>
                      <span><?php echo $row_member['rtdept1Name'];?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">분반</h5>
                      <span><?php echo $row_member['rtdept2Name'];?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
            </div>
<?php
	}
?>
			</div>
		</div>
	  </div>

	  <div class="col-lg-8">
		<div class="card">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-board1-tab" data-toggle="pill" href="#custom-tabs-board1" role="tab" aria-controls="custom-tabs-board1" aria-selected="true">공지사항</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-board2-tab" data-toggle="pill" href="#custom-tabs-board2" role="tab" aria-controls="custom-tabs-board2" aria-selected="false">자유게시판</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-board3-tab" data-toggle="pill" href="#custom-tabs-board3" role="tab" aria-controls="custom-tabs-board3" aria-selected="false">자료실</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-board1" role="tabpanel" aria-labelledby="custom-tabs-board1-tab">
                    <?php
						$sql_board1 = "select board_idx, boardCode, title, date_format(inputDate, '%Y-%m-%d') as inputDate from board where boardCode = '1' order by board_idx desc limit 4";
						$result_board1 = mysqli_query($conn, $sql_board1);
					?>
						<table class="table">
						  <tbody>
					<?php
						while ($row_board1 = mysqli_fetch_assoc($result_board1)) {
					?>
							<tr>
							  <td><a href="javascript:viewBoard('<?php echo $row_board1['board_idx'];?>', '<?php echo $row_board1['boardCode'];?>')"><?php echo $row_board1['title'];?></a></td>
							  <td class="text-center" style="width: 25%"><?php echo $row_board1['inputDate'];?></td>
							</tr>
					<?php
						}
					?>
						  </tbody>
						</table>
					<?php
						if ($_SESSION['ss_korname'] == ""){
					?>
							<a href="javascript:alert('로그인을 해주세요');"><button type="button" class="btn btn-info float-right badge badge-info"><i class="far fa-plus-square"></i> 더보기</button></a>
					<?php
						}else{
					?>
							<a href="https://www.remnantsummit.com/rtsc_board/list.php?boardCode=1"><button type="button" class="btn btn-info float-right badge badge-info"><i class="far fa-plus-square"></i> 더보기</button></a>
					<?php
						}
					?>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-board2" role="tabpanel" aria-labelledby="custom-tabs-board2-tab">
                    <?php
						$sql_board2 = "select board_idx, boardCode, title, date_format(inputDate, '%Y-%m-%d') as inputDate from board where boardCode = '2' order by board_idx desc limit 4";
						$result_board2 = mysqli_query($conn, $sql_board2);
					?>
						<table class="table">
						  <tbody>
					<?php
						while ($row_board2 = mysqli_fetch_assoc($result_board2)) {
					?>
							<tr>
							  <td><a href="javascript:viewBoard('<?php echo $row_board2['board_idx'];?>', '<?php echo $row_board2['boardCode'];?>')"><?php echo $row_board2['title'];?></a></td>
							  <td class="text-center" style="width: 25%"><?php echo $row_board2['inputDate'];?></td>
							</tr>
					<?php
						}
					?>
						  </tbody>
						</table>
					<?php
						if ($_SESSION['ss_korname'] == ""){
					?>
							<a href="javascript:alert('로그인을 해주세요');"><button type="button" class="btn btn-info float-right badge badge-info"><i class="far fa-plus-square"></i> 더보기</button></a>
					<?php
						}else{
					?>
							<a href="https://www.remnantsummit.com/rtsc_board/list.php?boardCode=2"><button type="button" class="btn btn-info float-right badge badge-info"><i class="far fa-plus-square"></i> 더보기</button></a>
					<?php
						}
					?>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-board3" role="tabpanel" aria-labelledby="custom-tabs-board3-tab">
                    <?php
						$sql_board3 = "select board_idx, boardCode, title, date_format(inputDate, '%Y-%m-%d') as inputDate from board where boardCode = '3' order by board_idx desc limit 4";
						$result_board3 = mysqli_query($conn, $sql_board3);
					?>
						<table class="table">
						  <tbody>
					<?php
						while ($row_board3 = mysqli_fetch_assoc($result_board3)) {
					?>
							<tr>
							  <td><a href="javascript:viewBoard('<?php echo $row_board3['board_idx'];?>', '<?php echo $row_board3['boardCode'];?>')"><?php echo $row_board3['title'];?></a></td>
							  <td class="text-center" style="width: 25%"><?php echo $row_board3['inputDate'];?></td>
							</tr>
					<?php
						}
					?>
						  </tbody>
						</table>
					<?php
						if ($_SESSION['ss_korname'] == ""){
					?>
							<a href="javascript:alert('로그인을 해주세요');"><button type="button" class="btn btn-info float-right badge badge-info"><i class="far fa-plus-square"></i> 더보기</button></a>
					<?php
						}else{
					?>
							<a href="https://www.remnantsummit.com/rtsc_board/list.php?boardCode=3"><button type="button" class="btn btn-info float-right badge badge-info"><i class="far fa-plus-square"></i> 더보기</button></a>
					<?php
						}
					?>
                  </div>
                </div>
              </div>
            </div>
		</div>
	  </div>
	</div>
	<div class="row">
	  <div class="col-lg-12">
            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">교구별 통계</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart_churcharea" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">부서별 통계</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart_dept" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
<?php
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
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R' and rtdept1Code in ('D10009', 'D10010','D10011')";
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
						<th>합계
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'R'";
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
						<td><?php echo $row_churcharea['korParishName'] ?></td> 
						<td>
							<?php
								# 태영아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10001' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
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
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10002' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유치부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10003' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등12부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10004' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등34부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10005' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등56부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10006' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 중등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10007' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 고등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10008' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 대학부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code in ('D10009', 'D10010', 'D10011') and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 사랑부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'R' and rtdept1Code = 'D10012' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td><?php echo $total_count ?></td>
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
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T' and rtdept1Code in ('D10009', 'D10010','D10011')";
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
						<th>합계
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'T'";
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
						<td><?php echo $row_churcharea['korParishName'] ?></td> 
						<td>
							<?php
								# 태영아부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10001' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
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
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10002' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 유치부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10003' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등12부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10004' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등34부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10005' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 초등56부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10006' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 중등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10007' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 고등부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10008' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 대학부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code in ('D10009', 'D10010', 'D10011') and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td>
							<?php
								# 사랑부
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'T' and rtdept1Code = 'D10012' and churchareaCode = '".$row_churcharea['churchareaCode']."'";
								$result_deptCount = mysqli_query($conn, $sql_deptCount);
								$row_deptCount = mysqli_fetch_assoc($result_deptCount);
								echo $row_deptCount['memberID_count'];
								$total_count = $total_count + $row_deptCount['memberID_count'];
							?>
						</td>
						<td><?php echo $total_count ?></td>
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
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P' and rtdept1Code in ('D10009', 'D10010','D10011')";
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
						<th>합계
						<?php
							$sql_deptCount_total = "select count(memberID) as memberID_count_total from member where left(memberID, 1) = 'P'";
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
						<td><?php echo $row_churcharea['korParishName'] ?></td> 
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
								$sql_deptCount = "select count(memberID) as memberID_count from member where left(memberID, 1) = 'P' and rtdept1Code in ('D10009', 'D10010', 'D10011') and churchareaCode = '".$row_churcharea['churchareaCode']."'";
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
						<td><?php echo $total_count ?></td>
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
//======================
// 교구별 통계
//======================
	$sql_churcharea = "select churchareaCode, korChurchAreaName, korParishName from churcharea order by korParishName";
	$result_churcharea = mysqli_query($conn, $sql_churcharea);
	while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
		If ($label_churcharea == "") {
			$label_churcharea = "['".$row_churcharea['korParishName'];
		}else{
			$label_churcharea = $label_churcharea."', '".$row_churcharea['korParishName'];
		}
	}
	$label_churcharea = $label_churcharea."']";
//	echo $label_churcharea;

	$sql_churcharea_group_teacher = "select b.korParishName, count(a.memberID) as memberID_count from member a, churcharea b where a.churchareaCode = b.churchareaCode and memberID like 'T%' group by korParishName order by korParishName";
	$result_churcharea_group_teacher = mysqli_query($conn, $sql_churcharea_group_teacher);
	while ($row_churcharea_group_teacher = mysqli_fetch_assoc($result_churcharea_group_teacher)) {
		If ($data_churcharea_group_teacher == "") {
			$data_churcharea_group_teacher = "[".$row_churcharea_group_teacher['memberID_count'];
		}else{
			$data_churcharea_group_teacher = $data_churcharea_group_teacher.", ".$row_churcharea_group_teacher['memberID_count'];
		}
	}
	$data_churcharea_group_teacher = $data_churcharea_group_teacher."]";
//	echo $data_churcharea_group_teacher;

	$sql_churcharea_group_remnant = "select b.korParishName, count(a.memberID) as memberID_count from member a, churcharea b where a.churchareaCode = b.churchareaCode and memberID like 'R%' group by korParishName order by korParishName";
	$result_churcharea_group_remnant = mysqli_query($conn, $sql_churcharea_group_remnant);
	while ($row_churcharea_group_remnant = mysqli_fetch_assoc($result_churcharea_group_remnant)) {
		If ($data_churcharea_group_remnant == "") {
			$data_churcharea_group_remnant = "[".$row_churcharea_group_remnant['memberID_count'];
		}else{
			$data_churcharea_group_remnant = $data_churcharea_group_remnant.", ".$row_churcharea_group_remnant['memberID_count'];
		}
	}
	$data_churcharea_group_remnant = $data_churcharea_group_remnant."]";
//	echo $data_churcharea_group_remnant;

	$sql_churcharea_group_pastor = "select a.korParishName, count(b.memberID) as memberID_count from churcharea a left outer join member b on a.churchareaCode = b.churchareaCode and b.memberID like 'P%' group by a.korParishName order by korParishName";
	$result_churcharea_group_pastor = mysqli_query($conn, $sql_churcharea_group_pastor);
	while ($row_churcharea_group_pastor = mysqli_fetch_assoc($result_churcharea_group_pastor)) {
		If ($data_churcharea_group_pastor == "") {
			$data_churcharea_group_pastor = "[".$row_churcharea_group_pastor['memberID_count'];
		}else{
			$data_churcharea_group_pastor = $data_churcharea_group_pastor.", ".$row_churcharea_group_pastor['memberID_count'];
		}
	}
	$data_churcharea_group_pastor = $data_churcharea_group_pastor."]";
//	echo $data_churcharea_group_pastor;

//======================
// 부서별 통계
//======================
	$sql_dept = "select rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
	$result_dept = mysqli_query($conn, $sql_dept);
	while ($row_dept = mysqli_fetch_assoc($result_dept)) {
		If ($label_dept == "") {
			$label_dept = "['".$row_dept['rtdept1Name'];
		}else{
			$label_dept = $label_dept."', '".$row_dept['rtdept1Name'];
		}
		$sql_dept_group_teacher = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'T%'";
		$result_dept_group_teacher = mysqli_query($conn, $sql_dept_group_teacher);
		$row_dept_group_teacher = mysqli_fetch_assoc($result_dept_group_teacher);
		If ($data_dept_group_teacher == "") {
			$data_dept_group_teacher = "[".$row_dept_group_teacher['cnt'];
		}else{
			$data_dept_group_teacher = $data_dept_group_teacher.", ".$row_dept_group_teacher['cnt'];
		}
		$sql_dept_group_remnant = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'R%'";
		$result_dept_group_remnant = mysqli_query($conn, $sql_dept_group_remnant);
		$row_dept_group_remnant = mysqli_fetch_assoc($result_dept_group_remnant);
		If ($data_dept_group_remnant == "") {
			$data_dept_group_remnant = "[".$row_dept_group_remnant['cnt'];
		}else{
			$data_dept_group_remnant = $data_dept_group_remnant.", ".$row_dept_group_remnant['cnt'];
		}
		$sql_dept_group_pastor = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'P%'";
		$result_dept_group_pastor = mysqli_query($conn, $sql_dept_group_pastor);
		$row_dept_group_pastor = mysqli_fetch_assoc($result_dept_group_pastor);
		If ($data_dept_group_pastor == "") {
			$data_dept_group_pastor = "[".$row_dept_group_pastor['cnt'];
		}else{
			$data_dept_group_pastor = $data_dept_group_pastor.", ".$row_dept_group_pastor['cnt'];
		}
	}
	$label_dept = $label_dept."']";
	$data_dept_group_teacher = $data_dept_group_teacher."]";
	$data_dept_group_remnant = $data_dept_group_remnant."]";
	$data_dept_group_pastor = $data_dept_group_pastor."]";

//	echo $data_dept_group_pastor;
?>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    var areaChartData_churcharea = {
 //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	  labels  : <?php echo $label_churcharea?>,
      datasets: [
        {
          label               : '교사',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_churcharea_group_teacher?>
        },
        {
          label               : '렘넌트',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
//        data                : [65, 59, 80, 81, 56, 55, 40]
		  data                : <?php echo $data_churcharea_group_remnant?>
        },
        {
          label               : '교역자',
          backgroundColor     : 'rgba(255, 0, 127, 0.9)',
          borderColor         : 'rgba(255, 0, 127, 0.8)',
          pointRadius          : false,
          pointColor          : '#FF007F',
          pointStrokeColor    : 'rgba(255, 0, 127,,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 0, 127,,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_churcharea_group_pastor?>
        },
      ]
    }

    var areaChartData_dept = {
 //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	  labels  : <?php echo $label_dept?>,
      datasets: [
        {
          label               : '교사',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_dept_group_teacher?>
        },
        {
          label               : '렘넌트',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
//        data                : [65, 59, 80, 81, 56, 55, 40]
		  data                : <?php echo $data_dept_group_remnant?>
        },
        {
          label               : '교역자',
          backgroundColor     : 'rgba(255, 0, 127, 0.9)',
          borderColor         : 'rgba(255, 0, 127, 0.8)',
          pointRadius          : false,
          pointColor          : '#FF007F',
          pointStrokeColor    : 'rgba(255, 0, 127,,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 0, 127,,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_dept_group_pastor?>
        },
      ]
    }

	var barChartData_churcharea = $.extend(true, {}, areaChartData_churcharea)
    var stackedBarChartCanvas_churcharea = $('#stackedBarChart_churcharea').get(0).getContext('2d')
    var stackedBarChartData_churcharea = $.extend(true, {}, barChartData_churcharea)

	var barChartData_dept = $.extend(true, {}, areaChartData_dept)
    var stackedBarChartCanvas_dept = $('#stackedBarChart_dept').get(0).getContext('2d')
    var stackedBarChartData_dept = $.extend(true, {}, barChartData_dept)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart_churcharea = new Chart(stackedBarChartCanvas_churcharea, {
      type: 'bar',
      data: stackedBarChartData_churcharea,
      options: stackedBarChartOptions
    })

    var stackedBarChart_dept = new Chart(stackedBarChartCanvas_dept, {
      type: 'bar',
      data: stackedBarChartData_dept,
      options: stackedBarChartOptions
    })
  })
</script>