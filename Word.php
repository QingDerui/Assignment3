<?php
/**
 * Author: Yuxuan Wang
 * Date: 2018-12-27
 * Time: 3:21 AM
 */

class Word
{
    private static $id = '';
    private static $count = 0;
    private $wordID;
    private $wordGer;
    private $wordEng;
    private $example;
    private $genus;

    /**
     * Word constructor.
     * @param $wordGer
     * @param $wordEng
     * @param $example
     * @param $genus
     */
    public function __construct($wordGer, $wordEng, $example, $genus)
    {
        self::$count++;
        $this->wordGer = $wordGer;
        $this->wordEng = $wordEng;
        $this->example = $example;
        $this->genus = $genus;
        $this->wordID = 'w' . self::$count;
    }

    /**
     * @return int
     */
    public static function getCount()
    {
        return self::$count;
    }

    /**
     * @param int $count
     */
    public static function setCount($count)
    {
        self::$count = $count;
    }

    /**
     * @return string
     */
    public static function getId()
    {
        return self::$id;
    }

    /**
     * @param string $id
     */
    public static function setId($id)
    {
        self::$id = $id;
    }

    /**
     * @return mixed
     */
    public function getWordID()
    {
        return $this->wordID;
    }

    /**
     * @param mixed $wordID
     */
    public function setWordID($wordID)
    {
        $this->wordID = $wordID;
    }

    /**
     * @return mixed
     */
    public function getWordGer()
    {
        return $this->wordGer;
    }

    /**
     * @param mixed $wordGer
     */
    public function setWordGer($wordGer)
    {
        $this->wordGer = $wordGer;
    }

    /**
     * @return mixed
     */
    public function getWordEng()
    {
        return $this->wordEng;
    }

    /**
     * @param mixed $wordEng
     */
    public function setWordEng($wordEng)
    {
        $this->wordEng = $wordEng;
    }

    /**
     * @return mixed
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param mixed $example
     */
    public function setExample($example)
    {
        $this->example = $example;
    }

    /**
     * @return mixed
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * @param mixed $genus
     */
    public function setGenus($genus)
    {
        $this->genus = $genus;
    }


}