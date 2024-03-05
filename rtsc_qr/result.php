<?php
	$mysql_host = "rtsummit.cqebf6co3wjz.ap-northeast-2.rds.amazonaws.com:3306";
	$mysql_user = "rtsummit";
	$mysql_password = "neoframemedia!@";
	$mysql_db = "rtsummit";
	$conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	if ($conn->connect_error) {
		die("연결실패 : " .  $conn->connect_error());
	}

	$myNo			= mysqli_real_escape_string($conn, trim($_REQUEST['myNo']));
	$worshipDate	= mysqli_real_escape_string($conn, trim($_REQUEST['worshipDate']));
	$worshipPlace	= mysqli_real_escape_string($conn, trim($_REQUEST['worshipPlace']));

  	if ($myNo == "") {
?>
		<script language = "javascript">
		<!--
			alert("교인번호가 입력되지 않았습니다.");
			location.href="index.php?worshipDate=<?php echo $worshipDate?>&worshipPlace=<?php echo $worshipPlace;?>";
		-->
		</script>	
<?php
	}
  	if ($worshipPlace == "") {
?>
		<script language = "javascript">
		<!--
			alert("장소가 선택되지 않았습니다.");
			location.href="index.php?worshipDate=<?php echo $worshipDate?>&worshipPlace=<?php echo $worshipPlace;?>";
		-->
		</script>	
<?php
	}

	# echo $lastResult."<br>";
	# echo $worshipDate."<br>";
	# echo $worshipPlace."<br>";
	
	$sql_check = "select count(idx) as cnt from apply_worship where worshipDate = '".$worshipDate."' and myNo= '".$myNo."'";
	$result_check = mysqli_query($conn, $sql_check);
	$row_check = mysqli_fetch_assoc($result_check);

  	if ($row_check['cnt'] == 0) {
?>
		<script language = "javascript">
		<!--
			alert("예배 신청자 리스트에 없습니다.");
			location.href="index.php?worshipDate=<?php echo $worshipDate?>&worshipPlace=<?php echo $worshipPlace;?>";
		-->
		</script>
<?php
	}else{
		$sql = "insert into churchcheckin (worshipDate, myNo, worshipPlace, checkinDate) values ('".$worshipDate."','".$myNo."','".$worshipPlace."', now())";
		$result = mysqli_query($conn, $sql);
	}
	mysqli_close($conn);
	echo "<script>location.replace('index.php?worshipDate=$worshipDate&worshipPlace=$worshipPlace&myNo=$myNo');</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>임마누엘교회</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<iframe src="silence.mp3" allow="autoplay" id="audio" style="display:none"></iframe>
<audio id="audio" autoplay>
	<source src="alarm.mp3" type="audio/mp3">
</audio>

</html>

