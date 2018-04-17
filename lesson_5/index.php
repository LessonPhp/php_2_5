<?php

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
    // задание 1
} catch (\App\Exceptions\DbException $ex) {
    // ведение лога, задание 5
    \App\Logger::getLog($ex);
    $view = new \App\View();
    $view->error = $ex->getMessage();
    echo $view->display(__DIR__ . '/templates/404.php');

    // задание 2
} catch (\App\Exceptions\Exception404 $ex) {
    // ведение лога, задание 5
    \App\Logger::getLog($ex);
    $view = new \App\View();
    $view->error404 = $ex->getMessage();
    echo $view->display(__DIR__ . '/templates/404_1.php');

} catch(\App\Exceptions\Error404 $error) {
    echo 'Тестовая ошибка';
}