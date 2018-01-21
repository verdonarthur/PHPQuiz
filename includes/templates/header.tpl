<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quizz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="#">
            <img src="" alt=""
                 width="112" height="28">
        </a>
        <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">Home</a>
            <a class="navbar-item" href="list_quizzes.php">Liste des quizzs</a>
            {if isset($smarty.session.username)}
                <a class="navbar-item" href="#">Gérer les quizz</a>
            {/if}
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="field is-grouped">
                    {if !isset($smarty.session.username)}
                        <p class="control">
                            <a class="button is-info" href="login.php">
                                <span class="icon"><i class="fas fa-sign-in-alt"></i> </span>
                                <span>Login</span>
                            </a>
                        </p>
                    {else}
                        <p class="control">
                            <a class="button is-info" href="logout.php">
                                <span class="icon"><i class="fas fa-sign-out-alt"></i> </span>
                                <span>Logout</span>
                            </a>
                        </p>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</nav>
<body>