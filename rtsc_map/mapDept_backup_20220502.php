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
            <h1 class="m-0">렘넌트서밋위원회</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php
	include "../include/connect.php";	
	$churchareaCode = trim($_REQUEST['churchareaCode']);
	$rtdept1Code = trim($_REQUEST['rtdept1Code']);
	$rtdept2Code = trim($_REQUEST['rtdept2Code']);
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<i class="fas fa-map-marker-alt"></i><b> 부서별 지도보기</b>
				</div>

				  <div class="card-header">
						<div class="col-12">
						  <div class="form-group row">
							<script language = "javascript">
							<!--
							// 분반코드 AJAX
							function getCont(t)
							{
								var obj = window.event.srcElement;
								var tgt = document.getElementById(t);
								var xmlhttp     = fncGetHttpRequest();

								// 두번째 파라미터 데이터를 가져올 페이지 URL 파라미터로 지금 선택된 select 의 값을 넘겨줍니다.
								xmlhttp.open('GET', '../include/getRtdept2.php?rtdept1Code='+obj.value, false);
								xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
								xmlhttp.onreadystatechange = function ()
								{
									if( xmlhttp.readyState=='4' )
									{
										// xmlhttp.status 값이 200 인경우 성공, 컴파일 오류 500, 페이지를 찾을수 없을경우 404, 접근권한 없는경우403
										tgt.innerHTML    = xmlhttp.responseText; // select 된 하위 객체에 값을 입력
									}
								}
								xmlhttp.send();
							}
							function fncGetHttpRequest()
							{
								var caller;
								try {
									caller = new XMLHttpRequest();	// IE 7 or none IE
								}
								catch (e) {
									try	{
										caller = new ActiveXObject("Msxml2.XMLHTTP");	// IE 5, 6
									}
									catch (e) {
										try {
											caller = new ActiveXObject("Microsoft.XMLHTTP");
										}
										catch (e) {
											caller = null; // can't instantiate caller
										}
									}
								}
								return caller;
							}
							function viewDept(){
								if (document.getElementById('rtdept1Code').value == ""){
									alert("부서를 선택하여 주세요.");
									return;
								}
								var churchareaCode = document.getElementById('churchareaCode').value;
								var rtdept1Code = document.getElementById('rtdept1Code').value;
								var rtdept2Code = document.getElementById('rtdept2Code').value;
//								alert(rtdept1Code);
//								alert(rtdept2Code);
								location.href="mapDept.php?churchareaCode="+churchareaCode+"&rtdept1Code="+rtdept1Code+"&rtdept2Code="+rtdept2Code;
							}
							//-->
							</script>
							<div class="col-sm-2">
							<?php
								$sql_churcharea = "select churchareaCode, korParishName from churcharea where churchareaCode <> 'A99999' order by korChurchAreaName, korParishName";
								$result_churcharea = mysqli_query($conn, $sql_churcharea);
							?>
								<select class="custom-select rounded-0" Id="churchareaCode" name="churchareaCode">
									<option value="">교구 선택</option>
							<?php
								while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
							?>
									<option value="<?php echo $row_churcharea['churchareaCode'] ?>"
									<?php
										if ($churchareaCode == $row_churcharea['churchareaCode']){
											echo "selected";
										}
									?>
									><?php echo $row_churcharea['korParishName'] ?></option>
							<?php
								}
							?>
									<option value="A99999" <?php if ($churchareaCode =="A99999"){echo "selected";}?>>미분류</option>
								</select>
							</div>

							<div class="col-sm-2">
								<?php
									//$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
									$sql_rtdept1 = "select rtdept1Code, rtdept1Name, parentsCode from rtdept1 where parentsCode  <> ''order by rtdept1Code";
									$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
									//$row = mysqli_fetch_assoc($result);
									//$cnt = mysqli_num_rows($result);
								?>
									<select class="custom-select rounded-0" Id="rtdept1Code" name="rtdept1Code" onchange='javascript:getCont("sel_2");'>
										<option value="">부서 선택</option>
								<?php
									while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
								?>
										<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"
										<?php
											if ($rtdept1Code == $row_rtdept1['rtdept1Code']){
												echo "selected";
											}
										?>><?php echo $row_rtdept1['rtdept1Name'] ?></option>
								<?php
									}
								?>
									</select>
							</div>
							<div class="col-sm-2">
								<span id='sel_2'>
								<?php
									// 대학부, 사랑부, 농인부, TCK부는 분반이 없다.
									if (($rtdept1Code == "D10012") || ($rtdept1Code == "D10014") || ($rtdept1Code == "D10015")){
								?>
										<select class="custom-select rounded-0" Id="rtdept2Code" name="rtdept2Code">
											<option value="">분반 선택</option>
										</select>

								<?php
									}else{
										$sql_rtdept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode = '".$rtdept1Code."' order by rtdept2Code";
										$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
										//$row = mysqli_fetch_assoc($result);
										//$cnt = mysqli_num_rows($result);
								?>
										<select class="custom-select rounded-0" Id="rtdept2Code" name="rtdept2Code">
											<option value="">분반 선택</option>
								<?php
										while ($row_rtdept2 = mysqli_fetch_assoc($result_rtdept2)) {
								?>
											<option value="<?php echo $row_rtdept2['rtdept2Code'] ?>"
											<?php
												if ($rtdept2Code == $row_rtdept2['rtdept2Code']){
													echo "selected";
												}
											?>><?php echo $row_rtdept2['rtdept2Name'] ?></option>
								<?php
										}
									}
								?>
										</select>
								</span>
							</div>
							<div class="col-sm-6">
								<a href="javascript:viewDept();"><button type="button" class="btn btn-primary">선택항목보기</button></a>
							</div>
						  </div>
						</div>
				  </div>
            </div>
            <!-- /.card -->




          </div>
          <!-- right col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php
	if ($rtdept1Code <> "") {
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div id="map" style="width:100%;height:550px;"></div>

						<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=259ed59323c48f62c7313459d81151e1&libraries=services"></script>
						<script>
						var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
							mapOption = {
								center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
								level: 4 // 지도의 확대 레벨
							};  

						// 지도를 생성합니다    
						var map = new kakao.maps.Map(mapContainer, mapOption); 

						// 주소-좌표 변환 객체를 생성합니다
						var geocoder = new kakao.maps.services.Geocoder();
<?php
	$sql_map = "select korname, address from member where address <>'' ";
	if ($churchareaCode <> ""){
		$sql_map = $sql_map."and churchareaCode = '".$churchareaCode."' "; 
	}
	if ($rtdept1Code <> ""){
		$sql_map = $sql_map."and rtdept1Code='".$rtdept1Code."' ";
	}
	if ($rtdept2Code <> ""){
		$sql_map = $sql_map."and rtdept2Code='".$rtdept2Code."' ";
	}
	$result_map = mysqli_query($conn, $sql_map);
	while ($row_map = mysqli_fetch_assoc($result_map)) {
?>
						// 주소로 좌표를 검색합니다
						geocoder.addressSearch('<?php echo $row_map['address'];?>', function(result, status) {

							// 정상적으로 검색이 완료됐으면 
							 if (status === kakao.maps.services.Status.OK) {

								var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

								// 결과값으로 받은 위치를 마커로 표시합니다
								var marker = new kakao.maps.Marker({
									map: map,
									position: coords
								});

								// 인포윈도우로 장소에 대한 설명을 표시합니다
								var infowindow = new kakao.maps.InfoWindow({
									content: '<div style="width:150px;text-align:center;padding:6px 0;"><?php echo $row_map['korname'];?></div>'
								});
								infowindow.open(map, marker);

								// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
								map.setCenter(coords);
							} 
						});
<?php
	}
?>
						</script>
					</div>
				</div>
			</div>
		</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
	}
?>

  </div>
  <!-- /.content-wrapper -->
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>