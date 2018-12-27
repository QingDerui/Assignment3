<?php
/**
 * Author: Yuxuan Wang
 * Date: 2018-12-27
 * Time: 3:21 AM
 */

class Word
{
    /**
     * @var string
     */
    private static $id = '';
    /**
     * @var int
     */
    private static $count = 0;
    /**
     * @var string
     */
    private $wordID;
    /**
     * @var string
     */
    private $wordGer;
    /**
     * @var string
     */
    private $wordEng;
    /**
     * @var string
     */
    private $example;
    /**
     * @var string
     */
    private $genus;
    /**
     * @var string
     */
    private $section;

    /**
     * Word constructor.
     * @param string $wordGer
     * @param string $wordEng
     * @param string $example
     * @param string $genus
     * @param string $section
     */
    public function __construct($wordGer, $wordEng, $example, $genus, $section)
    {
        $this->wordID = 'w' . strval(self::$count + 1);
        $this->wordGer = $wordGer;
        $this->wordEng = $wordEng;
        $this->example = $example;
        $this->genus = $genus;
        $this->section = $section;
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
    public function getWordID()
    {
        return $this->wordID;
    }

    /**
     * @param string $wordID
     */
    public function setWordID($wordID)
    {
        $this->wordID = $wordID;
    }

    /**
     * @return string
     */
    public function getWordGer()
    {
        return $this->wordGer;
    }

    /**
     * @param string $wordGer
     */
    public function setWordGer($wordGer)
    {
        $this->wordGer = $wordGer;
    }

    /**
     * @return string
     */
    public function getWordEng()
    {
        return $this->wordEng;
    }

    /**
     * @param string $wordEng
     */
    public function setWordEng($wordEng)
    {
        $this->wordEng = $wordEng;
    }

    /**
     * @return string
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param string $example
     */
    public function setExample($example)
    {
        $this->example = $example;
    }

    /**
     * @return string
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * @param string $genus
     */
    public function setGenus($genus)
    {
        $this->genus = $genus;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param string $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }

}