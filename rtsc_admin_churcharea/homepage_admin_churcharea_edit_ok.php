<?php

	include "../include/connect.php";

	$page					= trim($_REQUEST['page']);
	$idx					= trim($_REQUEST['idx']);
	$mode					= trim($_REQUEST['mode']);
	$Search					= trim($_REQUEST['Search']);
	$SearchString			= trim($_REQUEST['SearchString']);

	$korname			= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$churchPositionCode	= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$admin_pass			= mysqli_real_escape_string($conn, trim($_REQUEST['admin_pass']));	
	$korChurchAreaName	= mysqli_real_escape_string($conn, trim($_REQUEST['korChurchAreaName']));
	$korParishName	= mysqli_real_escape_string($conn, trim($_REQUEST['korParishName']));
	$mobile = mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
	$useYN = mysqli_real_escape_string($conn, trim($_REQUEST['useYN']));
	$dataAccessType			= mysqli_real_escape_string($conn, trim($_REQUEST['dataAccessType']));
	$timelineAccessType		= mysqli_real_escape_string($conn, trim($_REQUEST['timelineAccessType']));

	//첨부파일이 있을 경우
	if (isset($_FILES['photofilename']['name']) && $_FILES['photofilename']['name'] != "") {
		//기존에 첨부한 파일이 있는지 확인하고 있다면 먼저 삭제한다.
		$sql = "SELECT photofilename FROM homepage_admin_churcharea where idx = '".$idx."' ";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		if ($row['photofilename'] != ''){
			# echo "첨부파일이 있습니다.<br>";
			# echo $row['photofilename'];
			unlink("../upload/".$row['photofilename']);
			$sql = "update homepage_admin_churcharea set photofilename = '' where idx = '".$idx."'";
			$result = mysqli_query($conn, $sql);
		}

		//파일 업로드
		// 설정
		$uploads_dir = '../upload/';
		$allowed_ext = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
		//$time = time();

		// 변수 정리
		$error	= $_FILES['photofilename']['error'];
		$photofilename	= $_FILES['photofilename']['name'];
		$ext	= array_pop(explode('.', $photofilename));
		
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

		$sql = "update homepage_admin_churcharea set korname = '".$korname."', churchPositionCode = '".$churchPositionCode."', admin_pass = '".$admin_pass."', korChurchAreaName = '".$korChurchAreaName."', korParishName = '".$korParishName."', mobile = '".$mobile."', admin_pass = '".$admin_pass."', useYN = '".$useYN."', photofilename = '".$uploadFileName."', dataAccessType = '".$dataAccessType."', timelineAccessType = '".$timelineAccessType."' where idx = '".$idx."'";
		$result = mysqli_query($conn, $sql);
	}else{
		$sql = "update homepage_admin_churcharea set korname = '".$korname."', churchPositionCode = '".$churchPositionCode."', admin_pass = '".$admin_pass."', korChurchAreaName = '".$korChurchAreaName."', korParishName = '".$korParishName."', mobile = '".$mobile."', admin_pass = '".$admin_pass."', useYN = '".$useYN."', dataAccessType = '".$dataAccessType."', timelineAccessType = '".$timelineAccessType."' where idx = '".$idx."'";
		$result = mysqli_query($conn, $sql);
	}
	mysqli_close($conn);
	//echo $sql;

	echo '<script>location.replace("homepage_admin_churcharea_list.php?page='.$page.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'");</script>';
?>