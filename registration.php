<?php
/**
 *
 * @author Verdon Arthur
 */
require('bootstraper.php');

$clogin = new CLogin();

if (!isset($_POST['username']) || !isset($_POST['password']) || empty($_POST['username']) || empty($_POST['password']))
    $clogin->signup();
else {
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . reCAPTCHAKEY . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $obj = json_decode($response);

    if ($obj->success == true)
        $clogin->checkAndSaveRegistration($_POST['username'], $_POST['password']);
    else
        $clogin->signup();
}
