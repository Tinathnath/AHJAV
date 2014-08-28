<section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
    <header>
        <h2>Modifier un vin</h2>
    </header>
<form action="edit.php?type=vin&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="wine-nom">Nom :</label>
        <input type="text" name="wine-nom" id="wine-nom" class="form-control" required value="<?php echo $vinGet->nom; ?>"/>
    </div>
    <div class="form-group">
        <label for="wine-couleur">Couleur : </label>
        <select name="wine-couleur" id="wine-couleur" class="form-control" required>
            <option value="Rouge" <?php if($vinGet->couleur == 'Rouge') echo 'selected'; ?>>Rouge</option>
            <option value="Blanc" <?php if($vinGet->couleur == 'Blanc') echo 'selected'; ?>>Blanc</option>
            <option value="Rosé" <?php if($vinGet->couleur == 'Rosé') echo 'selected'; ?>>Rosé</option>
        </select>
    </div>
    <div class="form-group">
        <label for="wine-millesime">Millésime : </label>
        <input class="form-control" type="text" name="wine-millesime" id="wine-millesime" required value="<?php echo $vinGet->millesime; ?>"/>
    </div>
    <div class="form-group">
        <label for="wine-region">Région :</label>
        <input class="form-control" type="text" name="wine-region" id="wine-region" required value="<?php echo $vinGet->region; ?>"/>
    </div>
    <div class="form-group">
        <label for="wine-caracteristiques">Caractéristiques :</label>
        <input class="form-control" type="text" name="wine-caracteristiques" id="wine-caracteristiques" required value="<?php echo $vinGet->caracteristiques; ?>"/>
    </div>
    <div class="form-group">
        <label for="wine-met">Met associé :</label>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Nom: </span>
                    <input class="form-control" type="text" name="wine-met" id="wine-met" required value="<?php echo $vinGet->met; ?>"/>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Image:</span>
                    <input name="wine-met-image-name" type="hidden" value="<?php echo $vinGet->met_url; ?>"/>
                    <input class="form-control" type="file" name="wine-met-image" id="wine-met-url" accept="image/*"/>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="wine-prix">Prix :</label>
        <input class="form-control" type="number" step="0.1" name="wine-prix" id="wine-prix" required value="<?php echo $vinGet->prix; ?>"/>
    </div>
    <div class="from-group">
        <label for="wine-caviste">Caviste :</label>
        <input class="form-control" type="text" name="wine-caviste" id="wine-caviste" value="<?php echo $vinGet->caviste; ?>"/>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary center-block" value="Modifier"/>
    </div>
</form>
    </section>