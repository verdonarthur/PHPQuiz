<?php
/**
 *
 * @author Verdon Arthur
 */
require(CONTROLLERPATH . "Controller.php");

class CQuiz extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function showAllQuizzes($asc) {
        $listQuizzes = Quiz::getAllQuizzes($asc);
        $listCategories = Category::getAllCategory();

        /*if ($asc) TODO: Remake asc/desc sorting
            $listQuizzes
        else*/


        $this->getTPL()->assign("listCategories", $listCategories);
        $this->getTPL()->assign("listQuizzes", $listQuizzes);
        $this->getTPL()->display(TEMPLATESPATH . "list_quizzes.tpl");
    }

    public function showManageQuizzes() {
        $listQuizzes = Quiz::getAllQuizzesFromUser(User::getUserId(Session::get('username')));
        $listCategories = Category::getAllCategory();


        $this->getTPL()->assign("listCategories", $listCategories);
        $this->getTPL()->assign("listQuizzes", $listQuizzes);
        $this->getTPL()->display(TEMPLATESPATH . "manage_quizzes.tpl");
    }

    public function showAddQuiz() {
        $listCategories = Category::getAllCategory();

        $this->getTPL()->assign("listCategories", $listCategories);
        $this->getTPL()->display(TEMPLATESPATH . "add_quiz.tpl");
    }

    public function addNewQuiz($nameQuiz, $description, $categories, $questions) {
        $userId = User::getUserId(Session::get("username"));

        $db = new DB();
        try {
            $db->pdo->beginTransaction();

            $q = $db->pdo->prepare("INSERT INTO `quiz` (`name`, `description`, `idx_user`) 
                                VALUES ( :name, :description, :idxUser)");
            $q->bindParam(":name", $nameQuiz, PDO::PARAM_STR, 50);
            $q->bindParam(":description", $description, PDO::PARAM_LOB);
            $q->bindParam(":idxUser", $userId, PDO::PARAM_INT);
            $q->execute();

            $quizId = $db->pdo->lastInsertId();


            $q = $db->pdo->prepare("INSERT INTO `quiz_category` (`idx_category`, `idx_quiz`) 
                                                            VALUES (:idxCategory, :idxQuiz)");

            foreach ($categories as $category) {
                $q->bindParam(":idxCategory", $category->id, PDO::PARAM_INT);
                $q->bindParam(":idxQuiz", $quizId, PDO::PARAM_INT);
                $q->execute();
            }


            $q = $db->pdo->prepare("INSERT INTO `question` (`numOrder`, `titled`, `option`, `answer`, `idx_quiz`) 
                                            VALUES (:order, :titled, :option, :answer, :idxQuiz)");

            foreach ($questions as $question) {
                $q->bindParam(":order", $question->numOrder, PDO::PARAM_INT, 5);
                $q->bindParam(":titled", $question->titled, PDO::PARAM_STR, 255);
                $q->bindParam(":option", $question->option, PDO::PARAM_LOB);
                $q->bindParam(":answer", $question->answer, PDO::PARAM_STR, 255);
                $q->bindParam(":idxQuiz", $quizId, PDO::PARAM_INT);
                $q->execute();

            }


            $db->pdo->commit();
            $this->showModifyQuiz(Quiz::getById($quizId));
        } catch (Exception $e) {
            $db->pdo->rollBack();
            $this->getTPL()->assign("error", $e->getMessage());
            $this->getTPL()->display("error.tpl");
        }

    }

    public function showModifyQuiz($quiz) {
        $listCategories = Category::getAllCategory();

        $this->getTPL()->assign("listCategories", $listCategories);
        $this->getTPL()->assign("quiz", $quiz);
        $this->getTPL()->display(TEMPLATESPATH . "modify_quiz.tpl");
    }

    public function modifyQuiz($quiz, $questions) {

        $db = new DB();
        try {
            $db->pdo->beginTransaction();

            $q = $db->pdo->prepare("UPDATE `quiz` SET name=:name, description=:description 
                                 WHERE id=:quizId");
            $q->bindParam(":name", $quiz->name, PDO::PARAM_STR, 30);
            $q->bindParam(":description", $quiz->description, PDO::PARAM_LOB);
            $q->bindParam(":quizId", $quiz->id, PDO::PARAM_INT);
            $q->execute();


            $db->pdo->exec("DELETE FROM quiz_category WHERE idx_quiz=$quiz->id");
            $q = $db->pdo->prepare("INSERT INTO `quiz_category` (`idx_category`, `idx_quiz`) 
                                                            VALUES (:idxCategory, :idxQuiz)");

            foreach ($quiz->categories as $category) {
                $q->bindParam(":idxCategory", $category->id, PDO::PARAM_INT);
                $q->bindParam(":idxQuiz", $quiz->id, PDO::PARAM_INT);
                $q->execute();
            }


            $q = $db->pdo->prepare("INSERT INTO `question` (`numOrder`, `titled`, `option`, `answer`, `idx_quiz`) 
                                            VALUES (:order, :titled, :option, :answer, :idxQuiz)");

            $q2 = $db->pdo->prepare("UPDATE `question` AS q SET q.numOrder=:order, q.titled=:titled,
                                                q.option=:option,q.answer=:answer WHERE q.id=:questionID");
            foreach ($questions as $question) {
                if ($question->id == null) {
                    $q->bindParam(":order", $question->numOrder, PDO::PARAM_INT, 5);
                    $q->bindParam(":titled", $question->titled, PDO::PARAM_STR, 255);
                    $q->bindParam(":option", $question->option, PDO::PARAM_LOB);
                    $q->bindParam(":answer", $question->answer, PDO::PARAM_LOB, 255);
                    $q->bindParam(":idxQuiz", $quiz->id, PDO::PARAM_INT);
                    $q->execute();
                } else if ($question->idx_quiz == $quiz->id) {
                    $q2->bindParam(":order", $question->numOrder, PDO::PARAM_INT, 5);
                    $q2->bindParam(":titled", $question->titled, PDO::PARAM_STR, 255);
                    $q2->bindParam(":option", $question->option, PDO::PARAM_LOB);
                    $q2->bindParam(":answer", $question->answer, PDO::PARAM_LOB, 255);
                    $q2->bindParam(":questionID", $question->id, PDO::PARAM_INT);
                    $q2->execute();
                }
            }

            $db->pdo->commit();
            $this->showModifyQuiz(Quiz::getById($quiz->id));
        } catch (Exception $e) {
            $db->pdo->rollBack();
            $this->getTPL()->assign("error", $e->getMessage());
            $this->getTPL()->display("error.tpl");
        }
    }

    public function deleteQuiz($quiz){

        $db = new DB();
        try {
            $db->pdo->beginTransaction();

            $db->pdo->exec("DELETE FROM quiz WHERE id=".$quiz->id);
            $db->pdo->exec("DELETE FROM quiz_category WHERE idx_quiz=".$quiz->id);
            $db->pdo->exec("DELETE FROM question WHERE idx_quiz=".$quiz->id);

            $db->pdo->commit();
            $this->showManageQuizzes();
        }catch (Exception $e){
            $db->pdo->rollBack();
            $this->getTPL()->assign("error", $e->getMessage());
            $this->getTPL()->display("error.tpl");
        }


    }

    public function deleteQuestion($question) {
        $db = new DB();
        try {
            $db->pdo->beginTransaction();

            $db->pdo->exec("DELETE FROM question WHERE id=".$question->id);

            $db->pdo->commit();

            $this->showModifyQuiz(Quiz::getById($question->idx_quiz));
        }catch (Exception $e){
            $db->pdo->rollBack();
            $this->getTPL()->assign("error", $e->getMessage());
            $this->getTPL()->display("error.tpl");
        }
    }

    public function playQuiz($quiz) {
        $this->getTPL()->assign("quiz", $quiz);
        $this->getTPL()->assign("cquestion", new CQuestion());
        $this->getTPL()->display("play_quiz.tpl");
    }

    public function getQuizzesJSON($nbQuiz, $filter = array()) {
        $listQuizzes = array();
        $listCategories = array();


        return json_encode($listQuizzes);
    }

}