<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';
?>

<form class="vertical" method="post" action="requestsubcategory2.php">
    <input type="text" name="name" placeholder="Название подкатегории" required maxlength="32">
    <?php
    $parent=$_GET['c'];
    echo "<input type='text' name='parent' value='$parent' hidden required>"
    ?>
    <input type="submit" value="Запросить">
</form>
</body>
</html>
