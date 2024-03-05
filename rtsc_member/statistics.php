<?php
	include "../include/header.php";
	include "../include/Navbar.php";
	include "../include/leftMenu.php";
?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">통계</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
 
            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">교구별 통계</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart_churcharea" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">부서별 통계</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart_dept" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 


          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  
  
  
<?php
	include "../include/footer.php";

	include "../include/connect.php";
//======================
// 교구별 통계
//======================
	$sql_churcharea = "select churchareaCode, korChurchAreaName, korParishName from churcharea order by korParishName";
	$result_churcharea = mysqli_query($conn, $sql_churcharea);
	while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
		If ($label_churcharea == "") {
			$label_churcharea = "['".$row_churcharea['korParishName'];
		}else{
			$label_churcharea = $label_churcharea."', '".$row_churcharea['korParishName'];
		}
	}
	$label_churcharea = $label_churcharea."']";
//	echo $label_churcharea;

	$sql_churcharea_group_teacher = "select b.korParishName, count(a.memberID) as memberID_count from member a, churcharea b where a.churchareaCode = b.churchareaCode and memberID like 'T%' and rtdept1Code not in ('D99998', 'D99999') group by korParishName order by korParishName";
	$result_churcharea_group_teacher = mysqli_query($conn, $sql_churcharea_group_teacher);
	while ($row_churcharea_group_teacher = mysqli_fetch_assoc($result_churcharea_group_teacher)) {
		If ($data_churcharea_group_teacher == "") {
			$data_churcharea_group_teacher = "[".$row_churcharea_group_teacher['memberID_count'];
		}else{
			$data_churcharea_group_teacher = $data_churcharea_group_teacher.", ".$row_churcharea_group_teacher['memberID_count'];
		}
	}
	$data_churcharea_group_teacher = $data_churcharea_group_teacher."]";
//	echo $data_churcharea_group_teacher;

	$sql_churcharea_group_remnant = "select b.korParishName, count(a.memberID) as memberID_count from member a, churcharea b where a.churchareaCode = b.churchareaCode and memberID like 'R%' and rtdept1Code not in ('D99998', 'D99999') group by korParishName order by korParishName";
	$result_churcharea_group_remnant = mysqli_query($conn, $sql_churcharea_group_remnant);
	while ($row_churcharea_group_remnant = mysqli_fetch_assoc($result_churcharea_group_remnant)) {
		If ($data_churcharea_group_remnant == "") {
			$data_churcharea_group_remnant = "[".$row_churcharea_group_remnant['memberID_count'];
		}else{
			$data_churcharea_group_remnant = $data_churcharea_group_remnant.", ".$row_churcharea_group_remnant['memberID_count'];
		}
	}
	$data_churcharea_group_remnant = $data_churcharea_group_remnant."]";
//	echo $data_churcharea_group_remnant;

	$sql_churcharea_group_pastor = "select a.korParishName, count(b.memberID) as memberID_count from churcharea a left outer join member b on a.churchareaCode = b.churchareaCode and b.rtdept1Code not in ('D99998', 'D99999') and b.memberID like 'P%' group by a.korParishName order by korParishName";
	$result_churcharea_group_pastor = mysqli_query($conn, $sql_churcharea_group_pastor);
	while ($row_churcharea_group_pastor = mysqli_fetch_assoc($result_churcharea_group_pastor)) {
		If ($data_churcharea_group_pastor == "") {
			$data_churcharea_group_pastor = "[".$row_churcharea_group_pastor['memberID_count'];
		}else{
			$data_churcharea_group_pastor = $data_churcharea_group_pastor.", ".$row_churcharea_group_pastor['memberID_count'];
		}
	}
	$data_churcharea_group_pastor = $data_churcharea_group_pastor."]";
//	echo $data_churcharea_group_pastor;

