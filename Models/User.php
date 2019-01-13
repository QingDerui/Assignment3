<?php
/**
 * Author: Yuxuan Wang
 * Date: 2018-12-28
 * Time: 1:03 AM
 */

class User
{
    private $userID;
    private $userPW;

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getUserPW()
    {
        return $this->userPW;
    }

    /**
     * @param mixed $userPW
     */
    public function setUserPW($userPW)
    {
        $this->userPW = $userPW;
    }

}