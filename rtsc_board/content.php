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
            <h1 class="m-0">렘넌트서밋위원회</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">
					<i class="fas fa-map-marker-alt"></i>
					<b>
					<?php
						include "../include/connect.php";
						
						$page			= trim($_REQUEST['page']);
						$board_idx		= trim($_REQUEST['board_idx']);
						$boardCode		= trim($_REQUEST['boardCode']);
						$mode			= trim($_REQUEST['mode']);
						$Search			= trim($_REQUEST['Search']);
						$SearchString	= trim($_REQUEST['SearchString']);

						//echo "page : ".$page."<br>";
						//echo "board_idx : ".$board_idx."<br>";
						//echo "boardCode : ".$boardCode."<br>";
						//echo "mode : ".$mode."<br>";
						//echo "Search : ".$Search."<br>";
						//echo "SearchString : ".$SearchString."<br>";

						$sql_boardName = "SELECT boardName from boardinfo where boardCode = '".$boardCode."'";
						$result_boardName = mysqli_query($conn, $sql_boardName);
						$row_boardName = mysqli_fetch_assoc($result_boardName);
						echo $row_boardName['boardName'];
					?>
					</b>
				</h3>
              </div>

			<script language="javascript">
			<!--
			function send_reply(){
				if (document.reply.content.value == ""){
					alert("답변 내용을 입력하여주십시요.");
					document.reply.content.focus();
					return;
				}
				document.reply.submit();
			}
			function del(){
				ans = confirm("정말로 삭제하시겠습니까?");
				if(ans==true){
					document.del.submit();
				}
				else{
				}
			}
			function editReply(idx, board_idx){
				window.open("editReply.php?idx="+idx+"&board_idx="+board_idx, "editReply", "status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=400");
			}
			function delReply(idx, board_idx){
				window.open("delReply.php?idx="+idx+"&board_idx="+board_idx, "delReply", "status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=400");
			}
			function attachFiledelete(idx){
				ans = confirm("첨부파일을 삭제하시겠습니까?");
				if(ans==true){
					window.open("attachFiledelete.php?idx="+idx, "attachFiledelete", "status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=400");
				}
				else{
				}
			}
			//-->
			</script>
