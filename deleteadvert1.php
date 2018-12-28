<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Deletion status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';

$advid=$_GET['id'];
$con=defaultMysqlConnection();
$res=executeQuery($con,"DELETE FROM bulletinboard.advs WHERE id=$advid");
if(!$res)
{
    message('Удалено');
}
?>
</body>
</html>
