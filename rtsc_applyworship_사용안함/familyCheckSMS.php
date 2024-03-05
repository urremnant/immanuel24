<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>렘넌트서밋위원회</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            핸드폰 문자 인증하기
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

				$korname	= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
				$birthyear	= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
				$birthmonth	= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
				$birthday	= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
				$birthday	= $birthyear.$birthmonth.$birthday;
				$mobile		= mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
				//echo $korname."<br>";
				//echo $birthday."<br>";
				//echo $mobile."<br>";
				$sql = "select COUNT(idx) AS cnt FROM member_familyinfo where korname= '".$korname."' and birthday = '".$birthday."' and mobile = '".$mobile."'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				//echo $row['cnt'];
				if ($row['cnt'] == 0){
					echo "<script>alert('일치하는 데이터가 없습니다. 성명과 생년월일, 핸드폰번호를 다시 확인해주세요.');self.close();</script>";
				}else{
					//6자리 난수생성
					$randomNum = mt_rand(100000, 999999);
					//echo $randomNum;

					$sql_random = "update member_familyinfo set randomNum = '".$randomNum."' where korname= '".$korname."' and birthday = '".$birthday."' and mobile = '".$mobile."'";
					$result_random = mysqli_query($conn, $sql_random);
					

					//너나우리 문자발송
					include_once('../include/nusoap_youiwe.php');
	
					$snd_number		= "01036969157";		//보내는 사람 번호를 받음
					$rcv_number		= $mobile;				//받는 사람 번호를 받음
					$sms_content	= "[렘넌트서밋위원회]나의 가족정보 보기 인증번호는 ".$randomNum." 입니다.";	//전송 내용을 받음
				
					/******고객님 접속 정보************/
					$sms_id		= "fencer3927";				//고객님께서 부여 받으신 sms_id
					$sms_pwd	= "christ24";				//고객님께서 부여 받으신 sms_pwd
					/**********************************/
					$callbackURL = "www.youiwe.co.kr";
					$userdefine = $sms_id;					//예약취소를 위해 넣어주는 구분자 정의값, 사용자 임의로 지정해주시면 됩니다. 영문으로 넣어주셔야 합니다. 사용자가 구분할 수 있는 값을 넣어주세요.
					$canclemode = "1";						//예약 취소 모드 1: 사용자정의값에 의한 삭제.  현제는 무조건 1을 넣어주시면 됩니다.

					//구축 테스트 주소와 일반 웹서비스 선택
					if (substr($sms_id,0,3) == "bt_"){
						$webService = "http://webservice.youiwe.co.kr/SMS.v.6.bt/ServiceSMS_bt.asmx?WSDL";
					}
					else{
						$webService = "http://webservice.youiwe.co.kr/SMS.v.6/ServiceSMS.asmx?WSDL";
					}
					//+) funcMode는 메소드실행 후 반환값에 따라 다른 메시지를 띄우기 위해서 쓰입니다.
					$sms = new SMS($webService); //SMS 객체 생성
					/*즉시 전송으로 구성하실경우*/
					$result=$sms->SendSMS($sms_id,$sms_pwd,$snd_number,$rcv_number,$sms_content);// 5개의 인자로 함수를 호출합니다.

					echo "<script>alert('인증문자를 발송하였습니다. 인증문자를 입력하시고 나의 가족정보 보기 버튼을 클릭하여 주십시요.');self.close();</script>";
				}

				mysqli_close($conn);
			?>
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
</div>

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
