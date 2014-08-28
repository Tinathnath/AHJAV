<section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
    <header>
        <h2>Modifier un sponsor</h2>
    </header>
    <form action="?type=sponsor&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="sponsor-name">Nom:</label>
            <input class="form-control" type="text" name="sponsor-name" id="sponsor-name" required value="<?php echo $sponsorGet->nom ?>"/>
        </div>
        <div class="form-group">
            <label for="sponsor-website">Adresse du site web:</label>
            <input type="url" name="sponsor-website" id="sponsor-website" rows="4" class="form-control" placeholder="http://" required value="<?php echo $sponsorGet->website ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" value="Modifier" />
        </div>
    </form>
</section>