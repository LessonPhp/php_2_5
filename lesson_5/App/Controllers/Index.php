<?php

namespace App\Controllers;


use App\Controller;
use App\View;

class Index extends Controller
{
    public function actionIndex()
    {

        //$view = new View();
        $this->view->articles = \App\Models\Article::findAllNews();
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    public function actionArticle()
    {
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            header('Location: /lesson_5/home_work/?ctrl=Index&action=Index');
            die;
        }


        //$view = new View();
        $this->view->article = \App\Models\Article::findById($id);
        $this->view->display( __DIR__ . '/../../templates/article.php');
    }
}