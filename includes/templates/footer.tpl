<footer class="footer">
    <div class="container">
        <div class="content has-text-centered">
            <p>
                <strong>Quiz</strong> par <a href="#">Verdon Arthur</a>.
            </p>
        </div>
    </div>
</footer>


</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="js/bulmaBootstrap.js"></script>
<script src="js/main.js"></script>
{if strpos($smarty.server.SCRIPT_NAME,  "play_quiz.php") !== false}
    <script src="js/play_quiz.js"></script>
{/if}
{if strpos($smarty.server.SCRIPT_NAME,  "modify_quiz.php") !== false || strpos($smarty.server.SCRIPT_NAME,  "add_quiz.php") !== false}
    <script src="js/jquery.validate-json.js"></script>
    <script src="js/modify_quiz.js"></script>
{/if}