<?php

use App\Models\Article;
use App\View;

class AdminIndex extends AdminController
{

    protected function access() : bool
    {
        //return isset($_GET['name']) && 'Admin' == $_GET['name'];
        return true;
    }

    protected function handle()
    //public function actionAdminIndex()
    {

        $this->view->articles = Article::findAllNews();
        // вызывает исключение
        //throw new \App\Exceptions\Exception404('Ошибка при выводе новостей в админ-панели');
        echo $this->view->display(__DIR__ . '/../templates/index.php');
    }
}