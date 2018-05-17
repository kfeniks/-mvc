<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.11.2017
 * Time: 13:45
 */

/*
 * Define the file system and assign a root folder
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname( dirname(__FILE__) ));
define('VIEWS_PATH', ROOT.DS. 'views');

//Testing how redirecting works through the entry point to the index.php
//$uri = $_SERVER['REQUEST_URI'];
//print_r($uri);

require_once (ROOT.DS.'libraries'.DS.'init.php');

//$router = new Router($_SERVER['REQUEST_URI']);
//
//echo '<pre>';
//print_r('Route: ' . $router->getRoute() . PHP_EOL);
//print_r('Language: ' . $router->getLanguage() . PHP_EOL);
//print_r('Controller: ' . $router->getController() . PHP_EOL);
//print_r('Action to be called: ' . $router->getMethodPrefix() . $router->getAction() . PHP_EOL);
//echo 'Params: ';
//print_r($router->getParams());
//echo '</pre>';

// TRY TEST FLASH MESSAGE
//Session::setFlash('Test flash message');

session_start();

App::run($_SERVER['REQUEST_URI']);

// TRY TEST CONNECTION TO DB
//$test = App::$db->query('select * from pages');
//echo '<pre>';
//print_r($test);