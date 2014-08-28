<?php
require_once(dirname(__FILE__).'/../config/global.php');
require_once(dirname(__FILE__).'/templates/secure-page.php');
use ahjav\utils\JSONEncoder;
use ahjav\models\manager;

$vins = manager\WineManager::getInstance()->getLastWines();
$anecdotes = manager\AnecdoteManager::getInstance()->getLastAnecdotes();
$partenaires = manager\PartenairesManager::getInstance()->getLastPartenaires();

require_once "templates/header.php";
require_once "templates/modals.php";
?>
<div class="container main-container">
    <!--VINS ET ANECDOTES -->
    <div class="row">
        <section class="col-md-6 col-xs-12 recap-block-container">
            <div class="row">
                <section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
                    <header>
                        <h2>Derniers vins ajoutés</h2>
                    </header>
                    <ul class="list-group">
                        <?php
                        foreach($vins as $wine)
                        {
                            echo '<li class="list-group-item"><a href="edit.php?type=vin&id='. $wine['id'].'">'.encodeCharset($wine['nom']).'</a></li>';
                        }
                        ?>
                    </ul>
                    <a href="#" class="col-md-3 col-md-offset-9 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#wine-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
                </section>
            </div>
        </section>
        <section class="col-md-6 col-xs-12 recap-block-container">
            <div class="row">
                <section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
                    <header>
                        <h2>Dernières anecdotes</h2>
                    </header>
                    <ul class="list-group">
                        <?php
                        foreach($anecdotes as $anecdote)
                        {
                            echo '<li class="list-group-item"><a href="edit.php?type=anecdote&id='.$anecdote['id'].'">'.encodeCharset($anecdote['titre']).'</a></li>';
                        }
                        ?>
                    </ul>
                    <a href="#" class="col-md-3 col-md-offset-9 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#anecdote-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
                </section>
            </div>
        </section>
    </div>
    <!-- PARTENAIRES -->
    <div class="row">
        <section class="col-md-12 col-xs-12 recap-block" id="partenaire-block">
            <header>
                <h2>Derniers partenaires</h2>
            </header>
            <ul class="list-group">
                <?php
                foreach($partenaires as $partner)
                {
                    echo '<li class="list-group-item"><a href="edit.php?type=partenaire&id='.$partner['id'].'">'.encodeCharset($partner['nom']).'</a></li>';
                }
                ?>
            </ul>
            <a href="#" class="col-md-2 col-md-offset-10 col-xs-12 col-sm-5 col-sm-offset-7 btn btn-primary" data-toggle="modal" data-target="#partner-modal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
        </section>
    </div>
</div>

<?php
    require_once "templates/footer.php";
?>