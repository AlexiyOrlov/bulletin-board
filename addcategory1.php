<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавление подкатегории</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';
$parent=$_GET['parent'];
?>
<form action="addcategory2.php" method="post">
    <input type="text" placeholder="Name" name="name" maxlength="32" required>
    <?php echo "<input type='text' placeholder='Parent category' name='parent' value='$parent' required>" ?>
    <input type="submit" value="Create">

</form>
</body>
</html>
