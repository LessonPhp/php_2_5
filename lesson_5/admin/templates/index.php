<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница админ-панели</title>
</head>
<body>
<h3 style="text-align: center;">Админ-панель</h3>
<a href="/lesson_5/home_work1/admin/add.php?name=AddAdmin"><p style="text-align: center;">Добавить новость</p></a><br>
<?php
foreach ($this->articles as $article) : ?>
<h1 style="text-align: center;"><?php echo $article->title; ?></h1>
    <p style="text-align: justify; text-indent: 15px;"><?php echo $article->content; ?></p>
    <?php if(isset($article->author_id)) { ?>
        <p style="text-align: justify; text-indent: 15px;"><?php echo $article->author->name; ?></p>
        <?php
    }
        ?>
    <a href="/lesson_5/home_work1/admin/update.php?name=Admin&id=<?php echo $article->id; ?>">
        <p style="text-align: center;">Обновить новость</p></a><br>
    <a href="/lesson_5/home_work1/admin/delete.php?id=<?php echo $article->id; ?>">
        <p style="text-align: center;">Удалить новость</p></a><br>
    <?php
        endforeach;
    ?>
<a href="/lesson_5/home_work1/?name=Index"><p style="text-align: center;">Назад на главную</p></a>
</body>
</html>