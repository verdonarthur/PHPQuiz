{include file="header.tpl"}
<section class="section mainSection">
    <div class="container">
        <h1 class="title">Modification de {$quiz->name}</h1>
        <hr>
    </div>

    <form action="modify_quiz.php?idQuiz={$quiz->id}" method="post">
        <div class="container">
            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field"><input class="input" type="text" value="{$quiz->name}" placeholder="Nom"
                                              name="quizName">
                        <textarea class="textarea" placeholder="description"
                                  name="quizDescription">{$quiz->description}</textarea>
                    </div>
                    <div class="field">
                        <div class="select  is-multiple is-small">
                            <select class="slctCategory" name="quizCategory[]" size="3" multiple>
                                {foreach from=$listCategories item=category}

                                    {if in_array($category,$quiz->categories)}
                                        <option value="{$category->id}" selected>
                                    {else}
                                        <option value="{$category->id}">
                                    {/if}


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
                {foreach from=$quiz->getQuizQuestions() item=question}
                    <div class="column is-3 questionForm">
                        <input type="hidden" value="{$question->id}" name="questionId[]">
                        <div class="box field">
                            <div class="field-body">
                                <div class="field" style="width:20%">
                                    <input class="input" type="number" placeholder="1" value="{$question->numOrder}"
                                           name="questionOrder[]"></div>
                                <div class="field">
                                    <input class="input" type="text" placeholder="Intitulé de la question"
                                           name="questionTitled[]" value="{$question->titled}"></div>
                            </div>
                            <hr>
                            <div class="field-body">
                            <textarea class="textarea is-small" name="questionOption[]"
                                      placeholder='{ldelim}"options":[]{rdelim}'>{$question->option}</textarea>
                            </div>
                            <hr>
                            <div class="field-body">
                                <input class="input" type="text" name="questionAnswer[]" placeholder="Réponse"
                                       value="{$question->answer}">
                            </div>
                            <hr>
                            <div class="level level-right">
                                <a class="button is-danger is-outlined" href="delete_question.php?idQuestion={$question->id}">
                                    <span>Delete</span>
                                    <span class="icon is-small"><i class="fas fa-times"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                {/foreach}

                <div class="column is-3 questionFormTPL">
                    <input type="hidden" value="" name="questionId[]">
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
                            <input class="input" type="text" name="questionAnswer[]" placeholder="Réponse">
                        </div>
                        <hr>
                        <div class="level level-right">
                            <button type="button" class="button is-danger is-outlined" onclick="$(this).closest('.questionForm').remove();">
                                <span>Delete</span>
                                <span class="icon is-small"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </form>
</section>
{include file="footer.tpl"}