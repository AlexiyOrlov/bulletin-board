<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
include_once "../functions.php";
$res=sendMail('test','The subject','Message','alexiy.ov@gmail.com');
if($res)
{
    $res= json_decode($res,true);

    foreach ($res as $arr)
    {
       $status=($arr[0]['Status']);
       if($status=='success')
           message('Mail sent successfully');
    }

}
?>
</body>
</html>
