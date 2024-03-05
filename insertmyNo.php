<?php
	include "./include/connect.php";
	$sql = "select memberID, korname, birthday from member where myNo = '' and birthday <> '' and length(birthday) = 8";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
		$sql_myNo = "select myNo from leejaehoon where korname like '".$row['korname']."%' and birthday = '".$row['birthday']."'";
		$result_myNo = mysqli_query($conn, $sql_myNo);
		$row_myNo = mysqli_fetch_assoc($result_myNo);

		if (mysqli_num_rows($result_myNo) == 1){
			$sql_update = "update member set myNo = '".$row_myNo['myNo']."' where memberID = '".$row['memberID']."'";
			# echo $sql_update."<br>";
			$result_update = mysqli_query($conn, $sql_update);
		}
	}

	echo "End";
	mysqli_close($conn);
?>
