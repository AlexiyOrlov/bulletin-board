<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
 include_once "functions.php";

?>

<nav class="bigger-text padded-down"><a href="registration1.php">Регистрация</a>
    <a href="login1.php">Вход</a>
    <a href="index.php">Главная страница</a>
    <a href="mailform1.php">Сообщение администратору</a>
<?php
session_start();
    $user=getUserFromSession($_SESSION);
    if($user)
    {
        if($user->getGroup()==groupOverseers)
        {
            echo "<a href=\"administrative/administration.php\">Управление</a>";
            echo "<a href='createcategory1.php'>Создать категорию</a>";
        }
        else echo "<a href='requestcategory1.php'>Запросить категорию</a>";
        echo "<a href='logout.php'>Выход</a>";
    }


?>
</nav>
</body>
</html>
