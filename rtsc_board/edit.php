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

						$sql_boardName = "SELECT boardName from boardinfo where boardCode = '".$boardCode."'";
						$result_boardName = mysqli_query($conn, $sql_boardName);
						$row_boardName = mysqli_fetch_assoc($result_boardName);
						echo $row_boardName['boardName'];
					?>
					</b>
				</h3>
              </div>

			<script language = "javascript">
			<!--
			function sendit(){
				if (document.rtsc.title.value == ""){
						alert("제목을 입력하여 주십시요.");
						document.rtsc.title.focus();
						return false;
				}
				if (document.rtsc.content.value == ""){
						alert("내용을 입력하여 주십시요.");
						document.rtsc.content.focus();
						return false;
				}
				document.rtsc.submit();
			}
			function onlyNum(obj) {
				var val = obj.value;
				var re = /[^0-9]/gi;
				obj.value = val.replace(re, '');
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
	$sql = "select * from board where board_idx = '".$board_idx."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
?>
			<form class="form-horizontal" method ="POST" name="rtsc" enctype="multipart/form-data" action="edit_ok.php" onsubmit="return sendit()">

				<input type="hidden" name="page" value="<?php echo $page;?>">
				<input type="hidden" name="board_idx" value="<?php echo $board_idx;?>">
				<input type="hidden" name="boardCode" value="<?php echo $boardCode;?>">
				<input type="hidden" name="mode" value="<?php echo $mode;?>">
				<input type="hidden" name="Search" value="<?php echo $Search;?>">
				<input type="hidden" name="SearchString" value="<?php echo $SearchString;?>">

				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 공지로 등록</label>
						<div class="col-sm-10">
							<div class="custom-control custom-checkbox">
								<input class="form-check-input" type="checkbox" name="alwaysTopYN" value="Y"<?php if ($row['alwaysTopYN'] == "Y"){echo " checked";}?>>
								<label class="form-check-label">공지로 등록합니다. ※ 공지로 등록하면 게시판 상단에 항상 나옵니다.</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 제목</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="title" maxlength="50" value="<?php echo $row['title'] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"><font color="red">*</font> 내용</label>
						<div class="col-sm-10">
							<textarea id="summernote" name="content"><?php echo $row['content'] ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">첨부파일</label>
						<div class="col-sm-10">
							<?php
								//첨부파일
								$sql_file = "select idx, filename from board_filename where board_idx = '".$board_idx."' order by idx";
								$result_file = mysqli_query($conn, $sql_file);
								$count = mysqli_num_rows($result_file);
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
				<?php
					for ($i=1; $i< (6-$count); $i++) {
				?>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="myfile[]" name="myfile[]">
								<label class="custom-file-label" for="myfile[]">Choose file</label>
							</div>
						</div>
					</div>
				<?php
					}
				?>
				<!-- /.card-body -->

				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary btn-block">Submit</button>
				</div>
				<!-- /.card-footer -->
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
			['insert',['picture','link','video']],
			['view', ['fullscreen', 'codeview']]
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
	function sendFile(file, el, welEditable){
		var form_data = new FormData();
		form_data.append('file', file);
		$.ajax({
			data:form_data,
			type:"POST",
			url:'saveimage.php',
			cache:false,
			contentType:false,
			processData:false,
			success:function(url){
				$(el).summernote('editor.insertImage', $.trim(url));
			},
			error: function(data) {
				console.log(data);
			}
		});
	}
  })
</script>



