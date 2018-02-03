<?php
/**
 *
 * @author Verdon Arthur
 */

class Quiz {
    public $id, $name, $creationDate, $description, $categories, $idx_user;

    public function __construct($id, $name, $creationDate, $description, $categories, $idx_user) {

        $this->id = $id;
        $this->name = $name;
        $this->creationDate = $creationDate;
        $this->description = $description;
        $this->categories = $categories == array() ? $this->getAllCategories() : $categories;
        $this->idx_user = $idx_user;

    }

    public static function basicConstruct($name, $description, $categories) {
        return new self(null, $name, null, $description, $categories, null);
    }

    public function getAllCategories() {
        $listCategories = array();


        $db = new DB();
        $result = $db->query("SELECT category.* FROM quiz 
            INNER JOIN quiz_category ON quiz_category.idx_quiz=quiz.id 
            INNER JOIN category ON category.id=quiz_category.idx_category 
            WHERE quiz.id=$this->id;")->execute()->fetch_obj();

        for ($i = 0; $i < count($result); $i++) {
            $listCategories[] = new Category($result[$i]->id, $result[$i]->name);
        }

        return $listCategories;
    }

    public static function getById($idQuiz) {
        $db = new DB();
        $result = $db->query("SELECT * from quiz 
            WHERE quiz.id=$idQuiz;")->execute()->fetch_obj();


        return new Quiz($result[0]->id, $result[0]->name,
            $result[0]->creationDate, $result[0]->description, array(), $result[0]->idx_user);
    }

    public function getQuizQuestions() {
        $listQuestions = array();

        $db = new DB();
        $result = $db->query("SELECT question.* FROM quiz 
            INNER JOIN question ON question.idx_quiz=quiz.id 
            WHERE quiz.id=$this->id;")->execute()->fetch_obj();

        for ($i = 0; $i < count($result); $i++) {
            $listQuestions[] = new Question($result[$i]->id, $result[$i]->numOrder,
                $result[$i]->titled, $result[$i]->option, $result[$i]->answer, $result[$i]->idx_quiz);
        }

        return $listQuestions;
    }


    public function getAllCategoriesID() {
        $ids = array();
        foreach ($this->getAllCategories() as $category)
            $ids[] = $category->id;

        return $ids;
    }

    public function getAllCategoriesName() {
        $names = array();
        foreach ($this->getAllCategories() as $category)
            $names[] = $category->name;

        return $names;
    }

    public static function getAllQuizzes() {
        $listQuiz = array();
        $db = new DB();
        $result = $db->query("select * from quiz")->execute()->fetch_obj();

        for ($i = 0; $i < count($result); $i++) {
            $listQuiz[] = new Quiz($result[$i]->id, $result[$i]->name,
                $result[$i]->creationDate, $result[$i]->description, array(), $result[$i]->idx_user);
        }

        return $listQuiz;
    }

    public static function getAllQuizzesFromUser($idUser) {
        $listQuiz = array();
        $db = new DB();
        $result = $db->query("select * from quiz WHERE idx_user=$idUser")->execute()->fetch_obj();

        for ($i = 0; $i < count($result); $i++) {
            $listQuiz[] = new Quiz($result[$i]->id, $result[$i]->name,
                $result[$i]->creationDate, $result[$i]->description, array(), $result[$i]->idx_user);
        }

        return $listQuiz;
    }

}