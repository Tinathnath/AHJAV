<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\WineManager;
if(!empty($_POST))
{
    if(!empty($_POST['wine-nom']) && !empty($_POST['wine-couleur']) && !empty($_POST['wine-millesime']) && !empty($_POST['wine-region']) && !empty($_POST['wine-caracteristiques']) && !empty($_POST['wine-met']) && !empty($_FILES['wine-met-image']) && !empty($_POST['wine-prix']) && !empty($_POST['wine-caviste']))
    {
        $errors = array();
        $success = array();
        $wineManager = WineManager::getInstance();
        try
        {
            $vin = new Vin();
            $vin->nom = $_POST['wine-nom'];
            $vin->couleur = $_POST['wine-couleur'];
            $vin->millesime = $_POST['wine-millesime'];
            $vin->region = $_POST['wine-region'];
            $vin->caracteristiques = $_POST['wine-caracteristiques'];
            $vin->met = $_POST['wine-met'];
            $vin->met_url = $wineManager->handleImageUpload('wine-met-image');
            $vin->prix = $_POST['wine-prix'];
            $vin->caviste = $_POST['wine-caviste'];

            if($wineManager->addVin($vin))
                $success[] = "Vin ajouté avec succès";
            else
                $errors[] = "Une erreur est survenue lors de l'ajout du vin";
        }
        catch(ErrorException $e)
        {
            if($e->getCode() == 101001)
                $errors[] = "Un problème est survenu lors du traitement de l'image. ".$e->getMessage();
            else
                $errors[] = "Une erreur est survenue lors de l'ajout du vin";
        }
        catch(Exception $e)
        {
            $errors[] = "Une erreur est survenue lors de l'ajout du vin";
        }
    }
    else
    {
        $errors[] = "Vous devez remplir tous les champs svp.";
    }
}
else if(!empty($_GET))
{
    if(!empty($_GET['action']) && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        $action = $_GET['action'];
        if($action == 'delete')
        {
            try{
                if(WineManager::getInstance()->deleteVin($id))
                    $success[] = "Le vin a été supprimé avec succès";
                else
                    $errors[] = "Une erreur est survenue lors de la suppression";
            }
            catch(Exception $e)
            {
                $errors[] = "Une erreur inconnue s'est produite";
            }
        }
    }
}
//recup des vins
$vins = WineManager::getInstance()->getAllVins();

require_once "templates/header.php";
require_once "templates/modals/add-wine-modal.html";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#wine-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
    </div>
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block">
            <header>
                <h2>Liste des vins</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($vins as $wine)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=vin&id='.$wine['id'].'">'.encodeCharset($wine['nom']).'</a>'; ?>
                        <div class="btn-group pull-right">
                            <a href="edit.php?type=vin&id=<?php echo $wine['id']; ?>" class="btn btn-success btn-xs" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="vins.php?action=delete&id=<?php echo $wine['id']; ?>" class="btn btn-primary btn-xs" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </section>
    </div>
</div>
<?php
require_once "templates/footer.php";
?>
