<?php


use App\Models\Article;
use App\View;

class UpdateAdmin extends AdminController
{

    //public function actionUpdateAdmin()
    public function handle()
    {
        $id = $_GET['id'];
        $article = Article::findByIdArticle($id);
        $this->view->article = $article;
        echo $this->view->display(__DIR__ . '/../Models/update.php');
        echo $this->view->display(__DIR__ . '/../templates/update.php');
    }
}