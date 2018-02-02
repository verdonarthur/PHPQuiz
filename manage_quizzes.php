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

$cquiz->showManageQuizzes();