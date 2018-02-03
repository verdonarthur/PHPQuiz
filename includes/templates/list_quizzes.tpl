{include file="header.tpl"}
<section class="section mainSection">
    <div class="container">
        <h1 class="title">Liste des quizs </h1>
        <hr>
    </div>
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
                <div class="field">
                    <div class="buttons has-addons is-right">
                        <a class="button" href="list_quizzes.php?asc=1">Asc</a>
                        <a class="button" href="list_quizzes.php?asc=0">Desc</a>
                    </div>
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
                     data-name="{$quiz->name}">
                    <div class="box ">
                        {foreach from=$quiz->getAllCategoriesName() item=nameCategory}
                            <span class="tag">{$nameCategory}</span>
                        {/foreach}
                        <hr>
                        <p class="title">
                            {$quiz->name}
                        </p>
                        <p class="subtitle">
                            {$quiz->description}
                        </p>
                        <footer>
                            <p class="">
                                <span><a href="play_quiz.php?idQuiz={$quiz->id}">Play</a></span>
                            </p>
                        </footer>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
</section>
{include file="footer.tpl"}