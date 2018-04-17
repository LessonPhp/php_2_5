<?php

namespace App\Controllers;


use App\Controller;
use App\Exceptions\MultiException;

class Logger extends Controller
{
    protected function actionLogger()
    {
        $this->view->logger = \App\Logger::getLog();
        echo $this->view->display( __DIR__ . '/../../templates/logger.php');
    }
}