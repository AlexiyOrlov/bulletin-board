<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Статус категории</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once "navigation.php";
$categ=$_POST['category'];
$con=defaultMysqlConnection();
$initializeCategories="CREATE TABLE IF NOT EXISTS bulletinboard.categories (category VARCHAR(32) PRIMARY KEY NOT NULL)";
executeQuery($con, $initializeCategories);
$query = "SELECT category FROM bulletinboard.categories WHERE category='$categ'";
$res = executeQuery($con, $query);
if($res)
{
    message("Such category exists");
}
else{
    $q = "INSERT INTO bulletinboard.categories VALUES ('$categ',DEFAULT )";
    $r = executeQuery($con, $q,false,true);
    if($r)
    {
        message("Couldn't create category $categ");
    }
    else{
        message("Created category $categ");
    }

}
?>

</body>
</html>
