<?php
	include "../include/connect.php";
	
	$page			= trim($_REQUEST['page']);
	$memberID		= trim($_REQUEST['memberID']);
	$churchareaCode	= trim($_REQUEST['churchareaCode']);
	$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
	$deptMoveCode	= trim($_REQUEST['deptMoveCode']);	
	$mode			= trim($_REQUEST['mode']);
	$Search			= trim($_REQUEST['Search']);
	$SearchString	= trim($_REQUEST['SearchString']);

	$memberGubun			= mysqli_real_escape_string($conn, trim($_REQUEST['memberGubun']));
	$teacherGubun			= mysqli_real_escape_string($conn, trim($_REQUEST['teacherGubun']));
	$pkYN					= mysqli_real_escape_string($conn, trim($_REQUEST['pkYN']));
	$mkYN					= mysqli_real_escape_string($conn, trim($_REQUEST['mkYN']));
	$tckYN					= mysqli_real_escape_string($conn, trim($_REQUEST['tckYN']));
	$change_churchareaCode	= mysqli_real_escape_string($conn, trim($_REQUEST['change_churchareaCode']));
	if ($change_churchareaCode == "") { $change_churchareaCode = "A99999";}
	$change_rtdept1Code		= mysqli_real_escape_string($conn, trim($_REQUEST['change_rtdept1Code']));
	$change_rtdept2Code		= mysqli_real_escape_string($conn, trim($_REQUEST['change_rtdept2Code']));
	$myNo					= mysqli_real_escape_string($conn, trim($_REQUEST['myNo']));
	$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$engname				= mysqli_real_escape_string($conn, trim($_REQUEST['engname']));
	$churchPositionCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$gender					= mysqli_real_escape_string($conn, trim($_REQUEST['gender']));
	$photofilename			= mysqli_real_escape_string($conn, trim($_REQUEST['photofilename']));
	$birthyear				= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
	$birthmonth				= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
	$birthday				= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
	$birthday				= $birthyear.$birthmonth.$birthday;
	$mobile					= mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
	$email					= mysqli_real_escape_string($conn, trim($_REQUEST['email']));
	$zipcode				= mysqli_real_escape_string($conn, trim($_REQUEST['zipcode']));
	$address				= mysqli_real_escape_string($conn, trim($_REQUEST['address']));
	$job					= mysqli_real_escape_string($conn, trim($_REQUEST['job']));
	$company				= mysqli_real_escape_string($conn, trim($_REQUEST['company']));
	$countryCode			= mysqli_real_escape_string($conn, trim($_REQUEST['countryCode']));
	if ($countryCode == "") { $countryCode = "KR";}
	$language				= mysqli_real_escape_string($conn, trim($_REQUEST['language']));
	$vision					= mysqli_real_escape_string($conn, trim($_REQUEST['vision']));
	$expertMeetingCode		= mysqli_real_escape_string($conn, trim($_REQUEST['expertMeetingCode']));
	if ($expertMeetingCode == "") { $expertMeetingCode = "EP9999";}
	$train1					= mysqli_real_escape_string($conn, trim($_REQUEST['train1']));
	$train2					= mysqli_real_escape_string($conn, trim($_REQUEST['train2']));
	$train3					= mysqli_real_escape_string($conn, trim($_REQUEST['train3']));
	$train4					= mysqli_real_escape_string($conn, trim($_REQUEST['train4']));
	$train5					= mysqli_real_escape_string($conn, trim($_REQUEST['train5']));
	$train6					= mysqli_real_escape_string($conn, trim($_REQUEST['train6']));
	$train7					= mysqli_real_escape_string($conn, trim($_REQUEST['train7']));
	$train8					= mysqli_real_escape_string($conn, trim($_REQUEST['train8']));
	$train9					= mysqli_real_escape_string($conn, trim($_REQUEST['train9']));
	$train10				= mysqli_real_escape_string($conn, trim($_REQUEST['train10']));
	$train11				= mysqli_real_escape_string($conn, trim($_REQUEST['train11']));
	$train12				= mysqli_real_escape_string($conn, trim($_REQUEST['train12']));
	$train13				= mysqli_real_escape_string($conn, trim($_REQUEST['train13']));
	$train14				= mysqli_real_escape_string($conn, trim($_REQUEST['train14']));
	$train15				= mysqli_real_escape_string($conn, trim($_REQUEST['train15']));
	$train16				= mysqli_real_escape_string($conn, trim($_REQUEST['train16']));
	$train17				= mysqli_real_escape_string($conn, trim($_REQUEST['train17']));
	$train18				= mysqli_real_escape_string($conn, trim($_REQUEST['train18']));
	$train19				= mysqli_real_escape_string($conn, trim($_REQUEST['train19']));
	$prayertopic			= mysqli_real_escape_string($conn, trim($_REQUEST['prayertopic']));
	$pastorID				= mysqli_real_escape_string($conn, trim($_REQUEST['pastorID']));
	$teacher1ID				= mysqli_real_escape_string($conn, trim($_REQUEST['teacher1ID']));
	$teacher2ID				= mysqli_real_escape_string($conn, trim($_REQUEST['teacher2ID']));
	$familyID				= mysqli_real_escape_string($conn, trim($_REQUEST['familyID']));

	$family1_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family1_korname']));
	$family1_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family1_relation']));
	$family1_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family1_korChurchPosition']));
	$family1_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family1_mobile']));
	$family1_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family1_churchname']));
	$family1_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family1_job']));
	
	$family2_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family2_korname']));
	$family2_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family2_relation']));
	$family2_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family2_korChurchPosition']));
	$family2_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family2_mobile']));
	$family2_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family2_churchname']));
	$family2_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family2_job']));

	$family3_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family3_korname']));
	$family3_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family3_relation']));
	$family3_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family3_korChurchPosition']));
	$family3_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family3_mobile']));
	$family3_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family3_churchname']));
	$family3_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family3_job']));

	$family4_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family4_korname']));
	$family4_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family4_relation']));
	$family4_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family4_korChurchPosition']));
	$family4_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family4_mobile']));
	$family4_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family4_churchname']));
	$family4_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family4_job']));

	$family5_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family5_korname']));
	$family5_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family5_relation']));
	$family5_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family5_korChurchPosition']));
	$family5_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family5_mobile']));
	$family5_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family5_churchname']));
	$family5_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family5_job']));

	$family6_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family6_korname']));
	$family6_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family6_relation']));
	$family6_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family6_korChurchPosition']));
	$family6_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family6_mobile']));
	$family6_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family6_churchname']));
	$family6_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family6_job']));

	$family7_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family7_korname']));
	$family7_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family7_relation']));
	$family7_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family7_korChurchPosition']));
	$family7_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family7_mobile']));
	$family7_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family7_churchname']));
	$family7_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family7_job']));

	$family8_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family8_korname']));
	$family8_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family8_relation']));
	$family8_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family8_korChurchPosition']));
	$family8_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family8_mobile']));
	$family8_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family8_churchname']));
	$family8_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family8_job']));

	$family9_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family9_korname']));
	$family9_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family9_relation']));
	$family9_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family9_korChurchPosition']));
	$family9_mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['family9_mobile']));
	$family9_churchname			= mysqli_real_escape_string($conn, trim($_REQUEST['family9_churchname']));
	$family9_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family9_job']));

	$family10_korname			= mysqli_real_escape_string($conn, trim($_REQUEST['family10_korname']));
	$family10_relation			= mysqli_real_escape_string($conn, trim($_REQUEST['family10_relation']));
	$family10_korChurchPosition	= mysqli_real_escape_string($conn, trim($_REQUEST['family10_korChurchPosition']));
	$family10_mobile			= mysqli_real_escape_string($conn, trim($_REQUEST['family10_mobile']));
	$family10_churchname		= mysqli_real_escape_string($conn, trim($_REQUEST['family10_churchname']));
	$family10_job				= mysqli_real_escape_string($conn, trim($_REQUEST['family10_job']));

	$schoolinfo					= mysqli_real_escape_string($conn, trim($_REQUEST['schoolinfo']));
	$afterschool				= mysqli_real_escape_string($conn, trim($_REQUEST['afterschool']));
	$hobby						= mysqli_real_escape_string($conn, trim($_REQUEST['hobby']));
	$cvdip						= mysqli_real_escape_string($conn, trim($_REQUEST['cvdip']));
	$career						= mysqli_real_escape_string($conn, trim($_REQUEST['career']));
	$fieldsystem1				= mysqli_real_escape_string($conn, trim($_REQUEST['fieldsystem1']));
	$fieldsystem2				= mysqli_real_escape_string($conn, trim($_REQUEST['fieldsystem2']));

	//첨부파일이 있을 경우
	if (isset($_FILES['photofilename']['name']) && $_FILES['photofilename']['name'] != "") {

		//기존에 첨부한 사진파일이 있는지 확인하고 있다면 먼저 삭제한다.
		$sql_file = "SELECT photofilename FROM member where memberID = '" .$memberID . "'";
		$result_file = mysqli_query($conn, $sql_file);
		$row_file = mysqli_fetch_assoc($result_file);
		if ($row_file['photofilename'] != ''){
			unlink("../upload/".$row_file['photofilename']);
		}

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

	# $memberGubun이 변경되었을 경우
	# 1. member 테이블에 새로운 memberID를 생성해주고 데이터를 똑같이 넣어준다.
	# 2. 관련테이블의 memberID를 새로운 memberID로 교체해준다. 
	#    - attendworshipcheck -> memberID, 
	#    - member_history -> memberID, teacher1ID, teacher2ID, pastorID
	#    - member_timeline -> memberID
	# 3. member 테이블의 기존 memberID를 삭제해준다.
	if ((substr($memberID, 0, 1) <> $memberGubun)){
	//	$memberGubun - R : 렘넌트, T : 임원/교사, P : 교역자
		$sql_member = "select concat('".$memberGubun."', right(concat('00000', Max(right(memberID,5))+1),5)) AS memberID from member where memberID like '".$memberGubun."%'";
		$result_member = mysqli_query($conn, $sql_member);
		$row_member = mysqli_fetch_assoc($result_member);
		$new_memberID = $row_member['memberID'];
		
		# 사진파일이 첨부되어 넘어왔다면
		if (isset($_FILES['photofilename']['name']) && $_FILES['photofilename']['name'] != "") {
			$new_photofilename = $uploadFileName;
		}else{
			$sql_photo = "select photofilename from member where memberID = '".$memberID."'";
			$result_photo = mysqli_query($conn, $sql_photo);
			$row_photo = mysqli_fetch_assoc($result_photo);
			$new_photofilename = $row_photo['photofilename'];
		}

		$sql = "INSERT INTO member (memberID,teacherGubun,churchareaCode,rtdept1Code,rtdept2Code,korname,engname,churchPositionCode,gender,photofilename,birthday,mobile,email,zipcode,address,job,company,countryCode,language,vision,expertMeetingCode,prayertopic,teacher1ID,teacher2ID,pastorID,family1_korname,family1_relation,family1_korChurchPosition,family1_mobile,family1_churchname,family1_job,family2_korname,family2_relation,family2_korChurchPosition,family2_mobile,family2_churchname,family2_job,family3_korname,family3_relation,family3_korChurchPosition,family3_mobile,family3_churchname,family3_job,family4_korname,family4_relation,family4_korChurchPosition,family4_mobile,family4_churchname,family4_job,family5_korname,family5_relation,family5_korChurchPosition,family5_mobile,family5_churchname,family5_job,family6_korname,family6_relation,family6_korChurchPosition,family6_mobile,family6_churchname,family6_job,family7_korname,family7_relation,family7_korChurchPosition,family7_mobile,family7_churchname,family7_job,family8_korname,family8_relation,family8_korChurchPosition,family8_mobile,family8_churchname,family8_job,family9_korname,family9_relation,family9_korChurchPosition,family9_mobile,family9_churchname,family9_job,family10_korname,family10_relation,family10_korChurchPosition,family10_mobile,family10_churchname,family10_job,train1,train2,train3,train4,train5,train6,train7,train8,train9,train10,train11,train12,train13,train14,train15,train16,train17,train18,train19,schoolinfo,afterschool,hobby,cvdip,career,fieldsystem1,fieldsystem2,inputDate,pkYN,mkYN,tckYN,myNo)VALUES('".$new_memberID."', '".$teacherGubun."', '".$change_churchareaCode."', '".$change_rtdept1Code."', '".$change_rtdept2Code."', '".$korname."', '".$engname."', '".$churchPositionCode."', '".$gender."', '".$new_photofilename."', '".$birthday."', '".$mobile."', '".$email."', '".$zipcode."', '".$address."', '".$job."', '".$company."', '".$countryCode."', '".$language."', '".$vision."', '".$expertMeetingCode."', '".$prayertopic."', '".$teacher1ID."', '".$teacher2ID."', '".$pastorID."', '".$family1_korname."', '".$family1_relation."', '".$family1_korChurchPosition."', '".$family1_mobile."', '".$family1_churchname."', '".$family1_job."', '".$family2_korname."', '".$family2_relation."', '".$family2_korChurchPosition."', '".$family2_mobile."', '".$family2_churchname."', '".$family2_job."', '".$family3_korname."', '".$family3_relation."', '".$family3_korChurchPosition."', '".$family3_mobile."', '".$family3_churchname."', '".$family3_job."', '".$family4_korname."', '".$family4_relation."', '".$family4_korChurchPosition."', '".$family4_mobile."', '".$family4_churchname."', '".$family4_job."', '".$family5_korname."', '".$family5_relation."', '".$family5_korChurchPosition."', '".$family5_mobile."', '".$family5_churchname."', '".$family5_job."', '".$family6_korname."', '".$family6_relation."', '".$family6_korChurchPosition."', '".$family6_mobile."', '".$family6_churchname."', '".$family6_job."', '".$family7_korname."', '".$family7_relation."', '".$family7_korChurchPosition."', '".$family7_mobile."', '".$family7_churchname."', '".$family7_job."', '".$family8_korname."', '".$family8_relation."', '".$family8_korChurchPosition."', '".$family8_mobile."', '".$family8_churchname."', '".$family8_job."', '".$family9_korname."', '".$family9_relation."', '".$family9_korChurchPosition."', '".$family9_mobile."', '".$family9_churchname."', '".$family9_job."', '".$family10_korname."', '".$family10_relation."', '".$family10_korChurchPosition."', '".$family10_mobile."', '".$family10_churchname."', '".$family10_job."', '".$train1."', '".$train2."', '".$train3."', '".$train4."', '".$train5."', '".$train6."', '".$train7."', '".$train8."', '".$train9."', '".$train10."', '".$train11."', '".$train12."', '".$train13."', '".$train14."', '".$train15."', '".$train16."', '".$train17."', '".$train18."', '".$train19."', '".$schoolinfo."', '".$afterschool."', '".$hobby."', '".$cvdip."', '".$career."', '".$fieldsystem1."', '".$fieldsystem2."',now(), '".$pkYN."', '".$mkYN."', '".$tckYN."', '".$myNo."')";
		# echo $sql."<br>";
		$result = mysqli_query($conn, $sql);

		$sql = "update member_history set memberID = '".$new_memberID."' where memberID = '".$memberID."'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "update member_history set teacher1ID = '".$new_memberID."' where teacher1ID = '".$memberID."'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "update member_history set teacher2ID = '".$new_memberID."' where teacher2ID = '".$memberID."'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "update member_history set pastorID = '".$new_memberID."' where pastorID = '".$memberID."'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "update member_timeline set memberID = '".$new_memberID."' where memberID = '".$memberID."'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "update attendworshipcheck set memberID = '".$new_memberID."' where memberID = '".$memberID."'";
		$result = mysqli_query($conn, $sql);
		
		# member 테이블의 부서정보 분리를 위해 선행작업으로 기존 member 테이블의 회원정보 insert, update, delete 시 memberDeptInfo 테이블도 동시에 insert, update, delete 시켜준다.(2022-08-26 추가)
		$sql = "update memberDeptInfo set memberID = '".$new_memberID."', rtdept1Code = '".$change_rtdept1Code."', rtdept2Code = '".$change_rtdept2Code."' where memberID = '".$memberID."'";

		$result = mysqli_query($conn, $sql);

		$sql = "delete from member where memberID = '".$memberID."'";
		$result = mysqli_query($conn, $sql);
		
		if ($memberGubun == "R"){
			//해당년도의 담당교사/담당교역자 History가 있는지 체크를 한다.
			$current_year = date("Y");
			$sql_history_check = "select count(memberID) as CNT from member_history where memberID = '".$new_memberID."' and year = '".$current_year."'";
			$result_history_check = mysqli_query($conn, $sql_history_check);
			$row_history_check = mysqli_fetch_assoc($result_history_check);
			//해당년도의 담당교사/담당교역자 History가 있으면 Update, 없으면 Insert
			if ($row_history_check['CNT'] != "0"){
				$sql_history = "update member_history set teacher1ID = '".$teacher1ID."', teacher2ID = '".$teacher2ID."', pastorID = '".$pastorID."' where memberID = '".$new_memberID."' and year='".$current_year."'";
			}else{
				$sql_history = "insert into member_history (year, memberID, teacher1ID, teacher2ID, pastorID) values ('".$current_year."', '".$new_memberID."', '".$teacher1ID."', '".$teacher2ID."', '".$pastorID."')";
			}
			$result_history = mysqli_query($conn, $sql_history);
		}
		mysqli_close($conn);
		echo "<script>location.replace('content.php?memberID=$new_memberID&page=$page&churchareaCode=$churchareaCode&rtdept1Code=$rtdept1Code&rtdept2Code=$rtdept2Code&deptMoveCode=$deptMoveCode&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
	}else{
		$sql = "update member set teacherGubun = '".$teacherGubun."', churchareaCode = '".$change_churchareaCode."', rtdept1Code = '".$change_rtdept1Code."', rtdept2Code = '".$change_rtdept2Code."', korname = '".$korname."', engname = '".$engname."', churchPositionCode = '".$churchPositionCode."', gender = '".$gender."', ";

		if (isset($_FILES['photofilename']['name']) && $_FILES['photofilename']['name'] != "") {
			$sql = $sql."photofilename = '".$uploadFileName."', ";
		}

		$sql = $sql."birthday = '".$birthday."', mobile = '".$mobile."', email = '".$email."', zipcode = '".$zipcode."', address = '".$address."', job = '".$job."', company = '".$company."', countryCode = '".$countryCode."', language = '".$language."', vision = '".$vision."', expertMeetingCode = '".$expertMeetingCode."', prayertopic = '".$prayertopic."', teacher1ID = '".$teacher1ID."', teacher2ID = '".$teacher2ID."', pastorID = '".$pastorID."', familyID = '".$familyID."', family1_korname = '".$family1_korname."', family1_relation = '".$family1_relation."', family1_korChurchPosition = '".$family1_korChurchPosition."', family1_mobile = '".$family1_mobile."', family1_churchname = '".$family1_churchname."', family1_job = '".$family1_job."', family2_korname = '".$family2_korname."', family2_relation = '".$family2_relation."', family2_korChurchPosition = '".$family2_korChurchPosition."', family2_mobile = '".$family2_mobile."', family2_churchname = '".$family2_churchname."', family2_job = '".$family2_job."', family3_korname = '".$family3_korname."', family3_relation = '".$family3_relation."', family3_korChurchPosition = '".$family3_korChurchPosition."', family3_mobile = '".$family3_mobile."', family3_churchname = '".$family3_churchname."', family3_job = '".$family3_job."', family4_korname = '".$family4_korname."', family4_relation = '".$family4_relation."', family4_korChurchPosition = '".$family4_korChurchPosition."', family4_mobile = '".$family4_mobile."', family4_churchname = '".$family4_churchname."', family4_job = '".$family4_job."', family5_korname = '".$family5_korname."', family5_relation = '".$family5_relation."', family5_korChurchPosition = '".$family5_korChurchPosition."', family5_mobile = '".$family5_mobile."', family5_churchname = '".$family5_churchname."', family5_job = '".$family5_job."', family6_korname = '".$family6_korname."', family6_relation = '".$family6_relation."', family6_korChurchPosition = '".$family6_korChurchPosition."', family6_mobile = '".$family6_mobile."', family6_churchname = '".$family6_churchname."', family6_job = '".$family6_job."', family7_korname = '".$family7_korname."', family7_relation = '".$family7_relation."', family7_korChurchPosition = '".$family7_korChurchPosition."', family7_mobile = '".$family7_mobile."', family7_churchname = '".$family7_churchname."', family7_job = '".$family7_job."', family8_korname = '".$family8_korname."', family8_relation = '".$family8_relation."', family8_korChurchPosition = '".$family8_korChurchPosition."', family8_mobile = '".$family8_mobile."', family8_churchname = '".$family8_churchname."', family8_job = '".$family8_job."', family9_korname = '".$family9_korname."', family9_relation = '".$family9_relation."', family9_korChurchPosition = '".$family9_korChurchPosition."', family9_mobile = '".$family9_mobile."', family9_churchname = '".$family9_churchname."', family9_job = '".$family9_job."', family10_korname = '".$family10_korname."', family10_relation = '".$family10_relation."', family10_korChurchPosition = '".$family10_korChurchPosition."', family10_mobile = '".$family10_mobile."', family10_churchname = '".$family10_churchname."', family10_job = '".$family10_job."', train1 = '".$train1."', train2 = '".$train2."', train3 = '".$train3."', train4 = '".$train4."', train5 = '".$train5."', train6 = '".$train6."', train7 = '".$train7."', train8 = '".$train8."', train9 = '".$train9."', train10 = '".$train10."', train11 = '".$train11."', train12 = '".$train12."', train13 = '".$train13."', train14 = '".$train14."', train15 = '".$train15."', train16 = '".$train16."', train17 = '".$train17."', train18 = '".$train18."', train19 = '".$train19."', schoolinfo = '".$schoolinfo."', afterschool = '".$afterschool."', hobby = '".$hobby."', cvdip = '".$cvdip."', career = '".$career."', fieldsystem1 = '".$fieldsystem1."', fieldsystem2 = '".$fieldsystem2."', editDate = now(), pkYN = '".$pkYN."', mkYN = '".$mkYN."', tckYN = '".$tckYN."', myNo = '".$myNo."' where memberID = '".$memberID."'";
	//	echo $sql;
		$result = mysqli_query($conn, $sql);

		# member 테이블의 부서정보 분리를 위해 선행작업으로 기존 member 테이블의 회원정보 insert, update, delete 시 memberDeptInfo 테이블도 동시에 insert, update, delete 시켜준다.(2022-08-26 추가)
		$sql = "update memberDeptInfo set rtdept1Code = '".$change_rtdept1Code."', rtdept2Code = '".$change_rtdept2Code."' where memberID = '".$memberID."'";

		if ($memberGubun == "R"){
			//해당년도의 담당교사/담당교역자 History가 있는지 체크를 한다.
			$current_year = date("Y");
			$sql_history_check = "select count(memberID) as CNT from member_history where memberID = '".$memberID."' and year = '".$current_year."'";
			$result_history_check = mysqli_query($conn, $sql_history_check);
			$row_history_check = mysqli_fetch_assoc($result_history_check);
			//해당년도의 담당교사/담당교역자 History가 있으면 Update, 없으면 Insert
			if ($row_history_check['CNT'] != "0"){
				$sql_history = "update member_history set teacher1ID = '".$teacher1ID."', teacher2ID = '".$teacher2ID."', pastorID = '".$pastorID."' where memberID = '".$memberID."' and year='".$current_year."'";
			}else{
				$sql_history = "insert into member_history (year, memberID, teacher1ID, teacher2ID, pastorID) values ('".$current_year."', '".$memberID."', '".$teacher1ID."', '".$teacher2ID."', '".$pastorID."')";
			}
			$result_history = mysqli_query($conn, $sql_history);
		}
		mysqli_close($conn);
		echo "<script>location.replace('content.php?memberID=$memberID&page=$page&churchareaCode=$churchareaCode&rtdept1Code=$rtdept1Code&rtdept2Code=$rtdept2Code&deptMoveCode=$deptMoveCode&mode=$mode&Search=$Search&SearchString=$SearchString');</script>";
	}


?>