<?php
/**
 * Created by PhpStorm.
 * User: rose
 * Date: 12/28/2018
 * Time: 2:31 PM
 */
require_once('Models/User.php');
require_once('DB/DB.php');

$signUpId = $_POST['username'];
$signUpPw = $_POST['password'];
$signUpRePw = $_POST['passwordRepeat'];

session_start();

DB_Controller::createConnection();

if(!is_null($signUpId)) {
    $_SESSION['nameNull'] = false;
    if (DB_Controller::checkUser($signUpId)) {
        $_SESSION['signed'] = true;
    } else {
        $_SESSION['signed'] = false;
        if($signUpPw == $signUpRePw){
            $_SESSION['pwPass'] = true;
            $newUser = new User();
            $newUser->setUserID($signUpId);
            $newUser->setUserPW($signUpPw);
            DB_Controller::signUp($newUser);
        }else{
        $_SESSION['pwPass'] = false;
        }

    }
}else{
    $_SESSION['nameNull'] = true;
}

echo "<script>location.href='signUp.php'</script>";
