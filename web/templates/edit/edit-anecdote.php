<section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
    <header>
        <h2>Modifier une anecdote</h2>
    </header>
    <form action="edit.php?type=anecdote&id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="anecdote-titre">Titre:</label>
                <input class="form-control" type="text" name="anecdote-titre" id="anecdote-titre" value="<?php echo $anecdoteGet->titre; ?>"/>
            </div>
            <div class="form-group">
                <label for="anecdote-texte">Texte:</label>
                <textarea name="anecdote-texte" id="anecdote-texte" rows="4" class="form-control"><?php echo $anecdoteGet->texte; ?></textarea>
            </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" value="Modifier" />
        </div>
    </form>
</section>