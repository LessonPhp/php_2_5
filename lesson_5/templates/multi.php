<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Это мультиисключение</title>
</head>
<body>
<h3 style="text-align: center;">Это мультиисключение:</h3>
<h3 style="text-align: center;"><?php foreach ($this->errors as $error) : ?>
        <h4><?php echo $error->getMessage(); ?></h4>
        <?php
    endforeach;
    ?>
</h3>
</body>
</html>