<?php

	include "../include/connect.php";

	$rtdept1Code			= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept1Code']));
	$rtdept2Code			= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept2Code']));
	$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$churchPositionCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$mobile					= mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
	$useYN					= mysqli_real_escape_string($conn, trim($_REQUEST['useYN']));
	$dataAccessType			= mysqli_real_escape_string($conn, trim($_REQUEST['dataAccessType']));
	$timelineAccessType		= mysqli_real_escape_string($conn, trim($_REQUEST['timelineAccessType']));
	$deptMoveYN				= mysqli_real_escape_string($conn, trim($_REQUEST['deptMoveYN']));
	$from_rtdept1Code		= mysqli_real_escape_string($conn, trim($_REQUEST['from_rtdept1Code']));
	
	//첨부파일이 있을 경우
	if (isset($_FILES['photofilename']['name']) && $_FILES['photofilename']['name'] != "") {
		//파일 업로드
		// 설정
		$uploads_dir = '../upload/';
		$allowed_ext = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
		
		// 변수 정리
		$error			= $_FILES['photofilename']['error'];
		$photofilename	= $_FILES['photofilename']['name'];
		$ext			= array_pop(explode('.', $photofilename));
		
		// 오류 확인
		if( $error != UPLOAD_ERR_OK ) {
			switch( $error ) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					echo "파일이 너무 큽니다. ($error)";
					break;
				case UPLOAD_ERR_NO_FILE:
					echo "파일이 첨부되지 않았습니다. ($error)";
					break;
				default:
					echo "파일이 제대로 업로드되지 않았습니다. ($error)";
			}
			exit;
		}
		// 확장자 확인
		if( !in_array($ext, $allowed_ext) ) {
			echo "<script>alert('허용되지 않는 확장자입니다.');history.back();</script>";
			exit;
		}

		if ($photofilename){
			//$rePhotofilename = str_replace(",", "", $photofilename);
			//$rePhotofilename = str_replace(" ", "", $rePhotofilename);
			//$rePhotofilename = str_replace("－","-", $rePhotofilename);
			//$uploadFileName = $time.'_'.$rePhotofilename;
			$uploadFileName = date("YmdHis").".".$ext;
			move_uploaded_file( $_FILES['photofilename']['tmp_name'], $uploads_dir."/".$uploadFileName);
		}
	}

	$sql = "insert into homepage_admin (rtdept1Code, rtdept2Code, korname, churchPositionCode, mobile, useYN, photofilename, dataAccessType, timelineAccessType, deptMoveYN, from_rtdept1Code)values('".$rtdept1Code."','".$rtdept2Code."','".$korname."','".$churchPositionCode."','".$mobile."','".$useYN."','".$uploadFileName."','".$dataAccessType."','".$timelineAccessType."','".$deptMoveYN."','".$from_rtdept1Code."')";
	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);
	echo "<script>location.replace('list.php');</script>";
?>