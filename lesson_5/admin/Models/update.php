<?php

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];

} else {
    header('Location: /lesson_5/home_work1/index.php');
    die;
}

$article = \App\Models\Article::findByIdArticle($id);


if(isset($_POST['update'])) {
    $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
    $content = htmlspecialchars(strip_tags(trim($_POST['content'])));
    $author_id = $_POST['author_id'];
    $article = \App\Models\Article::findByIdArticle($id);
    $article->title = $title;
    $article->content = $content;
    $article->author_id = $author_id;
    $article->update();
    var_dump($article);
}