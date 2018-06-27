<?php

use App\Exceptions\DbException;
use App\Exceptions\Error404Exception;
use App\Logger;

require __DIR__ . '/autoload.php';

$ctrl = $_GET['ctrl'] ? $_GET['ctrl'] : 'Index';
$action = $_GET['action'] ? $_GET['action'] : 'Index';

try {
    $class = '\App\Controllers\\' . $ctrl;
    $controller = new $class;
    $controller->action($action);
} catch (DbException $ex) {
    // задание 1, 2
    $ctrl = new \App\Controllers\Error();
    $ctrl->action('DbError');
} catch(Error404Exception $ex) {
    // задание 2, 3
    $ctrl = new \App\Controllers\Error();
    $ctrl->action('NotFound404');
    // задание 5
} finally {
    if(isset($ex)) {
        Logger::getLog($ex);
    }
}

