<?php
/**
 *
 * @author Arthur Verdon
 */

class Question {
    public $id, $numOrder, $titled, $option, $answer, $idx_quiz;

    public function __construct($id, $numOrder, $titled, $option, $answer, $idx_quiz) {
        $this->id = $id;
        $this->numOrder = $numOrder;
        $this->titled = $titled;
        $this->option = $option;
        $this->answer = $answer;
        $this->idx_quiz = $idx_quiz;
    }

    public static function getAllQuestionByQuiz($idQuiz) {
        $questions = array();

        $db = new DB();
        $db->query("SELECT * FROM question WHERE idx_quiz=$idQuiz");
        $result = $db->execute()->fetch_obj();

        for ($i = 0; $i < count($result); $i++) {
            $questions[] = new Question($result[$i]->id, $result[$i]->numOrder, $result[$i]->titled,
                $result[$i]->option, $result[$i]->answer, $result[$i]->idx_quiz);
        }

        return $questions;
    }
}