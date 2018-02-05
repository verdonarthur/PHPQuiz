<?php
/**
 *
 * @author Verdon Arthur
 */

class CQuestion extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function displayOptionQuestion($question) {
        //print "<pre>";
        //var_dump($question->option,json_decode($question->option));
        //print "</pre>";
        $objOption = json_decode($question->option);

        $this->getTPL()->assign("youtubeLink", isset($objOption->youtubeLink) ? $objOption->youtubeLink : false);
        $this->getTPL()->assign("options", isset($objOption->options) ? $objOption->options : array());
        $this->getTPL()->assign("isMultiple", isset($objOption->isMultiple) ? $objOption->isMultiple : false);
        $this->getTPL()->assign("question", $question);
        $this->getTPL()->display("display_options.tpl");
    }

}