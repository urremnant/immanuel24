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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
<?php
	include "../include/connect.php";

	//데이터 접근권한, 언약의 여정 권한을 체크한다.
	$sql_access = "select dataAccessType, timelineAccessType from homepage_admin where homepage_admin_idx = '".$_SESSION['ss_homepage_admin_idx']."'";
	$result_access = mysqli_query($conn, $sql_access);
	$row_access = mysqli_fetch_assoc($result_access);
	$dataAccessType = $row_access['dataAccessType'];
	$timelineAccessType = $row_access['timelineAccessType'];


	$page			= trim($_REQUEST['page']);
	$memberID		= trim($_REQUEST['memberID']);
	$korname		= trim($_REQUEST['korname']);
	//$churchareaCode	= trim($_REQUEST['churchareaCode']);
	//$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	//$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);
	

	
								// 이름으로부터 memberID 추출 시작
								if ($memberID==""){
										$sql_findmemberID = "SELECT memberID, rtdept1Code, rtdept2Code from member where korname = '".$korname."'";
										$result_findmemberID = mysqli_query($conn, $sql_findmemberID);
										$row_memberID = mysqli_fetch_assoc($result_findmemberID);
										$memberID=  $row_memberID['memberID'];
										$rtdept1Code_db =  $row_memberID['rtdept1Code'];
										$rtdept2Code_db =  $row_memberID['rtdept2Code'];
										
							  }
								// 이름으로부터 memberID 추출 끝

	
	$sql = "SELECT * FROM member where memberID = '".$memberID."' ";
	if ($mode == "Find"){
		if ($Search =="parentsName"){
			$sql = $sql."and CONCAT(family1_korname, family2_korname,family3_korname, family4_korname,family5_korname, family6_korname,family7_korname, family8_korname,family9_korname, family10_korname) like '%".$SearchString."%'";
		}else{
			$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
		}
	}
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
//echo "검색한부서".$rtdept1Code_db."-로그인한부서".$_SESSION['ss_rtdept1code']."<br>";
//echo "검색한분반".$rtdept2Code_db."-로그인한분반".$_SESSION['ss_rtdept2code'];
	
// 권한체크

//	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
	//분반코드가 없는 경우 세션 분반 값을 넣어준다.
	
	if ($rtdept1Code=="D00001"){ echo "관리자";

	} else {
		 //echo "검색한부서".$rtdept1Code_db."-로그인한부서".$_SESSION['ss_rtdept1code'];
		
		if ($rtdept1Code_db == $_SESSION['ss_rtdept1code']) {
		//echo "OK!!!!검색한부서".$rtdept1Code_db."-로그인한부서".$_SESSION['ss_rtdept1code'];
	} else {	echo "<script>alert('권한이 없습니다.');history.back();</script>";
			}
	}
//권한체크 
	
	
	
	//	D00001	렘넌트서밋위원회		
