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
$con=defaultMysqlConnection();
if($con)
{
   $category=$_POST['category'];
   $q="SELECT category FROM bulletinboard.categories where category='$category'";

       $res=executeQuery($con,$q,false,true);
       if($res)
           message('Такая категория существует');
       else{
           $res=sendMail('knowbase','Category request',"Requested category - $category",administratorMail);
           if(strpos($res,"\"Status\":\"success\"")!==false)
               message("Запрос отправлен успешно");
           else
               message("Запрос не удался");
       }

}
?>
</body>
</html>
