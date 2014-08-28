<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\PartenairesManager;
if(!empty($_POST))
{
    if(!empty($_POST['partenaire-nom']) && !empty($_POST['partenaire-url']) && !empty($_POST['partenaire-adresse']) && !empty($_POST['partenaire-lat']) && !empty($_POST['partenaire-lng']))
    {
        $errors = array();
        $success = array();
        $partenaire = new Partenaire();
        $partenaire->nom = $_POST['partenaire-nom'];
        $partenaire->url = $_POST['partenaire-url'];
        $partenaire->address = $_POST['partenaire-adresse'];
        $partenaire->lat = $_POST['partenaire-lat'];
        $partenaire->lng = $_POST['partenaire-lng'];
        if(!empty($_FILES['partenaire-image']) && !empty($_FILES['partenaire-image']['tmp_name']))
        {
            $partenaire->image = PartenairesManager::getInstance()->handleImageUpload('partenaire-image');
        }

        if(PartenairesManager::getInstance()->addPartenaire($partenaire))
            $success[] = "Partenaire ajouté avec succès";
        else
            $errors[] = "Une erreur est survenue lors de l'ajout du partenaire";
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
                if(PartenairesManager::getInstance()->deletePartenaire($id))
                    $success[] = "Le partenaire a été supprimé avec succès";
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
$partenaires = PartenairesManager::getInstance()->getAllPartenaires();

require_once "templates/header.php";
require_once "templates/map-js.html";
require_once "templates/modals/add-partenaire-modal.html";
require_once "templates/modals/show-promo-modal.php";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#partner-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
    </div>
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block">
            <header>
                <h2>Liste des partenaires</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($partenaires as $partner)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=partenaire&id='.$partner['id'].'">'.encodeCharset($partner['nom']).'</a>'; ?>
                    <div class="btn-group pull-right">
                        <a href="#" class="btn btn-xs btn-info" title="Liste des promotions" data-toggle="modal" data-target="#show-promos-modal" data-partner="<?php echo $partner['id'];?>" ><span class="glyphicon glyphicon-barcode"></span>&nbsp; Promotions</a>
                        <a href="edit.php?type=partenaire&id=<?php echo $partner['id']; ?>" class="btn btn-success btn-xs" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="partenaires.php?action=delete&id=<?php echo $partner['id']; ?>" class="btn btn-primary btn-xs" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#show-promos-modal").on('show.bs.modal', function(e){
            $("#show-promo-body").html('');
            $.ajax({
                url: '../api/getPromos.php',
                data: {
                    'id' : $(e.relatedTarget).data('partner')
                }
            }).done(function(data, status, xhr){
                if(data != null && data != "undefined")
                {
                    var returnType = xhr.getResponseHeader("content-type");
                    var jObject;
                    var htmlString = '';
                    try
                    {
                        if(returnType == "application/json")
                            jObject = data;
                        else
                            jObject = JSON.parse(data);
                        if(jObject.length > 0)
                        {
                            var c = jObject.length;
                            htmlString = '<ul>';
                            for(var i = 0; i<c; i++)
                            {
                                htmlString+='<li class="list-group-item"><a href="edit.php?type=promo&id='+jObject[i].id+'">';
                                htmlString+= jObject[i].nom;
                                htmlString+= '</a></li>'
                            }
                            htmlString+= '</ul>';
                        }
                        else
                            htmlString = '<div class="alert alert-info">Il n\'y a pas de promotions pour ce partenaire</div>';
                    }
                    catch(e)
                    {
                        htmlString = '<div class="alert alert-danger">Erreur: Impossible de récupérer les promotions</div>';
                    }
                }
                $("#show-promo-body").html(htmlString);
            }).fail(function(error){
                var htmlString = '<div class="alert alert-danger">Erreur: Impossible de récupérer les promotions</div>';
                $("#show-promo-body").html(htmlString);
            });
        });
    });
</script>
<?php
require_once "templates/footer.php";
?>
