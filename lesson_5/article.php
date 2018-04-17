<?php
require __DIR__ . '/autoload.php';

// второй вариант

$controller = new App\Controllers\Article();
$controller->action('Article');

// первый вариант
/*
$ctrl = new App\Controllers\Article();
$ctrl->actionArticle();
*/

//$ctrl();
