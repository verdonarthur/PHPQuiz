<?php
/**
 *
 * @author Verdon Arthur
 */

class Controller {
    private $tpl;

    public function __construct() {
        $this->tpl = new Smarty();
        $this->tpl->smarty->template_dir = TEMPLATESPATH;
        $this->tpl->smarty->compile_dir = TEMPLATECOMPILEDPATH;
    }

    public function getTPL(){
        return $this->tpl;
    }

}