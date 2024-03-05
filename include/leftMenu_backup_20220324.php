  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/rtsc_member/main2.php" class="brand-link">
      <img src="/image/churchlogo.png" alt="임마누엘교회" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">렘넌트서밋위원회</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
		  <?php
			If ($_SESSION['ss_photofilename'] <> "") { 
				echo '<img src="/upload/'.$_SESSION['ss_photofilename'].'" class="img-circle elevation-2" alt="User Image" width="160">';
			}else{
				echo '<img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image">';
			}
		  ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['ss_korname']?></a>
        </div>
        <div class="image">
          <button type="button" class="btn btn-block btn-primary btn-sm" onClick="location.href='/logout.php'">로그아웃</button>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!--li class="nav-header">MULTI LEVEL EXAMPLE</li-->
<?php
	include "../include/connect.php";
	$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
	$deptMoveCode	= trim($_REQUEST['deptMoveCode']);
	$attendCheckDeptCode = trim($_REQUEST['attendCheckDeptCode']);

	# 등반관리 권한을 체크한다.
	$sql_deptMove = "select deptMoveYN, from_rtdept1Code from homepage_admin where homepage_admin_idx = '".$_SESSION['ss_homepage_admin_idx']."'";
	# echo $sql_deptMove;
	$result_deptMove = mysqli_query($conn, $sql_deptMove);
	$row_deptMove = mysqli_fetch_assoc($result_deptMove);
	# echo $row_deptMove['deptMoveYN'];
	# echo $row_deptMove['from_rtdept1Code'];
