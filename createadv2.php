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


        $conn=defaultMysqlConnection();
        $category=$_POST['category'];
        $subcat=$_POST['subcategory'];
        $text=$conn->real_escape_string($_POST['advertisement']);
        //convert newlines to html line breaks
        $text=str_replace('\r\n','<br>',$text);
        $phone=$_POST['phonenumber'];
        $email=$_POST['email'];
        $creator=$user->getName();
        $postAdv="INSERT INTO bulletinboard.advs VALUES (DEFAULT ,'$creator', '$subcat', '$category','$text','$phone','$email',DEFAULT )";
        $res=executeQuery($conn,$postAdv,false,true);
        if(!$res)
        {
            message("Объявление размещено в $category/$subcat");

        }
    }
}
?>
</body>
</html>
