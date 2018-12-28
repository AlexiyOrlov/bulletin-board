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
$aid=$_GET['id'];
$conn=defaultMysqlConnection();
if($conn)
{
    $retreive="SELECT * FROM bulletinboard.advs WHERE id=$aid";
    $res=executeQuery($conn,$retreive,true);
    if($res)
    {
        $content=$res[0]['content'];
        $phone=$res[0]['telephone'];
        $email=$res[0]['email'];
        $time=$res[0]['posttime'];
        $creator=$res[0]['creator'];
        echo "<div class='bigger-text'>";
//        var_dump($content);
        echo "<div class='content bigger-text margin-down'>$content</div>";
        if($phone)
        {
            try {
                $parts = str_split($phone, random_int(1, strlen($phone) - 2));
                echo "<span>Телефонный номер: ";
                foreach ($parts as $part)
                {
                    echo "<span>$part</span>";
                }
                echo "</span><br>";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        if($email)
        {
            try {
                $parts = str_split($email, random_int(1, strlen($email) - 2));
                echo "<span>Электронная почта: ";
                foreach ($parts as $part)
                {
                    echo "<span>$part</span>";
                }
                echo "</span>";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        $time=new DateTime($time);
        message('Размещено '.$time->format('d/m/Y H:i:s'));
        echo "</div>";
    }
}

?>
</body>
</html>
