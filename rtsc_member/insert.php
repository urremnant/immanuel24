<?php
	include "../include/header.php";
//	include "../include/Navbar.php";
	//include "../include/leftMenu.php";
?>

<?php
	include "../include/connect.php";

	//$rtdept1Code	= trim($_REQUEST['rtdept1Code']);
	//$rtdept2Code	= trim($_REQUEST['rtdept2Code']);
?>

	<?php
 
    error_reporting(0);
    //error_reporting(E_ALL);
    //ini_set('display_errors',1);
 
    //include('dbcon.php');
 
 
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
 
 
    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {
 
        // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받습니다.
 
        $userName=$_POST['userName'];
        $userPassword=$_POST['userPassword'];
        $userNumber=$_POST['userNumber'];
        $userTemperature=$_POST['userTemperature'];
 
        if(empty($userName)){
            $errMSG = "이름을 입력하세요.";
        }
        else if(empty($userPassword)){
            $errMSG = "학과를 입력하세요.";
        }
        else if(empty($userNumber)){
            $errMSG = "학번을 입력하세요.";
        }
 
 
 
        if(!isset($errMSG)) // 이름과 나라 모두 입력이 되었다면
        {
            try{
                // SQL문을 실행하여 데이터를 MySQL 서버의 person 테이블에 저장합니다.
                $stmt = $con->prepare('INSERT INTO topic(userName, userPassword, userNumber, userTime) 
                VALUES(:userName, :userPassword, :userNumber, NOW())');
                
                $stmt->bindParam(':userName', $userName);
                $stmt->bindParam(':userPassword', $userPassword);
                $stmt->bindParam(':userNumber', $userNumber);
 
 
 
                if($stmt->execute())
                {
                    $successMSG = "새로운 사용자를 추가했습니다.";
                }
                else
                {
                    $errMSG = "사용자 추가 에러";
                }
 
            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage());
            }
        }
 
    }
 
?>
 
 
<?php
    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;
 
	$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
 
    if( !$android )
    {
?>
    <html>
       <body>
 
            <form action="<?php $_PHP_SELF ?>" method="POST">
                userName: <input type = "text" name = "userName" />
                userPassword: <input type = "text" name = "userPassword" />
                userNumber: <input type = "text" name = "userNumber" />
                userTemperature: <input type = "text" name = "userTemperature" />
                <input type = "submit" name = "submit" />
            </form>
 
       </body>
    </html>
 
<?php
    }
?>