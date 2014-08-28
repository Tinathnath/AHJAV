<?php
require_once(dirname(__FILE__).'/../config/global.php');
use ahjav\utils\SecurityController;
use ahjav\models\manager\UserManager;
$errors = array();
if(!empty($_POST))
{
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $securityController = new SecurityController();
        if(null != $user = $securityController->checkUserExists($_POST['username']))
        {
            session_start();
            if($securityController->Login($user))
            {
                header('location: index.php');
            }
            else
                $errors[] = "Nom d'utilisateur ou mot de passe incorrect.";
        }
        else
        {
            $errors[] = "Cet utilisateur n'existe pas.";
        }
    }
    else
    {
        $errors[] = "Vous devez fournir un utilisateur et un mot de passe";
    }
}
?>
<!doctype html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>AHJAV Admin: Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style-login.css"/>
    <link rel="shortcut icon" type="image/png" href="assets/img/ahjav-icon.png"/>
    <script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand">
                <img src="assets/img/ahjav-logo.png" alt="Logo" id="ahjav-logo"/>
                <div id="ahjav-brand">AHJAV</div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="ahjav-menu-collapse"></div>
    </div>
</nav>
<div class="container-fluid main-container">
    <?php
    if(isset($errors) && sizeof($errors) > 0)
    {
        echo '<div class="container">';
        foreach($errors as $error)
        {
            echo '<div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
                  <strong><i class="fa fa-exclamation-circle"></i>&nbsp;Erreur: </strong>'.$error.'
               </div>';
        }
        echo '</div>';
    }
    ?>
    <div class="login-form-container col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
        <div class="row">
            <div class="login-image col-xs-4 col-xs-offset-2">
                <div class="row">
                    <img src="assets/img/ahjav-logo.png" alt="" class="col-xs-10 col-xs-offset-1"/>
                </div>
            </div>
            <div class="form-login col-xs-5 arrow_box">
                <form action="login.php" method="post">
                    <div class="row">
                        <div class="form-group input-group input-group-sm col-xs-10 col-xs-offset-1">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                            <input type="text" class="form-control" name="username" placeholder="Utilisateur"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group input-group input-group-sm col-xs-10 col-xs-offset-1">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-7 col-xs-offset-5">
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-off"></span>&nbsp;Connexion
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>