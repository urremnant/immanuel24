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
            <h1>일정추가하기</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
<?php 
	include "../include/connect.php";
?>
					<script language = "javascript">
					<!--
					function isAlldayCheck(){
						if (document.schedule.isAllday.value == "Y"){

							document.schedule.scheduleDate.value = "";
							document.schedule.scheduleDate.disabled = false;

							document.schedule.scheduleDateTimeRange.value = "";
							document.schedule.scheduleDateTimeRange.disabled = true;

							document.schedule.repeatStartDate.disabled = true;
							document.schedule.repeatEndDate.disabled = true;
							document.schedule.repeatStartTime.disabled = true;
							document.schedule.repeatEndTime.disabled = true;
							document.schedule.repeatDayOfWeek0.disabled = true;
							document.schedule.repeatDayOfWeek1.disabled = true;
							document.schedule.repeatDayOfWeek2.disabled = true;
							document.schedule.repeatDayOfWeek3.disabled = true;
							document.schedule.repeatDayOfWeek4.disabled = true;
							document.schedule.repeatDayOfWeek5.disabled = true;
							document.schedule.repeatDayOfWeek6.disabled = true;
							document.schedule.repeatDayOfWeek7.disabled = true;
							document.schedule.repeatDayOfWeek0.checked = false;
							document.schedule.repeatDayOfWeek1.checked = false;
							document.schedule.repeatDayOfWeek2.checked = false;
							document.schedule.repeatDayOfWeek3.checked = false;
							document.schedule.repeatDayOfWeek4.checked = false;
							document.schedule.repeatDayOfWeek5.checked = false;
							document.schedule.repeatDayOfWeek6.checked = false;
							document.schedule.repeatDayOfWeek7.checked = false;


						}
						if (document.schedule.isAllday.value == "N"){

							document.schedule.scheduleDate.value = "";
							document.schedule.scheduleDate.disabled = true;

							document.schedule.scheduleDate.value = "";
							document.schedule.scheduleDateTimeRange.disabled = false;

							document.schedule.repeatStartDate.disabled = true;
							document.schedule.repeatEndDate.disabled = true;
							document.schedule.repeatStartTime.disabled = true;
							document.schedule.repeatEndTime.disabled = true;
							document.schedule.repeatDayOfWeek0.disabled = true;
							document.schedule.repeatDayOfWeek1.disabled = true;
							document.schedule.repeatDayOfWeek2.disabled = true;
							document.schedule.repeatDayOfWeek3.disabled = true;
							document.schedule.repeatDayOfWeek4.disabled = true;
							document.schedule.repeatDayOfWeek5.disabled = true;
							document.schedule.repeatDayOfWeek6.disabled = true;
							document.schedule.repeatDayOfWeek7.disabled = true;
							document.schedule.repeatDayOfWeek0.checked = false;
							document.schedule.repeatDayOfWeek1.checked = false;
							document.schedule.repeatDayOfWeek2.checked = false;
							document.schedule.repeatDayOfWeek3.checked = false;
							document.schedule.repeatDayOfWeek4.checked = false;
							document.schedule.repeatDayOfWeek5.checked = false;
							document.schedule.repeatDayOfWeek6.checked = false;
							document.schedule.repeatDayOfWeek7.checked = false;

						}
						if (document.schedule.isAllday.value == "R"){

							document.schedule.scheduleDate.value = "";
							document.schedule.scheduleDate.disabled = true;

							document.schedule.scheduleDateTimeRange.value = "";
							document.schedule.scheduleDateTimeRange.disabled = true;

							document.schedule.repeatStartDate.disabled = false;
							document.schedule.repeatEndDate.disabled = false;
							document.schedule.repeatStartTime.disabled = false;
							document.schedule.repeatEndTime.disabled = false;
							document.schedule.repeatDayOfWeek0.disabled = false;
							document.schedule.repeatDayOfWeek1.disabled = false;
							document.schedule.repeatDayOfWeek2.disabled = false;
							document.schedule.repeatDayOfWeek3.disabled = false;
							document.schedule.repeatDayOfWeek4.disabled = false;
							document.schedule.repeatDayOfWeek5.disabled = false;
							document.schedule.repeatDayOfWeek6.disabled = false;
							document.schedule.repeatDayOfWeek7.disabled = false;

						}
					}
					function everyDayCheck(){
						if (document.schedule.repeatDayOfWeek7.checked == true){
							if (document.schedule.repeatDayOfWeek0.checked == false){
								document.schedule.repeatDayOfWeek0.checked = true;
							}
							if (document.schedule.repeatDayOfWeek1.checked == false){
								document.schedule.repeatDayOfWeek1.checked = true;
							}
							if (document.schedule.repeatDayOfWeek2.checked == false){
								document.schedule.repeatDayOfWeek2.checked = true;
							}
							if (document.schedule.repeatDayOfWeek3.checked == false){
								document.schedule.repeatDayOfWeek3.checked = true;
							}
							if (document.schedule.repeatDayOfWeek4.checked == false){
								document.schedule.repeatDayOfWeek4.checked = true;
							}
							if (document.schedule.repeatDayOfWeek5.checked == false){
								document.schedule.repeatDayOfWeek5.checked = true;
							}
							if (document.schedule.repeatDayOfWeek6.checked == false){
								document.schedule.repeatDayOfWeek6.checked = true;
							}
						}else{
							document.schedule.repeatDayOfWeek0.checked = false;
							document.schedule.repeatDayOfWeek1.checked = false;
							document.schedule.repeatDayOfWeek2.checked = false;
							document.schedule.repeatDayOfWeek3.checked = false;
							document.schedule.repeatDayOfWeek4.checked = false;
							document.schedule.repeatDayOfWeek5.checked = false;					
							document.schedule.repeatDayOfWeek6.checked = false;
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
						for(i=0; i<3; i++){
							if(document.schedule.isAllday[i].checked == true){
								isAllday_count += 1;
							}
						}
						if (isAllday_count == 0){
							alert("하루종일, 기간일정, 반복일정을 선택하여 주십시요.");
							document.schedule.isAllday[0].focus();
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

						if (document.schedule.isAllday.value == "R"){
							if ((document.schedule.repeatStartDate.value == "")&&(document.schedule.repeatEndDate.value == "")&&(document.schedule.repeatStartTime.value == "")&&(document.schedule.repeatEndTime.value == "")){
								alert("반복기간 또는 반복시간 둘 중에 한 곳은 반드시 설정하여야 합니다.");
								document.schedule.repeatStartDate.focus();
								return false;
							}
							if (document.schedule.repeatStartDate.value != ""){
								if (document.schedule.repeatEndDate.value == ""){
									alert("반복기간을 제대로 설정하여 주세요.");
									document.schedule.repeatEndDate.focus();
									return false;
								}
							}
							if (document.schedule.repeatEndDate.value != ""){
								if (document.schedule.repeatStartDate.value == ""){
									alert("반복기간을 제대로 설정하여 주세요.");
									document.schedule.repeatStartDate.focus();
									return false;
								}
							}
							if (document.schedule.repeatStartTime.value != ""){
								if (document.schedule.repeatEndTime.value == ""){
									alert("반복시간을 제대로 설정하여 주세요.");
									document.schedule.repeatEndTime.focus();
									return false;
								}
							} 
							if (document.schedule.repeatEndTime.value != ""){
								if (document.schedule.repeatStartTime.value == ""){
									alert("반복시간을 제대로 설정하여 주세요.");
									document.schedule.repeatStartTime.focus();
									return false;
								}
							} 
						}
						document.schedule.submit();
					}
					//-->
					</script>
				  <form class="form-horizontal" method ="POST" name="schedule" action="addEvent_ok.php" onsubmit="return sendit()">
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
									<input class="form-check-input" type="radio" name="calendar_category_idx" value="<?php echo $row_category['calendar_category_idx']?>">
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
						  <input type="text" class="form-control" name="title" maxlength="50">
						</div>
					  </div>
					  <div class="form-group row">
						<label class="col-sm-2 col-form-label">내용</label>
						<div class="col-sm-10">
						  <textarea class="form-control" name="content" rows="3"></textarea>
						</div>
					  </div>
					  <div class="form-group row">
						<label class="col-sm-2 col-form-label">날짜</label>
						<div class="col-sm-10">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="isAllday" value="Y" onclick="javascript:isAlldayCheck();"><label class="form-check-label">하루종일
							</div>
							<div class="form-group">
								<div class="input-group date" id="scheduleDate" data-target-input="nearest">
									<div class="input-group-append" data-target="#scheduleDate" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
									<input type="text" name="scheduleDate" class="form-control datetimepicker-input" data-target="#scheduleDate"/>
								</div>
							</div>
						</div>
					  </div>
					  <div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="isAllday" value="N" onclick="javascript:isAlldayCheck();"><label class="form-check-label">기간설정</label>
							</div>
							<div><br>※ 기간설정은 텍스트박스를 클릭하면 날짜 선택 창이 뜨고 설정할 날짜를 두 곳을 클릭한 후 시간을 설정하시면 됩니다.<br><br></div>
							<div class="form-group">
							  <div class="input-group">
								<div class="input-group-prepend">
								  <span class="input-group-text"><i class="far fa-clock"></i></span>
								</div>
								<input type="text" id="scheduleDateTimeRange" name="scheduleDateTimeRange" class="form-control float-right">
							  </div>
							</div>
						</div>
					  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="isAllday" value="R" onclick="javascript:isAlldayCheck();"><label class="form-check-label">반복일정</label>
						</div>
						<div><br>※ 반복기간 또는 반복시간 둘 중 한 곳은 반드시 입력해야 합니다.<br><br></div>
					</div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-1">
						<label class="form-check-label">반복기간</label>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="input-group date" id="repeatStartDate" data-target-input="nearest">
								<div class="input-group-append" data-target="#repeatStartDate" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
								<input type="text" name="repeatStartDate" class="form-control datetimepicker-input" data-target="#repeatStartDate"/>
							</div>
						</div>
					</div>
					<div class="col-sm-1 text-center">
					  <label>~</label>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="input-group date" id="repeatEndDate" data-target-input="nearest">
								<div class="input-group-append" data-target="#repeatEndDate" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
								<input type="text" name="repeatEndDate" class="form-control datetimepicker-input" data-target="#repeatEndDate"/>
							</div>
						</div>
					</div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-1">
						<label class="form-check-label">반복시간</label>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="input-group date" id="repeatStartTime" data-target-input="nearest">
								<div class="input-group-append" data-target="#repeatStartTime" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-clock"></i></div>
								</div>
								<input type="text" name="repeatStartTime" class="form-control datetimepicker-input" data-target="#repeatStartTime"/>
							</div>
						</div>		
					</div>
					<div class="col-sm-1 text-center">
					  <label>~</label>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<div class="input-group date" id="repeatEndTime" data-target-input="nearest">
								<div class="input-group-append" data-target="#repeatEndTime" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-clock"></i></div>
								</div>
								<input type="text" name="repeatEndTime" class="form-control datetimepicker-input" data-target="#repeatEndTime"/>
							</div>
						</div>	
					</div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-1">
						<label class="form-check-label">반복요일</label>
					</div>
					<div class="col-sm-9">
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek1" value="Y">
							<label class="form-check-label">월요일</label>
						</div>
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek2" value="Y">
							<label class="form-check-label">화요일</label>
						</div>
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek3" value="Y">
							<label class="form-check-label">수요일</label>
						</div>
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek4" value="Y">
							<label class="form-check-label">목요일</label>
						</div>
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek5" value="Y">
							<label class="form-check-label">금요일</label>
						</div>
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek6" value="Y">
							<label class="form-check-label">토요일</label>
						</div>
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek0" value="Y">
							<label class="form-check-label">일요일</label>
						</div>
						<div class="btn-group form-check">
							<input class="form-check-input" type="checkbox" name="repeatDayOfWeek7" value="Y" onclick="javascript:everyDayCheck()">
							<label class="form-check-label">매일</label>
						</div>
					</div>
                  </div>
				  <div class="form-group row">
					<label class="col-sm-2 col-form-label">URL</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="url" maxlength="50">
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

	//반복일정 시작일, 종료일
	$('#repeatStartDate').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#repeatEndDate').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	//반복일정 시작시간, 종료시간
	$('#repeatStartTime').datetimepicker({
		format: 'HH:mm'
	});
	$('#repeatEndTime').datetimepicker({
		format: 'HH:mm'
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