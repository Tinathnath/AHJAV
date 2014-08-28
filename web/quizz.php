<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\models\manager\QuestionManager;
if(!empty($_POST))
{
    if(!empty($_POST['question-theme']) && !empty($_POST['question-question']) && !empty($_POST['question-good-answer']) && !empty($_POST['question-bad-answer-1']) && !empty($_POST['question-bad-answer-2']) && !empty($_POST['question-explanation']))
    {
        $errors = array();
        $success = array();
        $question = new Question();
        $question->theme = $_POST['question-theme'];
        $question->question = $_POST['question-question'];
        $question->good_answer = $_POST['question-good-answer'];
        $question->false_answer_A = $_POST['question-bad-answer-1'];
        $question->false_answer_B = $_POST['question-bad-answer-2'];
        $question->explanation = $_POST['question-explanation'];

        if(QuestionManager::getInstance()->addQuestion($question))
            $success[] = "Question ajoutée avec succès";
        else
            $errors[] = "Une erreur est survenue lors de l'ajout de la question";
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
                if(QuestionManager::getInstance()->deleteQuestion($id))
                    $success[] = "La question a été supprimée avec succès";
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
$questions = QuestionManager::getInstance()->getAllQuestions();

require_once "templates/header.php";
require_once "templates/modals/add-question-modal.html";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#question-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
    </div>
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block">
            <header>
                <h2>Liste des questions</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($questions as $question)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=question&id='.$question['id'].'">'.encodeCharset($question['question']).'</a>'; ?>
                    <div class="btn-group pull-right">
                        <a href="edit.php?type=question&id=<?php echo $question['id']; ?>" class="btn btn-success btn-xs" title="Editer"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="quizz.php?action=delete&id=<?php echo $question['id']; ?>" class="btn btn-primary btn-xs" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
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