//	D00002	미취학렘넌트국		
//	D00003	초등렘넌트국		
//	D00004	청소년렘넌트국		
//	D00005	대학국		
//	D10001	태영아부	D00002	
//	D10002	유아부	D00002	
//	D10003	유치부	D00002	
//	D10004	초등12부	D00003	
//	D10005	초등34부	D00003	
//	D10006	초등56부	D00003	
//	D10007	중등부	D00004	
//	D10008	고등부	D00004	
//	D10009	대학1부	D00005	
//	D10010	대학2부	D00005	
//	D10011	대학3부	D00005	
//	D10012	사랑부		
	
	
	
	
?>
	<script language = "javascript">
	<!--
	function del(){
		ans = confirm("정말로 삭제하시겠습니까?");
		if(ans == true){
			document.del.submit();
		}
		else{
			return false;
		}
	}
	function addTimeline(memberID){
		window.open("addTimeline.php?memberID="+memberID, "addTimeline", "status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=400");
	}
	function editTimeline(idx){
		window.open("editTimeline.php?idx="+idx, "editTimeline", "status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=400");
	}
	function delTimeline(idx){
		window.open("delTimeline.php?idx="+idx, "delTimeline", "status=no, menubar=no, scrollbars=no, resizable=no, width=400, height=300");
	}
	//-->
	</script>
			<!-- Profile Image -->
			<div class="card card-primary card-outline">
			  <div class="card-body box-profile">
				<div class="text-center">
				  <?php
					If ($row['photofilename'] <> "") {
						//파일이 존재하는지 체크
						$filePathCheck = "../upload/".$row['photofilename'];
						//echo $filePathCheck;
						if (file_exists($filePathCheck)){
				  ?>
							<img src="../upload/<?echo $row['photofilename']?>" class="profile-user-img img-fluid img-circle" alt="User Image" width="60">
					  <?php
						}else{
					  ?>
							<img src="/image/photox.jpg" class="profile-user-img img-fluid img-circle" alt="User Image" width="60">
				  <?php
						}
					}else{
						echo "<img src='/image/photox.jpg' class='profile-user-img img-fluid img-circle' alt='User Image' width='60'>";
					}
				  ?>
				</div>
				<h3 class="profile-username text-center"><?php echo $row['korname'] ?></h3>

				<div class="text-center">
					<?php
						if ($dataAccessType == "W"){
					?>
						<a class="btn btn-info btn-sm" href="edit.php?page=<?php echo $page?>&memberID=<?php echo $row['memberID'] ?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><i class="fas fa-pencil-alt"></i> Edit</a>
						<a class="btn btn-danger btn-sm" href="javascript:del()"><i class="fas fa-trash"></i> Delete</a>
					<?php
						}
					?>
						<a class="btn btn-info btn-sm" href="list.php?page=<?php echo $page?>&churchareaCode=<?php echo $churchareaCode ?>&rtdept1Code=<?php echo $rtdept1Code ?>&rtdept2Code=<?php echo $rtdept2Code ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><i class="far fa-list-alt"></i> list</a>
				</div>
				<p></p>
				<ul class="list-group list-group-unbordered mb-3">
				  <li class="list-group-item">
					<i class="fas fa-birthday-cake"></i> <b>생년월일</b> 
					<?php 
						if ($row['birthday']<>""){
					?>
						<a class="float-right"><?php echo substr($row['birthday'], 0, 4)."년 ".substr($row['birthday'], 4, 2)."월 ".substr($row['birthday'],-2)."일" ?></a>
					<?php
						}
					?>
				  </li>
                  <li class="list-group-item">
                    <i class="fas fa-mobile-alt"></i> <b>핸드폰</b>
					<?php
						if ($row['mobile']<>""){
					?>
							<a href="tel:<?php echo $row['mobile']?>" class="float-right"><?php echo $row['mobile']?></a>
					<?php
						}
					?>
                  </li>
                  <li class="list-group-item">
                    <i class="far fa-envelope"></i> <b>이메일</b>
					<?php
						if ($row['email']<>""){
					?>
							<a href="mailto:<?php echo $row['email']?>" class="float-right"><?php echo $row['email']?></a>
					<?php
						}
					?>
                  </li>
				  <li class="list-group-item">
					<i class="fas fa-school"></i> <b>학교</b>
					<?php
						if ($row['schoolinfo']<>""){
					?>
							<a class="float-right"><?php echo $row['schoolinfo']?></a>
					<?php
						}
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-crosshairs"></i> <b>비전</b>
					<?php
						if ($row['vision']<>""){
					?>
							<a class="float-right"><?php echo $row['vision']?></a>
					<?php
						}
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-user-md"></i> <b>직업</b>
					<?php
						if ($row['job']<>""){
					?>
							<a class="float-right"><?php echo $row['job']?></a>
					<?php
						}
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-building"></i> <b>직장</b>
					<?php
						if ($row['company']<>""){
					?>
							<a class="float-right"><?php echo $row['company']?></a>
					<?php
						}
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-globe-africa"></i> <b>나라/언어</b>
					<?php
						if ($row['countryCode']<>""){
							$sql_country = "select korCountryName from country where countryCode = '".$row['countryCode']."'";
							$result_country = mysqli_query($conn, $sql_country);
							$row_country = mysqli_fetch_assoc($result_country);
							$country_language = $row_country['korCountryName'];
							if ($row['language']<>""){
								$country_language = $country_language."/".$row['language'];
								echo '<a class="float-right">'.$country_language.'</a>';
							}
						}else{
							if ($row['language']<>""){
								echo '<a class="float-right">'.$row['language'].'</a>';
							}
						}
					?>
				  </li>

				  <li class="list-group-item">
					<i class="fas fa-layer-group"></i></i> <b>관심전문별</b>
					<?php
						if ($row['expertMeetingCode']<>"EP9999"){
							$sql_expertMeeting = "select korProfessional from expertMeeting where expertMeetingCode = '".$row['expertMeetingCode']."'";
							$result_expertMeeting = mysqli_query($conn, $sql_expertMeeting);
							$row_expertMeeting = mysqli_fetch_assoc($result_expertMeeting);
							echo '<a class="float-right">'.$row_expertMeeting['korProfessional'].'</a>';
						}
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-house-user"></i></i> <b>주소</b>
				  </li>
				  <li class="list-group-item">
					<?php
						if ($row['zipcode']<>""){
					?>
							[<?php echo $row['zipcode']?>]
					<?php
						}
					?>
					<?php
						if ($row['address']<>""){
					?>
							<?php echo $row['address']?>
					<?php
						}
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-map"></i> <b>훈련</b>
				  </li>
				  <li class="list-group-item">
					<?php
						if ($row['train1'] == "Y"){
							$train = $train."초등합숙/";
						}
						if ($row['train2'] == "Y"){
							$train = $train."중고합숙/";
						}
						if ($row['train3'] == "Y"){
							$train = $train."일반합숙/";
						}
						if ($row['train4'] == "Y"){
							$train = $train."순회팀합숙/";
						}
						if ($row['train5'] == "Y"){
							$train = $train."70인1차/";
						}
						if ($row['train6'] == "Y"){
							$train = $train."미션홈/";
						}
						if ($row['train7'] == "Y"){
							$train = $train."전문별팀합숙/";
						}
						if ($row['train8'] == "Y"){
							$train = $train."70인3차/";
						}
						if ($row['train9'] == "Y"){
							$train = $train."전도합숙/";
						}
						if ($row['train10'] == "Y"){
							$train = $train."초등신학원/";
						}
						if ($row['train11'] == "Y"){
							$train = $train."청소년신학원/";
						}
						if ($row['train12'] == "Y"){
							$train = $train."대학신학원/";
						}
						if ($row['train13'] == "Y"){
							$train = $train."일반신학원/";
						}
						if ($row['train14'] == "Y"){
							$train = $train."선교사훈련원/";
						}
						if ($row['train15'] == "Y"){
							$train = $train."집중신학원/";
						}
						if ($row['train16'] == "Y"){
							$train = $train."RTS/";
						}
						if ($row['train17'] == "Y"){
							$train = $train."RU/";
						}
						if ($row['train18'] == "Y"){
							$train = $train."전도전문훈련원/";
						}
						if ($row['train19'] == "Y"){
							$train = $train."중직자대학원";
						}
						$str_cut = substr($train,-1);
						if ($str_cut === '/') {
							$train = substr($train,0,-1);
						}
						echo $train;
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-house-user"></i></i> <b>학원 동아리 방과후교실</b>
				  </li>
				  <li class="list-group-item">
					<?php
						if ($row['afterschool']<>""){
					?>
							<?php echo $row['afterschool']?>
					<?php
						}
					?>
				  </li>
				  <li class="list-group-item">
					<i class="fas fa-house-user"></i></i> <b>취미 특기 놀이</b>
				  </li>
				  <li class="list-group-item">
					<?php
						if ($row['hobby']<>""){
					?>
							<?php echo $row['hobby']?>
					<?php
						}
					?>
				  </li>

				</ul>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->

		  </div>


          <div class="col-md-8">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="deptInfo-tab" data-toggle="pill" href="#deptInfo" role="tab" aria-controls="deptInfo" aria-selected="true">부서정보</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="familyInfo-tab" data-toggle="pill" href="#familyInfo" role="tab" aria-controls="familyInfo" aria-selected="false">가족관계</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="spiritualInfo-tab" data-toggle="pill" href="#spiritualInfo" role="tab" aria-controls="spiritualInfo" aria-selected="false">영적정보</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="memberTimeline-tab" data-toggle="pill" href="#memberTimeline" role="tab" aria-controls="memberTimeline" aria-selected="false">언약의 여정</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="deptInfo" role="tabpanel" aria-labelledby="deptInfo-tab">
						<div class="card-header">
						  <h3 class="card-title"><i class="fas fa-info-circle"></i> 부서</h3>
						</div>
						<div class="card-body table-responsive p-0">
						<table class="table text-nowrap table-bordered">
							<tr class="text-center"> 
								<td bgcolor="#F6F6F6">교구</td>
								<td>
								<?php
									if ($row['churchareaCode']<>"A99999"){
										$sql_churcharea = "SELECT korChurchAreaName, korParishName from churcharea where churchareaCode = '".$row['churchareaCode']."'";
										$result_churcharea = mysqli_query($conn, $sql_churcharea);
										$row_churcharea = mysqli_fetch_assoc($result_churcharea);
										echo $row_churcharea['korChurchAreaName']." ".$row_churcharea['korParishName'];
									}
								?>
								</td>
								<td bgcolor="#F6F6F6">부서</td>
								<td>
								<?php
									if ($row['rtdept1Code']<>""){
										$sql_rtdept1 = "SELECT rtdept1Name from rtdept1 where rtdept1Code = '".$row['rtdept1Code']."'";
										$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
										$row_rtdept1 = mysqli_fetch_assoc($result_rtdept1);
										echo $row_rtdept1['rtdept1Name'];
									}
								?>
								</td>
								<td bgcolor="#F6F6F6">분반</td>
								<td>
								<?php
									if ($row['rtdept2Code']<>""){
										$sql_rtdept2 = "SELECT rtdept2Name from rtdept2 where rtdept2Code = '".$row['rtdept2Code']."'";
										$result_rtdept2 = mysqli_query($conn, $sql_rtdept2);
										$row_rtdept2 = mysqli_fetch_assoc($result_rtdept2);
										echo $row_rtdept2['rtdept2Name'];
									}
								?>
								</td>
								<td bgcolor="#F6F6F6">담당교역자</td>
								<td>
									<?php
										if ($row['pastorID']<>""){
											$sql_pastor = "select a.korname, b.korChurchPosition from member a, churchPosition b where a.churchPositionCode = b.churchPositionCode and a.memberID = '".$row['pastorID']."'";
											$result_pastor = mysqli_query($conn, $sql_pastor);
											$row_pastor = mysqli_fetch_assoc($result_pastor);
											echo $row_pastor['korname']." ".$row_pastor['korChurchPosition'];
										}
									?>
								</td>
							</tr>
						</table>
						</div>
						<div class="card-header">
						  <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> 담당교사</h3>
						</div>
						<div class="card-body table-responsive p-0">
						<table class="table text-nowrap table-bordered">
					<?php
						if ($row['teacher1ID']<>""){
							$sql_teacher1 = "select a.korname, b.korChurchPosition, a.mobile, a.train1, a.train2, a.train3, a.train4, a.train5, a.train6, a.train7, a.train8, a.train9, a.train10, a.train11, a.train12, a.train13, a.train14, a.train15, a.train16, a.train17, a.train18, a.train19, a.job, a.company, a.zipcode, a.address from member a, churchPosition b where a.churchPositionCode = b.churchPositionCode and a.memberID = '".$row['teacher1ID']."'";
							$result_teacher1 = mysqli_query($conn, $sql_teacher1);
							$row_teacher1 = mysqli_fetch_assoc($result_teacher1);
					?>
							<tr class="text-center">
								<td bgcolor="#F6F6F6">성명</td>
								<td><?php echo $row_teacher1['korname']?></td>
								<td bgcolor="#F6F6F6">직분</td>
								<td><?php echo $row_teacher1['korChurchPosition']?></td>
								<td bgcolor="#F6F6F6">연락처</td>
								<td><?php echo $row_teacher1['mobile']?></td>
							</tr>
							<tr class="text-center">
								<td bgcolor="#F6F6F6">훈련정도</td>
								<td colspan="3">
								<?php
									if ($row_teacher1['train1'] == "Y"){
										$train_teacher1 = $train_teacher1."초등합숙/";
									}
									if ($row_teacher1['train2'] == "Y"){
										$train_teacher1 = $train_teacher1."중고합숙/";
									}
									if ($row_teacher1['train3'] == "Y"){
										$train_teacher1 = $train_teacher1."일반합숙/";
									}
									if ($row_teacher1['train4'] == "Y"){
										$train_teacher1 = $train_teacher1."순회팀합숙/";
									}
									if ($row_teacher1['train5'] == "Y"){
										$train_teacher1 = $train_teacher1."70인1차/";
									}
									if ($row_teacher1['train6'] == "Y"){
										$train_teacher1 = $train_teacher1."미션홈/";
									}
									if ($row_teacher1['train7'] == "Y"){
										$train_teacher1 = $train_teacher1."전문별팀합숙/";
									}
									if ($row_teacher1['train8'] == "Y"){
										$train_teacher1 = $train_teacher1."70인3차/";
									}
									if ($row_teacher1['train9'] == "Y"){
										$train_teacher1 = $train_teacher1."전도합숙/";
									}
									if ($row_teacher1['train10'] == "Y"){
										$train_teacher1 = $train_teacher1."초등신학원/";
									}
									if ($row_teacher1['train11'] == "Y"){
										$train_teacher1 = $train_teacher1."청소년신학원/";
									}
									if ($row_teacher1['train12'] == "Y"){
										$train_teacher1 = $train_teacher1."대학신학원/";
									}
									if ($row_teacher1['train13'] == "Y"){
										$train_teacher1 = $train_teacher1."일반신학원/";
									}
									if ($row_teacher1['train14'] == "Y"){
										$train_teacher1 = $train_teacher1."선교사훈련원/";
									}
									if ($row_teacher1['train15'] == "Y"){
										$train_teacher1 = $train_teacher1."집중신학원/";
									}
									if ($row_teacher1['train16'] == "Y"){
										$train_teacher1 = $train_teacher1."RTS/";
									}
									if ($row_teacher1['train17'] == "Y"){
										$train_teacher1 = $train_teacher1."RU/";
									}
									if ($row_teacher1['train18'] == "Y"){
										$train_teacher1 = $train_teacher1."전도전문훈련원/";
									}
									if ($row_teacher1['train19'] == "Y"){
										$train_teacher1 = $train_teacher1."중직자대학원";
									}
									$str_cut_teacher1 = substr($train_teacher1,-1);
									if ($str_cut_teacher1 === '/') {
										$train_teacher1 = substr($train_teacher1,0,-1);
									}
									echo $train_teacher1;
								?>
								</td>
								<td bgcolor="#F6F6F6">직업/직장</td>
								<td><?php echo $row_teacher1['job']."/".$row_teacher1['company']?></td>
							</tr>
							<tr class="text-center">		
								<td bgcolor="#F6F6F6">주소</td>
								<td colspan="5">
								<?php
									if ($row_teacher1['zipcode']<>""){
								?>
										[<?php echo $row_teacher1['zipcode']?>]
								<?php
									}
								?>
								<?php
									if ($row_teacher1['address']<>""){
								?>
										<?php echo $row_teacher1['address']?>
								<?php
									}
								?>
								</td>
							</tr>
					<?php
						}
						if ($row['teacher2ID']<>""){
							$sql_teacher2 = "select a.korname, b.korChurchPosition, a.mobile, a.train1, a.train2, a.train3, a.train4, a.train5, a.train6, a.train7, a.train8, a.train9, a.train10, a.train11, a.train12, a.train13, a.train14, a.train15, a.train16, a.train17, a.train18, a.train19, a.job, a.company, a.zipcode, a.address from member a, churchPosition b where a.churchPositionCode = b.churchPositionCode and a.memberID = '".$row['teacher2ID']."'";
							$result_teacher2 = mysqli_query($conn, $sql_teacher2);
							$row_teacher2 = mysqli_fetch_assoc($result_teacher2);
					?>
							<tr class="text-center">
								<td bgcolor="#F6F6F6">성명</td>
								<td><?php echo $row_teacher2['korname']?></td>
								<td bgcolor="#F6F6F6">직분</td>
								<td><?php echo $row_teacher2['korChurchPosition']?></td>
								<td bgcolor="#F6F6F6">연락처</td>
								<td><?php echo $row_teacher2['mobile']?></td>
							</tr>
							<tr class="text-center">
								<td bgcolor="#F6F6F6">훈련정도</td>
								<td colspan="3">
								<?php
									if ($row_teacher2['train1'] == "Y"){
										$train_teacher2 = $train_teacher2."초등합숙/";
									}
									if ($row_teacher2['train2'] == "Y"){
										$train_teacher2 = $train_teacher2."중고합숙/";
									}
									if ($row_teacher2['train3'] == "Y"){
										$train_teacher2 = $train_teacher2."일반합숙/";
									}
									if ($row_teacher2['train4'] == "Y"){
										$train_teacher2 = $train_teacher2."순회팀합숙/";
									}
									if ($row_teacher2['train5'] == "Y"){
										$train_teacher2 = $train_teacher2."70인1차/";
									}
									if ($row_teacher2['train6'] == "Y"){
										$train_teacher2 = $train_teacher2."미션홈/";
									}
									if ($row_teacher2['train7'] == "Y"){
										$train_teacher2 = $train_teacher2."전문별팀합숙/";
									}
									if ($row_teacher2['train8'] == "Y"){
										$train_teacher2 = $train_teacher2."70인3차/";
									}
									if ($row_teacher2['train9'] == "Y"){
										$train_teacher2 = $train_teacher2."전도합숙/";
									}
									if ($row_teacher2['train10'] == "Y"){
										$train_teacher2 = $train_teacher2."초등신학원/";
									}
									if ($row_teacher2['train11'] == "Y"){
										$train_teacher2 = $train_teacher2."청소년신학원/";
									}
									if ($row_teacher2['train12'] == "Y"){
										$train_teacher2 = $train_teacher2."대학신학원/";
									}
									if ($row_teacher2['train13'] == "Y"){
										$train_teacher2 = $train_teacher2."일반신학원/";
									}
									if ($row_teacher2['train14'] == "Y"){
										$train_teacher2 = $train_teacher2."선교사훈련원/";
									}
									if ($row_teacher2['train15'] == "Y"){
										$train_teacher2 = $train_teacher2."집중신학원/";
									}
									if ($row_teacher2['train16'] == "Y"){
										$train_teacher2 = $train_teacher2."RTS/";
									}
									if ($row_teacher2['train17'] == "Y"){
										$train_teacher2 = $train_teacher2."RU/";
									}
									if ($row_teacher2['train18'] == "Y"){
										$train_teacher2 = $train_teacher2."전도전문훈련원/";
									}
									if ($row_teacher2['train19'] == "Y"){
										$train_teacher2 = $train_teacher2."중직자대학원";
									}
									$str_cut_teacher2 = substr($train_teacher2,-1);
									if ($str_cut_teacher2 === '/') {
										$train_teacher2 = substr($train_teacher2,0,-1);
									}
									echo $train_teacher2;
								?>
								</td>
								<td bgcolor="#F6F6F6">직업/직장</td>
								<td><?php echo $row_teacher2['job']."/".$row_teacher2['company']?></td>
							</tr>
							<tr class="text-center">
								<td bgcolor="#F6F6F6">주소</td>
								<td colspan="5">
								<?php
									if ($row_teacher2['zipcode']<>""){
								?>
										[<?php echo $row_teacher2['zipcode']?>]
								<?php
									}
								?>
								<?php
									if ($row_teacher2['address']<>""){
								?>
										<?php echo $row_teacher2['address']?>
								<?php
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
                  <div class="tab-pane fade" id="familyInfo" role="tabpanel" aria-labelledby="familyInfo-tab">
					<!-- 가족관계 시작 -->
					<table class="table table-hover text-nowrap">
					<thead>
						<tr class="text-center">
							<th>성명</th>
							<th>관계</th>
							<th>직분</th>
							<th>연락처</th>
							<th>교회</th>
							<th>직업/학교</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if ($row['family1_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family1_korname'] ?></td>
						<td><?php echo $row['family1_relation'] ?></td>
						<td><?php echo $row['family1_korChurchPosition'] ?></td>
						<td><?php echo $row['family1_mobile'] ?></td>
						<td><?php echo $row['family1_churchname'] ?></td>
						<td><?php echo $row['family1_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family2_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family2_korname'] ?></td>
						<td><?php echo $row['family2_relation'] ?></td>
						<td><?php echo $row['family2_korChurchPosition'] ?></td>
						<td><?php echo $row['family2_mobile'] ?></td>
						<td><?php echo $row['family2_churchname'] ?></td>
						<td><?php echo $row['family2_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family3_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family3_korname'] ?></td>
						<td><?php echo $row['family3_relation'] ?></td>
						<td><?php echo $row['family3_korChurchPosition'] ?></td>
						<td><?php echo $row['family3_mobile'] ?></td>
						<td><?php echo $row['family3_churchname'] ?></td>
						<td><?php echo $row['family3_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family4_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family4_korname'] ?></td>
						<td><?php echo $row['family4_relation'] ?></td>
						<td><?php echo $row['family4_korChurchPosition'] ?></td>
						<td><?php echo $row['family4_mobile'] ?></td>
						<td><?php echo $row['family4_churchname'] ?></td>
						<td><?php echo $row['family4_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family5_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family5_korname'] ?></td>
						<td><?php echo $row['family5_relation'] ?></td>
						<td><?php echo $row['family5_korChurchPosition'] ?></td>
						<td><?php echo $row['family5_mobile'] ?></td>
						<td><?php echo $row['family5_churchname'] ?></td>
						<td><?php echo $row['family5_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family6_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family6_korname'] ?></td>
						<td><?php echo $row['family6_relation'] ?></td>
						<td><?php echo $row['family6_korChurchPosition'] ?></td>
						<td><?php echo $row['family6_mobile'] ?></td>
						<td><?php echo $row['family6_churchname'] ?></td>
						<td><?php echo $row['family6_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family7_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family7_korname'] ?></td>
						<td><?php echo $row['family7_relation'] ?></td>
						<td><?php echo $row['family7_korChurchPosition'] ?></td>
						<td><?php echo $row['family7_mobile'] ?></td>
						<td><?php echo $row['family7_churchname'] ?></td>
						<td><?php echo $row['family7_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family8_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family8_korname'] ?></td>
						<td><?php echo $row['family8_relation'] ?></td>
						<td><?php echo $row['family8_korChurchPosition'] ?></td>
						<td><?php echo $row['family8_mobile'] ?></td>
						<td><?php echo $row['family8_churchname'] ?></td>
						<td><?php echo $row['family8_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family9_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family9_korname'] ?></td>
						<td><?php echo $row['family9_relation'] ?></td>
						<td><?php echo $row['family9_korChurchPosition'] ?></td>
						<td><?php echo $row['family9_mobile'] ?></td>
						<td><?php echo $row['family9_churchname'] ?></td>
						<td><?php echo $row['family9_job'] ?></td>
					</tr>
					<?php
						}
						if ($row['family10_relation']<>""){
					?>
					<tr class="text-center">
						<td><?php echo $row['family10_korname'] ?></td>
						<td><?php echo $row['family10_relation'] ?></td>
						<td><?php echo $row['family10_korChurchPosition'] ?></td>
						<td><?php echo $row['family10_mobile'] ?></td>
						<td><?php echo $row['family10_churchname'] ?></td>
						<td><?php echo $row['family10_job'] ?></td>
					</tr>
					<?php
						}
					?>
					</tfoot>
					</table>
					<!-- 가족관계 끝 -->
                  </div>
                  <div class="tab-pane fade" id="spiritualInfo" role="tabpanel" aria-labelledby="spiritualInfo-tab">
						<div class="card-header">
						  <h3 class="card-title"><i class="fas fa-pray"></i> 기도제목</h3>
						</div>
						<div class="card-body table-responsive p-0">
						<table class="table">
							<tr>
								<td><?php echo str_replace("\r\n", "<br>", $row['prayertopic']) ?></td>
							</tr>
						</table>
						</div>
						<div class="card-header">
						  <h3 class="card-title"><i class="fas fa-bible"></i> CVDIP</h3>
						</div>
						<div class="card-body table-responsive p-0">
						<table class="table">
							<tr>
								<td><?php echo str_replace("\r\n", "<br>", $row['cvdip']) ?></td>
							</tr>
						</table>
						</div>
						<div class="card-header">
						  <h3 class="card-title"><i class="fas fa-network-wired"></i> 현장시스템</h3>
						</div>
						<div class="card-body table-responsive p-0">
						<table class="table">
							<tr>
								<td><?php echo $row['fieldsystem1']." ".$row['fieldsystem2'] ?></td>
							</tr>
						</table>
						</div>

                  </div>
                  <div class="tab-pane fade" id="memberTimeline" role="tabpanel" aria-labelledby="memberTimeline-tab">
						<div class="post">
							<div class="card-header">
								<h3 class="card-title"><i class="fas fa-edit"></i> 언약의 여정</h3>
							</div>
							<div class="card-header">
								※ 영적배경(가정,가문), 소통하는사람(모델,멘토,친구), 삶의 모습(학교,가정,교회), 개인영적상태(신앙생활), 개인상담, 팀사역 내용(기도제목)등을 자유롭게 기록해주세요.
							</div>
							<div class="card-body">
<?php
	switch ($timelineAccessType){
		case "X" :
			echo "언약의 여정을 열람할 권한이 없습니다.";	
			break;
		case "R" :
?>
							<?php
								$sql_timeline = "select a.idx, b.korname, b.photofilename, c.korChurchPosition, a.content, a.inputDate from member_timeline a, homepage_admin b, churchPosition c where a.homepage_admin_idx = b.homepage_admin_idx and b.churchPositionCode = c.churchPositionCode and a.memberID = '".$row['memberID']."' order by a.inputDate";
								//echo $sql_timeline;
								$result_timeline = mysqli_query($conn, $sql_timeline);
								while ($row_timeline = mysqli_fetch_assoc($result_timeline)) {
									If ($row_timeline['korname'] == $_SESSION['ss_korname']) {
							?>
									<div class="direct-chat-msg">
										<div class="direct-chat-infos clearfix">
											<span class="direct-chat-name float-left"><?php echo $row_timeline['korname']?></span>
											<span class="float-right"><?php echo $row_timeline['inputDate']?></span>
										</div>
							<?php
									}else{
							?>
									<div class="direct-chat-msg right">
										<div class="direct-chat-infos clearfix">
											<span class="direct-chat-name float-right"><?php echo $row_timeline['korname']?></span>
											<span class="float-left"><?php echo $row_timeline['inputDate']?></span>
										</div>
							<?php
									}
							?>
									<!-- /.direct-chat-infos -->
									<?php
										If ($row_timeline['photofilename'] <> "") {
									?>
										<img class="direct-chat-img" src="/upload/<?php echo $row_timeline['photofilename'] ?>">
									<?php
										}else{
									?>
										<img src="/image/photox.jpg"  class="direct-chat-img" alt="User Image">
									<?php
										}
									?>
										<div class="direct-chat-text">
											<?php echo str_replace("\r\n", "<br>", $row_timeline['content']) ?>

									<?php
										If ($row_timeline['korname'] == $_SESSION['ss_korname']) {
									?>
											<p>
											<a class="btn btn-info btn-sm" href="javascript:editTimeline('<?php echo $row_timeline['idx'] ?>');">
												<i class="fas fa-pencil-alt"></i>Edit</a>
											<a class="btn btn-danger btn-sm" href="javascript:delTimeline('<?php echo $row_timeline['idx'] ?>');">
											<i class="fas fa-trash"></i>Delete</a>
											</p>
									<?php
										}
									?>
										</div>


										<!-- /.direct-chat-text -->
									</div>
									<!-- /.direct-chat-msg -->
							<?php
								}
							?>
							</div>
<?php
			break;
		case "W" :
?>
							<?php
								$sql_timeline = "select a.idx, b.korname, b.photofilename, c.korChurchPosition, a.content, a.inputDate from member_timeline a, homepage_admin b, churchPosition c where a.homepage_admin_idx = b.homepage_admin_idx and b.churchPositionCode = c.churchPositionCode and a.memberID = '".$row['memberID']."' order by a.inputDate";
								//echo $sql_timeline;
								$result_timeline = mysqli_query($conn, $sql_timeline);
								while ($row_timeline = mysqli_fetch_assoc($result_timeline)) {
									If ($row_timeline['korname'] == $_SESSION['ss_korname']) {
							?>
									<div class="direct-chat-msg">
										<div class="direct-chat-infos clearfix">
											<span class="direct-chat-name float-left"><?php echo $row_timeline['korname']?></span>
											<span class="float-right"><?php echo $row_timeline['inputDate']?></span>
										</div>
							<?php
									}else{
							?>
									<div class="direct-chat-msg right">
										<div class="direct-chat-infos clearfix">
											<span class="direct-chat-name float-right"><?php echo $row_timeline['korname']?></span>
											<span class="float-left"><?php echo $row_timeline['inputDate']?></span>
										</div>
							<?php
									}
							?>
									<!-- /.direct-chat-infos -->
									<?php
										If ($row_timeline['photofilename'] <> "") {
									?>
										<img class="direct-chat-img" src="/upload/<?php echo $row_timeline['photofilename'] ?>">
									<?php
										}else{
									?>
										<img src="/image/photox.jpg"  class="direct-chat-img" alt="User Image">
									<?php
										}
									?>
										<div class="direct-chat-text">
											<?php echo str_replace("\r\n", "<br>", $row_timeline['content']) ?>

									<?php
										If ($row_timeline['korname'] == $_SESSION['ss_korname']) {
									?>
											<p>
											<a class="btn btn-info btn-sm" href="javascript:editTimeline('<?php echo $row_timeline['idx'] ?>');">
												<i class="fas fa-pencil-alt"></i>Edit</a>
											<a class="btn btn-danger btn-sm" href="javascript:delTimeline('<?php echo $row_timeline['idx'] ?>');">
											<i class="fas fa-trash"></i>Delete</a>
											</p>
									<?php
										}
									?>
										</div>


										<!-- /.direct-chat-text -->
									</div>
									<!-- /.direct-chat-msg -->
							<?php
								}
							?>
							</div>
							<div class="card-header">
								<a href="javascript:addTimeline('<?php echo $row['memberID']?>');"><button type="button" class="btn btn-block btn-success btn-lg">언약의 여정 추가하기</button></a>
							</div>
<?php
			break;
		default :
	}
?>
						</div>
                  </div>
                </div>
              </div>
			</div>
		  </div>
			
	<form name="del" method="post" action="del.php" enctype='multipart/form-data'>
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="memberID" value="<?php echo $memberID ?>">
		<input type="hidden" name="churchareaCode" value="<?php echo $churchareaCode ?>">
		<input type="hidden" name="rtdept1Code" value="<?php echo $rtdept1Code ?>">
		<input type="hidden" name="rtdept2Code" value="<?php echo $rtdept2Code ?>">
		<input type="hidden" name="mode" value="<?php echo $mode ?>">
		<input type="hidden" name="Search" value="<?php echo $Search ?>">
		<input type="hidden" name="SearchString" value="<?php echo $SearchString ?>">
	</form>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>

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
