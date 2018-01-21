<?php
/**
 *
 * @author Verdon Arthur
 */
require('bootstraper.php');

$tpl = new Smarty();
$tpl->smarty->template_dir = TEMPLATESPATH;
$tpl->smarty->compile_dir = TEMPLATECOMPILEDPATH;

$tpl->display("./includes/templates/index.tpl");
?>

