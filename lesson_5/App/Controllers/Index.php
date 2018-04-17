<?php

namespace App\Controllers;


use App\Controller;
use App\Exceptions\Exception404;
use App\Models\Article;
use App\View;

class Index extends Controller
{
    protected function actionIndex()
    {
        // задание 3
        try {
            $this->view->articles = Article::findAllNews();
            echo $this->view->display(__DIR__ . '/../../templates/index.php');
        } catch (Exception404 $ex) {
            throw new Exception404('Новости не найдены');
        }

    }

    protected function actionArticle()
    {
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            header('Location: /lesson_5/home_work1/index.php');
            die;
        }
        //$view = new View();
        // задание 3
        try {
            $this->view->article = \App\Models\Article::findByIdArticle($id);
        } catch (Exception404 $ex) {
            throw new Exception404('Запрашиваемая вами новость не найдена');
        }

        // закрываем страницу article вообще
        //throw new Exception404('Запрос не может быть выполнен');
        echo $this->view->display( __DIR__ . '/../../templates/article.php');
    }
}