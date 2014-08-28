<?php
/**
 * ahjav/UserManager.class.php
 * Created by: Nathan
 * Date: 22/05/14
 */

namespace ahjav\models\manager;
use User;

class UserManager
{
    private static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
            self::$_instance = new UserManager();

        return self::$_instance;
    }

    public function addUser(User $user)
    {
        try
        {
            $user->save();
            return true;
        }
        catch(\Doctrine_Exception $e)
        {
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        $table = \Doctrine_Core::getTable('User');
        return $table->findBy('username', $username)->getFirst();
    }

    public function getUserById($id)
    {
        $table = \Doctrine_Core::getTable('User');
        return $table->find($id);
    }
} 