<?php
	//조회수 증가
	$sql_visit = "Update board Set visit = visit + 1 where board_idx = '".$board_idx."'";
	$result_visit = mysqli_query($conn, $sql_visit);

	$sql = "select a.title, a.content, a.homepage_admin_idx, b.photofilename, b.korname, a.visit, a.inputDate from board a, homepage_admin b where a.homepage_admin_idx = b.homepage_admin_idx and a.board_idx = '".$board_idx."' and a.boardCode = '".$boardCode."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
				<div class="card-body">
					<div class="card-body">
						<span class="float-left"><h4><?php echo $row['title'];?></h4></span>
						<span class="float-right">
						<?php
							if ($_SESSION['ss_homepage_admin_idx'] == $row['homepage_admin_idx']){
								echo '<a class="btn btn-info btn-sm" href="edit.php?page='.$page.'&board_idx='.$board_idx.'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'"><i class="fas fa-pencil-alt"></i> Edit</a>';
								echo '&nbsp;<a class="btn btn-danger btn-sm" href="javascript:del();"><i class="fas fa-trash"></i> Delete</a>';
							}
							echo '&nbsp;<a class="btn btn-info btn-sm" href="list.php?page='.$page.'&board_idx='.$board_idx.'&boardCode='.$boardCode.'&mode='.$mode.'&Search='.$Search.'&SearchString='.$SearchString.'"><i class="fas fa-list"></i> List</a>';
						?>
						</span>
					</div>
                    <div class="card-body">
                      <div class="user-block">
						  <?php
							If ($row['photofilename'] <> "") { 
								echo '<img src="/upload/'.$row['photofilename'].'" class="img-circle elevation-2" alt="User Image" width="128">';
							}else{
								echo '<img src="/image/photox.jpg" class="img-circle elevation-2" alt="User Image" width="128">';
							}
						  ?>
							<span class="username"><?php echo $row['korname'];?></span>
							<span class="description"><?php echo $row['inputDate'];?></span>
                      </div>
                      <!-- /.user-block -->
				  </div>
                  <div class="card-body">
                      <p>
                        <?php echo $row['content'];?>
                      </p>
					<?php
						//첨부파일
						$sql_file = "select idx, filename from board_filename where board_idx = '".$board_idx."' order by idx";
						$result_file = mysqli_query($conn, $sql_file);
						while ($row_file = mysqli_fetch_assoc($result_file)) {
					?>
							<div class="form-group row text-center">
								<a href="/upload/<?php echo $row_file['filename'];?>" class="link-black text-sm"><button type="button" class="btn btn-outline-info"><i class="fas fa-paperclip"></i> <?php echo $row_file['filename'];?></button></a>
					<?php
							// 자신의 글의 첨부파일은 삭제할 수 있다.
							if ($_SESSION['ss_homepage_admin_idx'] == $row['homepage_admin_idx']){
					?>
								&nbsp;<a href="javascript:attachFiledelete('<?php echo $row_file['idx']?>')"><button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button></a>
					<?php	
							}
					?>
							</div>
					<?php
						}
					?>
                    </div>
				</div>
				<!-- /.card-body -->

				<div class="card-footer">
				<?php
					$sql_reply = "select a.idx, a.content, a.homepage_admin_idx, b.photofilename, b.korname, a.inputDate from reply_board a, homepage_admin b where a.homepage_admin_idx = b.homepage_admin_idx and a.board_idx = '".$board_idx."'";
					$result_reply = mysqli_query($conn, $sql_reply);
					while ($row_reply = mysqli_fetch_assoc($result_reply)){
						if ($_SESSION['ss_homepage_admin_idx'] == $row_reply['homepage_admin_idx']){
				?>
							<div class="direct-chat-msg">
								<div class="direct-chat-infos clearfix">
									<span class="direct-chat-name float-left"><?php echo $row_reply['korname']?></span>
									<span class="float-right"><?php echo $row_reply['inputDate']?></span>
								</div>
					<?php
							}else{
					?>
							<div class="direct-chat-msg right">
								<div class="direct-chat-infos clearfix">
									<span class="direct-chat-name float-right"><?php echo $row_reply['korname']?></span>
									<span class="float-left"><?php echo $row_reply['inputDate']?></span>
								</div>
					<?php
							}
					?>
					<!-- /.direct-chat-infos -->
					<?php
						If ($row_reply['photofilename'] <> "") {
					?>
								<img class="direct-chat-img" src="/upload/<?php echo $row_reply['photofilename'] ?>">
					<?php
						}else{
					?>
								<img src="/image/photox.jpg"  class="direct-chat-img" alt="User Image">
					<?php
						}
					?>
								<div class="direct-chat-text">
									<?php echo str_replace("\r\n", "<br>", $row_reply['content']) ?>

									<?php
										if ($_SESSION['ss_homepage_admin_idx'] == $row_reply['homepage_admin_idx']){
									?>
											<p>
											<a class="btn btn-info btn-sm" href="javascript:editReply('<?php echo $row_reply['idx'] ?>', '<?php echo $board_idx ?>');">
												<i class="fas fa-pencil-alt"></i>Edit</a>
											<a class="btn btn-danger btn-sm" href="javascript:delReply('<?php echo $row_reply['idx'] ?>', '<?php echo $board_idx ?>');">
											<i class="fas fa-trash"></i>Delete</a>
											</p>
									<?php
										}
									?>
								</div>
								<!-- /.direct-chat-text -->
							</div>
							<!-- /.direct-chat-msg -->
				<?php
					}
				?>
					<form method="post" name="reply" action="reply_ok.php">

					<input type="hidden" name="page" value="<?php echo $page;?>">
					<input type="hidden" name="board_idx" value="<?php echo $board_idx;?>">
					<input type="hidden" name="boardCode" value="<?php echo $boardCode;?>">
					<input type="hidden" name="mode" value="<?php echo $mode;?>">
					<input type="hidden" name="Search" value="<?php echo $Search;?>">
					<input type="hidden" name="SearchString" value="<?php echo $SearchString;?>">

					  <div class="input-group">
						<input type="text" name="content" class="form-control">
						<span class="input-group-append">
						  <a href="javascript:send_reply()"><button type="button" class="btn btn-primary">Send</button></a>
						</span>
					  </div>
					</form>
				</div>
				<!-- /.card-footer -->


<!--삭제할 경우 //-->
<form name="del" method="post" action="del.php">
	<input type="hidden" name="page" value="<?php echo $page;?>">
	<input type="hidden" name="board_idx" value="<?php echo $board_idx;?>">
	<input type="hidden" name="boardCode" value="<?php echo $boardCode;?>">
	<input type="hidden" name="mode" value="<?php echo $mode;?>">
	<input type="hidden" name="Search" value="<?php echo $Search;?>">
	<input type="hidden" name="SearchString" value="<?php echo $SearchString;?>">
</form>

<?php
	mysqli_close($conn); // 데이터베이스 접속 종료
?>
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
	include "../include/footer.php";
?>
<!-- Page specific script -->
<script>
$(function () {
	$('#summernote').summernote({
		toolbar: [
			//[groupName, [list of button]]
			['fontname', ['fontname']],
			['fontsize', ['fontsize']],
			['style', ['bold', 'italic', 'underline','strikethrough', 'clear']],
			['color', ['forecolor','color']],
			['table', ['table']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			//['insert',['picture','link','video']],
			['view', ['fullscreen', 'help']]
		],
		fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New','맑은 고딕','궁서','굴림체','굴림','돋음체','바탕체'],
		fontSizes: ['8','9','10','11','12','14','16','18','20','22','24','28','30','36','50','72'],
		height: 500,                 // 에디터 높이
		minHeight: null,             // 최소 높이
		maxHeight: null,             // 최대 높이
		focus: true,                  // 에디터 로딩후 포커스를 맞출지 여부
		lang: "ko-KR",               // 한글 설정
		placeholder: '',	//placeholder 설정
		callbacks: {
			onImageUpload: function(files, editor, welEditable) {
				for (var i = files.length - 1; i >= 0; i--) {
					sendFile(files[i], this);
				}
			}
		}
		   
	});
  })
</script>



