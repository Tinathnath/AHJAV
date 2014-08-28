<section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
    <header>
        <h2>Modifier une actualité</h2>
    </header>
    <form action="?type=actualite&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="actualite-title">Titre:</label>
            <input class="form-control" type="text" name="actualite-title" id="actualite-title" required value="<?php echo $actuGet->titre ?>"/>
        </div>
        <div class="form-group">
            <label for="actualite-content">Texte:</label>
            <textarea name="actualite-content" id="actualite-content" rows="4" class="form-control"><?php echo $actuGet->content ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" value="Modifier" />
        </div>
    </form>
</section>