<?php
	include "../include/connect.php";
	
	$memberGubun		= mysqli_real_escape_string($conn, trim($_REQUEST['memberGubun']));
	$teacherGubun		= mysqli_real_escape_string($conn, trim($_REQUEST['teacherGubun']));
	$pkYN				= mysqli_real_escape_string($conn, trim($_REQUEST['pkYN']));
	$mkYN				= mysqli_real_escape_string($conn, trim($_REQUEST['mkYN']));
	$tckYN				= mysqli_real_escape_string($conn, trim($_REQUEST['tckYN']));
	$churchareaCode		= mysqli_real_escape_string($conn, trim($_REQUEST['churchareaCode']));
	if ($churchareaCode == "") { $churchareaCode = "A99999";}
	$rtdept1Code		= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept1Code']));
	$rtdept2Code		= mysqli_real_escape_string($conn, trim($_REQUEST['rtdept2Code']));
	$myNo				= mysqli_real_escape_string($conn, trim($_REQUEST['myNo']));
	$korname			= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$engname			= mysqli_real_escape_string($conn, trim($_REQUEST['engname']));
	$churchPositionCode	= mysqli_real_escape_string($conn, trim($_REQUEST['churchPositionCode']));
	$gender				= mysqli_real_escape_string($conn, trim($_REQUEST['gender']));
	$photofilename		= mysqli_real_escape_string($conn, trim($_REQUEST['photofilename']));
	$birthyear			= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
	$birthmonth			= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
	$birthday			= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
	$birthday			= $birthyear.$birthmonth.$birthday;
	$mobile				= mysqli_real_escape_string($conn, trim($_REQUEST['mobile']));
	$email_id			= mysqli_real_escape_string($conn, trim($_REQUEST['email_id']));
	$email_domain		= mysqli_real_escape_string($conn, trim($_REQUEST['email_domain']));
	$email				= $email_id."@".$email_domain;
	if (trim($email) == "@") { $email = "";}
	$zipcode			= mysqli_real_escape_string($conn, trim($_REQUEST['zipcode']));
	$address			= mysqli_real_escape_string($conn, trim($_REQUEST['address']));
	$job				= mysqli_real_escape_string($conn, trim($_REQUEST['job']));
	$company			= mysqli_real_escape_string($conn, trim($_REQUEST['company']));
	$countryCode		= mysqli_real_escape_string($conn, trim($_REQUEST['countryCode']));
	if ($countryCode == "") { $countryCode = "KR";}
	$language			= mysqli_real_escape_string($conn, trim($_REQUEST['language']));
	$vision				= mysqli_real_escape_string($conn, trim($_REQUEST['vision']));
	$expertMeetingCode	= mysqli_real_escape_string($conn, trim($_REQUEST['expertMeetingCode']));
	if ($expertMeetingCode == "") { $expertMeetingCode = "EP9999";}
	$train1				= mysqli_real_escape_string($conn, trim($_REQUEST['train1']));
	$train2				= mysqli_real_escape_string($conn, trim($_REQUEST['train2']));
	$train3				= mysqli_real_escape_string($conn, trim($_REQUEST['train3']));
	$train4				= mysqli_real_escape_string($conn, trim($_REQUEST['train4']));
	$train5				= mysqli_real_escape_string($conn, trim($_REQUEST['train5']));
	$train6				= mysqli_real_escape_string($conn, trim($_REQUEST['train6']));
	$train7				= mysqli_real_escape_string($conn, trim($_REQUEST['train7']));
	$train8				= mysqli_real_escape_string($conn, trim($_REQUEST['train8']));
	$train9				= mysqli_real_escape_string($conn, trim($_REQUEST['train9']));
	$train10			= mysqli_real_escape_string($conn, trim($_REQUEST['train10']));
	$train11			= mysqli_real_escape_string($conn, trim($_REQUEST['train11']));
	$train12			= mysqli_real_escape_string($conn, trim($_REQUEST['train12']));
	$train13			= mysqli_real_escape_string($conn, trim($_REQUEST['train13']));
	$train14			= mysqli_real_escape_string($conn, trim($_REQUEST['train14']));
	$train15			= mysqli_real_escape_string($conn, trim($_REQUEST['train15']));
	$train16			= mysqli_real_escape_string($conn, trim($_REQUEST['train16']));
	$train17			= mysqli_real_escape_string($conn, trim($_REQUEST['train17']));
	$train18			= mysqli_real_escape_string($conn, trim($_REQUEST['train18']));
	$train19			= mysqli_real_escape_string($conn, trim($_REQUEST['train19']));
	$prayertopic		= mysqli_real_escape_string($conn, trim($_REQUEST['prayertopic']));
	$pastorID			= mysqli_real_escape_string($conn, trim($_REQUEST['pastorID']));
	$teacher1ID			= mysqli_real_escape_string($conn, trim($_REQUEST['teacher1ID']));
	$teacher2ID			= mysqli_real_escape_string($conn, trim($_REQUEST['teacher2ID']));

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

