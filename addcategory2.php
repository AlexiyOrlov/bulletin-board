<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Подкатегория</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';
$name=$_POST['name'];

$parent=$_POST['parent'];
$ensuretable="CREATE TABLE IF NOT EXISTS bulletinboard.subcategories
 (
    indexx int PRIMARY KEY AUTO_INCREMENT,
    parent varchar(32) NOT NULL,
    name VARCHAR(32) NOT NULL,
    description VARCHAR(64) DEFAULT NULL
  );";
$con=defaultMysqlConnection();
executeQuery($con,$ensuretable);
$checking="SELECT name, parent FROM bulletinboard.subcategories where parent='$parent' and name='$name'";
$res=executeQuery($con,$checking);
if($res)
{

    echo "<P>Such category exists</P>";
    var_dump($res);
}
else{
    $insert="INSERT INTO bulletinboard.subcategories VALUES (DEFAULT ,'$parent','$name',NULL )";
    $r=executeQuery($con,$insert,false,true);
    if($r)
    {

    }
    else{
        echo "<p>Created subcategory '$name' under '$parent' </p>";
    }
}

?>
</body>
</html>
