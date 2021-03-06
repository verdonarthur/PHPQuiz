{include file="header.tpl"}
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Liste des quizs de {$smarty.session.username}</h1>
        </div>
    </div>
</section>
<section class="section mainSection">
    <div class="container">
        <form class="list_quizzes_form field is-horizontal">
            <div class="field-body">
                <div class="field"><input class="input inSearch" type="text" value="" placeholder="search..."></div>
                <div class="field">
                    <div class="select">
                        <select class="slctCategory">
                            <option value="-1" selected></option>
                            {foreach from=$listCategories item=category}
                                <option value="{$category->id}">
                                    {$category->name}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="field ">
                    <a type="button" class="button is-pulled-right addQuizz " href="add_quiz.php">Ajouter</a>
                </div>
            </div>
        </form>
        <hr>
    </div>
    <div class="container">
        <div class="columns is-multiline quizzesContainer">
            {foreach from=$listQuizzes item=quiz}
                <div class="column is-one-third"
                     data-category="{ldelim}{','|implode:$quiz->getAllCategoriesID()}{rdelim}"
                     data-name="{$quiz->name}"
                     data-id="{$quiz->id}">
                    <div class="box has-text-centered">
                        <div class="level">
                            <div class="tags level-item">
                                {foreach from=$quiz->getAllCategoriesName() item=nameCategory}
                                    <span class="tag is-info is-rounded">{$nameCategory}</span>
                                {/foreach}
                            </div>
                        </div>

                        <div class="level">
                            <div class="level-item"><p class="title">{$quiz->name}</p></div>
                        </div>
                        <div class="level">
                            <div class="level-item"><p class="subtitle">{$quiz->description|truncate:100:"...":true}</p></div>
                        </div>
                        <div class="level">
                                <span class="level-item">
                                    <a class="button is-outlined is-primary" href="modify_quiz.php?idQuiz={$quiz->id}">Modifier</a>
                                </span>
                                <span class="level-item">
                                    <button class="button is-danger is-outlined btnRemoveQuizz">Supprimer</button>
                                </span>
                        </div>
                    </div>
                    <div class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-card">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Supresssion de {$quiz->name}</p>
                            </header>
                            <section class="modal-card-body">
                                Êtes-vous sûr de vouloir supprimer {$quiz->name} ?
                            </section>
                            <footer class="modal-card-foot">
                                <a class="button is-danger btnYes" href="delete_quiz.php?idQuiz={$quiz->id}">oui</a>
                                <button class="button btnNo">non</button>
                            </footer>
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
</section>
{include file="footer.tpl"}