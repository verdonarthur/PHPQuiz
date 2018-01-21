<?php
/**
 *
 * @author Verdon Arthur
 */


/*
 * LOAD CLASS
 */
require 'smarty3/Smarty.class.php';

spl_autoload_register(function ($className) {

    if (file_exists(CONTROLLERPATH . $className . '.php')) {
        include CONTROLLERPATH . $className . '.php';
        return;
    } elseif (file_exists(MODELPATH . $className . '.php')) {
        include MODELPATH . $className . '.php';
        return;
    } elseif (file_exists(CLASSPATH . $className . '.php')) {
        include CLASSPATH . $className . '.php';
        return;
    } else {
        throw new MissingException("Impossible to load $className.");
    }

});


/*
 * START SESSION
 */
Session::start_session();
