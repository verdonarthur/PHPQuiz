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

if (!isset($_GET['idQuiz'])) {
    header("Location: manage_quizzes.php");
    die();
}

$quiz = Quiz::getById($_GET['idQuiz']);

if (User::getUserId(Session::get("username")) != $quiz->idx_user) {
    header("Location: manage_quizzes.php");
    die();
}


$cquiz = new CQuiz();

if (isset($_POST['quizName'])) {
    $questions = array();
    for ($i = 0; $i < count($_POST['questionTitled']); $i++) {
        if (!empty($_POST['questionTitled'][$i]) && $_POST['questionTitled'][$i] != "") {
            $questions[] = new Question(!empty($_POST['questionId'][$i]) ? $_POST['questionId'][$i] : null,
                $_POST['questionOrder'][$i],
                $_POST['questionTitled'][$i],
                $_POST['questionOption'][$i],
                $_POST['questionAnswer'][$i],
                $quiz->id);
        }
    }

    $categories = array();
    if (isset($_POST['quizCategory']))
        for ($i = 0; $i < count($_POST['quizCategory']); $i++) {
            $categories[] = new Category($_POST['quizCategory'][$i], "");
        }

    $quiz->name = $_POST['quizName'];
    $quiz->description = $_POST['quizDescription'];
    $quiz->categories = $categories;

    $cquiz->modifyQuiz($quiz, $questions);

} else
    $cquiz->showModifyQuiz($quiz);