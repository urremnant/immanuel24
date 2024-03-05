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
            <h1>일정수정하기</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

<?php 
	include "../include/connect.php";

	$idx = trim($_REQUEST['editModalidx']);
	$sql = "select * from calendar where idx = '".$idx."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	$scheduleDate = "";
	$scheduleDateTimeRange = "";

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
			function isAlldayCheck(){
				if (document.schedule.isAllday.value == "Y"){
					document.schedule.scheduleDate.disabled = false;
					document.schedule.scheduleDateTimeRange.value = "";
					document.schedule.scheduleDateTimeRange.disabled = true;
				}
				if (document.schedule.isAllday.value == "N"){
					document.schedule.scheduleDate.value = "";
					document.schedule.scheduleDate.disabled = true;
					document.schedule.scheduleDateTimeRange.disabled = false;
				}
			}
			function sendit(){

				var calendar_category_count = 0;
				for(i=0; i<8; i++){
					if(document.schedule.calendar_category_idx[i].checked == true){
						calendar_category_count += 1;
					}
				}
				if (calendar_category_count == 0){
					alert("구분을 선택하여 주십시요.");
					document.schedule.calendar_category_idx[0].focus();
					return false;
				}
				if (document.schedule.title.value == ""){
						alert("제목을 입력하여 주십시요.");
						document.schedule.title.focus();
						return false;
				}
				if (document.schedule.content.value == ""){
						alert("내용을 입력하여 주십시요.");
						document.schedule.content.focus();
						return false;
				}

				var isAllday_count = 0;
				for(i=0; i<2; i++){
					if(document.schedule.isAllday[i].checked == true){
						isAllday_count += 1;
					}
				}
				if (isAllday_count == 0){
					alert("하루종일 또는 기간설정을 선택하여 주십시요.");
					document.schedule.calendar_category_idx[0].focus();
					return false;
				}

				if (document.schedule.isAllday.value == "Y"){
					if (document.schedule.scheduleDate.value == ""){
						alert("날짜 아이콘을 클릭하여 날짜를 선택하여 주십시요.");
						document.schedule.scheduleDate.focus();
						return false;
					}
				}
				if (document.schedule.isAllday.value == "N"){
					if (document.schedule.scheduleDateTimeRange.value == ""){
						alert("기간설정을 하여 주십시요.");
						document.schedule.scheduleDateTimeRange.focus();
						return false;
					}
				}
				document.schedule.submit();
			}
			//-->
			</script>


              <form class="form-horizontal" method ="POST" name="schedule" action="editEvent_ok.php" onsubmit="return sendit()">
				<input type="hidden" name="idx" value="<?php echo $idx;?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">구분</label>
					<div class="col-sm-10">
						<?php
							$sql_category = "select calendar_category_idx, korCalendar, bgcolor from calendar_category order by calendar_category_idx";
							$result_category = mysqli_query($conn, $sql_category);
							while ($row_category = mysqli_fetch_assoc($result_category)) {
						?>
							<div class="btn-group form-check">
								<input class="form-check-input" type="radio" name="calendar_category_idx" value="<?php echo $row_category['calendar_category_idx']?>"<?php if ($row['calendar_category_idx'] == $row_category['calendar_category_idx']){echo " checked";}?>>
								<label class="form-check-label"><font color="<?php echo $row_category['bgcolor']?>"><?php echo $row_category['korCalendar']?></font></label>
							</div>
						<?php
							}
						?>
					</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">제목</label>
					<div class="col-sm-10">
                      <input type="text" class="form-control" name="title" maxlength="50" value="<?php echo $row['title'] ?>">
					</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">내용</label>
					<div class="col-sm-10">
                      <textarea class="form-control" name="content" rows="3"><?php echo $row['content'] ?></textarea>
					</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">날짜</label>
					<div class="col-sm-10">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="isAllday" value="Y" onclick="javascript:isAlldayCheck();"<?php if ($row['isAllday'] == "Y"){echo " checked";}?>><label class="form-check-label">하루종일
						</div>
						<div class="form-group">
							<div class="input-group date" id="scheduleDate" data-target-input="nearest">
								<div class="input-group-append" data-target="#scheduleDate" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
								<input type="text" name="scheduleDate" class="form-control datetimepicker-input" data-target="#scheduleDate" value="<?php echo $scheduleDate ?>"/>
							</div>
						</div>
					</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="isAllday" value="N" onclick="javascript:isAlldayCheck();"<?php if ($row['isAllday'] == "N"){echo " checked";}?>><label class="form-check-label">기간설정</label>
						</div>
						<div class="form-group">
						  <div class="input-group">
							<div class="input-group-prepend">
							  <span class="input-group-text"><i class="far fa-clock"></i></span>
							</div>
							<input type="text" id="scheduleDateTimeRange" name="scheduleDateTimeRange" class="form-control float-right"/>
						  </div>
						  <label>※ 현재 설정된 기간 : <?php echo $scheduleDateTimeRange?></label>
						</div>
					</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<div class="form-group">
						  <label>※ 기간설정은 텍스트박스를 클릭하면 날짜 선택 창이 뜨고 설정할 날짜를 두 곳을 클릭한 후 시간을 설정하시면 됩니다.</label>
						</div>
					</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">URL</label>
					<div class="col-sm-10">
                      <input type="text" class="form-control" name="url" maxlength="50" value="<?php echo $row['url']?>">
					</div>
                  </div>
                </div>
                <div class="card-footer">
				  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </form>
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
<?php
	include "../include/footer.php";
?>
<script>
  $(function () {
	//Date range picker
	$('#scheduleDate').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#scheduleDateTimeRange').daterangepicker({
		autoUpdateInput: false,
		timePicker: true,
		timePickerIncrement: 30,
		locale: {
			cancelLabel: 'Clear'
		}
	});

	$('#scheduleDateTimeRange').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('YYYY-MM-DD hh:mm A') + ' - ' + picker.endDate.format('YYYY-MM-DD hh:mm A'));
	});

	$('#scheduleDateTimeRange').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});

  })
</script>