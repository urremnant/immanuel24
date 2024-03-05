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
  <link type="text/css" rel="stylesheet" href="JsQRScanner.css">
  <script type="text/javascript" src="/JsQRScanner/jsPretty/jsqrscanner.nocache.js"></script>
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
				<div class="row-element-set row-element-set-QRScanner">
				<!-- RECOMMENDED if your web app will not function without JavaScript enabled -->
					<noscript>
						<div class="row-element-set error_message">
							Your web browser must have JavaScript enabled
							in order for this application to display correctly.
						</div>
					</noscript>
					<div class="row-element-set error_message" id="secure-connection-message" style="display: none;" hidden >
						You may need to serve this page over a secure connection (https) to run JsQRScanner correctly.
					</div>
					<script> 
					if (location.protocol != 'https:') { 
						document.getElementById('secure-connection-message').style='display: block';
					}
					</script>
					<div class="row-element text-center">
						<div class="qrscanner text-center" id="scanner"></div>
					</div>
				</div>
			</div>
            <div class="card-footer clearfix">

				<div class="row-element">
					<div class="form-field form-field-memo">
						<div class="form-field-caption-panel">
							<div class="gwt-Label form-field-caption">
								Scanned text
							</div>
						</div>
						<div class="FlexPanel form-field-input-panel">
							<input type="text" class="form-control textInput form-memo form-field-input textInput-readonly" id="scannedTextMemo" name="scannedTextMemo">
						</div>
					</div>
					<div class="form-field form-field-memo">
						<div class="form-field-caption-panel">
							<div class="gwt-Label form-field-caption">
								Scanned text history
							</div>
						</div>
						<div class="FlexPanel form-field-input-panel">
							<textarea id="scannedTextMemoHist" class="textInput form-memo form-field-input textInput-readonly" value="" rows="6" readonly></textarea>
						</div>
					</div>
				</div>

            </div>
          </div>
        </div>		
      </div>
    </section>

</body>
</html>
  <script type="text/javascript">
    function onQRCodeScanned(scannedText)
    {
    	var scannedTextMemo = document.getElementById("scannedTextMemo");
    	if(scannedTextMemo)
    	{
    		scannedTextMemo.value = scannedText;
    	}
    }
    
    function provideVideo()
    {
        var n = navigator;

        if (n.mediaDevices && n.mediaDevices.getUserMedia)
        {
          return n.mediaDevices.getUserMedia({
            video: {
              facingMode: "environment"
            },
            audio: false
          });
        } 
        
        return Promise.reject('Your browser does not support getUserMedia');
    }

    function provideVideoQQ()
    {
        return navigator.mediaDevices.enumerateDevices()
        .then(function(devices) {
            var exCameras = [];
            devices.forEach(function(device) {
            if (device.kind === 'videoinput') {
              exCameras.push(device.deviceId)
            }
         });
            
            return Promise.resolve(exCameras);
        }).then(function(ids){
            if(ids.length === 0)
            {
              return Promise.reject('Could not find a webcam');
            }
            
            return navigator.mediaDevices.getUserMedia({
                video: {
                  'optional': [{
                    'sourceId': ids.length === 1 ? ids[0] : ids[1]//this way QQ browser opens the rear camera
                    }]
                }
            });        
        });                
    }
    
    //this function will be called when JsQRScanner is ready to use
    function JsQRScannerReady()
    {
        //create a new scanner passing to it a callback function that will be invoked when
        //the scanner succesfully scan a QR code
        var jbScanner = new JsQRScanner(onQRCodeScanned);
        //var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
        //reduce the size of analyzed image to increase performance on mobile devices
        jbScanner.setSnapImageMaxSize(300);
    	var scannerParentElement = document.getElementById("scanner");
    	if(scannerParentElement)
    	{
    	    //append the jbScanner to an existing DOM element
    		jbScanner.appendTo(scannerParentElement);
    	}        
    }
  </script> 