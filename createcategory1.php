<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Создание категории</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';
?>
<form method="post" action="createcategory2.php">
    <div class="vertical">
    <input type="text" placeholder="Name" name="category" required maxlength="32">
    <input type="submit" value="Create">
    </div>
</form>
</body>
</html>
