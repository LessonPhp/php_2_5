<?php

use App\Exceptions\Exception404;
use App\View;

require __DIR__ . '/../autoload.php';


// вывод через контроллер
// задание 3, 5
try {
    $ctrl = new AdminIndex();
    $ctrl();
} catch(Exception404 $ex) {
    \App\Logger::getLog($ex);
    $view = new View();
    $view->errorAdmin = $ex->getMessage();
    echo $view->display(__DIR__ . '/templates/404_admin.php');
}


