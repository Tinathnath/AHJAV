<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\ActusManager;
if(!empty($_POST))
{
    if(!empty($_POST['actualite-titre']) && !empty($_POST['actualite-texte']))
    {
        try
        {
            $errors = array();
            $success = array();
            $actualite = new Actualite();
            $actualite->titre = $_POST['actualite-titre'];
            $actualite->content = $_POST['actualite-texte'];
            $actualite->actuDate = date('Y-m-d');
            if(!empty($_FILES['actualite-image']) && !empty($_FILES['actualite-image']['tmp_name']))
            {
                $actualite->image = ActusManager::getInstance()->handleImageUpload('actualite-image');
            }

            if(ActusManager::getInstance()->addActus($actualite))
                $success[] = "Actualité ajoutée avec succès";
            else
                $errors[] = "Une erreur est survenue lors de l'ajout de l'actualité";
        }
        catch(ErrorException $e)
        {
            if($e->getCode() == 101001)
                $errors[] = "Un problème est survenu lors du traitement de l'image. ".$e->getMessage();
            else
                $errors[] = "Une erreur est survenue lors de l'ajout de l'actualité";
        }
        catch(Exception $e)
        {
            $errors[] = "Une erreur est survenue lors de l'ajout de l'actualité";
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
                if(ActusManager::getInstance()->deleteActualite($id))
                    $success[] = "L'actualité a été supprimée avec succès";
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
$actualites = ActusManager::getInstance()->getAllActualites();

require_once "templates/header.php";
require_once "templates/modals/add-actualite-modal.html";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#actualite-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
    </div>
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block">
            <header>
                <h2>Liste des actualités</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($actualites as $actu)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=actualite&id='.$actu['id'].'">'.encodeCharset($actu['titre']).'</a>'; ?>
                    <div class="btn-group pull-right">
                        <a href="edit.php?type=actualite&id=<?php echo $actu['id']; ?>" class="btn btn-success btn-xs" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="actualites.php?action=delete&id=<?php echo $actu['id']; ?>" class="btn btn-primary btn-xs" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
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