//======================
// 부서별 통계
//======================
	$sql_dept = "select rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
	$result_dept = mysqli_query($conn, $sql_dept);
	while ($row_dept = mysqli_fetch_assoc($result_dept)) {
		If ($label_dept == "") {
			$label_dept = "['".$row_dept['rtdept1Name'];
		}else{
			$label_dept = $label_dept."', '".$row_dept['rtdept1Name'];
		}
		$sql_dept_group_teacher = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'T%'";
		$result_dept_group_teacher = mysqli_query($conn, $sql_dept_group_teacher);
		$row_dept_group_teacher = mysqli_fetch_assoc($result_dept_group_teacher);
		If ($data_dept_group_teacher == "") {
			$data_dept_group_teacher = "[".$row_dept_group_teacher['cnt'];
		}else{
			$data_dept_group_teacher = $data_dept_group_teacher.", ".$row_dept_group_teacher['cnt'];
		}
		$sql_dept_group_remnant = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'R%'";
		$result_dept_group_remnant = mysqli_query($conn, $sql_dept_group_remnant);
		$row_dept_group_remnant = mysqli_fetch_assoc($result_dept_group_remnant);
		If ($data_dept_group_remnant == "") {
			$data_dept_group_remnant = "[".$row_dept_group_remnant['cnt'];
		}else{
			$data_dept_group_remnant = $data_dept_group_remnant.", ".$row_dept_group_remnant['cnt'];
		}
		$sql_dept_group_pastor = "select count(a.memberID) as cnt from member a, rtdept1 b where a.rtdept1Code = b.rtdept1Code and b.rtdept1Name = '".$row_dept['rtdept1Name']."' and a.memberID like 'P%'";
		$result_dept_group_pastor = mysqli_query($conn, $sql_dept_group_pastor);
		$row_dept_group_pastor = mysqli_fetch_assoc($result_dept_group_pastor);
		If ($data_dept_group_pastor == "") {
			$data_dept_group_pastor = "[".$row_dept_group_pastor['cnt'];
		}else{
			$data_dept_group_pastor = $data_dept_group_pastor.", ".$row_dept_group_pastor['cnt'];
		}
	}
	$label_dept = $label_dept."']";
	$data_dept_group_teacher = $data_dept_group_teacher."]";
	$data_dept_group_remnant = $data_dept_group_remnant."]";
	$data_dept_group_pastor = $data_dept_group_pastor."]";

//	echo $data_dept_group_pastor;
?>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    var areaChartData_churcharea = {
 //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	  labels  : <?php echo $label_churcharea?>,
      datasets: [
        {
          label               : '교사',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_churcharea_group_teacher?>
        },
        {
          label               : '렘넌트',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
//        data                : [65, 59, 80, 81, 56, 55, 40]
		  data                : <?php echo $data_churcharea_group_remnant?>
        },
        {
          label               : '교역자',
          backgroundColor     : 'rgba(255, 0, 127, 0.9)',
          borderColor         : 'rgba(255, 0, 127, 0.8)',
          pointRadius          : false,
          pointColor          : '#FF007F',
          pointStrokeColor    : 'rgba(255, 0, 127,,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 0, 127,,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_churcharea_group_pastor?>
        },
      ]
    }

    var areaChartData_dept = {
 //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	  labels  : <?php echo $label_dept?>,
      datasets: [
        {
          label               : '교사',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_dept_group_teacher?>
        },
        {
          label               : '렘넌트',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
//        data                : [65, 59, 80, 81, 56, 55, 40]
		  data                : <?php echo $data_dept_group_remnant?>
        },
        {
          label               : '교역자',
          backgroundColor     : 'rgba(255, 0, 127, 0.9)',
          borderColor         : 'rgba(255, 0, 127, 0.8)',
          pointRadius          : false,
          pointColor          : '#FF007F',
          pointStrokeColor    : 'rgba(255, 0, 127,,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 0, 127,,1)',
//        data                : [28, 48, 40, 19, 86, 27, 90]
		  data                : <?php echo $data_dept_group_pastor?>
        },
      ]
    }

	var barChartData_churcharea = $.extend(true, {}, areaChartData_churcharea)
    var stackedBarChartCanvas_churcharea = $('#stackedBarChart_churcharea').get(0).getContext('2d')
    var stackedBarChartData_churcharea = $.extend(true, {}, barChartData_churcharea)

	var barChartData_dept = $.extend(true, {}, areaChartData_dept)
    var stackedBarChartCanvas_dept = $('#stackedBarChart_dept').get(0).getContext('2d')
    var stackedBarChartData_dept = $.extend(true, {}, barChartData_dept)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart_churcharea = new Chart(stackedBarChartCanvas_churcharea, {
      type: 'bar',
      data: stackedBarChartData_churcharea,
      options: stackedBarChartOptions
    })

    var stackedBarChart_dept = new Chart(stackedBarChartCanvas_dept, {
      type: 'bar',
      data: stackedBarChartData_dept,
      options: stackedBarChartOptions
    })
  })
</script>