?>

	<?php
		if (($_SESSION['ss_korname']=="관리자")||($_SESSION['ss_korname']=="홍병희")||($_SESSION['ss_korname']=="하영현")||($_SESSION['ss_korname']=="이혜림B")||($_SESSION['ss_korname']=="차수지")||($_SESSION['ss_korname']=="한병호")||($_SESSION['ss_korname']=="고은별")){
	?>	
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_admin/list.php" class="nav-link">
					<i class="fas fa-edit nav-icon"></i>
                    <p>홈페이지 관리자</p>
                    </a>
				</li>
			</ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_rtdept2/list.php" class="nav-link">
					<i class="fas fa-edit nav-icon"></i>
                    <p>분반코드 관리</p>
                    </a>
				</li>
			</ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php" class="nav-link">
					<i class="nav-icon fas fa-th"></i>
                    <p>전체부서검색</p>
                    </a>
				</li>
			</ul>
          </li>         
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/statistics.php" class="nav-link">
					<i class="nav-icon fas fa-chart-pie"></i>
                    <p>통계</p>
                    </a>
				</li>
			</ul>
          </li>        
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/statistics_churcharea.php" class="nav-link">
					<i class="nav-icon fas fa-chart-pie"></i>
                    <p>교구별 통계</p>
                    </a>
				</li>
			</ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_log/list.php" class="nav-link">
					<i class="nav-icon fas fa-sign-in-alt"></i>
                    <p>로그기록</p>
                    </a>
				</li>
			</ul>
          </li>
	<?php
		}
	?>

          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_board/list.php?boardCode=1" class="nav-link">
					<i class="fas fa-edit nav-icon"></i>
                    <p>공지사항</p>
                    </a>
				</li>
			</ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_board/list.php?boardCode=2" class="nav-link">
					<i class="fas fa-edit nav-icon"></i>
                    <p>자유게시판</p>
                    </a>
				</li>
			</ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_board/list.php?boardCode=3" class="nav-link">
					<i class="fas fa-edit nav-icon"></i>
                    <p>자료실</p>
                    </a>
				</li>
			</ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_calendar/calendar.php" class="nav-link">
					<i class="nav-icon far fa-calendar-alt"></i>
                    <p>렘넌트서밋위원회 일정</p>
                    </a>
				</li>
			</ul>
          </li>
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="http://rutc24.kr/?page_id=5325" class="nav-link" target="_blank">
					<i class="nav-icon fas fa-book-open"></i>
                    <p>주보</p>
                    </a>
				</li>
			</ul>
          </li>
	<?php
		if ($row_deptMove['deptMoveYN'] == "Y"){
	?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                등반관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			<?php
				# 태영아부  →  유아부는 등반담당부서가 태영아부, 유아부인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10001") || ($row_deptMove['from_rtdept1Code'] == "D10002")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00001" 
							<?php
								if ($deptMoveCode == "M00001"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>태영아부  →  유아부</p>
							</a>
						</li>
					</ul>
			<?php
				}
				# 유아부  →  유치부는 등반담당부서가 유아부, 유치부인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10002") || ($row_deptMove['from_rtdept1Code'] == "D10003")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00002" 
							<?php
								if ($deptMoveCode == "M00002"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>유아부  →  유치부</p>
							</a>
						</li>
					</ul>
			<?php
				}
				# 유치부  →  초등12부는 등반담당부서가 유치부, 초등12부인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10003") || ($row_deptMove['from_rtdept1Code'] == "D10004")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00003" 
							<?php
								if ($deptMoveCode == "M00003"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>유치부  →  초등12부</p>
							</a>
						</li>
					</ul>
			<?php
				}
				# 초등12부  →  초등34부는 등반담당부서가 초등12부, 초등34인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10004") || ($row_deptMove['from_rtdept1Code'] == "D10005")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00004" 
							<?php
								if ($deptMoveCode == "M00004"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>초등12부  →  초등34부</p>
							</a>
						</li>
					</ul>
			<?php
				}
				# 초등34부  →  초등56부는 등반담당부서가 초등34부, 초등56부인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10005") || ($row_deptMove['from_rtdept1Code'] == "D10006")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00005" 
							<?php
								if ($deptMoveCode == "M00005"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>초등34부  →  초등56부</p>
							</a>
						</li>
					</ul>
			<?php
				}
				# 초등56부  →  중등부는 등반담당부서가 초등56부, 중등부인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10006") || ($row_deptMove['from_rtdept1Code'] == "D10007")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00006" 
							<?php
								if ($deptMoveCode == "M00006"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>초등56부  →  중등부</p>
							</a>
						</li>
					</ul>
			<?php
				}
				# 중등부  →  고등부는 등반담당부서가 중등부, 고등부인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10007") || ($row_deptMove['from_rtdept1Code'] == "D10008")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00007" 
							<?php
								if ($deptMoveCode == "M00007"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>중등부  →  고등부</p>
							</a>
						</li>
					</ul>
			<?php
				}
				# 고등부  →  대학부는 등반담당부서가 고등부, 대학부인 경우 등반메뉴를 보여준다.
				if (($row_deptMove['from_rtdept1Code'] == "D10008") || ($row_deptMove['from_rtdept1Code'] == "D10009")){
			?>
					<ul class="nav nav-treeview">
						<li class="nav-item menu-open">
							<a href="/rtsc_member/list.php?deptMoveCode=M00008" 
							<?php
								if ($deptMoveCode == "M00008"){
									echo "class='nav-link active'";
								}else{
									echo "class='nav-link'";
								}
							?>>
							<i class="far fa-circle nav-icon"></i>
							<p>고등부  →  대학부</p>
							</a>
						</li>
					</ul>
			<?php
				}
			?>

	<?php
		}
	?>
