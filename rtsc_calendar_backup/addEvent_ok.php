<?php
	include "../include/connect.php";

	$calendar_category_idx	= mysqli_real_escape_string($conn, trim($_REQUEST['calendar_category_idx']));
	$title					= mysqli_real_escape_string($conn, trim($_REQUEST['title']));
	$content				= mysqli_real_escape_string($conn, trim($_REQUEST['content']));
	$isAllday				= mysqli_real_escape_string($conn, trim($_REQUEST['isAllday']));
	$scheduleDate			= mysqli_real_escape_string($conn, trim($_REQUEST['scheduleDate']));
	$scheduleDateTimeRange	= mysqli_real_escape_string($conn, trim($_REQUEST['scheduleDateTimeRange']));
	$url					= mysqli_real_escape_string($conn, trim($_REQUEST['url']));

	// 2020-12-12
	// 2020-12-14 05:30 AM - 2020-12-16 10:00 PM

	If ($isAllday == "Y") {
		$startDate = explode('-', $scheduleDate);
		$startYear = $startDate[0];
		$startMonth = $startDate[1];
		$startDay = $startDate[2];
		$startTime = "";
		$startMinute = "";
		$endYear = "";
		$endMonth = "";
		$endDay = "";
		$endTime = "";
		$endMinute = "";

//		echo "startYear : ".$startYear."<br>";
//		echo "startMonth : ".$startMonth."<br>";
//		echo "startDay : ".$startDay."<br>";
    }else{
		$dateRange = explode(' ', $scheduleDateTimeRange);
//		echo "dateRange[0] : ".$dateRange[0]."<br>";
//		echo "dateRange[1] : ".$dateRange[1]."<br>";
//		echo "dateRange[2] : ".$dateRange[2]."<br>";
//		echo "dateRange[3] : ".$dateRange[3]."<br>";
//		echo "dateRange[4] : ".$dateRange[4]."<br>";
//		echo "dateRange[5] : ".$dateRange[5]."<br>";
//		echo "dateRange[6] : ".$dateRange[6]."<br>";

		$startYear = substr($dateRange[0], 0, 4);
		$startMonth = substr($dateRange[0], 5, 2);
		$startDay = substr($dateRange[0],-2);
		$startTime = substr($dateRange[1], 0, 2);
		$startMinute = substr($dateRange[1], -2);
		If ($dateRange[2] == "PM"){
			$startTime =  (int)$startTime + 12;
		}
//		echo "startYear : ".$startYear."<br>";
//		echo "startMonth : ".$startMonth."<br>";
//		echo "startDay : ".$startDay."<br>";
//		echo "startTime : ".$startTime."<br>";
//		echo "startMinute : ".$startMinute."<br>";

		$endYear = substr($dateRange[4], 0, 4);
		$endMonth = substr($dateRange[4], 5, 2);
		$endDay = substr($dateRange[4],-2);
		$endTime = substr($dateRange[5], 0, 2);
		$endMinute = substr($dateRange[5], -2);
		If ($dateRange[6] == "PM"){
			$endTime =  (int)$endTime + 12;
		}
//		echo "endYear : ".$endYear."<br>";
//		echo "endMonth : ".$endMonth."<br>";
//		echo "endDay : ".$endDay."<br>";
//		echo "endTime : ".$endTime."<br>";
//		echo "endMinute : ".$endMinute."<br>";
	}
	
	$sql  = "insert into calendar (homepage_admin_idx, calendar_category_idx, startYear, startMonth, startDay, startTime, startMinute, endYear, endMonth, endDay, endTime, endMinute, isAllday, url, title, content, inputDate) values ('".$_SESSION['ss_homepage_admin_idx']."',  '".$calendar_category_idx."', '".$startYear."', '".$startMonth."', '".$startDay."', '".$startTime."', '".$startMinute."', '".$endYear."', '".$endMonth."', '".$endDay."', '".$endTime."', '".$endMinute."', '".$isAllday."', '".$url."', '".$title."', '".$content."', now())";
	$result = mysqli_query($conn, $sql);
//	echo $sql;
	mysqli_close($conn);
	$viewDate = $startYear."-".$startMonth."-".$startDay;
	echo "<script>location.href='calendar.php?viewDate=$viewDate';</script>";
?>