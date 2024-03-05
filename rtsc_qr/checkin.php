<?php
	$mysql_host = "rtsummit.cqebf6co3wjz.ap-northeast-2.rds.amazonaws.com:3306";
	$mysql_user = "rtsummit";
	$mysql_password = "neoframemedia!@";
	$mysql_db = "rtsummit";
	$conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	if ($conn->connect_error) {
		die("연결실패 : " .  $conn->connect_error());
	}

	$worshipDate	= trim($_REQUEST['worshipDate']);
	$worshipPlace	= trim($_REQUEST['worshipPlace']);
	$myNo			= trim($_REQUEST['myNo']);

//	echo $worshipDate."<br>";
//	echo $worshipPlace."<br>";
//	echo $myNo."<br>";
	if ($myNo != ""){
		$sql_myInfo = "select a.*, d.korChurchPosition, b.korParishName, c.rtdept1Name from apply_worship a, churcharea b, rtdept1 c, churchPosition d where a.churchareaCode = b.churchareaCode and a.rtdept1Code = c.rtdept1Code and a.churchPositionCode = d.churchPositionCode and a.worshipDate = '".$worshipDate."' and a.myNo = '".$myNo."'";
		$result_myInfo = mysqli_query($conn, $sql_myInfo);
?>
			  <div class="container-fluid">
				<div class="row">
<?php
		# QR코드는 맨처음 한번만 나오게 한다.
		$isQRView = true;
		while($row_myInfo = mysqli_fetch_assoc($result_myInfo)){
			if ($isQRView == true) {
?>
				  <div class="col-md-3 col-sm-6 col-12">
					<div class="info-box bg-success">
					  <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

					  <div class="info-box-content">
						<span class="info-box-text"><?php echo $row_myInfo['korname']." ".$row_myInfo['korChurchPosition'];?></span>
						<span class="info-box-text"><?php echo $worshipDate." / ".$worshipPlace;?></span>

						<div class="progress">
						  <div class="progress-bar" style="width: 100%"></div>
						</div>
						<span class="progress-description">출입체크 되었습니다.</span>
					  </div>
					  <!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				  </div>

				  <div class="col-md-3">
					<!-- Profile Image -->
					<div class="card card-primary card-outline">
					  <div class="card-body box-profile">
						<div class="text-center">
						  <div class="ribbon-wrapper ribbon-lg text-lg">
							<?php
								if (($row_myInfo['strollerYN']=="Y")||($row_myInfo['wheelchairYN']=="Y")){
							?>
									<div class="ribbon bg-danger text-lg">
										<?php echo $row_myInfo['carNo'];?>
									</div>
							<?php
								}
							?>
						  </div>
						  <p class="text-center"><h5><b><?php echo $row_myInfo['worshipDate'];?></b></h5></p>
							<?php
								if ($row_myInfo['myNo']!=""){
							?>
									<img src="http://chart.apis.google.com/chart?cht=qr&chs=177x177&chl=<?php echo $row_myInfo['myNo']?>&choe=UTF-8&chld=H|0">
							<?php
								}else{
							?>
									<img src="/image/photox.jpg" class="profile-user-img img-fluid img-circle" alt="User Image" width="60">
							<?php
								}
							?>
						</div>
						
						<h3 class="profile-username text-center"><?php echo $row_myInfo['korname']." ".$row_myInfo['korChurchPosition'];?></h3>

						<p class="text-center"><?php echo $row_myInfo['korParishName']." / ".$row_myInfo['rtdept1Name'];?></p>

					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				  </div>
				  <!-- /.col -->
			<?php
				}
				$isQRView = false;
			?>
				  <div class="col-md-3">
					<!-- Profile Image -->
					<div class="card card-primary card-outline">
					  <div class="card-body box-profile">

						<ul class="list-group list-group-unbordered mb-3">
						  <li class="list-group-item">
							<i class="fas fa-pray"></i> <b>참석예배</b> 
							<a class="float-right"><?php echo $row_myInfo['worshipGubun'];?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-map-marker-alt"></i> <b>예배장소</b> 
							<a class="float-right"><?php echo $row_myInfo['worshipPlace'];?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-mobile-alt"></i> <b>교인앱/교인증</b> 
							<a class="float-right">
								<?php
									switch($row_myInfo['appYN']){
										case "Y" :
											echo "예";
											break;
										case "N" :
											echo "아니오";
											break;
										case "X" :
											echo "핸드폰 없음";
											break;
										default:
									}
								?>					
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-car"></i> <b>교통수단</b> 
							<a class="float-right"><?php echo $row_myInfo['busUse'];?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-bus"></i> <b>귀가시 셔틀버스</b> 
							<a class="float-right"><?php echo $row_myInfo['bus2Use'];?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-language"></i> <b>통역어</b> 
							<a class="float-right">
								<?php
									if ($row_myInfo['useLanguage'] == ""){
										echo "필요없음";
									}else{
										echo $row_myInfo['useLanguage'];
									}
								?>
							</a>
						  </li>
						</ul>

					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				  </div>
				  <!-- /.col -->

<?php
		}
?>
				</div>
				<!-- /.row -->
			  </div><!-- /.container-fluid -->
<?php
	}
?>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>