{include file="header.tpl"}
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Ajout d'un nouveau quiz</h1>
        </div>
    </div>
</section>
<section class="section mainSection">
    <form action="add_quiz.php" method="post">
        <div class="container">
            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field"><input class="input" type="text" value="" placeholder="Nom" name="quizName"
                                              required>
                        <textarea class="textarea" placeholder="description" name="quizDescription"></textarea>
                    </div>
                    <div class="field">
                        <div class="select  is-multiple is-small">
                            <select class="slctCategory" name="quizCategory[]" size="3" multiple required>
                                {foreach from=$listCategories item=category}
                                    <option value="{$category->id}">
                                        {$category->name}
                                    </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <input type="button" class="button btnAddQuestion" value="Ajouter une question">
                        <input type="submit" class="button is-primary" value="Sauver">
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="columns is-multiline questionsContainer">
                <div class="column is-3 questionFormTPL">
                    <div class="box field">
                        <div class="field-body">
                            <div class="field" style="width:20%">
                                <input class="input" type="text" placeholder="1" value="1" name="questionOrder[]"
                                       pattern="[0-9]{ldelim}1-3{rdelim}" required></div>
                            <div class="field">
                                <input class="input" type="text" placeholder="Intitulé de la question"
                                       name="questionTitled[]" required></div>
                        </div>
                        <hr>
                        <div class="field-body">
                            <textarea class="textarea is-small"
                                      name="questionOption[]"
                                      placeholder='{ldelim}"options":[]{rdelim}'
                                      required>{ldelim}"options":[]{rdelim}</textarea>
                        </div>
                        <hr>
                        <div class="field-body">
                            <input class="input" type="text" name="questionAnswer[]" placeholder="Réponse" required>
                        </div>
                        <hr>
                        <div class="level level-right">
                            <button type="button" class="button is-danger is-outlined"
                                    onclick="$(this).closest('.questionForm').remove();">
                                <span>Delete</span>
                                <span class="icon is-small"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
{include file="footer.tpl"}