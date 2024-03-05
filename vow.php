<?php
	session_start();
	if ($_SESSION['ss_korname'] == ""){
		echo "<script>alert('세션이 끊겼습니다. 다시 로그인 하여 주세요.');</script>";
		echo "<script>location.replace('/index.php');</script>";
		exit;
	}
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

</head>
<!--body class="hold-transition login-page"-->
<body style="background-image: url('/image/login-bg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-color: rgba(255,255,255,0.6); " class="hold-transition login-page">
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<div class="card">
  <div class="card-body login-card-body">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> 개인정보보호서약서</h5>
              ※ 최초 1회 개인정보보호서약을 해주셔야만 홈페이지 이용이 가능합니다.
            </div>
            <!-- Main content -->
            <div class="col-12">
<p>본인은 임마누엘교회 교인으로서 다음의 사항을 준수할 것을 서약합니다.</p>
<p></p>
<p>1. 본인은 임마누엘교회 정보보호 정책 및 지침을 성실히 준수하겠습니다.</p>
<p>2. 본인은 업무를 수행함에 있어서  취득한 정보에 대한 권리는 임마누엘교회의 소유임을 확약합니다.</p>
<p>3. 본인은 업무 수행 상 알게된 일체의 정보 및 기밀(개인정보, 계정정보, 언약의 여정 등)을 임마누엘교회와 개인의 승인 없이 제3자에게 제공하지 않겠습니다.</p>
<p>4. 본인은 개인 정보를 수집할 때 업무상 필요한 정보 이외의 것을 확인하지 않으며 본인에게 접근이 허용되지 않은 정보에 대한 접근 통제 규칙을 철저하게 준수하겠습니다.</p>
<p>5. 개인의 정보유출이나 정보보호 위반 사례를 발견할 시에는 이를 지체없이 부서장 또는 정보보호 책임자에게 보고하겠습니다.</p>
<p>6. 본인은 정보통신망 이용촉진 및 정보보호 등에 관한 법률에 입각하여 교회의 정보보호 지침을 준수합니다.</p>
<p>7. 본인이 서약 사항을 위반하여 교회의 업무에 장애를 일으키거나 손해를 끼친 경우 민형사상 책임과 관계 법령 및 교회의 규정에 의한 조치를 따르겠습니다.</p>
<p></p>
<div class="text-center"><h4><?php echo date("Y-m-d");?></h4></div>
<p></p>
<div class="text-center"><h4><?php echo $_SESSION['ss_korname'];?></h4></div>
<p></p>
            </div>
			<div class="card-header">
				<a href="vow_ok.php"><button type="button" class="btn btn-block btn-success btn-lg">개인정보보호서약에 동의합니다.</button></a>
			</div>
          </div>
		</div>
        <!-- /.row -->
      </div>
	  <!-- /.container-fluid -->
    </section>
  </div>
</div>
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</body>
</html>