<?php

	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$board_idx		= trim($_REQUEST['board_idx']);
	$boardCode		= trim($_REQUEST['boardCode']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$title			= mysqli_real_escape_string($conn, trim($_REQUEST['title']));
	$content		= mysqli_real_escape_string($conn, trim($_REQUEST['content']));
	$alwaysTopYN	= mysqli_real_escape_string($conn, trim($_REQUEST['alwaysTopYN']));
	if ($alwaysTopYN == ""){
		$alwaysTopYN = "N";
	}
	$sql_board = "update board set title = '".$title."', content = '".$content."', alwaysTopYN = '".$alwaysTopYN."' where board_idx = '".$board_idx."'";
	$result_board = mysqli_query($conn, $sql_board);
	
	//파일업로드
	$uploads_dir = '../upload/';
	$allowed_ext = array('zip', 'txt', 'hwp', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'jpg', 'jpeg', 'bmp', 'png', 'gif');

	for($i = 0; $i < count($_FILES['myfile']['name']); $i++){
		$error	= $_FILES['myfile']['error'][$i];
		$name	= $_FILES['myfile']['name'][$i];
		$ext	= array_pop(explode('.', $name));
		if ($name){
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
				echo "허용되지 않는 확장자입니다.";
				exit;
			}
			// 파일 이동
			move_uploaded_file( $_FILES['myfile']['tmp_name'][$i], $uploads_dir."/".$name);
			$sql_board_filename = "insert into board_filename (board_idx, filename)values('".$board_idx."','".$name."')";
//			echo $sql_board_filename. "<br>";
			$result_board_filename = mysqli_query($conn, $sql_board_filename);
		}
	}
	mysqli_close($conn);
	echo "<script>location.replace('content.php?page=$page&board_idx=$board_idx&boardCode=$boardCode&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
?>