<?php
	$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);

	//echo "부서1 : ".$rtdept1Code."<br>";
	//echo "부서2 : ".$rtdept2Code."<br>";
	//echo "세션 부서 : ".$_SESSION['ss_rtdept1code']."<br>";
	//echo "세션 분반 : ".$_SESSION['ss_rtdept2code']."<br>";
	//echo "세션 성명 : ".$_SESSION['ss_korname']."<br>";
	//echo "세션 사진파일 : ".$_SESSION['ss_photofilename']."<br>";

	//열람권한체크
	//부서1이 다르다면 해당 부서에 대한 열람 권한이 있는지 체크를 한다. 
	if ($rtdept1Code != $_SESSION['ss_rtdept1code']){

		//렘넌트서밋위원회일 경우 모든 부서 열람이 가능하다.
		if ($_SESSION['ss_rtdept1code'] != "D00001"){

//--------------
//국별 권한체크
//--------------
			//미취학렘넌트국 - 태영아부, 유아부, 유치부 열람이 가능하다.
			if ($_SESSION['ss_rtdept1code'] == "D00002"){
				if (($rtdept1Code == "D10001") || ($rtdept1Code == "D10002") || ($rtdept1Code == "D10003")){
				}else{
					echo "<script>alert('미취학국을 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//초등렘넌트국 - 초등12부, 초등34부, 초등56부 열람이 가능하다.
			if ($_SESSION['ss_rtdept1code'] == "D00003"){
				if (($rtdept1Code == "D10004") || ($rtdept1Code == "D10005") || ($rtdept1Code == "D10006")){
				}else{
					echo "<script>alert('초등렘넌트국을 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}				
			}
			//청소년렘넌트국 - 중등부, 고등부 열람이 가능하다.
			if ($_SESSION['ss_rtdept1code'] == "D00004"){
				if (($rtdept1Code == "D10007") || ($rtdept1Code == "D10008")){
				}else{
					echo "<script>alert('청소년렘넌트국을 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}					
			}			
			//대학국 - 대학1부, 대학2부, 대학3부 열람이 가능하다.
			if ($_SESSION['ss_rtdept1code'] == "D00005"){
				if (($rtdept1Code == "D10009") || ($rtdept1Code == "D10010") || ($rtdept1Code == "D10011")){
				}else{
					echo "<script>alert('대학국을 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}					
			}
			//사랑부 - 사랑부 열람이 가능하다.
			if ($_SESSION['ss_rtdept1code'] == "D00006"){
				if (($rtdept1Code == "D10012")){
				}else{
					echo "<script>alert('사랑부를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}					
			}
			
//--------------
//부서별 권한체크
//--------------
			//태영아부
			if ($_SESSION['ss_rtdept1code'] == "D10001"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//유아부
			if ($_SESSION['ss_rtdept1code'] == "D10002"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//유치부
			if ($_SESSION['ss_rtdept1code'] == "D10003"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//초등12부
			if ($_SESSION['ss_rtdept1code'] == "D10004"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//초등34부
			if ($_SESSION['ss_rtdept1code'] == "D10005"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//초등56부
			if ($_SESSION['ss_rtdept1code'] == "D10006"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('초등56부를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//중등부
			if ($_SESSION['ss_rtdept1code'] == "D10007"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//고등부
			if ($_SESSION['ss_rtdept1code'] == "D10008"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//대학1부
			if ($_SESSION['ss_rtdept1code'] == "D10009"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//대학2부
			if ($_SESSION['ss_rtdept1code'] == "D10010"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//대학3부
			if ($_SESSION['ss_rtdept1code'] == "D10011"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
			//사랑부
			if ($_SESSION['ss_rtdept1code'] == "D10012"){
				if ($_SESSION['ss_rtdept1code'] != $rtdept1Code){
					echo "<script>alert('다른 부서를 열람할 권한이 없습니다.');self.close();</script>";
					exit;
				}
			}
		}
	}
?>