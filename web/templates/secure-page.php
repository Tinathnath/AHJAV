<?php
/**
 * ahjav/secure-page.php
 * Created by: Nathan
 * Date: 22/05/14
 */
use ahjav\utils\SecurityController;
session_start();
$authenticated = false;
if(!empty($_SESSION))
{
    if(!empty($_SESSION['user']['username']) && !empty($_SESSION['user']['password']))
    {
        $securityController = new SecurityController();
        if(null != $user = $securityController->checkUserExists($_SESSION['user']['username']))
        {
            if($securityController->authenticate($_SESSION['user']['username'], $_SESSION['user']['password'], $user))
                $authenticated = true;
        }
    }
}

if(!$authenticated)
    header('location: login.php');