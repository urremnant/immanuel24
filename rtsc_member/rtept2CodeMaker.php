<?php
	include "../include/connect.php";
	
?>
<script type="text/javascript">
function getCont(t)
{
    var obj = window.event.srcElement;
    var tgt = document.getElementById(t);
    var xmlhttp     = fncGetHttpRequest();

    // 두번째 파라미터 데이터를 가져올 페이지 URL 파라미터로 지금 선택된 select 의 값을 넘겨줍니다.
    xmlhttp.open('GET', 'getRtdept2.php?rtdept1Code='+obj.value, false);
    xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
    xmlhttp.onreadystatechange = function ()
    {
        if( xmlhttp.readyState=='4' )
        {
            // xmlhttp.status 값이 200 인경우 성공, 컴파일 오류 500, 페이지를 찾을수 없을경우 404, 접근권한 없는경우403
            tgt.innerHTML    = xmlhttp.responseText; // select 된 하위 객체에 값을 입력
        }
    }
    xmlhttp.send();
}
function fncGetHttpRequest()
{
    var caller;
    try {
        caller = new XMLHttpRequest();	// IE 7 or none IE
    }
    catch (e) {
        try	{
            caller = new ActiveXObject("Msxml2.XMLHTTP");	// IE 5, 6
        }
        catch (e) {
            try {
                caller = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                caller = null; // can't instantiate caller
            }
        }
    }
    return caller;
}
</script>
<select id="rtdept1Code" name="rtdept1Code" onchange='javascript:getCont("sel_2");'>
	<option value="">부서를 선택하세요</option>
<?php
	$sql_rtdept1 = "select rtdept1Code, rtdept1Name from rtdept1 where rtdept1Code like 'D1%' order by rtdept1Code";
	$result_rtdept1 = mysqli_query($conn, $sql_rtdept1);
	while ($row_rtdept1 = mysqli_fetch_assoc($result_rtdept1)) {
?>	
	<option value="<?php echo $row_rtdept1['rtdept1Code']?>"><?php echo $row_rtdept1['rtdept1Name']?></option>
<?php
	}
?>
</select>

<span id='sel_2'>
	<select name="rtdept2Code">
		<option value="">분반을 선택하세요</option>
	</select>
</span>


