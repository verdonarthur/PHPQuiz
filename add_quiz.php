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


if (isset($_POST['quizName'])) {
    $questions = array();
    for ($i = 0; $i < count($_POST['questionTitled']); $i++) {
        $questions[] = new Question(null,
            $_POST['questionOrder'][$i],
            $_POST['questionTitled'][$i],
            $_POST['questionOption'][$i],
            $_POST['questionAnswer'][$i],
            null);
    }

    $categories = array();
    for($i = 0;$i < count($_POST['quizCategory']);$i++){
        $categories[] = new Category($_POST['quizCategory'][$i],"");
    }

    $cquiz->addNewQuiz($_POST['quizName'],$_POST['quizDescription'], $categories, $questions);

} else
    $cquiz->showAddQuiz();