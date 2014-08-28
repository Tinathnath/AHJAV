<section class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 recap-block">
    <header>
        <h2>Modifier une question</h2>
    </header>
<form action="edit.php?type=question&id=<?php echo $id; ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label for="question-theme">Thème :</label>
            <input class="form-control" type="text" name="question-theme" id="question-theme" required value="<?php echo $questionGet->theme; ?>"/>
        </div>
        <div class="form-group">
            <label for="question-question">Question :</label>
            <input type="text" name="question-question" id="question-question" rows="4" class="form-control" required value="<?php echo $questionGet->question; ?>"/>
        </div>
        <div class="form-group">
            <label for="question-good-answer">Bonne réponse :</label>
            <input class="form-control" type="text" name="question-good-answer" id="question-good-answer" required value="<?php echo $questionGet->good_answer; ?>"/>
        </div>
        <div class="form-group">
            <label for="question-bad-answer-1">Mauvaise réponse #1 :</label>
            <input class="form-control" type="text" name="question-bad-answer-1" id="question-bad-answer-1" required value="<?php echo $questionGet->false_answer_A; ?>"/>
        </div>
        <div class="form-group">
            <label for="question-bad-answer-2">Mauvaise réponse #2 :</label>
            <input class="form-control" type="text" name="question-bad-answer-2" id="question-bad-answer-2" requried value="<?php echo $questionGet->false_answer_B; ?>"/>
        </div>
        <div class="form-group">
            <label for="question-explanation">Explication :</label>
            <input class="form-control" type="text" name="question-explanation" id="question-explanation" required value="<?php echo $questionGet->explanation; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary center-block" value="Modifier" />
    </div>
</form>
    </section>