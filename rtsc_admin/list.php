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
            <h1 class="m-0">홈페이지 관리자</h1>
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

	include "../include/connect.php";
  
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$sql = "SELECT COUNT(homepage_admin_idx) AS cnt FROM homepage_admin a, churchPosition b, rtdept1 c where a.churchPositionCode = b.churchPositionCode and a.rtdept1Code = c.rtdept1Code "; // homepage_admin 테이블에 등록되어있는 회원의 수를 구함
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

	$list = array(); // 회원 정보를 담을 배열 선언

	$sql = "select a.homepage_admin_idx, a.photofilename, c.rtdept1Name, ifnull((select rtdept2Name from rtdept2 where rtdept2Code = a.rtdept2Code),'') as rtdept2Name, a.korname, b.korChurchPosition, a.mobile, a.useYN, a.dataAccessType, a.timelineAccessType, ifnull(a.vowDate,'') as vowDate, a.deptMoveYN, ifnull((select rtdept1Name from rtdept1 where rtdept1Code = a.from_rtdept1Code),'') as from_rtdept1Name from homepage_admin a, churchPosition b, rtdept1 c where a.churchPositionCode = b.churchPositionCode and a.rtdept1Code = c.rtdept1Code "; // 회원 정보를 조회
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
	}
	$sql = $sql."ORDER BY a.rtdept1Code, a.rtdept2Code LIMIT {$from_record}, {$page_rows}";

	$result = mysqli_query($conn, $sql);
	for ($i=0; $row=mysqli_fetch_assoc($result); $i++) {
		$list[$i] = $row;
		$list_num = $total_count - ($page - 1) * $page_rows; // 회원 순번
		$list[$i]['num'] = $list_num - $i;
	}

	// 페이징 시작
	$str = ''; 
	if ($page > 1) {
		$str .= '<li class="page-item"><a class="page-link"  href="list.php?page=1&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($start_page-1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($end_page+1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$total_page.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'">맨끝</a></li>';
	}

	if ($str) // 페이지가 있다면 생성
		$write_page = $str;
	else
		$write_page = "";

	mysqli_close($conn); // 데이터베이스 접속 종료
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
						<a href="write.php"><button type="submit" class="btn btn-primary">홈페이지 관리자 추가하기</button></a>
						<a href="download_excel.php"><button type="submit" class="btn btn-info">엑셀다운로드</button></a>
						※ 엑셀다운로드시 홈페이지 사용자 비밀번호는 제외됩니다.
					</div>
				</div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
					<tr class="text-center">
						<th>번호</th>
						<th>사진</th>
						<th>부서</th>
						<th>분반</th>
						<th>성명</th>
						<th>직분</th>
						<th>핸드폰번호</th>
						<th>데이터접근권한</th>
						<th>언약의여정권한</th>
						<th>등반권한</th>
						<th>등반담당부서</th>
						<th>사용여부</th>
						<th>개인정보보호서약일</th>
						<th>관리</th>
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
								echo '<img src="/upload/'.$list[$i]['photofilename'].'" class="img-circle elevation-2" alt="User Image" width="60">';
							}else{
								echo '<img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="60">';
							}
						  ?>
						</td>
						<td><?php echo $list[$i]['rtdept1Name'] ?></td>
						<td><?php echo $list[$i]['rtdept2Name'] ?></td>
						<td><?php echo $list[$i]['korname'] ?></td>
						<td><?php echo $list[$i]['korChurchPosition'] ?></td>
						<td><?php echo $list[$i]['mobile'] ?></td>
						<td>
							<?php
								switch ($list[$i]['dataAccessType']){
									case "R" : 
										echo "읽기";
										break;
									case "W" :
										echo "읽기/쓰기/수정/삭제";
										break;
									default :
								}
							?>
						</td>
						<td>
							<?php
								switch ($list[$i]['timelineAccessType']){
									case "X" : 
										echo "접근불가";
										break;
									case "R" : 
										echo "읽기";
										break;
									case "W" :
										echo "읽기/쓰기/수정/삭제";
										break;
									default :
								}
							?>
						</td>
						<td><?php echo $list[$i]['deptMoveYN'] ?></td>
						<td><?php echo $list[$i]['from_rtdept1Name'] ?></td>
						<td><?php echo $list[$i]['useYN'] ?></td>
						<td><?php echo $list[$i]['vowDate'] ?></td>
						<td>
							<?php echo  '<a class="btn btn-info btn-sm" href="edit.php?page='.$page.'&homepage_admin_idx='.$list[$i]['homepage_admin_idx'].'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'"><i class="fas fa-pencil-alt"></i>Edit</a>'; ?>
							<?php 
								if ($list[$i]['useYN'] == "Y"){
									echo  '<a class="btn btn-danger btn-sm" href="change_useYN.php?change_useYN=N&page='.$page.'&homepage_admin_idx='.$list[$i]['homepage_admin_idx'].'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'"><i class="fas fa-trash"></i>사용취소</a>';
								}else{
									echo  '<a class="btn btn-success btn-sm" href="change_useYN.php?change_useYN=Y&page='.$page.'&homepage_admin_idx='.$list[$i]['homepage_admin_idx'].'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'"><i class="far fa-check-square"></i>사용승인</a>';
								}
							?>		
						</td>
					</tr>
<?php
	} 
?>
<?php if (count($list) == 0) { echo '<tr class="text-center"><td colspan="13"><font color="blue">등록된 관리자가 없습니다.</font></td></tr>'; } ?>
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
								<select name="Search" class="form-control col-sm-2">
									<option value="korname">성명</option>
									<option value="c.rtdept1Name">부서</option>
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
	include "../include/footer.php";
?>
