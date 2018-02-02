<?php
/**
 *
 * @author Verdon Arthur
 */

class Quiz {
    public $id, $name, $creationDate, $description, $categories;

    public function __construct($id, $name, $creationDate, $description, $categories) {

        $this->id = $id;
        $this->name = $name;
        $this->creationDate = $creationDate;
        $this->description = $description;

        $this->categories = $categories == array() ? $this->getAllCategories() : $categories;


    }

    public static function basicConstruct($name, $description, $categories) {
        return new self(null, $name, null, $description, $categories);
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
            $listQuiz[] = new Quiz($result[$i]->id, $result[$i]->name, $result[$i]->creationDate, $result[$i]->description, array());
        }

        return $listQuiz;
    }

    public static function getAllQuizzesFromUser($idUser){
        $listQuiz = array();
        $db = new DB();
        $result = $db->query("select * from quiz WHERE idx_user=$idUser")->execute()->fetch_obj();

        for ($i = 0; $i < count($result); $i++) {
            $listQuiz[] = new Quiz($result[$i]->id, $result[$i]->name, $result[$i]->creationDate, $result[$i]->description, array());
        }

        return $listQuiz;
    }

}