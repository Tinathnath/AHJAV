<?php

require_once('../config/global.php');
use ahjav\models\manager\WineManager;
use ahjav\utils\JSONEncoder;

try{
    header('Content-type: application/json');
    if(isset($_GET['id']))
    {
       //one wine
        if($_GET['id'] != null)
        {
            $id = $_GET['id'];
            $vin = WineManager::getInstance()->getVinById($id);
            if($vin)
            {
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
                echo JSONEncoder::getInstance()->encodeWines(array($vin));
            }
            else
            {
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
                echo json_encode(array());
            }
        }
        else
        {
            //all wines
            $vins = WineManager::getInstance()->getAllVins(false);
            header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
            echo JSONEncoder::getInstance()->encodeWines($vins);
        }
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
