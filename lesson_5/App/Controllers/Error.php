<?php

namespace App\Controllers;


use App\Controller;


class Error extends Controller
{
    // база данных не найдена
    public function actionDbError()
    {
        $this->view->display(__DIR__ . '/../../templates/errorDb.php');
    }

    // 404 - не найдено
    public function actionNotFound404()
    {
        $this->view->display(__DIR__ . '/../../templates/error404.php');
    }

    // запрос не может быть выполнен
    public function actionExecute()
    {
        $this->view->display(__DIR__ . '/../../templates/errorExecute.php');
    }

}