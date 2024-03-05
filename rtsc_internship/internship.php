<?php
	include "../include/header.php";
	include "../include/Navbar.php";
	include "../include/leftMenu.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">인턴십</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php
	include "../include/connect.php";

	$expertMeetingCode		= trim($_REQUEST['expertMeetingCode']);
	$rtdept1Code			= trim($_REQUEST['rtdept1Code']);
	$churchareaCode			= trim($_REQUEST['churchareaCode']);
	if ($expertMeetingCode == ""){
		$expertMeetingCode = "all";
	}
	if ($rtdept1Code == ""){
		$rtdept1Code = "all";
	}
	if ($churchareaCode == ""){
		$churchareaCode = "all";
	}
?>
<script language="javascript">
<!--
function viewDept(){
	if (document.getElementById('expertMeetingCode').value == ""){
		alert("전문별을 선택하여 주세요.");
		return;
	}
	if (document.getElementById('rtdept1Code').value == ""){
		alert("부서를 선택하여 주세요.");
		return;
	}
	if (document.getElementById('churchareaCode').value == ""){
		alert("교구를 선택하여 주세요.");
		return;
	}
	var expertMeetingCode = document.getElementById('expertMeetingCode').value;
	var rtdept1Code = document.getElementById('rtdept1Code').value;
	var churchareaCode = document.getElementById('churchareaCode').value;
	location.href="internship.php?expertMeetingCode="+expertMeetingCode+"&rtdept1Code="+rtdept1Code+"&churchareaCode="+churchareaCode;
}
//-->
</script>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
					<i class="fas fa-map-marker-alt"></i>
					<b>전문별/부서별/교구별</b>
				</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-header">
				  <div class="form-group row">
					<div class="col-sm-2">
						<?php
							$sql_expertMeeting = "select expertMeetingCode, korProfessional from expertMeeting where expertMeetingCode <> 'EP9999' order by korProfessional;";
							$result_expertMeeting = mysqli_query($conn, $sql_expertMeeting);
						?>
							<select class="custom-select rounded-0" id="expertMeetingCode" name="expertMeetingCode">
								<option value="">전문별선택</option>
								<option value="all"
								<?php
									if ($expertMeetingCode == "all"){
										echo " selected";
									}
								?>
								>전체</option>
						<?php
							while ($row_expertMeeting = mysqli_fetch_assoc($result_expertMeeting)) {
						?>
								<option value="<?php echo $row_expertMeeting['expertMeetingCode'] ?>"
								<?php 
									if ($row_expertMeeting['expertMeetingCode'] == $expertMeetingCode){
										echo " selected";
									}
								?>
								><?php echo $row_expertMeeting['korProfessional'] ?></option>
						<?php
							}
						?>
							</select>
					</div>
					<div class="col-sm-2">
						<?php
							$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
							$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
						?>
							<select class="custom-select rounded-0" Id="rtdept1Code" name="rtdept1Code">
								<option value="">부서 선택</option>
								<option value="all"
								<?php
									if ($rtdept1Code == "all"){
										echo " selected";
									}
								?>
								>전체</option>
						<?php
							while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
						?>
								<option value="<?php echo $row_rtdept1['rtdept1Code'] ?>"
								<?php
									if ($rtdept1Code == $row_rtdept1['rtdept1Code']){
										echo "selected";
									}
								?>><?php echo $row_rtdept1['rtdept1Name'] ?></option>
						<?php
							}
						?>
							</select>
					</div>
					<div class="col-sm-2">
					<?php
						$sql_churcharea = "select churchareaCode, korParishName from churcharea where churchareaCode <> 'A99999' order by korParishName";
						$result_churcharea = mysqli_query($conn, $sql_churcharea);
					?>
							<select class="custom-select rounded-0" Id="churchareaCode" name="churchareaCode">
								<option value="">교구 선택</option>
								<option value="all"
								<?php
									if ($churchareaCode == "all"){
										echo " selected";
									}
								?>
								>전체</option>
					<?php
						while ($row_churcharea = mysqli_fetch_assoc($result_churcharea)) {
					?>
								<option value="<?php echo $row_churcharea['churchareaCode'] ?>"
								<?php
									if ($churchareaCode == $row_churcharea['churchareaCode']){
										echo "selected";
									}
								?>
								><?php echo $row_churcharea['korParishName'] ?></option>
					<?php
						}
					?>
								<option value="A99999" <?php if ($churchareaCode =="A99999"){echo "selected";}?>>미분류</option>
							</select>
					</div>
					<div class="col-sm-3">
						<a href="javascript:viewDept();"><button type="button" class="btn btn-primary">선택항목보기</button></a>
					</div>
				</div>
			  </div>
<?php
	$sql_internship = "select a.korname, a.mobile, a.company, b.korProfessional, c.rtdept1Name, d.korParishName from member a, expertMeeting b, rtdept1 c, churcharea d where a.expertMeetingCode = b.expertMeetingCode and a.rtdept1Code = c.rtdept1Code and a.churchareaCode = d.churchareaCode and a.memberID like 'T%' and a.expertMeetingCode <> 'EP9999' ";
	if ($expertMeetingCode <> "all"){
		$sql_internship = $sql_internship."and a.expertMeetingCode = '".$expertMeetingCode."' ";
	}	
	if ($rtdept1Code <> "all"){
		$sql_internship = $sql_internship."and a.rtdept1Code = '".$rtdept1Code."' ";
	}	
	if ($churchareaCode <> "all"){
		$sql_internship = $sql_internship."and a.churchareaCode = '".$churchareaCode."' ";
	}
	$sql_internship = $sql_internship."order by b.korProfessional, c.rtdept1Name, d.korParishName, a.korname";
	# echo $sql_internship;
	$result_internship = mysqli_query($conn, $sql_internship);
