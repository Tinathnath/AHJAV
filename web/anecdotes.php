<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\AnecdoteManager;
if(!empty($_POST))
{
    if(!empty($_POST['anecdote-titre']) && !empty($_POST['anecdote-texte']))
    {
        $errors = array();
        $success = array();
        $anecdote = new Anecdote();
        $anecdote->titre = $_POST['anecdote-titre'];
        $anecdote->texte = $_POST['anecdote-texte'];

        if(AnecdoteManager::getInstance()->addAnecdote($anecdote))
            $success[] = "Anecdote ajoutée avec succès";
        else
            $errors[] = "Une erreur est survenue lors de l'ajout de l'anecdote";
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
                if(AnecdoteManager::getInstance()->deleteAnecdote($id))
                    $success[] = "L'anecdote a été supprimée avec succès";
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
$anecdotes = AnecdoteManager::getInstance()->getAllAnecdotes();

require_once "templates/header.php";
require_once "templates/modals/add-anecdote-modal.html";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#anecdote-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
    </div>
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block">
            <header>
                <h2>Liste des anecdotes</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($anecdotes as $anecdote)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=anecdote&id='.$anecdote['id'].'">'.encodeCharset($anecdote['titre']).'</a>'; ?>
                    <div class="btn-group pull-right">
                        <a href="edit.php?type=anecdote&id=<?php echo $anecdote['id']; ?>" class="btn btn-success btn-xs" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="anecdotes.php?action=delete&id=<?php echo $anecdote['id']; ?>" class="btn btn-primary btn-xs" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
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
