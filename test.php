<?php
/**
 * Author: Yuxuan Wang
 * Date: 2018-12-28
 * Time: 1:17 AM
 */

require_once('DB.php');
require_once('User.php');

$user = new User();
$user->setUserID('Derui Qing');
$user->setUserPW('1234');
DB_Controller::createConnection();
if (DB_Controller::checkUser($user->getUserID())) {
    $result = DB_Controller::checkPassword($user);
    if(false){
        echo "$result is true";
    }else{
        $f = false;
        echo "$f is false";
    }
} else {
    $result = DB_Controller::signUp($user);
    echo "no: $result";
}