<?php
/**
 *
 * @author Verdon Arthur
 */

require('bootstraper.php');

if (!Session::get("username")) {
    header("Location: login.php");
    die();
}


$cquiz = new CQuiz();


if (isset($_GET['idQuestion'])) {
    $question = Question::getById($_GET['idQuestion']);
    $quiz = Quiz::getById($question->idx_quiz);
    if (User::getUserId(Session::get("username")) == $quiz->idx_user)
        $cquiz->deleteQuestion($question);

} else
    $cquiz->showManageQuizzes();