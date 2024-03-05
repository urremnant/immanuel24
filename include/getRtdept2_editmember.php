<select class="custom-select rounded-0" Id="change_rtdept2Code" name='change_rtdept2Code'>
	<option value="">선택하세요</option>
<?php
	include "../include/connect.php";
	$rtdept1Code = $_REQUEST['rtdept1Code'];
	$sql_makertdept2 = "select rtdept2Code, rtdept2Name from rtdept2 where parentsCode = '".$rtdept1Code."' order by rtdept2Name";
	$result_makertdept2 = mysqli_query($conn, $sql_makertdept2);
	while ($row_makertdept2 = mysqli_fetch_assoc($result_makertdept2)) {
?>
	<option value="<?php echo $row_makertdept2['rtdept2Code']?>"><?php echo $row_makertdept2['rtdept2Name']?></option>
<?php
	}
?>
</select>