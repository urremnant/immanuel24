<?php
	include "header.php";
	include "Navbar.php";
	include "leftMenu.php";
?>


<?php
	include "powerCheck.php";
	include "../include/connect.php";
  
	$mode				= trim($_REQUEST['mode']);
	$Search				= trim($_REQUEST['Search']);
	$SearchString		= trim($_REQUEST['SearchString']);
	$korChurchAreaName	= trim($_REQUEST['korChurchAreaName']);
	$korParishName		= trim($_REQUEST['korParishName']);

/*
	A00001	동북권역	11교구
	A00002	동북권역	12교구
	A00003	동북권역	13교구
	A00004	동남권역	21교구
	A00005	동남권역	22교구
	A00006	동남권역	23교구
	A00007	동남권역	24교구
	A00008	동남권역	25교구
	A00009	동남권역	26교구
	A00010	서남권역	31교구
	A00011	서남권역	32교구
	A00012	서남권역	33교구
	A00013	서남권역	34교구
	A00014	서북권역	41교구
	A00015	서북권역	42교구
	A00016	서북권역	43교구
	A99999	미분류	미분류
*/		

	if ($korParishName == ""){
		if ($korChurchAreaName == "동북권역"){
			$churchareaCode = "('A00001','A00002','A00003')";
		}
		if ($korChurchAreaName == "동남권역"){
			$churchareaCode = "('A00004','A00005','A00006','A00007','A00008','A00009')";
		}
		if ($korChurchAreaName == "서남권역"){
			$churchareaCode = "('A00010','A00011','A00012','A00013')";
		}
		if ($korChurchAreaName == "서북권역"){
			$churchareaCode = "('A00014','A00015','A00016')";
		}
	}else{
		if ($korParishName == "11교구"){
			$churchareaCode = "A00001";
		}
		if ($korParishName == "12교구"){
			$churchareaCode = "A00002";
		}
		if ($korParishName == "13교구"){
			$churchareaCode = "A00003";
		}
		if ($korParishName == "21교구"){
			$churchareaCode = "A00004";
		}
		if ($korParishName == "22교구"){
			$churchareaCode = "A00005";
		}
		if ($korParishName == "23교구"){
			$churchareaCode = "A00006";
		}
		if ($korParishName == "24교구"){
			$churchareaCode = "A00007";
		}
		if ($korParishName == "25교구"){
			$churchareaCode = "A00008";
		}
		if ($korParishName == "26교구"){
			$churchareaCode = "A00009";
		}
		if ($korParishName == "31교구"){
			$churchareaCode = "A00010";
		}
		if ($korParishName == "32교구"){
			$churchareaCode = "A00011";
		}
		if ($korParishName == "33교구"){
			$churchareaCode = "A00012";
		}
		if ($korParishName == "34교구"){
			$churchareaCode = "A00013";
		}
		if ($korParishName == "41교구"){
			$churchareaCode = "A00014";
		}
		if ($korParishName == "42교구"){
			$churchareaCode = "A00015";
		}
		if ($korParishName == "43교구"){
			$churchareaCode = "A00016";
		}
	}

	$sql = "SELECT COUNT(memberID) AS cnt FROM member a, rtdept1 b, churchPosition c, churcharea d where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode ";
	if ($korParishName == ""){
		$sql = $sql."and a.churchareaCode in ".$churchareaCode." "; 
	}else{
		$sql = $sql."and a.churchareaCode = '".$churchareaCode."' "; 
	}
	if ($mode == "Find"){
		if ($Search =="parentsName"){
			$sql = $sql."and CONCAT(family1_korname, family2_korname,family3_korname, family4_korname,family5_korname, family6_korname,family7_korname, family8_korname,family9_korname, family10_korname) like '%".$SearchString."%'";
		}else{
			$sql = $sql."and ".$Search." like '%".$SearchString."%'";
		}
	}
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$total_count = $row['cnt'];

	$page_rows = 10; // 페이지당 목록 수
	$page = $_GET['page'];

	$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; }					// 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $page_rows;		// 시작 열을 구함

	$list = array(); // 회원 정보를 담을 배열 선언

	$sql = "select a.memberID, a.photofilename, d.korParishName, b.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code), '') as rtdept2Name, a.korname, c.korChurchPosition, a.mobile,(case left(a.memberID,1) when 'P' then CONCAT('A', a.memberID) when 'T' then CONCAT('B', a.memberID) when 'R' then CONCAT('C', a.memberID) end) as newMemberID from member a, rtdept1 b, churchPosition c, churcharea d where a.rtdept1Code = b.rtdept1Code and a.churchPositionCode = c.churchPositionCode and a.churchareaCode = d.churchareaCode "; // 회원 정보를 조회
	if ($korParishName == ""){
		$sql = $sql."and a.churchareaCode in ".$churchareaCode." "; 
	}else{
		$sql = $sql."and a.churchareaCode = '".$churchareaCode."' "; 
	}
	if ($mode == "Find"){
		if ($Search =="parentsName"){
			$sql = $sql."and CONCAT(family1_korname, family2_korname,family3_korname, family4_korname,family5_korname, family6_korname,family7_korname, family8_korname,family9_korname, family10_korname) like '%".$SearchString."%'";
		}else{
			$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
		}
	}
