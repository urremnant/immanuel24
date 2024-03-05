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
	
	
	
	
	
	//
  
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
		$str .= '<li class="page-item"><a class="page-link"  href="lastlistqr.php?page=1&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">처음</a></li>';
	}

	$start_page = ( ( (int)( ($page - 1 ) / $page_rows ) ) * $page_rows ) + 1;
	$end_page = $start_page + $page_rows - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= '<li class="page-item"><a class="page-link" href="lastlistqr.php?page='.($start_page-1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">이전</a></li>';

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($page != $k)
				$str .= '<li class="page-item"><a class="page-link" href="lastlistqr.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">'.$k.'</a></li>';
			else
				$str .= '<li class="page-item"><a class="page-link" href="lastlistqr.php?page='.$k.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'"><font color="red"><b>'.$k.'</b></font></a></li>';
				// $str .= '<span class="current">'.$k.'</span>';
		}
	}

	if ($total_page > $end_page) $str .= '<li class="page-item"><a class="page-link" href="lastlistqr.php?page='.($end_page+1).'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">다음</a></li>';

	if ($page < $total_page) {
		$str .= '<li class="page-item"><a class="page-link" href="lastlistqr.php?page='.$total_page.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'&rtdept1Code='.$rtdept1Code.'&rtdept2Code='.$rtdept2Code.'">맨끝</a></li>';
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

<!---QR Code 관련--->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">

   $(document).ready(function(){

	   $('#createBtn').click(function(){

	      

		// input에 입력하는 값들을 뽑아서 변수에 저장

	      var m_title = $('#m_title').val();

	      var m_director =  $('#m_director').val();

	      var m_genre = $('#m_genre').val();

	      var m_staring = $('#m_staring').val();

	      var m_opening = $('#m_opening').val();

	      

	      // encodeURIComponent로 인코딩 합시당. 

            // 이걸로 인코딩하는 이유는 배웠었는데 까먹었다.. 검색해봐야지.

	      m_title = encodeURIComponent(m_title);

	      m_director = encodeURIComponent(m_director);

	      m_genre = encodeURIComponent(m_genre);

	      m_staring = encodeURIComponent(m_staring);

	      m_opening = encodeURIComponent(m_opening);

	      	      

	      // 뒤에 코드가 길어지니까 그냥 한번 변수에 주소를 저장

	      googleQRUrl = "https://chart.googleapis.com/chart?chs=177x177&cht=qr&chl=";

	      

	      	 // 이미지가 나타날 영역에 원하는 내용을 넣은 QR code의 이미지를 출력합니다.

             // 여기 주소 부분을 변경해주면 원하는 값을 언제든 맘대로

	      	$('#qrcode').attr('src', googleQRUrl + "제목:" + m_title + "/ 감독:" + m_director

	        		 + "/ 장르:" + m_genre + "/ 출연:" + m_staring + "/ 개봉날짜:" + m_opening +'&choe=UTF-8');



	   });

	 

	});

</script>
<!---QR Code 관련--->

       <div class="card-header">
				<div class="row">
					<div class="col-12">
						<p>※ 렘넌트서밋위원회 헌신예배 참석 확정 명단입니다. 화면 아래 검색기능을 이용하시면 명단 확인이 쉽습니다.</p>
						<p>※ 양해와 협조를 요청드립니다. 부서별 좌석배치 중이며, 부서 변경이 불가하오니 확인된 좌석에서 은혜누리시길 기도합니다.</p>
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
						<th>RCJP ID</th>
						<th>부모정보</th>
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
						
						<td>
<?php

								// 이름으로부터 memberID 추출 시작
										$sql_findmemberID = "SELECT memberID, family1_korname, family2_korname from member where korname = '".$list[$i]['korname']."'";
										$result_findmemberID = mysqli_query($conn, $sql_findmemberID);
										$row_memberID = mysqli_fetch_assoc($result_findmemberID);
										$memberID=  $row_memberID['memberID'];
										$family1_korname =  $row_memberID['family1_korname'];
										$family2_korname =  $row_memberID['family2_korname'];
										
							  // 이름으로부터 memberID 추출 끝
								echo "<a target=blank href=http://remnantsummit.com/rtsc_member/content.php?memberID=$memberID>".$memberID."</a>";
?>							
							
							
						</td>
						<td>
						<?=$family1_korname."/".$family2_korname;?>
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
						<form method ="POST" name="list" action="lastlistqr.php" onsubmit="return search()">
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
