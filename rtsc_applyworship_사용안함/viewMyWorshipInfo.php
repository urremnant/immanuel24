<?php
	include "header.php";
	include "Navbar.php";
	include "menu_worship.php";

	include "connect.php";

	$worshipDate	= trim($_REQUEST['worshipDate']);
	$korname		= trim($_REQUEST['korname']);
	$birthyear		= trim($_REQUEST['birthyear']);	
	$birthmonth		= trim($_REQUEST['birthmonth']);					
	$birthday		= trim($_REQUEST['birthday']);
	$birthday		= $birthyear.$birthmonth.$birthday;

	$sql_countCheck = "SELECT COUNT(*) AS cnt FROM apply_worship where worshipDate = '".$worshipDate."' and korname = '".$korname."' and birthday = '".$birthday."'";
	$result_countCheck = mysqli_query($conn, $sql_countCheck);
	$rowCnt = mysqli_fetch_assoc($result_countCheck);
	if ($rowCnt['cnt'] == 0){
		echo "<script>alert('입력하신 정보를 다시 확인해주세요.');</script>";
		echo "<script>location.replace('myWorshipInfo.php');</script>";
	}

	$sql = "select a.*, d.korChurchPosition, b.korParishName, c.rtdept1Name from apply_worship a, churcharea b, rtdept1 c, churchPosition d where a.churchareaCode = b.churchareaCode and a.rtdept1Code = c.rtdept1Code and a.churchPositionCode = d.churchPositionCode and a.worshipDate = '".$worshipDate."' and a.korname = '".$korname."' and a.birthday = '".$birthday."'";
	$result = mysqli_query($conn, $sql);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">나의 예배신청정보</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 
    <!-- Main content -->
    <section class="content">
<?php
	while ($row = mysqli_fetch_assoc($result)) {
?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
				  <div class="ribbon-wrapper ribbon-lg text-lg">
					<?php
						if (($row['strollerYN']=="Y")||($row['wheelchairYN']=="Y")){
					?>
							<div class="ribbon bg-danger text-lg">
								<?php echo $row['carNo'];?>
							</div>
					<?php
						}
					?>
                  </div>
				  <p class="text-center"><h5><b><?php echo $row['worshipDate'];?></b></h5></p>
					<?php
						if ($row['myNo']!=""){
					?>
							<img src="http://chart.apis.google.com/chart?cht=qr&chs=177x177&chl=<?php echo $row['myNo']?>&choe=UTF-8&chld=H|0">
					<?php
						}else{
					?>
							<img src="/image/photox.jpg" class="profile-user-img img-fluid img-circle" alt="User Image" width="60">
					<?php
						}
					?>
                </div>
				
                <h3 class="profile-username text-center"><?php echo $row['korname']." ".$row['korChurchPosition'];?></h3>

                <p class="text-center"><?php echo $row['korParishName']." / ".$row['rtdept1Name'];?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <i class="fas fa-pray"></i> <b>참석예배</b> 
					<a class="float-right"><?php echo $row['worshipGubun'];?></a>
                  </li>
                  <li class="list-group-item">
                    <i class="fas fa-map-marker-alt"></i> <b>예배장소</b> 
					<a class="float-right"><?php echo $row['worshipPlace'];?></a>
                  </li>
                  <li class="list-group-item">
                    <i class="fas fa-mobile-alt"></i> <b>교인앱/교인증</b> 
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
					<a class="float-right"><?php echo $row['busUse'];?></a>
                  </li>
                  <li class="list-group-item">
                    <i class="fas fa-language"></i> <b>통역어</b> 
					<a class="float-right">
						<?php
							if ($row['useLanguage'] == ""){
								echo "필요없음";
							}else{
								echo $row['useLanguage'];
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
<?php
	}
?>
    </section>

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