//	$sql = $sql."ORDER BY a.rtdept2Code, c.korChurchPosition desc LIMIT {$from_record}, {$page_rows}";
	$sql = $sql."ORDER BY d.korParishName, newMemberID, a.korname asc LIMIT {$from_record}, {$page_rows}";
//	echo $sql;
	$result = mysqli_query($conn, $sql);
	for ($i=0; $row=mysqli_fetch_assoc($result); $i++) {
		$list[$i] = $row;
		$list_num = $total_count - ($page - 1) * $page_rows; // 회원 순번
		$list[$i]['num'] = $list_num - $i;
	}

	// 페이징 시작
	$str = ''; 
	if ($page > 1) {
		$str .= '<li class="page-item"><a class="page-link"  href="list.php?page=1&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&korChurchAreaName='.$korChurchAreaName.'&korParishName='.$korParishName.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($start_page-1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&korChurchAreaName='.$korChurchAreaName.'&korParishName='.$korParishName.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&korChurchAreaName='.$korChurchAreaName.'&korParishName='.$korParishName.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&korChurchAreaName='.$korChurchAreaName.'&korParishName='.$korParishName.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($end_page+1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&korChurchAreaName='.$korChurchAreaName.'&korParishName='.$korParishName.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$total_page.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&korChurchAreaName='.$korChurchAreaName.'&korParishName='.$korParishName.'">맨끝</a></li>';
	}

	if ($str) // 페이지가 있다면 생성
		$write_page = $str;
	else
		$write_page = "";
?>
<script language ="javascript">
<!--
function search(){
	if (document.list.SearchString.value == ""){
		alert("검색어를 입력하여 주십시요.");
		document.list.SearchString.focus();
	 }
	 else{
		document.list.submit()
	}
}
-->
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><b>
				<?php
					echo $korChurchAreaName;
					if ($korParishName != ""){
						echo " > ".$korParishName;
					}
				?></b>
			</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
			  <div class="card-header">
				<div class="form-group row">
				<script language = "javascript">
				<!--
				function downloadExcel(){
					if (document.getElementById('excel_korParishName').value == ""){
						alert("교구를 선택하여 주세요.");
						return;
					}
					var excel_korParishName = document.getElementById('excel_korParishName').value;
					location.href="download_excel.php?excel_korParishName="+excel_korParishName;
				}
				//-->
				</script>
				<select id="excel_korParishName" name="excel_korParishName" class="form-control col-sm-2">
					<option value="">교구 선택</option>
	<?php
		if ($_SESSION['ss_korChurchAreaName']=="전체"){
	?>
					<option value="전체">전체</option>
	<?php
		}
	?>
	<?php
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
					<option value="동북권역">동북권역</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="11교구")){
	?>
					<option value="11교구">11교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="12교구")){
	?>
					<option value="12교구">12교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="13교구")){
	?>
					<option value="13교구">13교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
					<option value="동남권역">동남권역</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="21교구")){
	?>
					<option value="21교구">21교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="22교구")){
	?>
					<option value="22교구">22교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="23교구")){
	?>
					<option value="23교구">23교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="24교구")){
	?>
					<option value="24교구">24교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="25교구")){
	?>
					<option value="25교구">25교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="26교구")){
	?>
					<option value="26교구">26교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
					<option value="서남권역">서남권역</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="31교구")){
	?>
					<option value="31교구">31교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="32교구")){
	?>
					<option value="32교구">32교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="33교구")){
	?>
					<option value="33교구">33교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="34교구")){
	?>
					<option value="34교구">34교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
					<option value="서북권역">서북권역</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="41교구")){
	?>
					<option value="41교구">41교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="42교구")){
	?>
					<option value="42교구">42교구</option>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="43교구")){
	?>
					<option value="43교구">43교구</option>
	<?php
			}
		}
	?>
				</select>&nbsp;
				<a href="javascript:downloadExcel();"><button type="button" class="btn btn-info">엑셀다운로드</button></a>
				</div>
			  </div>
              <!-- /.card-header -->
              <div class="card-body">
				  <div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					  <thead>
						<tr class="text-center">
							<th>번호</th>
							<th>사진</th>	 
							<th>교구</th>
							<th>부서</th>
							<th>분반</th>
							<th>성명</th>
							<th>직분</th>
							<th>핸드폰번호</th>
						</tr>
					  </thead>
					  <tbody>
