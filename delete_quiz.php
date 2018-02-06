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


if (isset($_GET['idQuiz'])) {
    $quiz = Quiz::getById($_GET['idQuiz']);
    if (User::getUserId(Session::get("username")) == $quiz->idx_user && !empty($quiz))
        $cquiz->deleteQuiz($quiz);

} else
    $cquiz->showManageQuizzes();