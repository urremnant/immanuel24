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
            <h1>렘넌트서밋위원회 캘린더</h1>
          </div>
	<?php
		if (($_SESSION['ss_korname']=="관리자")||($_SESSION['ss_korname']=="홍병희")||($_SESSION['ss_korname']=="하영현")||($_SESSION['ss_korname']=="이혜림B")||($_SESSION['ss_korname']=="차수지")){
	?>
          <div class="col-sm-8">
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
			info.jsEvent.preventDefault(); // don't let the browser navigate
			if (info.event.url) {
				window.open(info.event.url);
			}
			// change the border color just for fun
			//info.el.style.borderColor = 'red';
			//alert(info.event.id);
			//alert(info.event.title);
			//alert(info.event.extendedProps.content);
			$('#modalId').html(info.event.id);
			$('#modalUserID').html(info.event.extendedProps.userID);
			$('#modalTitle').html(info.event.title);
			$('#modalBody').html(info.event.extendedProps.content);
			//$('#eventUrl').attr('href',info.event.url);
			idx = info.event.id;
			userID = info.event.extendedProps.userID;
			document.viewEvent.modalUserID.value = userID;
			document.editEvent.editModalidx.value = idx;
			document.delEvent.delModalidx.value = idx;
			$('#calendarModal').modal();
		}
    });
    calendar.render();
	calendar.gotoDate( '<?php echo $viewDate?>' );
  })
  function editEvent(){
	if (document.getElementById('modalUserID').value != "<?php echo $_SESSION['ss_homepage_admin_idx']?>"){
		alert("자신이 작성한 일정만 수정이 가능합니다.");
		return;
	}
	document.editEvent.submit();
  }
  function delEvent(){
	if (document.getElementById('modalUserID').value != "<?php echo $_SESSION['ss_homepage_admin_idx']?>"){
		alert("자신이 작성한 일정만 삭제가 가능합니다.");
		return;
	}
	document.delEvent.submit();
  }
</script>
<form name="viewEvent">
<div class="modal fade" id="calendarModal">
	<input type="hidden" class="form-control" id="modalUserID" name="modalUserID">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="modalTitle" class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="modalBody" class="modal-body"></div>
			<div class="modal-footer justify-content-between">
				<div class="col-md-6">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>&nbsp;
					<a class="btn btn-info btn-sm" href="javascript:editEvent();"><i class="fas fa-pencil-alt"></i>Edit</a>&nbsp;<a class="btn btn-danger btn-sm" href="javascript:delEvent();"><i class="fas fa-trash"></i>Delete</a>
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<form method ="POST" name="editEvent" action="editEvent.php">
	<input type="hidden" class="form-control" id="editModalidx" name="editModalidx">
</form>
<form method ="POST" name="delEvent" action="delEvent.php">
	<input type="hidden" class="form-control" id="delModalidx" name="delModalidx">
</form>