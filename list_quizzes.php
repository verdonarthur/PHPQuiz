<?php
/**
 *
 * @author Verdon Arthur
 */

require('bootstraper.php');
require(CONTROLLERPATH . "CQuiz.php");
$cquiz = new CQuiz();

$asc = 1;

if (isset($_GET["asc"]) )
    $asc = $_GET["asc"];

$cquiz->showAllQuizzes($asc == 1 ? true : false);
