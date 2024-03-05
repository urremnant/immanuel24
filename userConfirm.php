<?php
	session_start();
	unset($_SESSION['ss_rtdept1code']);
	unset($_SESSION['ss_rtdept2code']);
	unset($_SESSION['ss_homepage_admin_idx']);
	unset($_SESSION['ss_korname']);
	unset($_SESSION['ss_photofilename']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>렘넌트서밋위원회</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">

  <script language = "javascript">
  <!--
	function loginchk(){
		if (document.userConfirm.korname.value == ""){
			alert("성명을 입력하여 주십시요.");
			document.userConfirm.korname.focus();
			return false;
		}
		if (document.userConfirm.mobile.value == ""){
			alert("핸드폰번호를 입력하여 주십시요.");
			document.userConfirm.mobile.focus();
			return false;
		}
		if (document.userConfirm.checkSMSNo.value == ""){
			alert("핸드폰 인증문자를 입력하여 주십시요.");
			document.userConfirm.checkSMSNo.focus();
			return false;
		}
		if (document.userConfirm.admin_pass.value == ""){
			alert("사용하실 비밀번호를 입력하여 주십시요.");
			document.userConfirm.admin_pass.focus();
			return false;
		}
		return true;
	}

	function checkSMS(){
		if (document.userConfirm.korname.value == ""){
			alert("성명을 입력하여주십시요.");
			document.userConfirm.korname.focus();
			return;
		}
		if (document.userConfirm.mobile.value == ""){
			alert("핸드폰번호를 입력하여주십시요.");
			document.userConfirm.mobile.focus();
			return;
		}
		window.open("sendSMS.php?korname="+document.userConfirm.korname.value+"&mobile="+document.userConfirm.mobile.value, "sendSMS", "status=no, menubar=no, scrollbars=no, resizable=no, width=500, height=300");
	}

	function onlyNum(obj) {
		var val = obj.value;
		var re = /[^0-9]/gi;
		obj.value = val.replace(re, '');
	}
  //-->
  </script>

</head>
<!--body class="hold-transition login-page"-->
<body style="background-image: url('/image/login-bg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-color: rgba(255,255,255,0.6); " class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/index.php"><b><font color="#ffffff">렘넌트서밋위원회</font></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">사용자 인증 및 비밀번호 설정하기</p>
	  <form name="userConfirm" action="/userConfirm_ok.php" method="post" onsubmit="return loginchk()">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="성명" name="korname">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="핸드폰번호" name="mobile" onkeyup="onlyNum(this);">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-mobile-alt"></span>
            </div>
			<a href="javascript:checkSMS();"><button type="button" class="btn btn-info btn-block">인증번호받기</button></a>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="인증번호" name="checkSMSNo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-check-circle"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="사용하실 비밀번호" name="admin_pass" maxlength="15">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</body>
</html>