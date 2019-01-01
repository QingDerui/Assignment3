<?php
/**
 * Author: Yuxuan Wang
 * Date: 2018-12-27
 * Time: 3:03 AM
 */
require_once('User.php');
require_once('Word.php');

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
        $query = "use germana1;update word set wordger = ?, wordeng = ?, example = ?, genus = ?, section = ? where wordid = ?;";


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
    public static function checkUser($userID)
    {
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
    public static function checkPassword($user)
    {
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


    /**
     * getting a list of 10 random words from word table with the specified section. this method is used when user is not signed in.
     * @param $section
     * @return array|null: the list of 10 random words
     */
    public static function getRandomList_XSigned($section)
    {
        $query = "select wordid, wordger, wordeng, example, genus from word where section=? order by rand() limit 10";

        $wordid = '';
        $wordeng = '';
        $wordger = '';
        $example = '';
        $genus = '';

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("s", $section);
            $stmt->execute();
            $stmt->bind_result($wordid, $wordger, $wordeng, $example, $genus);
            while ($stmt->fetch()) {
                $word = new Word($wordger, $wordeng, $example, $genus, $section);
                $word->setWordID($wordid);
                $words[] = $word;
            }
            $stmt->close();
            if (!empty($words)) {
                return $words;
            } else {
                return null;
            }
        }
    }

    /**
     * getting a list of 10 random words from word table with the specified section. The list doesn't include words that are marked familiar for 3 times.
     * This method is used for signed in users.
     * @param $section
     * @param $userID
     * @param $listNumber
     * @return array|null :the list of 10 random words
     */
    public static function getRandomList_signed($section, $userID, $listNumber)
    {
        $query = "SELECT 
    table1.wordid,
    wordger,
    wordeng,
    example,
    genus
FROM
    word table1
        LEFT JOIN
    (SELECT 
        wordid, COUNT(*) AS count
    FROM
        user_word_status
    WHERE
        userid = ? AND status = 1
    GROUP BY wordid) table2 ON table1.wordid = table2.wordid
WHERE
    section = ?
        AND (table2.count IS NULL
        OR table2.count != 3)
ORDER BY RAND()
LIMIT 10";

        $wordid = '';
        $wordeng = '';
        $wordger = '';
        $example = '';
        $genus = '';

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("ss", $userID, $section);
            $stmt->execute();
            $stmt->bind_result($wordid, $wordger, $wordeng, $example, $genus);
            while ($stmt->fetch()) {
                $word = new Word($wordger, $wordeng, $example, $genus, $section);
                $wordids[] = $wordid;
                $word->setWordID($wordid);
                $words[] = $word;
            }
            $stmt->close();
        }

        // save into user_word_status
        $query = "insert into user_word_status (userid, wordid, listnumber) values (?, ?, ?)";


        if ($stmt = self::$con->prepare($query)) {
            foreach ($wordids as $wordid) {
                $stmt->bind_param('sss', $userID, $wordid, $listNumber);
                $stmt->execute();
                while ($stmt->fetch()) {
                    //null
                }
            }
            $stmt->close();
        }


        if (!empty($words)) {
            return $words;
        } else {
            return null;
        }
    }

    /**
     * This function is used to save status into user_word_status
     * @param $userID
     * @param $wordID
     * @param $status
     */
    public static function saveWordStatus($userID, $wordID, $status, $listNumber)
    {
        $query = "update user_word_status set status=status+? where userid=? and wordid=? and listnumber=?;";


        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param('isss', $status, $userID, $wordID, $listNumber);
            $stmt->execute();
            while ($stmt->fetch()) {
                // null
            }
            $stmt->close();
        }
    }

    /**
     * This function is used to get the number of the recognized words of the specified user and word section.
     * @param $userid
     * @param $section
     * @return int|null : the number of the recognized words; return null when where is error
     */
    public static function getRecognizedWordNumber($userid, $section)
    {
        $query = "SELECT 
    COUNT(*)
FROM
    word table1
        LEFT JOIN
    (SELECT 
        wordid, COUNT(*) AS count
    FROM
        user_word_status
    WHERE
        userid = ? AND status = 1
    GROUP BY wordid) table2 ON table1.wordid = table2.wordid
WHERE
    section = ? AND (table2.count >= 1)
";
        $result = 0;

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param('ss', $userid, $section);
            $stmt->execute();
            $stmt->bind_result($result);
            while ($stmt->fetch()) {
                return $result;
            }
            $stmt->close();
        }
        return null;
    }

    /**
     * This function is used to get the number of the lists of the specified user and word section.
     * @param $userid
     * @param $section
     * @return int|null the number of the lists; return null when where is error
     */
    public static function getListNumber($userid, $section)
    {
        $query = "select count(*) from (select distinct listnumber from user_word_status where userid=? and user_word_status.wordid in (select wordid from word where section=?)) as a";
        $result = 0;

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param('ss', $userid, $section);
            $stmt->execute();
            $stmt->bind_result($result);
            while ($stmt->fetch()) {
                return $result;
            }
            $stmt->close();
        }
        return null;
    }

    /**
     * This function is used to get a list of words with the specified userid, word section, and list number.
     * @param $userid
     * @param $section
     * @param $listNumber
     * @return array|null array of words
     */
    public static function getListWords($userid, $section, $listNumber)
    {
        $query = "SELECT 
    word.wordid,
    word.wordger,
    word.wordeng,
    word.example,
    word.genus,
    user_word_status.status
FROM
    word,
    user_word_status
WHERE
    word.wordid = user_word_status.wordid
        AND user_word_status.userid = ?
        AND user_word_status.listnumber = ?
        AND word.wordid IN (SELECT 
            wordid
        FROM
            word
        WHERE
            section = ?)";
        $wordid = '';
        $wordger = '';
        $wordeng = '';
        $example = '';
        $genus = '';
        $status = 0;

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param('sss',$userid, $listNumber, $section);
            $stmt->execute();
            $stmt->bind_result($wordid, $wordger, $wordeng, $example, $genus, $status);
            while ($stmt->fetch()) {
                $word = new Word($wordger, $wordeng, $example, $genus, $section);
                $word->setWordID($wordid);
                $wordAndStatus = array();
                $wordAndStatus[] = $word;
                $wordAndStatus[] = $status;
                $result[] = $wordAndStatus;
            }
            $stmt->close();
        }

        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    /**
     * This function is used to get the number of words in a specified section
     * @param $section
     * @return int|null
     */
    public static function getSectionWordNumber($section){
        $query = "select count(*) from word where section=?";

        $result = 0;

        if ($stmt = self::$con->prepare($query)) {
            $stmt->bind_param("s", $section);
            $stmt->execute();
            $stmt->bind_result($result);
            while ($stmt->fetch()) {
                return $result;
            }
            $stmt->close();
            return null;
        }
    }
}