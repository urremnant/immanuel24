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
		if (document.login.korname.value == ""){
			alert("성명을 입력하여 주십시요.");
			document.login.korname.focus();
			return false;
		}
		if (document.login.admin_pass.value == ""){
			alert("비밀번호를 입력하여 주십시요.");
			document.login.admin_pass.focus();
			return false;
		}
		return true;
	}
  -->
  </script>

</head>
<!--body class="hold-transition login-page"-->
<body style="background-image: url('/image/login-bg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-color: rgba(255,255,255,0.6); " class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/index.php"><b><font color="#ffffff">렘넌트서밋위원회</font></b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">최초 로그인시 사용자 인증을 통해 개인비밀번호를 설정하셔야 합니다.</p>
	  <p class="login-box-msg">
		<a href="userConfirm.php"><button type="button" class="btn btn-info btn-block">사용자 인증 및 비밀번호 설정하기</button></a>
	  </p>
	  <form name="login" action="/login_ok.php" method="post" onsubmit="return loginchk()">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="성명" name="korname">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="비밀번호" name="admin_pass" maxlength="15">
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
        <!--div class="row">
          <div class="col-12 text-center">
            <a href="/guide.php"><p>개인정보처리방침</p></a>
          </div>
        </div-->
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