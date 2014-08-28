<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\PromoManager;
use ahjav\models\manager\PartenairesManager;
if(!empty($_POST))
{
    if(!empty($_POST['promotion-nom']) && !empty($_POST['promotion-categorie']) && !empty($_POST['promotion-partenaire']))
    {
        $errors = array();
        $success = array();

        $promotion = new Promotion();
        $promotion->nom = $_POST['promotion-nom'];
        $promotion->categorie = $_POST['promotion-categorie'];
        $promotion->partenaire_id = $_POST['promotion-partenaire'];
        if(!empty($_FILES['promo-image']) && !empty($_FILES['promo-image']['tmp_name']))
        {
            try
            {
                $promotion->image = PromoManager::getInstance()->handleImageUpload('promo-image');
            }
            catch(ErrorException $e)
            {
                $errors[] = "Une erreur est survenue lors du téléchargement de l'image.";
            }
        }

        if(PromoManager::getInstance()->addPromo($promotion))
            $success[] = "Promotion ajoutée avec succès";
        else
            $errors[] = "Une erreur est survenue lors de l'ajout de la promotion";
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
                if(PromoManager::getInstance()->deletePromotion($id))
                    $success[] = "La promotion a été supprimée avec succès";
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
$promotions = PromoManager::getInstance()->getAllPromos();
$partenaires = PartenairesManager::getInstance()->getAllPartenaires();
require_once "templates/header.php";
require_once "templates/modals/add-promo-modal.php";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#promo-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
    </div>
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block">
            <header>
                <h2>Liste des promotions</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($promotions as $promo)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=promo&id='.$promo['id'].'">'.$promo['nom'].'</a>'; ?>
                    <div class="btn-group pull-right">
                        <a href="edit.php?type=promo&id=<?php echo $promo['id']; ?>" class="btn btn-success btn-xs" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="promos.php?action=delete&id=<?php echo $promo['id']; ?>" class="btn btn-primary btn-xs" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
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