?>
			  <!--div class="card-body">
				<span class="btn btn-success btn-md">관심전문별 : 
				<?php 
					if (($expertMeetingCode == "")||($expertMeetingCode == "all")){
						echo "전체";
					}else{
						$sql_expertMeeting = "select korProfessional from expertMeeting where expertMeetingCode = '".$expertMeetingCode."'";
						$result_expertMeeting = mysqli_query($conn, $sql_expertMeeting);
						$row_expertMeeting = mysqli_fetch_assoc($result_expertMeeting);
						echo $row_expertMeeting['korProfessional'];
					}
				?>
				</span>
			  </div-->
			  <div class="card-header">
				<span class="btn btn-info btn-sm">교사</span>
			  </div>
			  <div class="card-body">
				  <div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					  <thead>
						<tr>
							<th>번호</th>
							<th>전문별</th>
							<th>부서</th>
							<th>교구</th>
							<th>성명</th>
							<th>연락처</th>
							<th>회사명</th>
						</tr>
					  </thead>
<?php
		$count = 1;
		while ($row_internship = mysqli_fetch_assoc($result_internship)) {
?>
						<tr>
							<td><?php echo $count;?></td>
							<td><?php echo $row_internship['korProfessional'];?></td>
							<td><?php echo $row_internship['rtdept1Name'];?></td>
							<td><?php echo $row_internship['korParishName'];?></td>
							<td><?php echo preg_replace("/(^.)./u", "$1○", $row_internship['korname']);?></td>
							<td>
								<?php
									if ($row_internship['mobile']<>""){
										echo preg_replace("/(^02.{0}|^01.{1}|[0-9]{4})([0-9]+)([0-9]{3})/", "$1*****$3", $row_internship['mobile']);
									}
								?>							
							</td>
							<td>
							<?php 
								if ($row_internship['company'] <> ""){
									if (mb_strlen($row_internship['company']) > 3){
										echo "○○○".mb_substr($row_internship['company'],3,mb_strlen($row_internship['company']));
									}else{
										echo "○".mb_substr($row_internship['company'],1,mb_strlen($row_internship['company']));
									}
								}
							?>
							</td>
						</tr>
<?php
			$count = $count + 1;
		}
?>
					  <tbody>
					  </tfoot>
					</table>
				  </div>
              </div>
<?php
	$sql_internship = "select a.korname, a.mobile, a.schoolinfo, b.korProfessional, c.rtdept1Name, d.korParishName from member a, expertMeeting b, rtdept1 c, churcharea d where a.expertMeetingCode = b.expertMeetingCode and a.rtdept1Code = c.rtdept1Code and a.churchareaCode = d.churchareaCode and a.memberID like 'R%' and a.expertMeetingCode <> 'EP9999' ";
	if ($expertMeetingCode <> "all"){
		$sql_internship = $sql_internship."and a.expertMeetingCode = '".$expertMeetingCode."' ";
	}	
	if ($rtdept1Code <> "all"){
		$sql_internship = $sql_internship."and a.rtdept1Code = '".$rtdept1Code."' ";
	}	
	if ($churchareaCode <> "all"){
		$sql_internship = $sql_internship."and a.churchareaCode = '".$churchareaCode."' ";
	}
	$sql_internship = $sql_internship."order by b.korProfessional, c.rtdept1Name, d.korParishName, a.korname";
	$result_internship = mysqli_query($conn, $sql_internship);
?>
			  <div class="card-header">
				<span class="btn btn-info btn-sm">렘넌트</span>
			  </div>
			  <div class="card-body">
				  <div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					  <thead>
						<tr>
							<th>번호</th>
							<th>전문별</th>
							<th>부서</th>
							<th>교구</th>
							<th>성명</th>
							<th>연락처</th>
							<th>학교명</th>
						</tr>
					  </thead>
<?php
		$count = 1;
		while ($row_internship = mysqli_fetch_assoc($result_internship)) {
?>
						<tr>
							<td><?php echo $count;?></td>
							<td><?php echo $row_internship['korProfessional'];?></td>
							<td><?php echo $row_internship['rtdept1Name'];?></td>
							<td><?php echo $row_internship['korParishName'];?></td>
							<td><?php echo preg_replace("/(^.)./u", "$1○", $row_internship['korname']);?></td>
							<td>
								<?php
									if ($row_internship['mobile']<>""){
										echo preg_replace("/(^02.{0}|^01.{1}|[0-9]{4})([0-9]+)([0-9]{3})/", "$1*****$3", $row_internship['mobile']);
									}
								?>							
							</td>
							<td>
								<?php
									if ($row_internship['schoolinfo'] <> ""){
										if (mb_strlen($row_internship['schoolinfo']) > 3){
											echo "○○○".mb_substr($row_internship['schoolinfo'],3,mb_strlen($row_internship['schoolinfo']));
										}else{
											echo "○".mb_substr($row_internship['schoolinfo'],1,mb_strlen($row_internship['schoolinfo']));
										}
									}
								?>
							</td>
						</tr>
<?php
			$count = $count + 1;
		}
?>
					  <tbody>
					  </tfoot>
					</table>
				  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
	include "../include/footer.php";
?>