//	$memberGubun - R : 렘넌트, T : 임원/교사, P : 교역자
	$sql_member = "select concat('".$memberGubun."', right(concat('00000', Max(right(memberID,5))+1),5)) AS memberID from member where memberID like '".$memberGubun."%'";
	$result_member = mysqli_query($conn, $sql_member);
	$row_member = mysqli_fetch_assoc($result_member);
	$memberID = $row_member['memberID'];

	$sql = "INSERT INTO member (memberID,teacherGubun,churchareaCode,rtdept1Code,rtdept2Code,korname,engname,churchPositionCode,gender,photofilename,birthday,mobile,email,zipcode,address,job,company,countryCode,language,vision,expertMeetingCode,prayertopic,teacher1ID,teacher2ID,pastorID,family1_korname,family1_relation,family1_korChurchPosition,family1_mobile,family1_churchname,family1_job,family2_korname,family2_relation,family2_korChurchPosition,family2_mobile,family2_churchname,family2_job,family3_korname,family3_relation,family3_korChurchPosition,family3_mobile,family3_churchname,family3_job,family4_korname,family4_relation,family4_korChurchPosition,family4_mobile,family4_churchname,family4_job,family5_korname,family5_relation,family5_korChurchPosition,family5_mobile,family5_churchname,family5_job,family6_korname,family6_relation,family6_korChurchPosition,family6_mobile,family6_churchname,family6_job,family7_korname,family7_relation,family7_korChurchPosition,family7_mobile,family7_churchname,family7_job,family8_korname,family8_relation,family8_korChurchPosition,family8_mobile,family8_churchname,family8_job,family9_korname,family9_relation,family9_korChurchPosition,family9_mobile,family9_churchname,family9_job,family10_korname,family10_relation,family10_korChurchPosition,family10_mobile,family10_churchname,family10_job,train1,train2,train3,train4,train5,train6,train7,train8,train9,train10,train11,train12,train13,train14,train15,train16,train17,train18,train19,schoolinfo,afterschool,hobby,cvdip,career,fieldsystem1,fieldsystem2,inputDate,pkYN,mkYN,tckYN,myNo)VALUES('".$memberID."', '".$teacherGubun."', '".$churchareaCode."', '".$rtdept1Code."', '".$rtdept2Code."', '".$korname."', '".$engname."', '".$churchPositionCode."', '".$gender."', '".$uploadFileName."', '".$birthday."', '".$mobile."', '".$email."', '".$zipcode."', '".$address."', '".$job."', '".$company."', '".$countryCode."', '".$language."', '".$vision."', '".$expertMeetingCode."', '".$prayertopic."', '".$teacher1ID."', '".$teacher2ID."', '".$pastorID."', '".$family1_korname."', '".$family1_relation."', '".$family1_korChurchPosition."', '".$family1_mobile."', '".$family1_churchname."', '".$family1_job."', '".$family2_korname."', '".$family2_relation."', '".$family2_korChurchPosition."', '".$family2_mobile."', '".$family2_churchname."', '".$family2_job."', '".$family3_korname."', '".$family3_relation."', '".$family3_korChurchPosition."', '".$family3_mobile."', '".$family3_churchname."', '".$family3_job."', '".$family4_korname."', '".$family4_relation."', '".$family4_korChurchPosition."', '".$family4_mobile."', '".$family4_churchname."', '".$family4_job."', '".$family5_korname."', '".$family5_relation."', '".$family5_korChurchPosition."', '".$family5_mobile."', '".$family5_churchname."', '".$family5_job."', '".$family6_korname."', '".$family6_relation."', '".$family6_korChurchPosition."', '".$family6_mobile."', '".$family6_churchname."', '".$family6_job."', '".$family7_korname."', '".$family7_relation."', '".$family7_korChurchPosition."', '".$family7_mobile."', '".$family7_churchname."', '".$family7_job."', '".$family8_korname."', '".$family8_relation."', '".$family8_korChurchPosition."', '".$family8_mobile."', '".$family8_churchname."', '".$family8_job."', '".$family9_korname."', '".$family9_relation."', '".$family9_korChurchPosition."', '".$family9_mobile."', '".$family9_churchname."', '".$family9_job."', '".$family10_korname."', '".$family10_relation."', '".$family10_korChurchPosition."', '".$family10_mobile."', '".$family10_churchname."', '".$family10_job."', '".$train1."', '".$train2."', '".$train3."', '".$train4."', '".$train5."', '".$train6."', '".$train7."', '".$train8."', '".$train9."', '".$train10."', '".$train11."', '".$train12."', '".$train13."', '".$train14."', '".$train15."', '".$train16."', '".$train17."', '".$train18."', '".$train19."', '".$schoolinfo."', '".$afterschool."', '".$hobby."', '".$cvdip."', '".$career."', '".$fieldsystem1."', '".$fieldsystem2."',now(), '".$pkYN."', '".$mkYN."', '".$tckYN."', '".$myNo."')";
	//echo $sql;
	$result = mysqli_query($conn, $sql);

	# member 테이블의 부서정보 분리를 위해 선행작업으로 기존 member 테이블의 회원정보 insert, update, delete 시 memberDeptInfo 테이블도 동시에 insert, update, delete 시켜준다.(2022-08-26 추가)
	$sql_memberDeptInfo = "insert into memberDeptInfo (memberID, rtdept1Code, rtdept2Code) values ('".$memberID."',  '".$rtdept1Code."', '".$rtdept2Code."')";
	$result = mysqli_query($conn, $sql_memberDeptInfo);


	if (substr($memberID,0,1) == "R"){
		$current_year = date("Y");
		$sql_history = "insert into member_history (year, memberID, teacher1ID, teacher2ID, pastorID) values ('".$current_year."', '".$memberID."', '".$teacher1ID."', '".$teacher2ID."', '".$pastorID."')";
		$result_history = mysqli_query($conn, $sql_history);
	}

	mysqli_close($conn);
	echo "<script>location.replace('list.php?rtdept1Code=$rtdept1Code&rtdept2Code=$rtdept2Code');</script>";
?>