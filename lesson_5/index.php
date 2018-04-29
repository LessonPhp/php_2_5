<?php

use App\Exceptions\DbException;
use App\Exceptions\Error404Exception;
use App\Logger;
use App\View;

require __DIR__ . '/autoload.php';


if(isset($_GET['ctrl'])) {
    $ctrl = $_GET['ctrl'];
} else {
    $ctrl = 'Index';
}

if(isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'Index';
}

try {
    $class = '\App\Controllers\\' . $ctrl;
    $controller = new $class;
    $controller->action($action);
} catch (DbException $ex) {
    // задание 1, 2, 5
    $getLog = Logger::getLog($ex);
    $view = new View();
    $view->errorDb = $ex->getMessage();
    $view->display(__DIR__ . '/templates/errorDb.php');
} catch(Error404Exception $ex) {
    // задание 2, 3, 5
    $getLog = Logger::getLog($ex);
    $view = new View();
    $view->error404 = $ex->getMessage();
    $view->display(__DIR__ . '/templates/error404.php');
}

