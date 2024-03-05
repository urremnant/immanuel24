  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/rtsc_member/main.php" class="brand-link">
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
<?php
	include "../include/connect.php";
	$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
?>
<!-- 미취학렘넌트국 시작 -->
<?php
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10001") || ($_SESSION['ss_rtdept1code']=="D10002") || ($_SESSION['ss_rtdept1code']=="D10003")){
?>
	<?php
		if ($_SESSION['ss_korname']=="이송현"){
	?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
		</ul>
	  </nav>
	<?php
		}
	?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
				<li class="nav-item menu-open">
					<a href="/rtsc_member/list.php?rtdept1Code=D00002" class="nav-link">
					<i class="nav-icon fas fa-th"></i>
                    <p>미취학렘넌트국</p>
                    </a>
				</li>
			</ul>
          </li>
		</ul>
	  </nav>
	<!-- 태영아부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10001")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10001" 
								<?php
									if ($rtdept1Code == "D10001"){
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
								<p>태영아부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10001&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10001"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
	<!-- 태영아부 끝 -->
	<!-- 유아부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10002")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10002#D10002"
								<?php
									if ($rtdept1Code == "D10002"){
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
								<p>유아부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
			<a name="D10002"></a>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10002&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10002"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
	<!-- 유아부 끝 -->
	<!-- 유치부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00002") || ($_SESSION['ss_rtdept1code']=="D10003")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10003" 
								<?php
									if ($rtdept1Code == "D10003"){
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
								<p>유치부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10003&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10003"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
	<!-- 유치부 끝 -->
<?php
	}
?>
<!-- 미취학렘넌트국 끝 -->
<!-- 초등렘넌트국 시작 -->
<?php
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10004") || ($_SESSION['ss_rtdept1code']=="D10005") || ($_SESSION['ss_rtdept1code']=="D10006")) {
?>
<!-- 초등12부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10004")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10004" 
								<?php
									if ($rtdept1Code == "D10004"){
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
								<p>초등12부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10004&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10004"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 초등12부 끝 -->
<!-- 초등34부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10005")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10005" 
								<?php
									if ($rtdept1Code == "D10005"){
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
								<p>초등34부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10005&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10005"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 초등34부 끝 -->
<!-- 초등56부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00003") || ($_SESSION['ss_rtdept1code']=="D10006")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10006" 
								<?php
									if ($rtdept1Code == "D10006"){
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
								<p>초등56부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10006&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10006"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 초등56부 끝 -->
<?php
	}
?>
<!-- 초등렘넌트국 끝 -->
<!-- 청소년렘넌트국 시작 -->
<?php
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10007") || ($_SESSION['ss_rtdept1code']=="D10008")){
?>
<!-- 중등부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10007")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10007" 
								<?php
									if ($rtdept1Code == "D10007"){
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
								<p>중등부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10007&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10007"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 중등부 끝 -->
<!-- 고등부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00004") || ($_SESSION['ss_rtdept1code']=="D10008")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10008" 
								<?php
									if ($rtdept1Code == "D10008"){
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
								<p>고등부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10008&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10008"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 고등부 끝 -->
<?php
	}
?>
<!-- 청소년렘넌트국 끝 -->
<!-- 대학국 시작 -->
<?php
	if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00005") || ($_SESSION['ss_rtdept1code']=="D10009") || ($_SESSION['ss_rtdept1code']=="D10010") || ($_SESSION['ss_rtdept1code']=="D10011")){
?>
<!-- 대학1부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00005") || ($_SESSION['ss_rtdept1code']=="D10009")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10009" 
								<?php
									if ($rtdept1Code == "D10009"){
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
								<p>대학1부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10009&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10009"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 대학1부 끝 -->
<!-- 대학2부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00005") || ($_SESSION['ss_rtdept1code']=="D10010")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10010" 
								<?php
									if ($rtdept1Code == "D10010"){
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
								<p>대학2부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10010&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10010"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 대학2부 끝 -->
<!-- 대학3부 시작 -->
	<?php
		if (($_SESSION['ss_rtdept1code']=="D00001") || ($_SESSION['ss_rtdept1code']=="D00005") || ($_SESSION['ss_rtdept1code']=="D10011")){
	?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10011" 
								<?php
									if ($rtdept1Code == "D10011"){
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
								<p>대학3부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10011&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10011"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
		}
	?>
<!-- 대학3부 끝 -->
<?php
	}
?>
<!-- 대학국 끝 -->
<!-- 사랑부 시작 -->
<?php
	if (($_SESSION['ss_rtdept1code']=="D00001")|| ($_SESSION['ss_rtdept1code']=="D10012")){
?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10012" 
								<?php
									if ($rtdept1Code == "D10012"){
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
								<p>사랑부</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		<?php
			$sql = "select rtdept2Code, rtdept2Name from rtdept2 order by rtdept2Name";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item menu-open">
						<ul class="nav nav-treeview">
							<li class="nav-item menu-open">
								<a href="/rtsc_member/list.php?rtdept1Code=D10012&rtdept2Code=<?php echo $row['rtdept2Code'] ?>" 
								<?php
									if ($rtdept1Code == "D10012"){
										if ($rtdept2Code == $row['rtdept2Code']){
											echo "class='nav-link active'";
										}else{
											echo "class='nav-link'";
										}
									}else{
										echo "class='nav-link'";
									}
								?>>
								<i class="far fa-list-alt nav-icon"></i>
								<p><?php echo $row['rtdept2Name'] ?></p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
	<?php
			}
	}
?>
<!-- 사랑부 끝 -->

<?php
	mysqli_close($conn);
?>
<!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>