<?php

if(isset($_POST['add'])) {
    $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
    $content = htmlspecialchars(strip_tags(trim($_POST['content'])));
    $author_id = $_POST['author_id'];
    $article = new \App\Models\Article();
    $article->title = $title;
    $article->content = $content;
    $article->author_id = $author_id;
    $article->insert();
    var_dump($article);
}