<?php


define('PATH', 'https://blog-p21.loc/');
define('ROOT', dirname(__DIR__));

define('PUBLIC', ROOT . '/public');

define('CORE', ROOT . '/core');

define('APP', ROOT . '/app');
define('VIEWS', APP . '/views');
define('COMPONENTS', VIEWS . '/components');

define('CONTROLLERS', APP . '/controllers');

define('ERRORS', VIEWS."/errors");
define ('CONFIG', ROOT.'/config');
define ('CLASSES', CORE.'/classes');

define ('POSTS_CONTROLLER', CONTROLLERS.'/posts');
define ('POSTS_VIEWS', VIEWS.'/posts');
