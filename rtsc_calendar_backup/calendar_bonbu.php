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
          <div class="col-sm-4">
            <h1>본부일정</h1>
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
		googleCalendarApiKey : 'AIzaSyDANY6CcHwTgTLRMP81elw8jPIgJjf9bb4',
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

		eventSources : [{googleCalendarId : 'infooffice3@gmail.com' , className : '본부일정'}],
    });
    calendar.render();
  })
</script>