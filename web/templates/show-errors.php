<!-- Alertes (retour des scripts) -->
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

if(isset($success) && sizeof($success) > 0)
{
    echo '<div class="container">';
    foreach($success as $ok)
    {
        echo '<div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
                  <i class="fa fa-check"></i>'.$ok.'
               </div>';
    }
    echo '</div>';
}
?>