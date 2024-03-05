<?php
	function sendMail($EMAIL, $NAME, $mailto, $SUBJECT, $CONTENT){
		//$EMAIL : 답장받을 메일주소
		//$NAME : 보낸이
		//$mailto : 보낼 메일주소
		//$SUBJECT : 메일 제목
		//$CONTENT : 메일 내용
		$admin_email = $EMAIL;
		$admin_name = $NAME;

		$header = "Return-Path: ".$admin_email."\n";
		$header .= "From: =?EUC-KR?B?".base64_encode($admin_name)."?= <".$admin_email.">\n";
		$header .= "MIME-Version: 1.0\n";
		$header .= "X-Priority: 3\n";
		$header .= "X-MSMail-Priority: Normal\n";
		$header .= "X-Mailer: FormMailer\n";
		$header .= "Content-Transfer-Encoding: base64\n";
		$header .= "Content-Type: text/html;\n \tcharset=euc-kr\n";

		$subject = "=?EUC-KR?B?".base64_encode($SUBJECT)."?=\n";
		$contents = $CONTENT;

		$message = base64_encode($contents);
		flush();
		return mail($mailto, $subject, $message, $header);
	}

	$email_id = trim($_REQUEST['email_id']);
	$company_email = "gospelunity@daum.net";
	$company_name = iconv('UTF-8','EUC-KR', '이송현');
	$mailto = "omc@iomc.kr";
	$subject = iconv('UTF-8','EUC-KR', '게시물 등록 알림');
	$content = iconv('UTF-8','EUC-KR', '전문인 만남 신청에 게시물이 등록되었습니다.');
	# $content = "<br>OURS <font color='red'><b>전문인 만남 신청</b></font>에 게시물이 등록되었습니다.<br><br>";
	# $content .= "<br><br>감사합니다.<br><br>";
	sendMail($company_email, $company_name, $mailto, $subject, $content);
?>
<script language="javascript">
<!--
	location.href="http://ours.cvdip.com/omc_askForHelp/meet.asp";
//-->
</script>