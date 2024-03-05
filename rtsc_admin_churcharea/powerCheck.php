<?php
	
	$korChurchAreaName	= trim($_REQUEST['korChurchAreaName']);
	$korParishName		= trim($_REQUEST['korParishName']);

	# echo "korChurchAreaName : ".$korChurchAreaName."<br>";
	# echo "korParishName : ".$korParishName."<br>";
	# echo "세션 권역 : ".$_SESSION['ss_korChurchAreaName']."<br>";
	# echo "세션 교구 : ".$_SESSION['ss_korParishName']."<br>";

	if ($_SESSION['ss_korChurchAreaName'] != "전체"){

		if ($korChurchAreaName != $_SESSION['ss_korChurchAreaName']){
			echo "<script>alert('해당 권역을 열람할 권한이 없습니다.');location.replace('main.php');</script>";
			exit;
		}else{
			if ($_SESSION['ss_korParishName'] != ""){
				if ($korParishName != $_SESSION['ss_korParishName']){
					echo "<script>alert('해당 교구를 열람할 권한이 없습니다.');location.replace('main.php');</script>";
					exit;
				}
			}
		}
	}

?>