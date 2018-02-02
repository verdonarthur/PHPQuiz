{include file="header.tpl"}
<section class="section mainSection">
    <div class="container">
        <h1 class="title">Liste de vos quizs </h1>
        <hr>
    </div>

    <form>
        <div class="container">
            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field"><input class="input" type="text" value="" placeholder="Nom" name="quizName">
                    </div>
                    <div class="field">
                        <div class="select">
                            <select class="slctCategory" name="quizCategory">
                                <option value="-1" selected>Catégorie</option>
                                {foreach from=$listCategories item=category}
                                    <option value="{$category->id}">
                                        {$category->name}
                                    </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="field ">
                        <button type="button" class="button is-pulled-right btnAddQuestion">Ajouter une question
                        </button>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="columns is-multiline questionsContainer">
                {foreach from=$listQuestion item=question}
                    <div class="column is-3 questionForm">
                        <div class="box field">
                            <div class="field-body">
                                <div class="field" style="width:20%">
                                    <input class="input" type="number" placeholder="1" name="questionOrder[]"></div>
                                <div class="field">
                                    <input class="input" type="text" placeholder="Intitulé de la question"
                                           name="questionTitled[]"></div>
                            </div>
                            <hr>
                            <div class="field-body">
                            <textarea class="textarea is-small" name="questionOption[]"
                                      placeholder='{ldelim}"options":[]{rdelim}'></textarea>
                            </div>
                            <hr>
                            <div class="field-body">
                                <input class="input" type="text" name="answer" placeholder="Réponse">
                            </div>
                            <hr>
                            <div class="level level-right">
                                <button class="button is-danger is-outlined">
                                    <span>Delete</span>
                                    <span class="icon is-small"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                {/foreach}
                <div class="column is-3 questionForm">
                    <div class="box field">
                        <div class="field-body">
                            <div class="field" style="width:20%">
                                <input class="input" type="number" placeholder="1" name="questionOrder[]"></div>
                            <div class="field">
                                <input class="input" type="text" placeholder="Intitulé de la question"
                                       name="questionTitled[]"></div>
                        </div>
                        <hr>
                        <div class="field-body">
                            <textarea class="textarea is-small" name="questionOption[]"
                                      placeholder='{ldelim}"options":[]{rdelim}'></textarea>
                        </div>
                        <hr>
                        <div class="field-body">
                            <input class="input" type="text" name="answer" placeholder="Réponse">
                        </div>
                        <hr>
                        <div class="level level-right">
                            <button class="button is-danger is-outlined">
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