<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\WineManager;
use ahjav\models\manager\AnecdoteManager;
use ahjav\models\manager\QuestionManager;
use ahjav\models\manager\PartenairesManager;
use ahjav\models\manager\PromoManager;
use ahjav\models\manager\SponsorManager;
use ahjav\models\manager\ActusManager;
if(!empty($_GET))
{
    if(!empty($_GET['type']) && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        $type = $_GET['type'];
        $errors = array();
        $success = array();
        if($type == 'vin')
        {
            //gestion form
            if(!empty($_POST))
            {
                if(!empty($_POST['wine-nom']) && !empty($_POST['wine-couleur']) && !empty($_POST['wine-millesime']) && !empty($_POST['wine-region']) && !empty($_POST['wine-caracteristiques']) && !empty($_POST['wine-met']) && !empty($_POST['wine-prix']) && !empty($_POST['wine-caviste']))
                {
                    $vin = new Vin();
                    $vin->nom = $_POST['wine-nom'];
                    $vin->couleur = $_POST['wine-couleur'];
                    $vin->millesime = $_POST['wine-millesime'];
                    $vin->region = $_POST['wine-region'];
                    $vin->caracteristiques = $_POST['wine-caracteristiques'];
                    $vin->met = $_POST['wine-met'];
                    $vin->prix = $_POST['wine-prix'];
                    $vin->caviste = $_POST['wine-caviste'];
                    $vin->id = $id;

                    if(!empty($_FILES['wine-met-image']) && !empty($_FILES['wine-met-image']['tmp_name']))
                    {
                        try
                        {
                            $vin->met_url = WineManager::getInstance()->handleImageUpload('wine-met-image');
                            if(!empty($_POST['wine-met-image-name']))
                                WineManager::getInstance()->deleteImage($_POST['wine-met-image-name']);
                        }
                        catch(Exception $e)
                        {
                            if($e->getCode() == 101001)
                                $errors[] = "Un problème est survenu lors du traitement de l'image. ".$e->getMessage();
                            else
                                $errors[] = "Une erreur est survenue lors de la modification du vin";
                        }
                    }
                    else
                        $vin->met_url = $_POST['wine-met-image-name'];

                    if(WineManager::getInstance()->updateVin($vin))
                        $success[] = "Vin modifié avec succès";
                    else
                        $errors[] = "Une erreur est survenue lors de la modification du vin";
                }
                else
                {
                    $errors[] = "Vous devez remplir tous les champs svp.";
                }
            }

            //getVin
            $vinGet = WineManager::getInstance()->getVinById($id);
        }
        else if($type == 'anecdote')
        {
            if(!empty($_POST))
            {
                if(!empty($_POST['anecdote-titre']) && !empty($_POST['anecdote-texte']))
                {
                    $anecdote = new Anecdote();
                    $anecdote->titre = $_POST['anecdote-titre'];
                    $anecdote->texte = $_POST['anecdote-texte'];
                    $anecdote->id = $id;

                    if(AnecdoteManager::getInstance()->updateAnecdote($anecdote))
                        $success[] = "Anecdote modifiée avec succès";
                    else
                        $errors[] = "Une erreur est survenue lors de la modification de l'anecdote";
                }
                else
                {
                    $errors[] = "Vous devez remplir tous les champs svp.";
                }
            }

            //get Anecdote
            $anecdoteGet = AnecdoteManager::getInstance()->getAnecdoteById($id);
        }
        else if($type == 'question')
        {
            if(!empty($_POST))
            {
                if(!empty($_POST['question-theme']) && !empty($_POST['question-question']) && !empty($_POST['question-good-answer']) && !empty($_POST['question-bad-answer-1']) && !empty($_POST['question-bad-answer-2']) && !empty($_POST['question-explanation']))
                {
                    $question = new Question();
                    $question->theme = $_POST['question-theme'];
                    $question->question = $_POST['question-question'];
                    $question->good_answer = $_POST['question-good-answer'];
                    $question->false_answer_A = $_POST['question-bad-answer-1'];
                    $question->false_answer_B = $_POST['question-bad-answer-2'];
                    $question->explanation = $_POST['question-explanation'];
                    $question->id = $id;

                    if(QuestionManager::getInstance()->updateQuestion($question))
                        $success[] = "Question modifiée avec succès";
                    else
                        $errors[] = "Une erreur est survenue lors de la modification de la question";
                }
                else
                {
                    $errors[] = "Vous devez remplir tous les champs svp.";
                }
            }
            $questionGet = QuestionManager::getInstance()->getQuestionById($id);
        }
        elseif($type == 'partenaire')
        {
            if(!empty($_POST))
            {
                if(!empty($_POST['partenaire-nom']) && !empty($_POST['partenaire-url']) && !empty($_POST['partenaire-adresse']) && !empty($_POST['partenaire-lat']) && !empty($_POST['partenaire-lng']))
                {
                    $partenaire = PartenairesManager::getInstance()->getPartenaireById($id);
                    $partenaire->nom = $_POST['partenaire-nom'];
                    $partenaire->url = $_POST['partenaire-url'];
                    $partenaire->address = $_POST['partenaire-adresse'];
                    $partenaire->lat = $_POST['partenaire-lat'];
                    $partenaire->lng = $_POST['partenaire-lng'];
                    $partenaire->id = $id;

                    if(PartenairesManager::getInstance()->updatePartenaire($partenaire))
                        $success[] = "Partenaire modifié avec succès";
                    else
                        $errors[] = "Une erreur est survenue lors de la modification du partenaire";
                }
                else
                {
                    $errors[] = "Vous devez remplir tous les champs svp.";
                }
            }
            $partnerGet = PartenairesManager::getInstance()->getPartenaireById($id);
        }
        else if($type == 'promo')
        {
            if(!empty($_POST))
            {
                if(!empty($_POST['promotion-nom']) && !empty($_POST['promotion-categorie']) && !empty($_POST['promotion-partenaire']))
                {
                    $promotion = new Promotion();
                    $promotion->nom = $_POST['promotion-nom'];
                    $promotion->categorie = $_POST['promotion-categorie'];
                    $promotion->partenaire_id = $_POST['promotion-partenaire'];
                    $promotion->id = $id;

                    if(PromoManager::getInstance()->updatePromotion($promotion))
                        $success[] = "Promotion modifiée avec succès";
                    else
                        $errors[] = "Une erreur est survenue lors de la modification de la promotion";
                }
                else
                {
                    $errors[] = "Vous devez remplir tous les champs svp.";
                }
            }
            $promoGet = PromoManager::getInstance()->getPromoById($id);
            $partenaires = PartenairesManager::getInstance()->getAllPartenaires();
        }
        else if($type == 'sponsor')
        {
            if(!empty($_POST))
            {
                if(!empty($_POST['sponsor-name']) && !empty($_POST['sponsor-website']))
                {
                    $sponsor = new Sponsor();
                    $sponsor->nom = $_POST['sponsor-name'];
                    $sponsor->website = $_POST['sponsor-website'];
                    $sponsor->id = $id;

                    if(SponsorManager::getInstance()->updateSponsor($sponsor))
                        $success[] = "Sponsor modifié avec succès";
                    else
                        $errors[] = "Une erreur est survenue lors de la modification du sponsor";
                }
                else
                {
                    $errors[] = "Vous devez remplir tous les champs svp.";
                }
            }
            $sponsorGet = SponsorManager::getInstance()->getSponsorById($id);
        }
        else if($type == 'actualite')
        {
            if(!empty($_POST))
            {
                if(!empty($_POST['actualite-title']) && !empty($_POST['actualite-content']))
                {
                    $actu = ActusManager::getInstance()->getActualiteById($id);
                    $actu->titre = $_POST['actualite-title'];
                    $actu->content = $_POST['actualite-content'];
                    $actu->id = $id;

                    if(ActusManager::getInstance()->updateActualite($actu))
                        $success[] = "Actualité modifiée avec succès";
                    else
                        $errors[] = "Une erreur est survenue lors de la modification de l'actualité";
                }
                else
                {
                    $errors[] = "Vous devez remplir tous les champs svp.";
                }
            }
            $actuGet = ActusManager::getInstance()->getActualiteById($id);
        }
    }
    else
        header('location: index.php');
}
else
    header('location: index.php');

require_once "templates/header.php";
?>
<div class="container main-container">
    <?php require_once "templates/show-errors.php"; ?>
    <section class="recap-block-container">
        <div class="row">
        <?php
        switch($type)
        {
            case 'vin':
                require_once "templates/edit/edit-wine.php";
                break;
            case 'anecdote':
                require_once "templates/edit/edit-anecdote.php";
                break;
            case 'question':
                require_once "templates/edit/edit-question.php";
                break;
            case 'partenaire':
                require_once "templates/edit/edit-partenaire.php";
                break;
            case 'promo':
                require_once "templates/edit/edit-promo.php";
                break;
            case 'sponsor':
                require_once "templates/edit/edit-sponsor.php";
                break;
            case 'actualite':
                require_once "templates/edit/edit-actu.php";
                break;
        }
        ?>
        </div>
    </section>
</div>
<?php
require_once "templates/footer.php";
?>