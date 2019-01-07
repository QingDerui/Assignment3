<?php
/**
 * Created by PhpStorm.
 * User: Pan
 */
//validation();
session_start();

require_once("DB.php");
require_once("Word.php");

DB_Controller::createConnection();

if(isset($_POST['wordList'])&& isset($_SESSION['username'])){

    $data = $_POST['wordList'];
    $arr_word = (array)(json_decode($data));
    $wordList = (array)($arr_word['dataWord']);
    $wordID = Word::getCount();

    for($i=0;$i<count($wordList);$i++){

        $wordItem = (array)($wordList[$i]);

        $wordObj = new Word($wordItem['wordGer'],$wordItem['wordEng'],$wordItem['wordExample'],$wordItem['wordGenus'],0);
        $wordObj->setWordID("w".strval($wordID+$i+1));

        DB_Controller::addWord_userList($wordObj,$_SESSION['username'],$wordItem['listName']);

    }
}
?>