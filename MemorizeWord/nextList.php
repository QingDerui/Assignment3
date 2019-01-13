<?php
/**
 * To store the status of the words in a list of a certain user into the database and point the flag to the next list.
 * User: Qing Derui
 * Date: 12/30/2018
 * Time: 6:42 PM
 */

require_once('../DB/DB.php');
require_once('../Models/Word.php');
require_once('../Models/User.php');
session_start();

DB_Controller::createConnection();


for ($a = 1; $a < 11; $a++) { // A list has maximum 10 words

    if (isset($_GET[$a]) && !is_null($_GET[$a])) { // Test whether the form has been posted.


        $wordId = $_GET[$a]; // Get the wordid.
        $statusName = 'status' . strval($a); // Get the status of a certain word
        $wordStatus = $_GET[$statusName]; // Get the userid

        DB_Controller::saveWordStatus($_SESSION['username'], $wordId, intval($wordStatus), strval($_SESSION['list'])); // store the status.


    }


}

$_SESSION['goToNextList'] = true; // Set the flag so that the memory interface will change to the next list

DB_Controller::closeConnection(); // Close DB connection

echo "<script>location.href='../MemorizeWord/memorizeWords.php'</script>"; //Back to the website