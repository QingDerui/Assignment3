<?php
/**
 * Created by PhpStorm.
 * User: rose
 * Date: 12/27/2018
 * Time: 5:20 PM
 */
require_once ('DB.php');
require_once ('User.php');

session_start();
$loginUser = new User();
$loginUser->setUserID($_POST['username']);
$loginUser->setUserPW($_POST['password']);

DB_Controller::createConnection();

if(!is_null($loginUser->getUserID())) {
    if (DB_Controller::checkUser($loginUser->getUserID())) {
        $_SESSION['userExisted'] = true;
        if(!is_null($loginUser->getUserPw())) {
            if (DB_Controller::checkPassword($loginUser)) {
                $_SESSION['userPass'] = true;
                $_SESSION['username'] = $loginUser->getUserID();
                echo "<script>location.href='index.php'</script>";
            } else {
                $_SESSION['userPass'] = false;
            }
        }
    } else {
        $_SESSION['userExisted'] = false;
    }
}

echo "<script>location.href='login.php'</script>";