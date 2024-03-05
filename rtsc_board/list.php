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

	$boardCode		= trim($_REQUEST['boardCode']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$sql = "SELECT COUNT(board_idx) AS cnt FROM board a, homepage_admin b where a.homepage_admin_idx = b.homepage_admin_idx and a.boardCode = '".$boardCode."' and a.alwaysTopYN ='N' ";
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

	$sql = "select a.board_idx, a.title, b.korname, a.visit, date_format(a.inputDate, '%Y-%m-%d') as inputDate from board a, homepage_admin b where a.homepage_admin_idx = b.homepage_admin_idx and a.boardCode = '".$boardCode."' and a.alwaysTopYN ='N' ";
	if ($mode == "Find"){
		$sql = $sql."and ".$Search." like '%".$SearchString."%' ";
	}
	$sql = $sql."ORDER BY a.board_idx desc LIMIT {$from_record}, {$page_rows}";
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
		$str .= '<li class="page-item"><a class="page-link"  href="list.php?page=1&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($start_page-1).'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$k.'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="list.php?page='.($end_page+1).'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="list.php?page='.$total_page.'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">맨끝</a></li>';
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
					<i class="fas fa-map-marker-alt"></i>
					<b>
					<?php
						$sql_boardName = "SELECT boardName from boardinfo where boardCode = '".$boardCode."'";
						$result_boardName = mysqli_query($conn, $sql_boardName);
						$row_boardName = mysqli_fetch_assoc($result_boardName);
						echo $row_boardName['boardName'];
					?>&nbsp;&nbsp;&nbsp;<a href="write.php?boardCode=<?php echo $boardCode; ?>"><button type="submit" class="btn btn-primary">글쓰기</button></a>
					</b>
				</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
				  <div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					  <thead>
						<tr class="text-center">
							<th>번호</th>
							<th>제목</th>
							<th>작성자</th>
							<th>조회수</th>
							<th>작성일</th>
						</tr>
					  </thead>
					  <tbody>
<?php
	//항상 최상위 노출 데이터
	$sql_top = "select a.board_idx, a.title, b.korname, a.visit, date_format(a.inputDate, '%Y-%m-%d') as inputDate from board a, homepage_admin b where a.homepage_admin_idx = b.homepage_admin_idx and a.boardCode = '".$boardCode."' and a.alwaysTopYN ='Y' ";
	$result_top = mysqli_query($conn, $sql_top);
	while ($row_top = mysqli_fetch_assoc($result_top)){
?>
						<tr align="center">
							<td><span class="center badge badge-danger">공지</span></td>
							<td class="text-left">
								<?php 
									echo '<a href="content.php?page='.$page.'&board_idx='.$row_top['board_idx'].'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'">'.$row_top['title']."</a>"
								?>
								<?php
									$sql_replyCount = "select count(idx) as replyCount from reply_board where board_idx='".$row_top['board_idx']."'";
									$result_replyCount = mysqli_query($conn, $sql_replyCount);
									$row_replyCount = mysqli_fetch_assoc($result_replyCount);
									if ($row_replyCount['replyCount'] <> 0){
										echo '<span class="badge badge-info right">'.$row_replyCount['replyCount']."</span>";
									}
								?>
							</td>
							<td><?php echo $row_top['korname'] ?></td>
							<td><?php echo $row_top['visit'] ?></td>
							<td><?php echo $row_top['inputDate'] ?></td>
						</tr>
<?php
	}
?>
<?php
	for ($i=0; $i<count($list); $i++) {
?>
						<tr align="center">
							<td><?php echo $list[$i]['num'] ?></td>
							<td class="text-left">
								<?php 
									echo '<a href="content.php?page='.$page.'&board_idx='.$list[$i]['board_idx'].'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'">'.$list[$i]['title']."</a>"
								?>
								<?php
									$sql_replyCount = "select count(idx) as replyCount from reply_board where board_idx='".$list[$i]['board_idx']."'";
									$result_replyCount = mysqli_query($conn, $sql_replyCount);
									$row_replyCount = mysqli_fetch_assoc($result_replyCount);
									if ($row_replyCount['replyCount'] <> 0){
										echo '<span class="badge badge-info right">'.$row_replyCount['replyCount']."</span>";
									}
								?>
							</td>
							<td><?php echo $list[$i]['korname'] ?></td>
							<td><?php echo $list[$i]['visit'] ?></td>
							<td><?php echo $list[$i]['inputDate'] ?></td>
						</tr>
<?php
	}
?>
<?php if (count($list) == 0) { echo '<tr class="text-center"><td colspan="5"><font color="blue">해당 데이터가 없습니다.</font></td></tr>'; } ?>
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
								<input type="hidden" name="boardCode" value="<?php echo $boardCode;?>">
								<select name="Search" class="form-control col-sm-2">
									<option value="a.title">제목</option>
									<option value="a.content">내용</option>
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