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
$catname=$_GET['categ'];
$con=defaultMysqlConnection();
$deleteSubCategories="DELETE FROM bulletinboard.subcategories WHERE parent='$catname'";
$res=executeQuery($con,$deleteSubCategories);
if(!$res)
{
    message('Deleted subcategories');
    $r=executeQuery($con,"DELETE FROM bulletinboard.categories WHERE category='$catname'");
    if(!$r)
    {
        message("Deleted $catname");
    }
}
?>
</body>
</html>
