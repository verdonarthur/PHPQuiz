<?php
/**
 *
 * @author Arthur Verdon
 */

class Question {
    public $id, $numOrder, $titled, $option, $answer,$idx_quiz;

    public function __construct($id, $numOrder, $titled, $option, $answer,$idx_quiz) {
        $this->id = $id;
        $this->numOrder = $numOrder;
        $this->titled = $titled;
        $this->option = $option;
        $this->answer = $answer;
        $this->idx_quiz = $idx_quiz;
    }
}