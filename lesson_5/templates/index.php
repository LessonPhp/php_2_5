<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница</title>
</head>
<body>
<!--<a href="/lesson_5/home_work1/admin/index.php"><h3 style="text-align: center;">Админ-панель</h3></a>-->
<a href="/lesson_5/home_work1/admin/index.php?name=Admin"><h3 style="text-align: center;">Админ-панель</h3></a>
<?php

//foreach ($this->data['articles'] as $article) {

foreach ($this->articles as $article) : ?>
    <h1 style="text-align: center;"><?php echo $article->title; ?></h1>
    <p style="text-align: justify; text-indent: 15px;"><?php echo $article->content; ?></p>
    <?php
    if(isset($article->author_id)) { ?>
        <p style="text-align: justify; text-indent: 15px;"><?php echo $article->author->name; ?></p>
        <?php
    } else { ?>
        Нет автора
    <?php
    }
    ?>
    <a href="/lesson_5/home_work1/index.php?ctrl=Index&action=Article&id=<?php echo $article->id; ?>">читать далее</a>
    <?php
endforeach;
?>
</body>
</html>