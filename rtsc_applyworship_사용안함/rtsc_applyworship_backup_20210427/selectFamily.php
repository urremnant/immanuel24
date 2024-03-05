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
            <h1 class="m-0">예배신청하기(가족)</h1>
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
              <div class="card-header">
				<div class="row">
					<div class="col-5">
						<h5>※ 자신의 가족 성명을 확인하시고 예배신청하기(가족) 버튼을 클릭하세요.</h5>
					</div>
				</div>
              </div>
              <div class="card-body">
				<?php
					include "connect.php";
					$worshipDate	= trim($_REQUEST['worshipDate']);
					$korname		= trim($_REQUEST['korname']);
					$birthyear		= trim($_REQUEST['birthyear']);	
					$birthmonth		= trim($_REQUEST['birthmonth']);					
					$birthday		= trim($_REQUEST['birthday']);
					$birthday		= $birthyear.$birthmonth.$birthday;

					$sql_faimly = "select familyID from member_familyinfo where korname like '%".$korname."%' and birthday = '".$birthday."'";
					$result_faimly = mysqli_query($conn, $sql_faimly);
					$count_faimly = mysqli_num_rows($result_faimly);
					//echo $count;
					if ($count_faimly == 0){
						echo "<script>alert('해당 이름으로 등록된 가족이 없습니다.');history.back();</script>";
					}
				?>
				<script language = "javascript">
				<!--
				function sendit(){
//
					document.rtsc.submit();
				}
				//-->
				</script>
                  <div class="col-12">
					<!-- 가족관계 시작 -->
					<table class="table table-hover text-nowrap">
					<thead>
						<tr class="text-center">
							<th>가족 성명</th>
							<th>예배신청하기(가족)</th>
						</tr>
					</thead>
					<tbody>
				<?php
					while ($row_faimly = mysqli_fetch_assoc($result_faimly)) {
						$sql_faimly_korname = "select korname from member_familyinfo where familyID = '".$row_faimly['familyID']."'";
						$result_faimly_korname = mysqli_query($conn, $sql_faimly_korname);
						while ($row_faimly_korname = mysqli_fetch_assoc($result_faimly_korname)) {
							if ($faimly_korname == ""){
								$faimly_korname = $row_faimly_korname['korname'];
							}else{
								$faimly_korname = $faimly_korname."/".$row_faimly_korname['korname'];
							}
						}
				?>
						<tr class="text-center">
							<td><?php echo $faimly_korname ?></td>
							<td><a href="registWorship_Family.php?worshipDate=<?php echo $worshipDate?>&familyID=<?php echo $row_faimly['familyID']?>"><button type="button" class="btn btn-primary">예배신청하기(가족)</button></a></td>
						</tr>
				<?php
					}
				?>
					</tfoot>
					</table>
				  </div>
				<?php
					mysqli_close($conn);
				?>
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
	include "footer.php";
?>
