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
        $listQuizzes = array();
        $listCategories = array();

        for ($i = 0; $i < 6; $i++) {
            $listCategories[] = new Category($i, "Category " . $i);
        }


        if ($asc)
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
        else
            for ($i = 10; $i > 0; $i--) {
                $rndCategory = rand(0, 5);
                $rndCategory2 = rand(0, 5);
                $listQuizzes[] = new Quiz($i, "Quiz " . $i, time(),
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id ultrices ligula. Nam pretium odio leo, vitae scelerisque nisl convallis et. 
                Fusce eu venenatis diam, sit amet hendrerit orci. Suspendisse eget risus pharetra, egestas arcu vel, vehicula enim. 
                Donec tincidunt vitae dolor vitae venenatis.",
                    array($listCategories[$rndCategory], $listCategories[$rndCategory2])
                );
            }

        $this->getTPL()->assign("listCategories", $listCategories);
        $this->getTPL()->assign("listQuizzes", $listQuizzes);
        $this->getTPL()->display(TEMPLATESPATH . "list_quizzes.tpl");
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