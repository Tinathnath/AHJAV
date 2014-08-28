<?php
require_once('../config/global.php');
use ahjav\models\manager\PartenairesManager;
use ahjav\utils\JSONEncoder;
try{
    header('Content-type: application/json');
    if(isset($_GET['id']) && $_GET['id'] != null)
    {
        $id = $_GET['id'];
        $partenaire = PartenairesManager::getInstance()->getPartenaireById($id);
        $promos = $partenaire->getPromotions();
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
        echo JSONEncoder::getInstance()->encodePromotions($promos);
    }
    else
    {
        header($_SERVER['SERVER_PROTOCOL'] . '400 Bad Request', true, 400);
        echo json_encode(array(
            "error" => array(
                "status" => "400",
                "responseText" => "Vous devez indiquer l'id du partenaire auteur des promotions"
            )
        ));
    }
}
catch (Exception $e)
{
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo json_encode(array(
        "error" => array(
            "status" => "500",
            "responseText" => "Une erreur inconnue s'est produite. Exception message: ".$e->getMessage()
        )
    ));
}