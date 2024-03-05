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
            <h1 class="m-0">예배 신청하기(<?php echo trim($_REQUEST['worshipDate'])?>)</h1>
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
              <!-- /.card-header -->
              <div class="card-body">

<?php

	include "connect.php";
  
	$worshipDate	= trim($_REQUEST['worshipDate']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$sql = "SELECT COUNT(a.idx) AS cnt FROM apply_worship a, churcharea b, rtdept1 c, churchPosition d where a.churchareaCode = b.churchareaCode and a.rtdept1Code = c.rtdept1Code and a.churchPositionCode = d.churchPositionCode and worshipDate = '".$worshipDate."' "; // apply_worship 테이블에 등록되어있는 회원의 수를 구함
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%'";
	}
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$total_count = $row['cnt'];

	$page_rows = 10; // 페이지당 목록 수
	$page = $_GET['page'];

	$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; }					// 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $page_rows;		// 시작 열을 구함

	$list = array(); //  게시판 정보를 담을 배열 선언

	$sql = "select a.*, d.korChurchPosition, b.korParishName, c.rtdept1Name from apply_worship a, churcharea b, rtdept1 c, churchPosition d where a.churchareaCode = b.churchareaCode and a.rtdept1Code = c.rtdept1Code and a.churchPositionCode = d.churchPositionCode and worshipDate = '".$worshipDate."' ";
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
	}
	//$sql = $sql."ORDER BY Idx desc, a.korname, a.worshipDate desc LIMIT {$from_record}, {$page_rows}";
	$sql = $sql."ORDER BY worshipDate desc, inputDate desc LIMIT {$from_record}, {$page_rows}";
	$result = mysqli_query($conn, $sql);
	for ($i=0; $row=mysqli_fetch_assoc($result); $i++) {
		$list[$i] = $row;
		$list_num = $total_count - ($page - 1) * $page_rows; // 회원 순번
		$list[$i]['num'] = $list_num - $i;
	}

	// 페이징 시작
	$str = '';
	if ($page > 1) {
		$str .= '<li class="page-item"><a class="page-link"  href="list.php?page=1&worshipDate='.$worshipDate.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($start_page-1).'&worshipDate='.$worshipDate.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&worshipDate='.$worshipDate.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&worshipDate='.$worshipDate.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($end_page+1).'&worshipDate='.$worshipDate.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$total_page.'&worshipDate='.$worshipDate.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">맨끝</a></li>';
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
              <div class="card-header">
				<div class="row">
					<div class="col-12">
						<a href="/rtsc_applyworship/beforeRegistWorshipFamily.php?worshipDate=<?php echo $worshipDate;?>"><button type="button" class="btn btn-primary"><i class="fas fa-users"></i> 예배신청하기(가족)</button></a>
						<a href="/rtsc_applyworship/registWorship.php?worshipDate=<?php echo $worshipDate;?>"><button type="button" class="btn btn-primary"><i class="fas fa-user"></i> 예배신청하기(개인)</button></a>
					</div>
					<div class="col-12">
						<p>&nbsp;</p>
						<p>※ 이미 등록하셨는데 또 등록하시면 기존 등록데이터가 업데이트되며 날짜도 수정됩니다. QR코드보기 버튼은 교인번호가 등록되신 분만 생성됩니다.<p>
					</div>
				</div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
					<tr class="text-center">
						<th>번호</th>
						<th>예배 날짜</th>
						<th>참석 예배</th>
						<th>성명</th>
						<th>직분</th>
						<th>QR코드</th>
						<th>교구</th>
						<th>부서</th>
						<th>교인앱/교인증</th>
						<th>셔틀버스</th>
						<th>기타</th>
						<th>예배장소</th>
						<th>통역어</th>
					</tr>
				  </thead>
				  <tbody>
<?php
	for ($i=0; $i<count($list); $i++) {
?>
					<tr align="center">
						<td><?php echo $list[$i]['num'] ?></td>
						<td><?php echo $list[$i]['worshipDate'] ?></td>
						<td><?php echo $list[$i]['worshipGubun'] ?></td>
						<td><?php echo $list[$i]['korname'] ?></td>
						<td><?php echo $list[$i]['korChurchPosition'] ?></td>
						<td>
							<?php
								if ($list[$i]['myNo'] != ""){
							?>
									<a href="/rtsc_applyworship/myWorshipInfo.php"><button type="button" class="btn btn-sm btn-info"><i class="fas fa-qrcode"></i> QR코드 보기</button></a>
							<?php
								}
							?>
						</td>
						<td><?php echo $list[$i]['korParishName'] ?></td>
						<td><?php echo $list[$i]['rtdept1Name'] ?></td>
						<td>
							<?php
								switch($list[$i]['appYN']){
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
						</td>
						<td><?php echo $list[$i]['busUse'] ?></td>
						<td>
							<?php
								if ($list[$i]['strollerYN'] == "Y"){
									echo "<i class='fas fa-baby-carriage'></i>";
								}
								if ($list[$i]['wheelchairYN'] == "Y"){
									echo "<i class='fas fa-wheelchair'></i>";
								}
							?>
						</td>
						<td><?php echo $list[$i]['worshipPlace'] ?></td>
						<td><?php echo $list[$i]['useLanguage'] ?></td>
					</tr>
<?php
	} 
?>
<?php if (count($list) == 0) { echo '<tr class="text-center"><td colspan="13"><font color="blue">해당 자료가 없습니다.</font></td></tr>'; } ?>
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
							<div class="form-group row text-center">
								<input type="hidden" name="mode" value="Find">
								<input type="hidden" name="worshipDate" value="<?php echo $worshipDate;?>">
								
								<select name="Search" class="form-control col-sm-2">
									<option value="korname">성명</option>
									<option value="c.rtdept1Name">부서</option>
									<option value="b.korParishName">교구</option>
								</select>
								<input type="text" class="form-control col-sm-2" name="SearchString">
								<button type="submit" class="btn btn-primary">Search</button>
							</div>
						</form>
					</div>
				</div>
			  <!-- /.card-footer -->
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
	include "footer.php";
?>
