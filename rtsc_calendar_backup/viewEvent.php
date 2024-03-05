<?php
	include "../include/header.php";
	include "../include/Navbar.php";
	include "../include/leftMenu.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-sm-12">
            <h1>렘넌트서밋위원회 캘린더</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

<?php 
	include "../include/connect.php";

	$idx = trim($_REQUEST['idx']);
	$sql = "select * from calendar where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	$scheduleDate = "";
	$scheduleDateTimeRange = "";

	//캘린더로 돌아갈때 필요하다.
	$viewDate = $row['startYear']."-". $row['startMonth']."-".$row['startDay'];

	switch($row['isAllday']){
		case "Y":
			$scheduleDate = $row['startYear']."-". $row['startMonth']."-".$row['startDay'];
			break;
		case "N":
			//2020-12-14 05:30 AM - 2020-12-16 10:00 PM
			if ((int)$row['startTime'] > 12){
				$startTime = (int)$row['startTime'] - 12;
				if (strlen((string)$startTime) == 1){
					$startTime = "0".(string)$startTime;
				}
				$startAMPM = "PM";
			}else{
				$startTime = $row['startTime'];
				$startAMPM = "AM";
			}
			if ((int)$row['endTime'] > 12){
				$endTime = (int)$row['endTime'] - 12;
				if (strlen((string)$endTime) == 1){
					$endTime = "0".(string)$endTime;
				}
				$endAMPM = "PM";
			}else{
				$endTime = $row['endTime'];
				$endAMPM = "AM";
			}

			$scheduleDateTimeRange1 = $row['startYear']."-".$row['startMonth']."-".$row['startDay']." ".$startTime.":".$row['startMinute']." ".$startAMPM;
			$scheduleDateTimeRange2 = $row['endYear']."-".$row['endMonth']."-".$row['endDay']." ".$endTime.":".$row['endMinute']." ".$endAMPM;

			$scheduleDateTimeRange = $scheduleDateTimeRange1." - ".$scheduleDateTimeRange2;
			break;
	}
	//echo $scheduleDate."<br>";
	//echo $scheduleDateTimeRange."<br>";
?>
			<script language = "javascript">
			<!--
			function del(){
				ans = confirm("정말로 삭제하시겠습니까?");
				if(ans==true){
					document.del.submit();
				}
				else{
				}
			}
			//-->
			</script>

			  <div class="card card-secondary">
				<div class="card-header">
					<h3 class="card-title"><font color="<?php echo $row_category['bgcolor']?>"><?php echo $row['title'] ?></font></h3>
				</div>
				<div class="card-body">
                  <div class="form-group row">
					<div class="col-sm-12"><?php echo $row['content'] ?></div>
                  </div>
                  <div class="form-group row">
					<div class="col-sm-1">
						<button type="button" class="btn btn-primary">날짜</button>
					</div>
					<div class="col-sm-11 text-left">

						<?php 
							if ($row['isAllday'] == "Y"){
								echo $scheduleDate;
							}else{
								echo $scheduleDateTimeRange;
							}
						?>
					</div>
                  </div>
				<?php
					if ($row['url'] != ""){
				?>
                  <div class="form-group row">
					<div class="col-sm-1">
						<button type="button" class="btn btn-primary">URL</button>
					</div>
					<div class="col-sm-11 text-left"><a href="<?php echo $row['url']?>" target="_blank"><?php echo $row['url']?></a></div>
                  </div>
                </div>
				<?php
					}
				?>
					<div class="card-footer">
						<a href="calendar.php?viewDate=<?php echo $viewDate?>"><button type="button" class="btn btn-primary">캘린더로 되돌아가기</button></a>
					<?php
						if ($row['homepage_admin_idx'] == ($_SESSION['ss_homepage_admin_idx'])){
					?>
					  <a class="btn btn-info btn-sm" href="editEvent.php?idx=<?php echo $idx?>"><i class="fas fa-pencil-alt"></i>Edit</a>
					  <a class="btn btn-danger btn-sm" href="javascript:del();"><i class="fas fa-trash"></i>Delete</a>
					<?php
						}
					?>
					</div>
			  </div>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
<?php
	include "../include/footer.php";
?>
<!--삭제할 경우 //-->
<form name="del" method="post" action="delEvent.php">
	<input type="hidden" name="idx" value="<?php echo $idx;?>">
</form>
