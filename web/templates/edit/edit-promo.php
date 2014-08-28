<section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
    <header>
        <h2>Modifier une promotion</h2>
    </header>
    <form action="edit.php?type=promo&id=<?php echo $id; ?>" method="post">
        <div class="form-group">
            <label for="promotion-nom">Nom :</label>
            <input class="form-control" type="text" name="promotion-nom" id="promotion-nom" required value="<?php echo $promoGet->nom ?>"/>
        </div>
        <div class="form-group">
            <label for="promotion-categorie">Catégorie :</label>
            <input class="form-control" type="text" name="promotion-categorie" id="promotion-categorie" required value="<?php echo $promoGet->categorie ?>"/>
        </div>
        <div class="form-group">
            <label for="promotion-partenaire">Partenaire :</label>
            <select name="promotion-partenaire" id="promotion-partenaire" class="form-control">
                <?php
                foreach($partenaires as $partner)
                {
                    if($promoGet->partenaire_id == $partner['id'])
                        echo '<option value="'.$partner['id'].'" selected>'.$partner['nom'].'</option>';
                    else
                        echo '<option value="'.$partner['id'].'">'.$partner['nom'].'</option>';
                }
                ?>
            </select>
        </div>
        <input type="submit" class="btn btn-primary center-block" value="Modifier"/>
    </form>
</section>