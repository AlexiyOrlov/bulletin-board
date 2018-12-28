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
if(session_start())
{
    $user=getUserFromSession($_SESSION);
    if($user)
    {
        $subcategory=$_POST['name'];
        $category=$_POST['parent'];
        $conn=defaultMysqlConnection();
        if($conn)
        {
            $check="SELECT * FROM bulletinboard.subcategories WHERE parent='$category' AND name='$subcategory'";
            $res=executeQuery($conn,$check,true,true);
            if($res)
            {
                message('Такая подкатегория существует');
            }
            else{
                $res=sendMail('knowbase','Subcategory request',"Requested subcategory $subcategory under $category",administratorMail);
                if(strpos($res,"\"Status\":\"success\"")!==false)
                    message("Запрос отправлен успешно");
                else
                    message("Запрос не удался");
            }
        }
    }
}
?>
</body>
</html>
