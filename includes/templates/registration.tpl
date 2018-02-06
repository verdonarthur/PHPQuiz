{include file="header.tpl"}
<script src='https://www.google.com/recaptcha/api.js'></script>
<section class="hero is-alt is-fullheight">
    <div class="hero-body">
        <div class="container">
            <article class="card is-rounded">
                <form class="card-content" method="post" action="registration.php">
                    <h1 class="title">
                        Inscription
                    </h1>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input" type="text" placeholder="Username" name="username" required>
                            <span class="icon is-small is-left">
                          <i class="fas fa-user"></i>
                        </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                            <input class="input" type="password" placeholder="Password" name="password" required>
                        </p>
                    </div>
                    <div class="field">
                        <div class="g-recaptcha" data-sitekey="6Lf3qkQUAAAAAMDoTgaEzCPdQFWoRSgKxFIg_dYh"></div>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input type="submit" class="button is-primary is-medium is-fullwidth" value="S'inscrire !">
                        </p>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
{include file="footer.tpl"}