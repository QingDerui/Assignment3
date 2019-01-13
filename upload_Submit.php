<?php
/**
 * Created by PhpStorm.
 * User: Pan
 */
//validation();
session_start();
require_once("Models/DB.php");
require_once("Models/Word.php");
DB_Controller::createConnection();
if (isset($_POST['wordList']) && isset($_SESSION['username'])) {
    $data = $_POST['wordList'];
    $arr_word = (array)(json_decode($data));
    $wordList = (array)($arr_word['dataWord']);
    $wordListName = trim($arr_word['name']);
    $wordID = Word::getCount();
    if (DB_Controller::checkListName($wordListName)) {
        $result['type'] = 1;
        $result['message'] = $wordListName;
        for ($i = 0; $i < count($wordList); $i++) {
            $wordItem = (array)($wordList[$i]);
            $wordObj = new Word($wordItem['wordGer'], $wordItem['wordEng'], $wordItem['wordExample'], $wordItem['wordGenus'], 0);
            $wordObj->setWordID("w" . strval($wordID + $i + 1));
            DB_Controller::addWord_userList($wordObj, $_SESSION['username'], $wordListName);
        }
    } else {
        $result['type'] = 0;
        $result['message'] = "wordlist repeated";
    }
    echo json_encode($result);
}
?>