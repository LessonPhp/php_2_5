<?php

namespace App\Controllers;


use App\Controller;
use App\Exceptions\MultiException;


class Error extends Controller
{

    public function actionDbError()
    {
        $this->view->display(__DIR__ . '/../../templates/errorDb.php');
    }


    public function actionNotFound404()
    {
        $this->view->display(__DIR__ . '/../../templates/error404.php');
    }
}