<!-- 미취학렘넌트국 시작 -->
<?php
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10001") || ($_SESSION['ss_rtdept1code']=="D10002") || ($_SESSION['ss_rtdept1code']=="D10003") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
?>
          <li class="nav-item menu-open">
            <a href="/rtsc_member/list.php?rtdept1Code=D00002" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                미취학렘넌트국
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D00002" 
					<?php
						if ($rtdept1Code == "D00002"){
							if ($rtdept2Code == ""){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>미취학렘넌트국 전체</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 태영아부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10001") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10001" 
					<?php
						if ($rtdept1Code == "D10001"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>태영아부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 태영아부 끝 -->
	<!-- 유아부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10002") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10002"
					<?php
						if ($rtdept1Code == "D10002"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>유아부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 유아부 끝 -->
	<!-- 유치부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10003") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10003"
					<?php
						if ($rtdept1Code == "D10003"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>유치부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
			<!-- 유치부 끝 -->
          </li>
<!-- 미취학렘넌트국 끝 -->
<?php
	}
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10004") || ($_SESSION['ss_rtdept1code']=="D10005") || ($_SESSION['ss_rtdept1code']=="D10006") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")) {
?>
<!-- 초등렘넌트국 시작 -->
          <li class="nav-item menu-open">
            <a href="/rtsc_member/list.php?rtdept1Code=D00003" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                초등렘넌트국
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D00003"
					<?php
						if ($rtdept1Code == "D00003"){
							if ($rtdept2Code == ""){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>초등렘넌트국 전체</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 초등12부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10004") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10004"
					<?php
						if ($rtdept1Code == "D10004"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>초등12부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 초등12부 끝 -->
	<!-- 초등34부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10005") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10005"
					<?php
						if ($rtdept1Code == "D10005"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>초등34부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 초등34부 끝 -->
	<!-- 초등56부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10006") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10006"
					<?php
						if ($rtdept1Code == "D10006"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>초등56부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 초등56부 끝 -->
          </li>
<!-- 초등렘넌트국 끝 -->
<?php
	}
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10007") || ($_SESSION['ss_rtdept1code']=="D10008") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
?>
<!-- 청소년렘넌트국 시작 -->
          <li class="nav-item menu-open">
            <a href="/rtsc_member/list.php?rtdept1Code=D00004" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                청소년렘넌트국
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D00004"
					<?php
						if ($rtdept1Code == "D00004"){
							if ($rtdept2Code == ""){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>청소년렘넌트국 전체</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 중등부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10007") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10007"
					<?php
						if ($rtdept1Code == "D10007"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>중등부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 중등부 끝 -->
	<!-- 고등부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10008") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10008"
					<?php
						if ($rtdept1Code == "D10008"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>고등부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 고등부 끝 -->
          </li>
<!-- 청소년렘넌트국 끝 -->
<?php
	}
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00005") || ($_SESSION['ss_rtdept1code']=="D10009") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
?>
<!-- 대학국 시작 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                대학국
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
		<!-- 대학부 시작 -->
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10009"
					<?php
						if ($rtdept1Code == "D10009"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>대학부</p>
                    </a>
				</li>
			</ul>
		<!-- 대학부 끝 -->
          </li>
<!-- 대학국 끝 -->
<?php
	}
	if (($_SESSION['ss_rtdept1code']=="D00001")  || ($_SESSION['ss_rtdept1code']=="D00006") || ($_SESSION['ss_rtdept1code']=="D10012") ||  ($_SESSION['ss_rtdept1code']=="D10014") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
?>
<!-- 미션렘넌트국 시작 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                미션렘넌트국
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>


	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001")  || ($_SESSION['ss_rtdept1code']=="D00006") || ($_SESSION['ss_rtdept1code']=="D10012") ||  ($_SESSION['ss_rtdept1code']=="D10014") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D00006"
					<?php
						if ($rtdept1Code == "D00006"){
							if ($rtdept2Code == ""){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>미션렘넌트국 전체</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>

		<!-- 사랑부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00006") || ($_SESSION['ss_rtdept1code']=="D10012") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10012"
					<?php
						if ($rtdept1Code == "D10012"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>사랑부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 사랑부 끝 -->

		<!-- 농인부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00006") || ($_SESSION['ss_rtdept1code']=="D10014") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10014"
					<?php
						if ($rtdept1Code == "D10014"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>농인부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 농인부 끝 -->

          </li>
<!-- 미션렘넌트국 끝 -->
<?php
	}
	if (($_SESSION['ss_rtdept1code']=="D00001")  || ($_SESSION['ss_rtdept1code']=="D00019") || ($_SESSION['ss_rtdept1code']=="D10015") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
?>
<!-- TCK부 시작 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                글로벌렘넌트국
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

		<!-- TCK부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00006") || ($_SESSION['ss_rtdept1code']=="D10015") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D10015"
					<?php
						if ($rtdept1Code == "D10015"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>TCK부</p>
                    </a>
				</li>
			</ul>

	<?php
		}
	?>
		<!-- TCK부 끝 -->
          </li>
<!-- TCK부 끝 -->
<?php
	}
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010") || ($_SESSION['ss_rtdept1code']=="D99999")){
?>
<!-- 기타 시작 -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                기타
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

		<!-- 기타 시작 -->
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D99999"
					<?php
						if ($rtdept1Code == "D99999"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>기타</p>
                    </a>
				</li>
			</ul>

		<!-- 기타 끝 -->
		<!-- 대학부 졸업자 시작 -->
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D99998"
					<?php
						if ($rtdept1Code == "D99998"){
							if (($rtdept2Code == "")&&($attendCheckDeptCode == "")){
								echo "class='nav-link active'";
							}else{
								echo "class='nav-link'";
							}
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>대학부 졸업자</p>
                    </a>
				</li>
			</ul>
		<!-- 대학부 졸업자 끝 -->
          </li>
<!-- 기타 끝 -->
<?php
	}
?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                출석체크
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
	<!-- 태영아부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10001") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10001" 
					<?php
						if ($attendCheckDeptCode == "D10001"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>태영아부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 태영아부 끝 -->
	<!-- 유아부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10002") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10002"
					<?php
						if ($attendCheckDeptCode == "D10002"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>유아부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 유아부 끝 -->
	<!-- 유치부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10003") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10003"
					<?php
						if ($attendCheckDeptCode == "D10003"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>유치부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 유치부 시작 -->
	<!-- 초등12부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10004") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10004"
					<?php
						if ($attendCheckDeptCode == "D10004"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>초등12부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 초등12부 끝 -->
	<!-- 초등34부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10005") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10005"
					<?php
						if ($attendCheckDeptCode == "D10005"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>초등34부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 초등34부 끝 -->
	<!-- 초등56부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10006") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10006"
					<?php
						if ($attendCheckDeptCode == "D10006"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>초등56부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 초등56부 시작 -->
		<!-- 중등부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10007") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10007"
					<?php
						if ($attendCheckDeptCode == "D10007"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>중등부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
	<!-- 중등부 끝 -->
	<!-- 고등부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10008") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10008"
					<?php
						if ($attendCheckDeptCode == "D10008"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>고등부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 대학부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00005") || ($_SESSION['ss_rtdept1code']=="D10009") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10009"
					<?php
						if ($attendCheckDeptCode == "D10009"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>대학부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 대학부 끝 -->
		<!-- 사랑부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001")  || ($_SESSION['ss_rtdept1code']=="D00006") || ($_SESSION['ss_rtdept1code']=="D10012") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10012"
					<?php
						if ($attendCheckDeptCode == "D10012"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>사랑부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 사랑부 끝 -->
		<!-- 농인부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001")  || ($_SESSION['ss_rtdept1code']=="D00006") || ($_SESSION['ss_rtdept1code']=="D10014") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10014"
					<?php
						if ($attendCheckDeptCode == "D10014"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>농인부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- 농인부 끝 -->
		<!-- TCK부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001")  || ($_SESSION['ss_rtdept1code']=="D00019") || ($_SESSION['ss_rtdept1code']=="D10015") || ($_SESSION['ss_rtdept1code']=="D00007") || ($_SESSION['ss_rtdept1code']=="D00008") || ($_SESSION['ss_rtdept1code']=="D00009") || ($_SESSION['ss_rtdept1code']=="D00010")){
	?>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/list.php?attendCheckDeptCode=D10015"
					<?php
						if ($attendCheckDeptCode == "D10015"){
							echo "class='nav-link active'";
						}else{
							echo "class='nav-link'";
						}
					?>>
                    <i class="far fa-circle nav-icon"></i>
                    <p>TCK부</p>
                    </a>
				</li>
			</ul>
	<?php
		}
	?>
		<!-- TCK부 끝 -->
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                출석통계
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/totalAll.php" class='nav-link'>
                    <i class="far fa-circle nav-icon"></i>
                    <p>전체 출석통계</p>
                    </a>
				</li>
			</ul>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/totalDept.php" class='nav-link'>
                    <i class="far fa-circle nav-icon"></i>
                    <p>부서별/반별 출석통계</p>
                    </a>
				</li>
			</ul>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/totalPerson.php" class='nav-link'>
                    <i class="far fa-circle nav-icon"></i>
                    <p>개인별 출석통계</p>
                    </a>
				</li>
			</ul>
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_attendchcek/totalBarChart.php" class='nav-link'>
                    <i class="far fa-circle nav-icon"></i>
                    <p>부서별 Bar Chart</p>
                    </a>
				</li>
			</ul>
          </li>
<?php
	mysqli_close($conn);
?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>