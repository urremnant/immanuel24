<?php
	include "header.php";
	include "menu_worship.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">2021년 3월 7일 렘넌트서밋위원회 헌신예배 확정명단</h1>
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
  
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$sql = "select count(idx) as cnt from apply_worshiplist ";
	if ($mode == "Find"){
		$sql = $sql."where ".$Search." like '%".$SearchString."%'";
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

	$sql = "select * from apply_worshiplist ";
	if ($mode == "Find"){
		$sql = $sql."where ".$Search." like '%".$SearchString."%' ";
	}
	$sql = $sql."order by idx LIMIT {$from_record}, {$page_rows}";
	$result = mysqli_query($conn, $sql);
	for ($i=0; $row=mysqli_fetch_assoc($result); $i++) {
		$list[$i] = $row;
		$list_num = $total_count - ($page - 1) * $page_rows; // 회원 순번
		$list[$i]['num'] = $list_num - $i;
	}

	// 페이징 시작
	$str = '';
	if ($page > 1) {
		$str .= '<li class="page-item"><a class="page-link"  href="lastlist.php?page=1&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="lastlist.php?page='.($start_page-1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="lastlist.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="lastlist.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="lastlist.php?page='.($end_page+1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="lastlist.php?page='.$total_page.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">맨끝</a></li>';
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
						<p>※ 렘넌트서밋위원회 헌신예배 참석 확정 명단입니다. 화면 아래 검색기능을 이용하시면 명단 확인이 쉽습니다.</p>
						<p>※ 양해와 협조를 요청드립니다. 부서별 좌석배치 중이며, 부서 변경이 불가하오니 확인된 좌석에서 은혜누리시길 기도합니다.</p>
						<img src="01.jpg" width="300" class="img-fluid mb-2">
						<img src="02.jpg" width="300" class="img-fluid mb-2">
						<img src="03.jpg" width="300" class="img-fluid mb-2">
						<img src="04.jpg" width="300" class="img-fluid mb-2">
						<img src="05.jpg" width="300" class="img-fluid mb-2">
					</div>
              </div>
				</div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
					<tr class="text-center">
						<th>번호</th>
						<th>최종 예배 희망 부서</th>
						<th>성명</th>
						<th>직분</th>
						<th>교구</th>
						<th>핸드폰(뒤4자리)</th>
						<th>교인앱/교인증</th>
					</tr>
				  </thead>
				  <tbody>
<?php
	for ($i=0; $i<count($list); $i++) {
?>
					<tr align="center">
						<td><?php echo $list[$i]['idx'] ?></td>
						<td><?php echo $list[$i]['worshipPlace'] ?></td>
						<td><?php echo $list[$i]['korname'] ?></td>
						<td><?php echo $list[$i]['korChurchPosition'] ?></td>
						<td><?php echo $list[$i]['korParishName'] ?></td>
						<td><?php echo substr($list[$i]['mobile'],-4) ?></td>
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
					</tr>
<?php
	} 
?>
<?php if (count($list) == 0) { echo '<tr class="text-center"><td colspan="8"><font color="blue">해당 자료가 없습니다.</font></td></tr>'; } ?>
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
						<form method ="POST" name="list" action="lastlist.php" onsubmit="return search()">
							<div class="form-group row text-center">
								<input type="hidden" name="mode" value="Find">
								<select name="Search" class="form-control col-sm-2">
									<option value="korname">성명</option>
									<option value="worshipPlace">최종 예배 희망 부서</option>
									<option value="korParishName">교구</option>
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
