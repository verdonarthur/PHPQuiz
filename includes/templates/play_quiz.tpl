{include file="header.tpl"}
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                {$quiz->name}
            </h1>
            <h2 class="subtitle">
                {$quiz->description}
            </h2>
        </div>
    </div>
</section>
<section class="mainSection">
    {foreach from=$quiz->getQuizQuestions() item=question name=foo}
        <div class="section question" data-order="{$smarty.foreach.foo.iteration}" data-idquestion="{$question->id}"
             data-answer="{$question->answer}">
            <div class="container">
                <h1 class="title">{$question->titled}</h1>
                {$cquestion->displayOptionQuestion($question)}
                <p id="answer{$question->id}"></p>
            </div>
        </div>
    {/foreach}

    <div class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Score</p>
                <p class="title score">0</p>
            </div>

        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Question</p>
                <p class="title"><span id="nbrActualQuestion">1</span> / {$smarty.foreach.foo.iteration}</p>
            </div>
        </div>
    </div>
    <div class="section level">
        <div class="container">
            <div class="level-left">
                <p class="level-item">
                    <button class="button" id="btnLastQuestion" disabled>Précdente question</button>
                </p>
            </div>
            <div class="level-right">
                <p class="level-item">
                    <button id="btnCorrect" class="button">Corriger</button>
                <p class="level-item">
                    <button id="btnNextQuestion" class="button">Prochaine question</button>
                </p>
            </div>
        </div>
    </div>
</section>

<div class="modal" id="quizEnded">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Bravo vous avez fini {$quiz->name}</p>
        </header>
        <section class="modal-card-body">
            Votre score est de <span class="score">0</span><br>
            Vous avez rempli <span class="nbrDoneQuestion">0</span> question sur {$smarty.foreach.foo.iteration}

        </section>
        <footer class="modal-card-foot">
            <button class="button btnWatchAnswer">Continuer le quiz</button>
            <a class="button is-info" href="list_quizzes.php">Revenir aux quizs</a>
        </footer>
    </div>
</div>
{include file="footer.tpl"}