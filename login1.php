<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
    <link rel="stylesheet" href="statics/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
<?php
include_once 'navigation.php';
?>
<form action="login2.php" method="post">
    <ul class="list-no-markers">
        <li><input type="text" placeholder="Идентификатор" name="identifier" required></li>
        <li><input type="password" name="password" placeholder="Пароль" required></li>
        <li><input type="submit" value="Войти в систему"></li>
    </ul>
</form>
</body>
</html>
