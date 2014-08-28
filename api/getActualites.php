<?php

require_once('../config/global.php');
use ahjav\models\manager\ActusManager;
use ahjav\utils\JSONEncoder;

try{
    header('Content-type: application/json');
    $actualites = ActusManager::getInstance()->getAllActualites(false);
    if($actualites)
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
        echo JSONEncoder::getInstance()->encodeActualite($actualites);
    }
    else
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
        echo json_encode(array());
    }

}
catch(Exception $e)
{
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo json_encode(array(
        "error" => array(
            "status" => "500",
            "responseText" => "Une erreur inconnue s'est produite. Exception message: ".$e->getMessage()
        )
    ));
}
