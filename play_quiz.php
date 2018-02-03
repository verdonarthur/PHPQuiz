<?php
/**
 *
 * @author Verdon Arthur
 */

require('bootstraper.php');

if (!isset($_GET['idQuiz'])) {
    header("Location: manage_quizzes.php");
    die();
}

$quiz = Quiz::getById($_GET['idQuiz']);

$cquiz = new CQuiz();

$cquiz->playQuiz($quiz);
