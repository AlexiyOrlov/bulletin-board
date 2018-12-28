<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Logout result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';
session_start();
$_SESSION=array();
session_destroy();
if(session_status()==PHP_SESSION_NONE || session_status()==PHP_SESSION_DISABLED)
{
    message("Вы успешно вышли");
}
else echo session_status();
?>
</body>
</html>
