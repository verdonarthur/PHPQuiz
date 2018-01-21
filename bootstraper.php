<?php
/**
 *
 * @author Verdon Arthur
 */

define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);
define('INCLUDESPATH', ROOTPATH . "includes" . DIRECTORY_SEPARATOR);
define('CLASSPATH', INCLUDESPATH . 'class' . DIRECTORY_SEPARATOR);
define('CONFIGPATH', INCLUDESPATH . 'config' . DIRECTORY_SEPARATOR);
define('TEMPLATESPATH', INCLUDESPATH . 'templates' . DIRECTORY_SEPARATOR);
define('TEMPLATECOMPILEDPATH', INCLUDESPATH . 'templates_c' . DIRECTORY_SEPARATOR);

define('CONTROLLERPATH', realpath(CLASSPATH . 'controller') . DIRECTORY_SEPARATOR);
define('MODELPATH', realpath(CLASSPATH . 'model') . DIRECTORY_SEPARATOR);
define('VIEWPATH', realpath(CLASSPATH . 'view') . DIRECTORY_SEPARATOR);

require(CONFIGPATH . "config.php");
require(CONFIGPATH . "boot.php");