<?php

	include "../include/connect.php";

	$boardCode		= mysqli_real_escape_string($conn, trim($_REQUEST['boardCode']));
	$title			= mysqli_real_escape_string($conn, trim($_REQUEST['title']));
	$content		= mysqli_real_escape_string($conn, trim($_REQUEST['content']));
	$alwaysTopYN	= mysqli_real_escape_string($conn, trim($_REQUEST['alwaysTopYN']));
	if ($alwaysTopYN == ""){
		$alwaysTopYN = "N";
	}
	$sql_board_idx = "select ifnull(max(board_idx),0)+1 as board_idx from board";
	$result_board_idx = mysqli_query($conn, $sql_board_idx);
	$row_board_idx = mysqli_fetch_assoc($result_board_idx);
	$board_idx = $row_board_idx['board_idx'];
//	echo "board_idx : ".$board_idx."<br>";

	$sql_board = "insert into board (board_idx, boardCode, title, content, homepage_admin_idx, visit, alwaysTopYN, inputDate)values('".$board_idx."','".$boardCode."','".$title."','".$content."','".$_SESSION['ss_homepage_admin_idx']."','0','".$alwaysTopYN."',now())";
//	echo "sql_board : ".$sql_board."<br>";
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
	echo '<script>location.replace("list.php?boardCode='.$boardCode.'");</script>';
?>