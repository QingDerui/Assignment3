<?php
/**
 * Author: Yuxuan Wang
 * Date: 2018-12-27
 * Time: 3:03 AM
 */
require("Word.php");

class DB_Controller
{
    private static $con;
    private static $host = "localhost";
    private static $port = 3306;
    private static $socket = "";
    private static $user = "root";
    private static $password = "";
    private static $dbname = "germana1";

    public static function createConnection()
    {
        self::$con = new mysqli(self::$host, self::$user, self::$password, self::$dbname, self::$port, self::$socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    }

    public static function closeConnection()
    {
        self::$con->close();
    }

    public static function addWord($word)
    {
        $query = "insert into word (wordid, wordger, wordeng, example, genus) values (?, ?, ?, ?, ?)";
        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("sssss", $word->getWordID, $word->getWordGer, $word->getWordEng, $word->getExample, $word->getGenus);
            $stmt->execute();
            $stmt->close();
        }
    }

    public static function setWordCount()
    {
        $query = "select wordid from word";
        $wordid = '';
        $maxid = 0;
        if ($stmt = self::$con->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($wordid);
            while ($stmt->fetch()) {
                $wordid = substr($wordid, 1, strlen($wordid) - 1);
                $wordid_int = intval($wordid);
                if ($wordid_int > $maxid) {
                    $maxid = $wordid_int;
                }
            }
            $stmt->close();
        }
        Word::setId('w' . strval($maxid));
        Word::setCount(strval($maxid));
    }
}