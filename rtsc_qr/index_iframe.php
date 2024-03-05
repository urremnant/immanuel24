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
	if ($worshipDate == ""){
		$sql_baseWorshipDate = "select worshipDate from baseWorshipDateTime";
		$result_baseWorshipDate = mysqli_query($conn, $sql_baseWorshipDate);
		$row_baseWorshipDate = mysqli_fetch_assoc($result_baseWorshipDate);
		$worshipDate = $row_baseWorshipDate['worshipDate'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>임마누엘교회</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <script src="html5-qrcode.min.js"></script>
</head>
<body>

			<section class="content">
			  <div class="container-fluid">
				<div class="row">
				  <div class="col-4">
					<div class="card card-primary">
					  <div class="card-header">
						<h3 class="card-title">QR Code Scan</h3>
					  </div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div id="qr-reader" style="width:100%"></div>
						<div id="qr-reader-results"></div>
					</div>
					<div class="card-footer clearfix">
						<input type="text" class="form-control" id="worshipDate" name="worshipDate" value="<?php echo $worshipDate;?>">
						<select class="custom-select rounded-0" id="worshipPlace" name="worshipPlace">
							<option value="">장소를 선택하세요</option>
							<option value="1층입구-교구"<?php if ($worshipPlace=="1층입구-교구"){echo " selected";}?>>1층입구-교구</option>
							<option value="1층입구-렘넌트/다민족"<?php if ($worshipPlace=="1층입구-렘넌트/다민족"){echo " selected";}?>>1층입구-렘넌트/다민족</option>
							<option value="본당1층"<?php if ($worshipPlace=="본당1층"){echo " selected";}?>>본당1층</option>
							<option value="본당2층"<?php if ($worshipPlace=="본당2층"){echo " selected";}?>>본당2층</option>
							<option value="본당3층"<?php if ($worshipPlace=="본당3층"){echo " selected";}?>>본당3층</option>
							<option value="태영아부실"<?php if ($worshipPlace=="태영아부실"){echo " selected";}?>>태영아부실</option>
							<option value="유아부실"<?php if ($worshipPlace=="유아부실"){echo " selected";}?>>유아부실</option>
							<option value="유치부실"<?php if ($worshipPlace=="유치부실"){echo " selected";}?>>유치부실</option>
							<option value="초등12부실"<?php if ($worshipPlace=="초등12부실"){echo " selected";}?>>초등12부실</option>
							<option value="초등34부실"<?php if ($worshipPlace=="초등34부실"){echo " selected";}?>>초등34부실</option>
							<option value="초등56부실"<?php if ($worshipPlace=="초등56부실"){echo " selected";}?>>초등56부실</option>
							<option value="중등부실"<?php if ($worshipPlace=="중등부실"){echo " selected";}?>>중등부실</option>
							<option value="고등부실"<?php if ($worshipPlace=="고등부실"){echo " selected";}?>>고등부실</option>
							<option value="대학국실"<?php if ($worshipPlace=="대학국실"){echo " selected";}?>>대학국실</option>
							<option value="사랑부실"<?php if ($worshipPlace=="사랑부실"){echo " selected";}?>>사랑부실</option>
							<option value="농인부실"<?php if ($worshipPlace=="농인부실"){echo " selected";}?>>농인부실</option>
							<option value="TCK부실"<?php if ($worshipPlace=="TCK부실"){echo " selected";}?>>TCK부실</option>
							<option value="청년부실"<?php if ($worshipPlace=="청년부실"){echo " selected";}?>>청년부실</option>
							<option value="영어예배부실"<?php if ($worshipPlace=="영어예배부실"){echo " selected";}?>>영어예배부실</option>
							<option value="중국어예배부실"<?php if ($worshipPlace=="중국어예배부실"){echo " selected";}?>>중국어예배부실</option>
							<option value="일본어예배부실"<?php if ($worshipPlace=="일본어예배부실"){echo " selected";}?>>일본어예배부실</option>
							<option value="스페인어예배부실"<?php if ($worshipPlace=="스페인어예배부실"){echo " selected";}?>>스페인어예배부실</option>
							<option value="러시아어예배부실"<?php if ($worshipPlace=="러시아어예배부실"){echo " selected";}?>>러시아어예배부실</option>
							<option value="북한선교부실"<?php if ($worshipPlace=="북한선교부실"){echo " selected";}?>>북한선교부실</option>
							<option value="렘넌트서밋위원회실"<?php if ($worshipPlace=="렘넌트서밋위원회실"){echo " selected";}?>>렘넌트서밋위원회실</option>
						</select>
					</div>
				  </div>
				</div>		
			  </div>
			  <div class="container-fluid">
				<div class="row">
					<iframe id="myIframe">
						<input type="text" class="form-control textInput form-memo form-field-input textInput-readonly" id="scannedText" name="scannedText">
					</iframe>
				</div>		
			  </div>


<?php
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
    </section>


</body>
</html>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        // var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(qrCodeMessage) {
            if (qrCodeMessage !== lastResult) {
                ++countResults;
                lastResult = qrCodeMessage;
                //resultContainer.innerHTML += `<div>[${countResults}] - ${qrCodeMessage}</div>`;
				if (lastResult != ""){
					//document.getElementById('scannedText').value = lastResult;
					myIframe.scannedText.value = lastResult;
					//location.href="result.php?myNo="+lastResult+"&worshipDate="+document.getElementById('worshipDate').value+"&worshipPlace="+document.getElementById('worshipPlace').value;
				}

            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>