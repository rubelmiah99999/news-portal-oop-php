<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}


if(isset($_POST['login-submit'])) {
    require_once __DIR__.'/../database/dbFunctions.php';
	
	$mailuid = str_replace(array(':', '-', '/', '*', '<', '<'), '', $_POST['mailuid']);
    $password = str_replace(array(':', '-', '/', '*', '<', '<'), '', $_POST['pwd']);
    
    $dbFunctions = new DatabaseFunctions();
	
	If(empty($mailuid) || empty($password))  {
		header("Location: ../public/loginuser.php?error=emptyfields&mailuid=".$mailuid."&mail=".$email);
		exit();
	}
	else {
		$sql = "SELECT * FROM user WHERE username = ? OR email = ? ;";
		$result = $dbFunctions->stmtWithTwoParam($sql, $mailuid, $mailuid);
			if(!empty($result)) {
                foreach($result as $key => $value) {
                    $pwdCheck = password_verify($password, $value['password']);
                    if($pwdCheck == false) {
                        header("Location: ../public/loginuser.php?error=wrongpwd");
                        exit();
                    }
                    else if($pwdCheck == true) {
                        $_SESSION['userId'] = $row['id'];
                        $_SESSION['userUsername'] = $row['username'];
                        
                        header("Location: ../public/index.php?login=succes");
                        exit();
                    }
                }
			} else {
				header("Location: ../public/loginuser.php?error=nouser");
				exit();
			}
		}
	}

else {
	header("Location: ../public/loginuser.php");
	exit();
}