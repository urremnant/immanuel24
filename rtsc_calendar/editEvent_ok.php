<?php
	include "../include/connect.php";

	$idx = trim($_REQUEST['idx']);

	$calendar_category_idx	= mysqli_real_escape_string($conn, trim($_REQUEST['calendar_category_idx']));
	$title					= mysqli_real_escape_string($conn, trim($_REQUEST['title']));
	$content				= mysqli_real_escape_string($conn, trim($_REQUEST['content']));
	$isAllday				= mysqli_real_escape_string($conn, trim($_REQUEST['isAllday']));
	$scheduleDate			= mysqli_real_escape_string($conn, trim($_REQUEST['scheduleDate']));
	$scheduleDateTimeRange	= mysqli_real_escape_string($conn, trim($_REQUEST['scheduleDateTimeRange']));
	$url					= mysqli_real_escape_string($conn, trim($_REQUEST['url']));

	//반복일정
	$repeatStartDate		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatStartDate']));
	$repeatEndDate			= mysqli_real_escape_string($conn, trim($_REQUEST['repeatEndDate']));
	$repeatStartTime		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatStartTime']));
	$repeatEndTime			= mysqli_real_escape_string($conn, trim($_REQUEST['repeatEndTime']));
	$repeatDayOfWeek0		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek0']));
	$repeatDayOfWeek1		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek1']));
	$repeatDayOfWeek2		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek2']));
	$repeatDayOfWeek3		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek3']));
	$repeatDayOfWeek4		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek4']));
	$repeatDayOfWeek5		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek5']));
	$repeatDayOfWeek6		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek6']));
	$repeatDayOfWeek7		= mysqli_real_escape_string($conn, trim($_REQUEST['repeatDayOfWeek7']));

	$dayofweek = "";
	If ($repeatDayOfWeek7 == "Y"){
		$dayofweek = "[0,1,2,3,4,5,6]";
	}else{
		// 일요일
		If ($repeatDayOfWeek0 == "Y"){
			$dayofweek = "[0";
		}
		// 월요일
		If ($repeatDayOfWeek1 == "Y"){
			If ($dayofweek == ""){
				$dayofweek = "[1";
			}else{
				$dayofweek = $dayofweek . ",1";
			}
		}
		// 화요일
		If ($repeatDayOfWeek2 == "Y"){
			If ($dayofweek == ""){
				$dayofweek = "[2";
			}else{
				$dayofweek = $dayofweek . ",2";
			}
		}
		// 수요일
		If ($repeatDayOfWeek3 == "Y"){
			If ($dayofweek == ""){
				$dayofweek = "[3";
			}else{
				$dayofweek = $dayofweek . ",3";
			}
		}
		// 목요일
		If ($repeatDayOfWeek4 == "Y"){
			If ($dayofweek == ""){
				$dayofweek = "[4";
			}else{
				$dayofweek = $dayofweek . ",4";
			}
		}
		// 금요일
		If ($repeatDayOfWeek5 == "Y"){
			If ($dayofweek == ""){
				$dayofweek = "[5";
			}else{
				$dayofweek = $dayofweek . ",5";
			}
		}
		// 토요일
		If ($repeatDayOfWeek6 == "Y"){
			If ($dayofweek == ""){
				$dayofweek = "[6";
			}else{
				$dayofweek = $dayofweek . ",6";
			}
		}
		$dayofweek = $dayofweek . "]";
	}

	// 2020-12-12
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
	}
	// 2020-12-14 05:30 AM - 2020-12-16 10:00 PM
	If ($isAllday == "N") {
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
	If ($isAllday == "R") {
		//2020-12-14
		if ($repeatStartDate != ""){
			$startDate = explode('-', $repeatStartDate);
			$startYear = $startDate[0];
			$startMonth = $startDate[1];
			$startDay = $startDate[2];
		}
		if ($repeatEndDate != ""){
			$startDate = explode('-', $repeatEndDate);
			$endYear = $startDate[0];
			$endMonth = $startDate[1];
			$endDay = $startDate[2];
		}
		//12:05
		if ($repeatStartTime != ""){
			$startDate = explode(':', $repeatStartTime);
			$startTime = $startDate[0];
			$startMinute = $startDate[1];
		}
		if ($repeatEndTime != ""){
			$startDate = explode(':', $repeatEndTime);
			$endTime = $startDate[0];
			$endMinute = $startDate[1];
		}
	}
	$sql = "update calendar set calendar_category_idx = '".$calendar_category_idx."', startYear = '".$startYear."', startMonth = '".$startMonth."', startDay = '".$startDay."', startTime = '".$startTime."', startMinute = '".$startMinute."', endYear = '".$endYear."', endMonth = '".$endMonth."', endDay = '".$endDay."', endTime = '".$endTime."', endMinute = '".$endMinute."', isAllday = '".$isAllday."', dayofweek = '".$dayofweek."', url = '".$url."', title = '".$title."', content = '".$content."' where idx  = '".$idx."'";
	$result = mysqli_query($conn, $sql);
//	echo $sql;
	mysqli_close($conn);
	$viewDate = $startYear."-".$startMonth."-".$startDay;
	echo "<script>location.href='calendar.php?viewDate=$viewDate';</script>";
?>