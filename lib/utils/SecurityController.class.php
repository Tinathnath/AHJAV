<?php
/**
 * ahjav/SecurityController.class.php
 * Created by: Nathan
 * Date: 22/05/14
 */

namespace ahjav\utils;

use ahjav\models\manager\UserManager;
use User;

class SecurityController
{
    private $userManager;

    public function __construct()
    {
        if(!$this->userManager instanceof UserManager)
            $this->userManager = UserManager::getInstance();
    }

    public function checkUserExists($username)
    {
        return $this->userManager->getUserByUsername($username);
    }

    public function Login(User $user)
    {
        if($this->loginCheck($user))
        {
            $_SESSION['user']['username'] = $user->username;
            $_SESSION['user']['password'] = $user->passphrase;
            return true;
        }
        else
            return false;
    }

    private function loginCheck(User $user)
    {
        $password = $_POST['password'];
        $username = $_POST['username'];
        if($username == $user->username && $this->hashPasswd($password, $user->salt) == $user->passphrase)
            return true;
        else
            return false;
    }

    public function authenticate($username, $password, User $user)
    {
        if($username == $user->username && $password == $user->passphrase)
            return true;
        else
            return false;
    }

    public function hashPasswd($passPhrase, $salt)
    {
        return sha1($passPhrase.$salt);
    }

    public function generateSalt($size = 10)
    {
        $salt = "";
        $chars = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
        $saltMaxlength = strlen($chars);

        if ($size > $saltMaxlength) {
            $size = $saltMaxlength;
        }

        $i = 0;
        while ($i < $size) {
            $currentChar = substr($chars, mt_rand(0, $saltMaxlength-1), 1);
            if (!strstr($salt, $currentChar)) {
                $salt .= $currentChar;
                $i++;
            }
        }
        return $salt;
    }
} 