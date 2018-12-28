<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';
?>
<form method="post" action="mailform2.php" class="vertical">
    <input type="text" name="subject" placeholder="Тема">
    <textarea name="message" required rows="10"></textarea>
    <input type="email" required placeholder="Ваш адрес почты" name="email">
    <input type="submit" value="Отправить">
</form>
</body>
</html>
