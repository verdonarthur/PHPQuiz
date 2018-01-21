<?php
/**
 *
 * @author Verdon Arthur
 */
require('bootstraper.php');

$clogin = new CLogin();

if(!isset($_POST['username']) || !isset($_POST['password']))
    $clogin->login();
else
    $clogin->checkLogin($_POST['username'],$_POST['password']);