<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ahjav: Association Havraise des jeunes amateurs de vin</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
    <link rel="shortcut icon" type="image/png" href="assets/img/ahjav-icon.png"/>
    <script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ahjav-menu-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
                <img src="assets/img/ahjav-logo.png" alt="Logo" id="ahjav-logo"/>
                <div id="ahjav-brand">AHJAV</div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="ahjav-menu-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></sp></a></li>
                <li><a href="vins.php">Vins</a></li>
                <li class="dropdown">
                    <a href="partenaires.php" class="dropdown-toggle" data-toggle="dropdown">Partenaires&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="partenaires.php">Partenaires</a></li>
                        <li><a href="promos.php">Promotions</a></li>
                    </ul>
                </li>
                <li><a href="anecdotes.php">Anecdotes</a></li>
                <li><a href="actualites.php">Actualites</a></li>
                <li><a href="quizz.php">Questions</a></li>
                <li><a href="sponsors.php">Sponsors</a></li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" title="Deconnexion"><span class="glyphicon glyphicon-user"></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li class="dropdown-header"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $_SESSION['user']['username'] ?></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>&nbsp;Déconnexion</a></li>
                            <li class="divider"></li>
                            <li><a href="add_user.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter un utilisateur</a></li>
                        </ul>
                    </li>
            </ul>
        </div>
    </div>
</nav>