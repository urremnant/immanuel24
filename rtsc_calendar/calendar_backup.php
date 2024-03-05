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
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1>렘넌트서밋위원회 캘린더</h1>
          </div>
	<?php
		if (($_SESSION['ss_korname']=="관리자")||($_SESSION['ss_korname']=="홍병희")||($_SESSION['ss_korname']=="하영현")||($_SESSION['ss_korname']=="이혜림B")||($_SESSION['ss_korname']=="차수지")||($_SESSION['ss_korname']=="김신태")){
	?>
          <div class="col-sm-9">
			  <a href="addEvent.php"><button type="button" class="btn btn-primary">일정 추가하기</button></a>
		  </div>

	<?php
		}
	?>
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
                <div id="calendar"></div>
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
	if(isset($_REQUEST["viewDate"])){
		$viewDate = trim($_REQUEST["viewDate"]);
	}else{
		$viewDate = date("Y-m-d", time());
	}
?>
<!-- Page specific script -->
<script>
  $(function () {

    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

	var calendar = new Calendar(calendarEl, {
		headerToolbar: {
			left  : 'prev,next today',
			center: 'title',
			right : 'dayGridMonth,timeGridWeek,timeGridDay'
		},
		themeSystem: 'bootstrap',
		defaultView: 'dayGridMonth',
		locale: 'ko',
//		navLinks: true, // can click day/week names to navigate views
//		editable: true,
//		allDaySlot: false,
//		eventLimit: true, // allow "more" link when too many events
//		minTime: '10:00:00',
//		maxTime: '24:00:00',
//		contentHeight: 'auto',
		eventSources: [{
			events: function(info, successCallback, failureCallback){
				$.ajax({
					url :	'data.php',
					type :	'post',
					async : false,
					dataType : 'text',
					data : {
						start : moment(info.startStr).format('YYYYMMDD'),
						end : moment(info.endStr).format('YYYYMMDD')
					},
					success : function(data){
						var jsonObj = eval("("+data+")");
                        successCallback(jsonObj);
					},
					error:function(xhr, textStatus){
						document.write(xhr.responseText);
					}
				});
			}
		}],
		eventClick: function(info) {
			idx = info.event.id;
			location.href="viewEvent.php?idx="+idx;
		}
    });
    calendar.render();
	calendar.gotoDate( '<?php echo $viewDate?>' );
  })
</script>