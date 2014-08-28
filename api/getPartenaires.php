<?php

require_once('../config/global.php');
use ahjav\models\manager\PartenairesManager;
use ahjav\utils\JSONEncoder;

try{
    header('Content-type: application/json');
    if(isset($_GET['id']))
    {
        //one partner
        if($_GET['id'] != null)
        {
            $id = $_GET['id'];
            $partenaire = PartenairesManager::getInstance()->getPartenaireById($id);
            if($partenaire)
            {
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
                echo JSONEncoder::getInstance()->encodePartenaires(array($partenaire), true);
            }
            else
            {
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
                echo json_encode(array());
            }
        }
        else
        {
            //all partners
            $withPromo = true;
            $partenaires = PartenairesManager::getInstance()->getAllPartenaires(false);
            if(!empty($_POST['withPromo']))
                if($_POST['withPromo'] && ($_POST['withPromo'] == 0 || $_POST['withPromo'] == false))
                    $withPromo = false;

            header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
            echo JSONEncoder::getInstance()->encodePartenaires($partenaires, $withPromo);
        }
    }
}
catch(Exception $e)
{
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo '[{"status" : "error", "code" : 500, "responseText" : "Une erreur inconnue s\'est produite '.$e->getMessage().'" }]';
}
