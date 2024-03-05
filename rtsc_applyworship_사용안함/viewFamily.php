<?php
	include "header.php";
	include "Navbar.php";
	include "menu_worship.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">나의 가족정보</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 
	<?php
		include "connect.php";
		$familyID		= trim($_REQUEST['familyID']);

		$korname		= trim($_REQUEST['korname']);
		$birthyear		= trim($_REQUEST['birthyear']);	
		$birthmonth		= trim($_REQUEST['birthmonth']);					
		$birthday		= trim($_REQUEST['birthday']);
		$birthday		= $birthyear.$birthmonth.$birthday;
		$mobile			= trim($_REQUEST['mobile']);
		$randomNum		= trim($_REQUEST['checkSMSNo']);

		//$familyID 가 없는 경우는 나의 가족정보 메뉴에서 온 경우이다. 이름과 생년월일로 familyID를 찾아 가족정보를 찾아보여준다.
		if ($familyID == ""){
			//핸드폰 인증 번호가 맞는지 확인한다.
			$sql = "SELECT COUNT(*) AS cnt FROM member_familyinfo where korname = '".$korname."' and birthday = '".$birthday."' and mobile = '".$mobile."' and randomNum = '".$randomNum."'";
			$result = mysqli_query($conn, $sql);
			$rowCnt = mysqli_fetch_assoc($result);
			if ($rowCnt['cnt'] == 0){
				echo "<script>alert('입력하신 정보를 다시 확인해주세요.');</script>";
				echo "<script>location.replace('myFamilyInfo.php');</script>";
			}else{
				//인증숫자 초기화
				$sql_randomNum = "Update member_familyinfo Set randomNum = '' where korname = '".$korname."' and birthday = '".$birthday."' and mobile = '".$mobile."' and randomNum = '".$randomNum."'";
				$result_randomNum = mysqli_query($conn, $sql_randomNum);
			}

			$sql_faimlyID = "select familyID from member_familyinfo where korname = '".$korname."' and birthday = '".$birthday."' and mobile = '".$mobile."'";
			$result_faimlyID	= mysqli_query($conn, $sql_faimlyID);
			$row_faimlyID		= mysqli_fetch_assoc($result_faimlyID);
			$familyID		= $row_faimlyID['familyID'];
		}

		$sql = "select * from member_familyinfo where familyID = '".$familyID."'";
		$result = mysqli_query($conn, $sql);
		$total_rows = mysqli_num_rows($result);
		if ($total_rows != 0){
	?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-header">
				<div class="row">
					<div class="col-12">
						<p><h5><b>※ 예배신청은 좌측 예배신청하기 메뉴에서 하셔야 합니다.</b> <a href="addFamilyMember.php?familyID=<?php echo $familyID?>"><button type="button" class="btn btn-primary">나의 가족 추가하기</button></a></h5></p>
					</div>
				</div>
              </div>
	<?php
		}else{
			echo "<script>alert('가족정보가 없습니다.');location.replace('myFamilyInfo.php');</script>";
		}
	?>

              <div class="card-body">
				<div class="row">
<?php
	while ($row = mysqli_fetch_assoc($result)) {
?>
				  <div class="col-md-4">
					<div class="card card-primary card-outline">
					  <div class="card-body box-profile">
						<h3 class="profile-username text-center"><?php echo $row['korname'] ?></h3>
						<p class="text-muted text-center">
							<?php
								$sql_korChurchPosition = "select korChurchPosition from churchPosition where churchPositionCode = '".$row['churchPositionCode']."'";
								$result_korChurchPosition = mysqli_query($conn, $sql_korChurchPosition);
								$row_korChurchPosition = mysqli_fetch_assoc($result_korChurchPosition);
								echo $row_korChurchPosition['korChurchPosition'];
							?>						
						</p>
						<p class="text-muted text-center">
							<?php echo  '<a class="btn btn-info btn-sm" href="editFamilyMember.php?familyID='.$familyID.'&idx='.$row['idx'].'"><i class="fas fa-pencil-alt"></i>Edit</a>'; ?>
							<?php echo  '<a class="btn btn-danger btn-sm" href="deleteFamilyMember.php?familyID='.$familyID.'&idx='.$row['idx'].'"><i class="fas fa-trash"></i>Delete</a>'; ?>
						</p>
						<ul class="list-group list-group-unbordered mb-3">
						  <li class="list-group-item">
							<i class="fas fa-address-book"></i> <b>교인번호</b>
							<a class="float-right"><?php echo $row['myNo'] ?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-link"></i> <b>관계</b>
							<a class="float-right"><?php echo $row['familyPosition'] ?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-venus-mars"></i> <b>성별</b>
							<a class="float-right">
							<?php  
								switch($row['gender']){
									case "M":
										echo "남";
										break;
									case "F":
										echo "여";
										break;
								}
							?>
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-birthday-cake"></i> <b>생년월일</b> 
							<a class="float-right">
							<?php 
								if ($row['birthday']<>""){
							?>
								<?php echo substr($row['birthday'], 0, 4)."년 ".substr($row['birthday'], 4, 2)."월 ".substr($row['birthday'],-2)."일" ?>
							<?php
								}
							?>
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-mobile-alt"></i> <b>핸드폰</b>
							<a class="float-right"><?php echo $row['mobile'] ?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-map-marker-alt"></i> <b>교구</b>
							<a class="float-right">
								<?php
									$sql_churcharea = "SELECT korChurchAreaName, korParishName from churcharea where churchareaCode = '".$row['churchareaCode']."'";
									$result_churcharea = mysqli_query($conn, $sql_churcharea);
									$row_churcharea = mysqli_fetch_assoc($result_churcharea);
									echo $row_churcharea['korChurchAreaName']." ".$row_churcharea['korParishName'];
								?>
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-map-marked-alt"></i> <b>부서</b>
							<a class="float-right">
								<?php
									$sql_rtdept1 = "select rtdept1Name from rtdept1 where rtdept1Code = '".$row['rtdept1Code']."'";
									$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
									$row_rtdept1 = mysqli_fetch_assoc($result_rtdept1);
									echo $row_rtdept1['rtdept1Name'];
								?>								
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-address-card"></i> <b>교인앱/교인증</b>
							<a class="float-right">
								<?php
									switch($row['appYN']){
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
							<i class="fas fa-bus"></i> <b>셔틀버스</b>
							<a class="float-right"><?php echo $row['busUse'] ?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-baby-carriage"></i> <b>유모차</b>
							<a class="float-right">
								<div class="custom-control custom-checkbox">
								  <input class="custom-control-input custom-control-input-danger" type="checkbox" id="strollerYN" <?php if ($row['strollerYN'] == "Y"){echo "checked";}?>>
								  <label for="strollerYN" class="custom-control-label"></label>
								</div>
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-wheelchair"></i> <b>휠체어</b>
							<a class="float-right">
								<div class="custom-control custom-checkbox">
								  <input class="custom-control-input custom-control-input-danger" type="checkbox" id="wheelchairYN" <?php if ($row['wheelchairYN'] == "Y"){echo "checked";}?>>
								  <label for="wheelchairYN" class="custom-control-label"></label>
								</div>
							</a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-pray"></i> <b>예배장소</b>
							<a class="float-right"><?php echo $row['worshipPlace'] ?></a>
						  </li>
						  <li class="list-group-item">
							<i class="fas fa-language"></i> <b>통역어</b>
							<a class="float-right"><?php echo $row['useLanguage'] ?></a>
						  </li>
						</ul>
					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->
				  </div>

<?php
	}
?>
				</div>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
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
	include "footer.php";
?>