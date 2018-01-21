{include file="header.tpl"}
<section class="hero is-alt is-fullheight">
    <div class="hero-body">
        <div class="container">
            <article class="card is-rounded">
                <form class="card-content" method="post" action="login.php">
                    <h1 class="title">
                        Quiz login
                    </h1>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input" type="text" placeholder="Username" name="username">
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
                            <input class="input" type="password" placeholder="Password" name="password">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input type="submit" class="button is-primary is-medium is-fullwidth" value="Login">
                        </p>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
{include file="footer.tpl"}