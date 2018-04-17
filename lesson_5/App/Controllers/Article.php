<?php

namespace App\Controllers;


use App\Controller;
use App\Error404;
use App\View;

class Article extends Controller
{
    public function actionArticle()
    {
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            header('Location: /lesson_5/home_work1/index.php');
            die;
        }
        //$view = new View();
        $this->view->article = \App\Models\Article::findByIdArticle($id);
        echo $this->view->display( __DIR__ . '/../../templates/article.php');
    }
}