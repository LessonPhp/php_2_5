<?php

namespace App\Controllers;


use App\Controller;
use App\Exceptions\Error404Exception;
use App\Exceptions\ExecuteException;

class Admin extends Controller
{
    public function actionAdmin()
    {
        $this->view->articles = \App\Models\Article::findAll();
        $articles = \App\Models\Article::findAll();

        // задание 3
        if(empty($articles)) {
            throw new Error404Exception('Новости не найдены');
        }
        $this->view->display(__DIR__ . '/../../admin/templates/index.php');
    }

    public function actionAdd()
    {
        if(isset($_POST['add'])) {
            $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
            $content = htmlspecialchars(strip_tags(trim($_POST['content'])));
            $author_id = $_POST['author_id'];
            $article = new \App\Models\Article();
            $article->title = $title;
            $article->content = $content;
            $article->author_id = $author_id;
            $article->save();
            header('Location: /lesson_5/home_work/?ctrl=Admin&action=Admin');
            die;
        } else {
            throw new ExecuteException('Запрос не может быть выполнен');
        }
    }

    public function actionViewAdd()
    {
        $this->view->display(__DIR__ . '/../../admin/templates/add.php');
    }

    public function actionUpdate()
    {
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            header('Location: /lesson_5/home_work/?ctrl=Admin&action=Admin');
            die;
        }

        if(isset($_POST['update'])) {
            $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
            $content = htmlspecialchars(strip_tags(trim($_POST['content'])));
            $author_id = $_POST['author_id'];
            $article = \App\Models\Article::findById($id);
            $article->title = $title;
            $article->content = $content;
            $article->author_id = $author_id;
            $article->save();
            header('Location: /lesson_5/home_work/?ctrl=Admin&action=Admin');
            die;
        } else {
            throw new ExecuteException('Запрос не может быть выполнен');
        }

    }

    public function actionViewUpdate()
    {
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        } else {
            header('Location: /lesson_5/home_work/?ctrl=Admin&action=Admin');
            die;
        }

        $this->view->article = \App\Models\Article::findById($id);
        $this->view->display(__DIR__ . '/../../admin/templates/update.php');
    }

    public function actionDelete()
    {
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $article = \App\Models\Article::findById($id);
        } else {
            header('Location: /lesson_5/home_work/?ctrl=Admin&action=Admin');
            die;
        }

        $article->delete();
        header('Location: /lesson_5/home_work/?ctrl=Admin&action=Admin');
        die;
    }
}