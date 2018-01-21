<?php
/**
 *
 * @author Verdon Arthur
 */
require 'bootstraper.php';
header('Content-Type: application/json');

if (isset($_GET['type']) && !empty($_GET['type'])) {
    switch ($_GET['type']) {
        case 'quizzes':
            {
                $cquiz = new CQuiz();
                echo $cquiz->getQuizzesJSON(-1);
            }
            break;

    }
}else{
    echo '{"hello":"Welcome on quiz API"}';
}