<?php
	include "../include/connect.php";
	$start	= $_REQUEST["start"];
	$end	= $_REQUEST["end"];

	$sql = "select a.idx, a.homepage_admin_idx, a.title, a.content, a.startYear, a.startMonth, a.startDay, a.startTime, a.startMinute, a.endYear, a.endMonth, a.endDay, a.endTime, a.endMinute, a.isAllday, a.url, b.bgcolor from calendar a, calendar_category b where a.calendar_category_idx = b.calendar_category_idx ";
	$sql = $sql."and concat(a.startYear, a.startMonth, a.startDay) >= '".$start."' ";
	$sql = $sql."and concat(a.endYear, a.endMonth, a.endDay) <= '".$end."' ";

	$result = mysqli_query($conn, $sql);

	$strJson	= "";
	$strStart	= "";
	$strEnd		= "";

	while ($row = mysqli_fetch_assoc($result)) {
		$strIdx = "{id : '".$row['idx']."', ";
		$strUserID = "userID : '".$row['homepage_admin_idx']."', ";
		$strTitle = "title : '".$row['title']."', ";
		$strContent = "content : '".$row['content']."', ";
		switch ($row['isAllday']){
			case "Y" :
				$strAllday = "allDay : true}, ";
				$strStart = "start : '".$row['startYear']."-".$row['startMonth']."-".$row['startDay'];
				if ($row['startTime'] != ""){
					$strStart = $strStart." ".$row['startTime'];
				}
				if ($row['startMinute'] != ""){
					$strStart = $strStart.":".$row['startMinute'];
				}
				$strStart = $strStart."', ";
				break;
			case "N" :
				$strAllday = "allDay : false}, ";
				$strStart = "start : '".$row['startYear']."-".$row['startMonth']."-".$row['startDay'];
				if ($row['startTime'] <> ""){
					$strStart = $strStart." ".$row['startTime'];
				}
				if ($row['startMinute'] <> ""){
					$strStart = $strStart.":".$row['startMinute'];
				}
				$strStart = $strStart."', ";
				
				if ($row['endYear'] != ""){
					$strEnd = "end : '".$row['endYear']."-".$row['endMonth']."-".$row['endDay'];
					if ($row['endTime'] <> ""){
						$strEnd = $strEnd." ".$row['endTime'];
					}
					if ($row['endMinute'] <> ""){
						$strEnd = $strEnd.":".$row['endMinute'];
					}
					$strEnd = $strEnd."', ";
				}
		}
		$strColor = "backgroundColor : '".$row['bgcolor']."', borderColor : '".$row['bgcolor']."', ";

		if ($row['url'] <> ""){
			$strUrl = "url : '".$row['url']."',";
			$strJson = $strJson.$strIdx.$strTitle.$strContent.$strStart.$strEnd.$strUrl.$strColor.$strAllday;
		}else{
			$strJson = $strJson.$strIdx.$strUserID.$strTitle.$strContent.$strStart.$strEnd.$strColor.$strAllday;
		}
	}
	$strJson = "[".substr($strJson,0,-2)."]";
	$strJson = str_replace("\r\n", "<br>", $strJson);
	echo $strJson;
	mysqli_close($conn); // 데이터베이스 접속 종료
?>