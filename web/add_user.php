<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\utils\SecurityController;
use ahjav\models\manager\UserManager;
$errors = array();
$success = array();
if(!empty($_POST))
{
    if(!empty($_POST['username']) && !empty($_POST['passwordFirst']) && !empty($_POST['passwordSecond']))
    {
        $securityController = new SecurityController();
        if(!$securityController->checkUserExists($_POST['username']) instanceof User)
        {
            if($_POST['passwordFirst'] == $_POST['passwordSecond'])
            {
                $user = new User();
                $salt = $securityController->generateSalt();
                $passPhrase = $securityController->hashPasswd($_POST['passwordFirst'], $salt);
                $user->username = $_POST['username'];
                $user->salt = $salt;
                $user->passphrase = $passPhrase;
                if(UserManager::getInstance()->addUser($user))
                    $success[] = "Utilisateur ajouté avec succès";
                else
                    $errors[] = "Une erreur est survenue lors de l'ajout de l'utilisateur";
            }
            else
                $errors[] = "Les deux mots de passe ne sont pas identiques";
        }
        else
            $errors[] = "Cet utilisateur existe déjà";
    }
    else
        $errors[] = "Vous devez remplir tous les champs.";
}

require_once "templates/header.php";
?>
<div class="container main-container">
    <?php require_once"templates/show-errors.php"; ?>
    <div class="row">
        <section class="recap-block-container">
            <section class="col-md-12 col-xs-12 recap-block">
                <header>
                    <h2>Ajouter un utilisateur</h2>
                </header>
                <form action="add_user.php" method="post">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur :</label>
                        <input class="form-control" type="text" name="username" id="username" required />
                    </div>
                    <div class="form-group">
                        <label for="passwordFirst">Mot de passe :</label>
                        <input class="form-control" type="password" name="passwordFirst" id="passwordFirst" required/>
                    </div>
                    <div class="form-group">
                        <label for="passwordSecond">Confirmation :</label>
                        <input class="form-control" type="password" name="passwordSecond" id="passwordSecond" required/>
                    </div>
                    <input type="submit" class="btn btn-primary center-block" value="Ajouter"/>
                </form>
            </section>
        </section>
    </div>
</div>
<?php
require_once "templates/footer.php";
?>
