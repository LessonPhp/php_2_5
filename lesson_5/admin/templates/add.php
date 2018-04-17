<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить новость</title>
</head>
<body>
<h3>Добавить новость</h3>
<form method="post" action="/lesson_5/home_work1/admin/add.php">
    <input type="text" name="title"><br>
    <textarea name="content" style="resize: none;"></textarea><br>
    <input type="hidden" name="author_id" value="1">
    <button type="submit" name="add">Добавить новость</button>
</form>
<a href="/lesson_5/home_work1/admin/index.php">Назад в админ-панель</a>
</body>
</html>