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
include_once "navigation.php";
$subcategoryid=$_GET['subcat'];
$con=defaultMysqlConnection();
$delete="DELETE FROM bulletinboard.subcategories WHERE indexx=$subcategoryid";
$res=executeQuery($con,$delete);
if(!$res)
{
    message('Deleted subcategory');
}
?>
</body>
</html>
