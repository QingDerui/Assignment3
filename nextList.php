<?php
/**
 * Created by PhpStorm.
 * User: rose
 * Date: 12/30/2018
 * Time: 6:42 PM
 */

require_once('DB.php');
require_once('Word.php');
require_once('User.php');
session_start();

DB_Controller::createConnection();
for ($a = 1; $a < 11; $a++) {

    if (isset($_POST[$a]) && !is_null($_POST[$a])) {

        $wordId = $_POST[$a];
        $statusName = 'status' . strval($a);
        $wordStatus = $_POST[$statusName];
        DB_Controller::saveWordStatus($_SESSION['username'], $wordId, intval($wordStatus), strval($_SESSION['list']));


    }


}

DB_Controller::closeConnection();
echo "<script>location.href='memoryWords.php'</script>";