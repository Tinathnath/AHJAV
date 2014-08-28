<div class="modal fade" id="promo-modal" tabindex="-1" role="dialog" aria-labelledby="anecdote-add" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="promos.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
                    <h4 class="modal-title" id="partenaire-add-label">Ajouter une promotion</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="promotion-nom">Nom :</label>
                        <input class="form-control" type="text" name="promotion-nom" id="promotion-nom" required/>
                    </div>
                    <div class="form-group">
                        <label for="promotion-categorie">Catégorie :</label>
                        <input class="form-control" type="text" name="promotion-categorie" id="promotion-categorie" required/>
                    </div>
                    <div class="form-group">
                        <label for="promo-image">Code barre correspondant (facultatif): </label>
                        <input type="file" class="form-control" name="promo-image" id="promo-image" required>
                    </div>
                    <div class="form-group">
                        <label for="promotion-partenaire">Partenaire :</label>
                        <select name="promotion-partenaire" id="promotion-partenaire" class="form-control">
                            <?php
                            foreach($partenaires as $partner)
                            {
                                echo '<option value="'.$partner['id'].'">'.$partner['nom'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-primary" value="Ajouter"/>
                </div>
            </form>
        </div>
    </div>
</div>