<?php

require __DIR__ . '/autoload.php';

$view = new \App\View();

// вывод через контроллер
$controller = new \App\Controllers\Logger();
$controller->action('Logger');

// вывод через view
/*
$view->logger = \App\Logger::getLog();
var_dump($logger);
*/
