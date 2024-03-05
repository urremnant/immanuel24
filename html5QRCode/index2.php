<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>임마누엘교회</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <script src="html5-qrcode.min.js"></script>
</head>
<body class="hold-transition login-page">

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">QR Code Scan</h3>
              </div>
			</div>
            <!-- /.card-header -->
            <div class="card-body">
				<div id="qr-reader" style="width:500px"></div>
				<div id="qr-reader-results"></div>
			</div>
            <div class="card-footer clearfix">
			<script language="javascript">
			<!--
				function gotopage(){
					alert("체인지이벤트");
					return;
				}
			//-->
			</script>
				<input type="text" class="form-control textInput form-memo form-field-input textInput-readonly" id="scannedTextMemo" name="scannedTextMemo" onChange="javascript:gotopage();">
            </div>
          </div>
        </div>		
      </div>
    </section>

</body>
</html>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        // var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(qrCodeMessage) {
            if (qrCodeMessage !== lastResult) {
                ++countResults;
                lastResult = qrCodeMessage;
                //resultContainer.innerHTML += `<div>[${countResults}] - ${qrCodeMessage}</div>`;
				if (lastResult != ""){
					document.getElementById('scannedTextMemo').value = lastResult;
					location.href="result.php?lastResult="+lastResult;
				}
				
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>