<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\SponsorManager;
if(!empty($_POST))
{
    if(!empty($_POST['sponsor-name']) && !empty($_POST['sponsor-website']) && !empty($_FILES['sponsor-image']['tmp_name']))
    {
        $errors = array();
        $success = array();
        try
        {
            $sponsor = new Sponsor();
            $sponsor->nom = $_POST['sponsor-name'];
            $sponsor->website =  $_POST['sponsor-website'];
            $sponsor->logo_url = SponsorManager::getInstance()->handleImageUpload('sponsor-image');

            if(SponsorManager::getInstance()->addSponsor($sponsor))
                $success[] = "Sponsor ajouté avec succès";
            else
                $errors[] = "Une erreur est survenue lors de l'ajout du sponsor";
        }
        catch(ErrorException $e)
        {
            if($e->getCode() == 101001)
                $errors[] = "Un problème est survenu lors du traitement de l'image. ".$e->getMessage();
            else
                $errors[] = "Une erreur est survenue lors de l'ajout du sponsor";
        }
        catch(Exception $e)
        {
            $errors[] = "Une erreur est survenue lors de l'ajout du sponsor";
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
                if(SponsorManager::getInstance()->deleteSponsor($id))
                    $success[] = "Le sponsor a été supprimé avec succès";
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
//recup des sponsors
$sponsors = SponsorManager::getInstance()->getAllSponsors();

require_once "templates/header.php";
require_once "templates/modals/add-sponsor-modal.html";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#sponsor-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
    </div>
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block">
            <header>
                <h2>Liste des sponsors</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($sponsors as $sponsor)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=sponsor&id='.$sponsor['id'].'">'.encodeCharset($sponsor['nom']).'</a>'; ?>
                    <div class="btn-group pull-right">
                        <a href="edit.php?type=sponsor&id=<?php echo $sponsor['id']; ?>" class="btn btn-success btn-xs" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="sponsors.php?action=delete&id=<?php echo $sponsor['id']; ?>" class="btn btn-primary btn-xs" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
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
