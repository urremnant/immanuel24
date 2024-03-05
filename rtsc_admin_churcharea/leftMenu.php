  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/rtsc_admin_churcharea/main.php" class="brand-link">
      <img src="/image/churchlogo.png" alt="임마누엘교회" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">교구 교역자</span>
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
          <button type="button" class="btn btn-block btn-primary btn-sm" onClick="location.href='logout.php'">로그아웃</button>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!--li class="nav-header">MULTI LEVEL EXAMPLE</li-->
<?php
	include "../include/connect.php";

#	echo $_SESSION['ss_korChurchAreaName']."<br>";
#	echo $_SESSION['ss_korChurchAreaName']."<br>";

	if (($_SESSION['ss_korname']=="관리자") || ($_SESSION['ss_korname']=="하영현") || ($_SESSION['ss_korname']=="이혜림B") ||  ($_SESSION['ss_korname']=="음성일")){
?>
          <li class="nav-item has-treeview menu-open">
            <a href="/rtsc_admin_churcharea/homepage_admin_churcharea_list.php" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                교구교역자관리
              </p>
            </a>
          </li>
<?php
	}
?>
<?php
	if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){ 
?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                동북권역
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			<ul class="nav nav-treeview">
	<?php
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동북권역" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>동북권역 전체</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="11교구")){
	?>
            
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동북권역&korParishName=11교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>11교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="12교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동북권역&korParishName=12교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>12교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="13교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동북권역&korParishName=13교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>13교구</p>
                    </a>
				</li>
	<?php
			}
		}
	?>
			</ul>
		  </li>
<?php
	}
	if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){ 
?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                동남권역
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			<ul class="nav nav-treeview">
	<?php
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동남권역" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>동남권역 전체</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="21교구")){
	?>
            
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동남권역&korParishName=21교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>21교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="22교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동남권역&korParishName=22교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>22교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="23교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동남권역&korParishName=23교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>23교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="24교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동남권역&korParishName=24교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>24교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="25교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동남권역&korParishName=25교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>25교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="동남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="26교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=동남권역&korParishName=26교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>26교구</p>
                    </a>
				</li>
	<?php
			}
		}
	?>
			</ul>
		  </li>
<?php
	}
	if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){ 
?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                서남권역
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			<ul class="nav nav-treeview">
	<?php
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서남권역" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>서남권역 전체</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="31교구")){
	?>
            
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서남권역&korParishName=31교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>31교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="32교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서남권역&korParishName=32교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>32교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="33교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서남권역&korParishName=33교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>33교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서남권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="34교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서남권역&korParishName=34교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>34교구</p>
                    </a>
				</li>
	<?php
			}
		}
	?>
			</ul>
		  </li>
<?php
	}
	if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){ 
?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                서북권역
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			<ul class="nav nav-treeview">
	<?php
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서북권역" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>서북권역 전체</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="41교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서북권역&korParishName=41교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>41교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="42교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서북권역&korParishName=42교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>42교구</p>
                    </a>
				</li>
	<?php
			}
		}
		if (($_SESSION['ss_korChurchAreaName']=="전체") || ($_SESSION['ss_korChurchAreaName']=="서북권역")){
			if (($_SESSION['ss_korParishName']=="") || ($_SESSION['ss_korParishName']=="43교구")){
	?>
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=서북권역&korParishName=43교구" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>43교구</p>
                    </a>
				</li>
	<?php
			}
		}
	?>
<?php
	}
?>
          <!--li class="nav-item menu-open">
            <a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=미분류" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                미분류
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="/rtsc_admin_churcharea/list.php?korChurchAreaName=미분류&korParishName=미분류">
                    <i class="far fa-circle nav-icon"></i>
                    <p>미분류</p>
                    </a>
				</li-->

			</ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>