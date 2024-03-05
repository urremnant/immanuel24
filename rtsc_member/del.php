<?php
	include "../include/connect.php";

	$page			= trim($_REQUEST['page']);
	$memberID		= trim($_REQUEST['memberID']);
	$churchareaCode = trim($_REQUEST['churchareaCode']);
	$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

//	echo $memberID."<br>";
//	echo substr($memberID, 0, 1);

	// 교사, 교역자를 삭제할 경우 반드시 해당 교사ID와 교역자ID를 참조하고 있는 렘넌트가 있는지를 확인하고 삭제해야 한다.
	switch (substr($memberID, 0, 1)) {
		//교사인 경우
		case "T" :
			$sql_timeline = "select count(memberID) as CNT from member_timeline where memberID = '".$memberID."'";
			$result_timeline = mysqli_query($conn, $sql_timeline);
			$row_timeline = mysqli_fetch_assoc($result_timeline);
			if ($row_timeline['CNT'] != "0"){
				echo "<script>alert('언약의 여정 데이터가 남아있어 삭제할 수 없습니다. 언약의 여정을 먼저 삭제한 후 다시 시도해주세요.');history.back();</script>";
			}else{
				$sql = "select count(memberID) as CNT from member where concat(pastorID, '-', teacher1ID, '-', teacher2ID) like '%".$memberID."%'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);

				if ($row['CNT'] == "0"){

					// 출결기록을 지운다.
					$sql_deleteAttendCheck = "delete from attendworshipcheck where memberID = '".$memberID."'";
					$result_deleteAttendCheck = mysqli_query($conn, $sql_deleteAttendCheck);

					//기존에 첨부한 사진파일이 있는지 확인하고 있다면 먼저 삭제한다.
					$sql_file = "SELECT photofilename FROM member where memberID = '" .$memberID . "'";
					$result_file = mysqli_query($conn, $sql_file);
					$row_file = mysqli_fetch_assoc($result_file);
					if ($row_file['photofilename'] != ''){
						unlink("../upload/".$row_file['photofilename']);
					}

					# member 테이블의 부서정보 분리를 위해 선행작업으로 기존 member 테이블의 회원정보 insert, update, delete 시 memberDeptInfo 테이블도 동시에 insert, update, delete 시켜준다.(2022-08-26 추가)
					$sql_deleteMemberDeptInfo = "delete from memberDeptInfo where memberID = '".$memberID."'";
					$result_deleteMemberDeptInfo = mysqli_query($conn, $sql_deleteMemberDeptInfo);

					$sql_deleteMember = "delete from member where memberID = '".$memberID."'";
					$result_deleteMember = mysqli_query($conn, $sql_deleteMember);

					mysqli_close($conn);

					echo "<script>alert('삭제되었습니다.');</script>";
					echo "<script>location.replace('list.php?page=$page&churchareaCode=$churchareaCode&rtdept1Code=$rtdept1Code&rtdept2Code=$rtdept2Code&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
				}else{
					mysqli_close($conn);
					echo "<script>alert('해당 교사를 참조하고 있는 데이터가 있어서 삭제가 불가능합니다.');history.back();</script>";
				}
			}
			break;
		//교역자인 경우
		case "P" :
			$sql_timeline = "select count(memberID) as CNT from member_timeline where memberID = '".$memberID."'";
			$result_timeline = mysqli_query($conn, $sql_timeline);
			$row_timeline = mysqli_fetch_assoc($result_timeline);
			if ($row_timeline['CNT'] != "0"){
				echo "<script>alert('언약의 여정 데이터가 남아있어 삭제할 수 없습니다. 언약의 여정을 먼저 삭제한 후 다시 시도해주세요.');history.back();</script>";
			}else{
				$sql = "select count(memberID) as CNT from member where concat(pastorID, '-', teacher1ID, '-', teacher2ID) like '%".$memberID."%'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);

				if ($row['CNT'] == "0"){

					// 출결기록을 지운다.
					$sql_deleteAttendCheck = "delete from attendworshipcheck where memberID = '".$memberID."'";
					$result_deleteAttendCheck = mysqli_query($conn, $sql_deleteAttendCheck);

					//기존에 첨부한 사진파일이 있는지 확인하고 있다면 먼저 삭제한다.
					$sql_file = "SELECT photofilename FROM member where memberID = '" .$memberID . "'";
					$result_file = mysqli_query($conn, $sql_file);
					$row_file = mysqli_fetch_assoc($result_file);
					if ($row_file['photofilename'] != ''){
						unlink("../upload/".$row_file['photofilename']);
					}

					# member 테이블의 부서정보 분리를 위해 선행작업으로 기존 member 테이블의 회원정보 insert, update, delete 시 memberDeptInfo 테이블도 동시에 insert, update, delete 시켜준다.(2022-08-26 추가)
					$sql_deleteMemberDeptInfo = "delete from memberDeptInfo where memberID = '".$memberID."'";
					$result_deleteMemberDeptInfo = mysqli_query($conn, $sql_deleteMemberDeptInfo);

					$sql_deleteMember = "delete from member where memberID = '".$memberID."'";
					$result_deleteMember = mysqli_query($conn, $sql_deleteMember);
					
					mysqli_close($conn);

					echo "<script>alert('삭제되었습니다.');</script>";
					echo "<script>location.replace('list.php?page=$page&churchareaCode=$churchareaCode&rtdept1Code=$rtdept1Code&rtdept2Code=$rtdept2Code&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
				}else{
					mysqli_close($conn);
					echo "<script>alert('해당 교역자를 참조하고 있는 데이터가 있어서 삭제가 불가능합니다.');history.back();</script>";
				}
			}
			break;

		default:
			//언약의 여정에 기록이 있는지 확인한다.
			$sql_timeline = "select count(memberID) as CNT from member_timeline where memberID = '".$memberID."'";
			$result_timeline = mysqli_query($conn, $sql_timeline);
			$row_timeline = mysqli_fetch_assoc($result_timeline);
			if ($row_timeline['CNT'] != "0"){
				echo "<script>alert('언약의 여정 데이터가 남아있어 삭제할 수 없습니다. 언약의 여정을 먼저 삭제한 후 다시 시도해주세요.');history.back();</script>";
			}else{

				// 출결기록을 지운다.
				$sql_deleteAttendCheck = "delete from attendworshipcheck where memberID = '".$memberID."'";
				$result_deleteAttendCheck = mysqli_query($conn, $sql_deleteAttendCheck);

				//기존에 첨부한 사진파일이 있는지 확인하고 있다면 먼저 삭제한다.
				$sql_file = "SELECT photofilename FROM member where memberID = '" .$memberID . "'";
				$result_file = mysqli_query($conn, $sql_file);
				$row_file = mysqli_fetch_assoc($result_file);
				if ($row_file['photofilename'] != ''){
					unlink("../upload/".$row_file['photofilename']);
				}

				$sql_deleteMember_history = "delete from member_history where memberID = '".$memberID."'";
				$result_deleteMember_history = mysqli_query($conn, $sql_deleteMember_history);

				# member 테이블의 부서정보 분리를 위해 선행작업으로 기존 member 테이블의 회원정보 insert, update, delete 시 memberDeptInfo 테이블도 동시에 insert, update, delete 시켜준다.(2022-08-26 추가)
				$sql_deleteMemberDeptInfo = "delete from memberDeptInfo where memberID = '".$memberID."'";
				$result_deleteMemberDeptInfo = mysqli_query($conn, $sql_deleteMemberDeptInfo);

				$sql_deleteMember = "delete from member where memberID = '".$memberID."'";
				$result_deleteMember = mysqli_query($conn, $sql_deleteMember);
		
				mysqli_close($conn);

				echo "<script>alert('삭제되었습니다.');</script>";
				echo "<script>location.replace('list.php?page=$page&churchareaCode=$churchareaCode&rtdept1Code=$rtdept1Code&rtdept2Code=$rtdept2Code&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
			}
	}
?>