<?php
	for ($i=0; $i<count($list); $i++) {
?>
						<tr align="center">
							<td><?php echo $list[$i]['num'] ?></td>
							<td>
							  <?php
								If ($list[$i]['photofilename'] <> "") {
									//파일이 존재하는지 체크
									$filePathCheck = "../upload/".$list[$i]['photofilename'];
									//echo $filePathCheck;
									if (file_exists($filePathCheck)){
							  ?>
										<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&korChurchAreaName=<?php echo $korChurchAreaName ?>&korParishName=<?php echo $korParishName ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><img src="../upload/<?php echo $list[$i]['photofilename']?>" class="img-circle elevation-2" alt="User Image" width="60"></a>
								  <?php
									}else{
								  ?>
										<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&korChurchAreaName=<?php echo $korChurchAreaName ?>&korParishName=<?php echo $korParishName ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="60"></a>
							  <?php
									}
								}else{
							  ?>
									<a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&korChurchAreaName=<?php echo $korChurchAreaName ?>&korParishName=<?php echo $korParishName ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="60"></a>

							  <?php
								}
							  ?>
							</td>
							<td><?php echo $list[$i]['korParishName'] ?></td>
							<td><?php echo $list[$i]['rtdept1Name'] ?></td>
							<td><?php echo $list[$i]['rtdept2Name'] ?></td>
							<td><a href="content.php?page=<?php echo $page?>&memberID=<?php echo $list[$i]['memberID'] ?>&korChurchAreaName=<?php echo $korChurchAreaName ?>&korParishName=<?php echo $korParishName ?>&mode=<?php echo $mode ?>&Search=<?php echo $Search?>&SearchString=<?php echo $SearchString?>"><?php echo $list[$i]['korname'] ?></a></td>
							<td><?php echo $list[$i]['korChurchPosition'] ?></td>
							<td>
								<?php
									if ($list[$i]['mobile']<>""){
								?>
										<a href="tel:<?php echo $list[$i]['mobile']?>"><?php echo $list[$i]['mobile']?></a>
								<?php
									}
								?>
							</td>
						</tr>
<?php
	} 
?>
<?php if (count($list) == 0) { echo '<tr class="text-center"><td colspan="8"><font color="blue">해당 데이터가 없습니다.</font></td></tr>'; } ?>
					  </tfoot>
					</table>
				  </div>
				  <!-- /.card-body -->
				  <!-- /.card-footer -->
				  <div class="card-footer clearfix">
					<ul class="pagination pagination-sm m-0 float-left">
						<?php echo $write_page; ?>
					</ul>
				  </div>
				  <div class="card-footer">
					<div class="col-12 text-center">
						<form method ="POST" name="list" action="list.php" onsubmit="return search()">
							<input type="hidden" name="mode" value="Find">
							<input type="hidden" name="korChurchAreaName" value="<?php echo $korChurchAreaName;?>">
							<input type="hidden" name="korParishName" value="<?php echo $korParishName;?>">
							<div class="form-group row text-center">
								<select name="Search" class="form-control col-sm-2">
									<option value="korname">성명</option>
									<option value="c.rtdept1Name">부서</option>
									<option value="schoolinfo">학교</option>
									<option value="parentsName">부모성명</option>
								</select>
								<input type="text" class="form-control col-sm-2" name="SearchString">
								<button type="submit" class="btn btn-primary">Search</button>
							</div>
						</form>
					</div>
				  </div>
				  <!-- /.card-footer -->
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
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>