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
					<i class="fas fa-map-marker-alt"></i><b> 부서별 지도보기</b> ※ 주소가 없거나 정확하지 않은 사람은 지도에 나오지 않습니다.
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
			<div class="col-sm-3">
				<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title">Search Result</h3>
						</div>
						<div class="card-body">
							<div class="direct-chat-messages2">

<?php
	# $sql_map = "select memberID, photofilename, korname, address from member where address <>'' ";
	$sql_map = "select a.memberID, a.photofilename, a.korname, a.engname, c.korChurchPosition, a.mobile, a.address, (case when left(a.memberID,1) = 'P' then CONCAT('A', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '정교사' then CONCAT('B', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '부교사' then CONCAT('C', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '인턴십교사' then CONCAT('D', a.memberID) when left(a.memberID,1) = 'T' and teacherGubun = '' then CONCAT('E', a.memberID) when left(a.memberID,1) = 'R' then CONCAT('F', a.memberID) end) as newMemberID from member a, rtdept1 b, churchPosition c, churcharea d where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode and a.address <> '' ";
	if ($churchareaCode <> ""){
		$sql_map = $sql_map."and a.churchareaCode = '".$churchareaCode."' "; 
	}
	if ($rtdept1Code <> ""){
		$sql_map = $sql_map."and a.rtdept1Code='".$rtdept1Code."' ";
	}
	if ($rtdept2Code <> ""){
		$sql_map = $sql_map."and a.rtdept2Code='".$rtdept2Code."' ";
	}
	$sql_map = $sql_map."ORDER BY newMemberID asc, a.churchPositionCode asc";
	$result_map = mysqli_query($conn, $sql_map);
?>
						<table class="table table-hover text-nowrap">
<?php
	while ($row_map = mysqli_fetch_assoc($result_map)) {
?>
							<tr>
								<td style="width: 120px">
									  <?php
										If ($row_map['photofilename'] <> "") {
											//파일이 존재하는지 체크
											$filePathCheck = "../upload/".$row_map['photofilename'];
											//echo $filePathCheck;
											if (file_exists($filePathCheck)){
									  ?>
												<a href="content.php?memberID=<?php echo $row_map['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>"><img src="../upload/<?php echo $row_map['photofilename']?>" class="img-circle elevation-2" alt="User Image" width="60"></a>
										  <?php
											}else{
										  ?>
												<a href="content.php?memberID=<?php echo $row_map['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>"><img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="60"></a>
									  <?php
											}
										}else{
									  ?>
											<a href="content.php?memberID=<?php echo $row_map['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>"><img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="60"></a>

									  <?php
										}
									  ?>								
								</td>
								<td>
									<?php
										if (substr($row_map['newMemberID'],0,1)=="A"){
											echo " <span class='btn btn-danger btn-xs'>교역자</span>";
										}
										if (substr($row_map['newMemberID'],0,1)=="B"){
											echo " <span class='btn btn-success btn-xs'>정교사</span>";
										}
										if (substr($row_map['newMemberID'],0,1)=="C"){
											echo " <span class='btn btn-warning btn-xs'>부교사</span>";
										}
										if (substr($row_map['newMemberID'],0,1)=="D"){
											echo " <span class='btn btn-info btn-xs'>인턴십교사</span>";
										}
										if (substr($row_map['newMemberID'],0,1)=="E"){
											if (substr($row_map['memberID'],0,1)=="T"){
												echo " <span class='btn btn-secondary btn-xs'>교사</span>";
											}
										}
										#if (substr($row_map['newMemberID'],0,1)=="F"){
										#	echo " <span class='btn btn-secondary btn-xs'>렘넌트</span>";
										#}
									?>
									<?php 
										echo " ".$row_map['korname'];
										if ($row_map['engname'] <> ""){
											echo "(".$row_map['engname'].")";
										}
									?>
									<br>
									<?php 
										if ($row_map['mobile']<>""){
											echo preg_replace("/(^02.{0}|^01.{1}|[0-9]{4})([0-9]+)([0-9]{3})/", "$1*****$3", $row_map['mobile']);
										}
									?>
									<?php
										if ($row_map['address'] <> ""){
											# echo "<br>".$row_map['address'];
											# echo "<br><a href='#' target='' class='btn btn-xs btn-success'><i class='fas fa-map-marker-alt'></i> 지도보기</a>";
										}
									?>
								</td>
							</tr>
<?php
	}
?>
						</table>

							</div>
						</div>
				</div>
			</div>
<?php
	if ($rtdept1Code <> "") {
?>
			<div class="col-sm-9">
				<div class="card">
					<div class="card-body">
						※ (교) 교역자, (정) 정교사, (부) 부교사, (인) 인턴십교사, (일) 임원 및 일반교사
						<div id="map" style="width:100%;height:550px;"></div>

						<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=259ed59323c48f62c7313459d81151e1&libraries=services"></script>
						<script>
						var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
							mapOption = {
								center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
								level: 7 // 지도의 확대 레벨
							};  

						// 지도를 생성합니다    
						var map = new kakao.maps.Map(mapContainer, mapOption); 

						// 주소-좌표 변환 객체를 생성합니다
						var geocoder = new kakao.maps.services.Geocoder();
<?php
	mysqli_data_seek($result_map, 0);
	while ($row_map = mysqli_fetch_assoc($result_map)) {
		if (substr($row_map['newMemberID'],0,1)=="A"){
			$mapContent = "(교)";
		}
		if (substr($row_map['newMemberID'],0,1)=="B"){
			$mapContent = "(정)";
		}
		if (substr($row_map['newMemberID'],0,1)=="C"){
			$mapContent = "(부)";
		}
		if (substr($row_map['newMemberID'],0,1)=="D"){
			$mapContent = "(인)";
		}
		if (substr($row_map['newMemberID'],0,1)=="E"){
			if (substr($row_map['memberID'],0,1)=="T"){
				$mapContent = "(일)";
			}
		} 
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
									content: '<div style="width:150px;text-align:center;padding:6px 0;"><a href="/rtsc_member/list.php?churchareaCode=<?php echo $churchareaCode;?>&rtdept1Code=<?php echo $rtdept1Code;?>&rtdept2Code=<?php echo $rtdept2Code;?>&mode=Find&Search=korname&SearchString=<?php echo $row_map['korname'];?>" target="_blank"><?php echo $mapContent.$row_map['korname'];?></a></div>'
								});
								infowindow.open(map, marker);

								// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
								map.setCenter(coords);
							} 
						});
<?php
		$mapContent= "";
	}
?>
						</script>

					</div>
				</div>
			</div>
<?php
	}
?>
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