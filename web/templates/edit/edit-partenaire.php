<section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
    <header>
        <h2>Modifier un partenaire</h2>
    </header>
    <form action="edit.php?type=partenaire&id=<?php echo $id; ?>" method="post">
        <div class="form-group">
            <label for="partenaire-nom">Nom:</label>
            <input class="form-control" type="text" name="partenaire-nom" id="partenaire-nom" required value="<?php echo $partnerGet->nom ?>"/>
        </div>
        <div class="form-group">
            <label for="partenaire-url">Adresse du site web:</label>
            <input class="form-control" type="url" name="partenaire-url" id="partenaire-url" value="<?php echo $partnerGet->url ?>"/>
        </div>
        <div class="form-group">
            <label for="partenaire-adresse">Adresse:</label>
            <textarea class="form-control" name="partenaire-adresse" id="partenaire-adresse" rows="2" required><?php echo $partnerGet->address ?></textarea>
        </div>
        <div class="form-group">
            <label for="partenaire-lat">Coordonnées GPS:</label>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Lat.</span>
                        <input class="form-control" type="text" name="partenaire-lat" id="partenaire-lat" required value="<?php echo $partnerGet->lat ?>"/>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Lng.</span>
                        <input class="form-control" type="text" name="partenaire-lng" id="partenaire-lng" required value="<?php echo $partnerGet->lng ?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" value="Modifier"/>
        </div>
    </form>
</section>