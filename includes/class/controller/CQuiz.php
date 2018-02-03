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
        $listQuizzes = Quiz::getAllQuizzes();
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
        //$this->getTPL()->assign("listQuizzes", $listQuizzes);
        $this->getTPL()->display(TEMPLATESPATH . "add_quiz.tpl");
    }

    public function addNewQuiz($nameQuiz, $description, $categories, $questions) {
        $userId = User::getUserId(Session::get("username"));

        $db = new DB();
        try {
            $db->pdo->beginTransaction();

            $q = $db->pdo->prepare("INSERT INTO `quiz` (`name`, `description`, `idx_user`) 
                                VALUES ( :name, :description, :idxUser)");
            $q->bindParam(":name", $nameQuiz, PDO::PARAM_STR, 30);
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
        } catch (Exception $e) {
            $db->pdo->rollBack();
            //TODO : MANAGE ERROR MESSAGE
            echo "Failed: " . $e->getMessage();
            die();
        }
    }

    

    public function getQuizzesJSON($nbQuiz, $filter = array()) {
        $listQuizzes = array();
        $listCategories = array();

        for ($i = 0; $i < 6; $i++) {
            $listCategories[] = new Category($i, "Category " . $i);
        }


        for ($i = 0; $i < 10; $i++) {
            $rndCategory = rand(0, 5);
            $rndCategory2 = rand(0, 5);

            $listQuizzes[] = new Quiz($i, "Quiz " . $i, time(),
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id ultrices ligula. Nam pretium odio leo, vitae scelerisque nisl convallis et. 
                Fusce eu venenatis diam, sit amet hendrerit orci. Suspendisse eget risus pharetra, egestas arcu vel, vehicula enim. 
                Donec tincidunt vitae dolor vitae venenatis.",
                array($listCategories[$rndCategory], $listCategories[$rndCategory2])
            );
        }

        return json_encode($listQuizzes);
    }
}