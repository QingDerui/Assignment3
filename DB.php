<?php
/**
 * Author: Yuxuan Wang
 * Date: 2018-12-27
 * Time: 3:03 AM
 */
require_once ('User.php');
require_once ('Word.php');
class DB_Controller
{
    /**
     * @var
     */
    private static $con;
    /**
     * @var string
     */
    private static $host = "localhost";
    /**
     * @var int
     */
    private static $port = 3306;
    /**
     * @var string
     */
    private static $socket = "";
    /**
     * @var string
     */
    private static $user = "root";
    /**
     * @var string
     */
    private static $password = "";
    /**
     * @var string
     */
    private static $dbname = "germana1";

    /**
     *
     */
    public static function createConnection()
    {
        self::$con = new mysqli(self::$host, self::$user, self::$password, self::$dbname, self::$port, self::$socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    }

    /**
     *
     */
    public static function closeConnection()
    {
        self::$con->close();
    }

    /**
     * @param $word
     * @return bool
     */
    public static function addWord($word)
    {
        $query = "insert into word (wordid, wordger, wordeng, example, genus, section) values (?, ?, ?, ?, ?, ?)";
        if ($stmt = self::$con->prepare($query)) {
            $wordid = $word->getWordID();
            $wordGer = $word->getWordGer();
            $wordEng = $word->getWordEng();
            $example = $word->getExample();
            $genus = $word->getGenus();
            $section = $word->getSection();
            $stmt->bind_param("ssssss", $wordid, $wordGer, $wordEng, $example, $genus, $section);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        return false;
    }

    /**
     *
     */
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

    /**
     * @return array|null
     */
    public static function getAllWords()
    {
        $query = "select wordid, wordger, wordeng, example, genus, section from word";
        $wordid = '';
        $wordeng = '';
        $wordger = '';
        $example = '';
        $genus = '';
        $section = '';

        if ($stmt = self::$con->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($wordid, $wordger, $wordeng, $example, $genus, $section);
            while ($stmt->fetch()) {
                $word = new Word($wordger, $wordeng, $example, $genus, $section);
                $word->setWordID($wordid);
                $words[] = $word;
            }
            $stmt->close();
        }

        if (empty($words)) {
            return null;
        } else {
            return $words;
        }
    }

    /**
     * @param $wordID
     * @param $wordGer
     * @param $wordEng
     * @param $example
     * @param $genus
     * @param $section
     * @return bool
     */
    public static function updateWord($wordID, $wordGer, $wordEng, $example, $genus, $section)
    {
        $query = "update word set wordger = ?, wordeng = ?, example = ?, genus = ?, section = ? where wordid = ?";


        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("ssssss", $wordGer, $wordEng, $example, $genus, $section, $wordID);
            $result = $stmt->execute();
            while ($stmt->fetch()) {
                //null
            }
            $stmt->close();
            return $result;
        }
        return false;
    }

    /**
     * @param $wordID
     * @return bool
     */
    public static function deleteWord($wordID)
    {
        $query = "delete from word where wordid = ?";


        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param('s', $wordID);
            $result = $stmt->execute();
            while ($stmt->fetch()) {
                //null
            }
            $stmt->close();
            return $result;
        }
        return false;
    }

    /**
     * @param $user
     * @return bool: true if succeeded
     */
    public static function signUp($user)
    {
        $query = "insert into user (userid, password) values (?,?)";
        $userID = $user->getUserID();
        $password = $user->getUserPW();

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("ss", $userID, $password);
            $result = $stmt->execute();
            while ($stmt->fetch()) {
                //printf("%s, %s\n", $field1, $field2);
            }
            $stmt->close();
            return $result;
        }
        return false;
    }

    /**
     * @param $userID
     * @return bool: true if has there exists a user with the specified user ID
     */
    public static function checkUser($userID){
        $query = "select userid from user where userid=?";

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("s", $userID);
            $stmt->execute();
            while ($stmt->fetch()) {
                return true;
            }
            $stmt->close();
            return false;
        }
    }

    /**
     * !!!call checkUser first!!!
     * @param $user
     * @return bool: true if the password is correct.
     */
    public static function checkPassword($user){
        $query = "select userid from user where userid=? and password=?";

        $userID = $user->getUserID();
        $password = $user->getUserPW();

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("ss", $userID, $password);
            $stmt->execute();
            while ($stmt->fetch()) {
                return true;
            }
            $stmt->close();
            return false;
        }
    }
}