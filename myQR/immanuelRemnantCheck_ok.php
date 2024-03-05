<?php
	include "../include/connect.php";

	$korname				= mysqli_real_escape_string($conn, trim($_REQUEST['korname']));
	$birthyear				= mysqli_real_escape_string($conn, trim($_REQUEST['birthyear']));
	$birthmonth				= mysqli_real_escape_string($conn, trim($_REQUEST['birthmonth']));
	$birthday				= mysqli_real_escape_string($conn, trim($_REQUEST['birthday']));
	$birthday				= $birthyear.$birthmonth.$birthday;

	# 교인들은 대부분 자기이름 뒤에 붙는 알파벳을 모른다.
	$sql = "select idx from churchremnantsystem where korname like '".$korname."%' and replace(birthday, '-','') = '".$birthday."'";
	# echo $sql;
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	if ($count == 0){
			mysqli_close($conn);
			echo "<script language='javascript'>alert('교적정보와 일치하는 데이터가 없습니다. 입력하신 데이터를 확인해 주시고 계속 진행이 안되시면 하영현 집사에게 문의하기기 바랍니다.(Tel.010-3696-9157)');history.back();</script>";
	}else{
		mysqli_close($conn);
		echo "<script>location.replace('myQR.php?korname=$korname&birthday=$birthday');</script>";
	}

?>