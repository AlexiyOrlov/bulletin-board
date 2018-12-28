<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Статус входа</title>
    <link rel="stylesheet" href="statics/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<?php
include_once 'navigation.php';
$name=$_POST['identifier'];
$password=$_POST['password'];
$conn=defaultMysqlConnection();
$query="SELECT identifier, groupp, activated, password, email, telephone FROM bulletinboard.users WHERE identifier='$name'";
$result=executeQuery($conn,$query,true);
if($result)
{
    if(!$result[0]['activated'])
    {
        message("Этот профиль деактивирован");
    }
    else
    {
        $hashedpassword=$result[0]['password'];
        if(password_verify($password,$hashedpassword))
        {
            if(session_start())
            {
                setSessionVariables($result[0]['identifier'],$result[0]['email'],$result[0]['groupp'],$result[0]['telephone']);
                message("Вход успешен");
            }
            else{
                message("Не получилось начать сессию");
            }
        }
        else{
            message("Неправильный пароль");
        }
    }
}
else {
    message("Неправильное имя пользователя");
}
?>
</body>
</html>
