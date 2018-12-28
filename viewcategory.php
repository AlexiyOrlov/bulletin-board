<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php
    $category=$_GET['c'];
        echo "<title>$category</title>";
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<script>
    function validate() {
        let phone=document.getElementsByName('phonenumber')[0]
        let mail=document.getElementsByName('email')[0]
        if(!phone.value && !mail.value)
        {
            alert('Должен быть указан телефонный номер и/или адрес почты')
            return false
        }
        return true
    }
</script>
<?php
include_once 'navigation.php';
$index=$_GET['index'];

$con=defaultMysqlConnection();
$ensureTable="CREATE TABLE IF NOT EXISTS bulletinboard.advs (
            id int PRIMARY KEY AUTO_INCREMENT,
            creator VARCHAR(32) NOT NULL ,
            subcategory varchar(32) NOT NULL,
            category varchar(32) NOT NULL,
            content TEXT NOT NULL ,
            telephone VARCHAR(16),
            email varchar(256),
            posttime DATETIME DEFAULT (NOW()+MAKETIME(2,0,0))
        )";
executeQuery($con,$ensureTable);
$q1="SELECT * FROM bulletinboard.subcategories where indexx=$index";
$req=executeQuery($con,$q1);

if($req)
{
    $parent=$req[0][1];
    $name=$req[0][2];
    echo "<h1>$parent</h1>";
    echo "<h2>$name</h2>";
    $retrieveAdvs="SELECT * FROM bulletinboard.advs where category='$parent' && subcategory='$name'";
    $res=executeQuery($con,$retrieveAdvs,true);
    $startSession=session_start();
    $user=null;
    if($startSession)
        $user=getUserFromSession($_SESSION);
    if($res)
    {
        $nextbulletin=0;
        foreach ($res as $row)
        {
            $id=$row['id'];
            $content=$row['content'];
            $phone=$row['telephone'];
            $email=$row['email'];
            $time=$row['posttime'];
            $creator=$row['creator'];
            echo "<div class='content margin-down'>$content</div>";
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
            echo "<a href='viewadvert.php?id=$id' class='padded-right'>Открыть</a>";
            if($user && ($user->getName()==$creator or $user->getGroup()==groupOverseers))
            {
                echo "<A href='deleteadvert1.php?id=$id' onclick='return confirm(\"Подтвердить удаление\")'>Удалить</A>";
            }
        }
    }
    else
    {
        message('Нет объявлений');
    }

        if($user)
        {
            $phone=$user->getTelephone();
            $email=$user->getAddress();
            echo "<h3>Подать объявление сюда:</h3>
                <form method='post' action='createadv2.php' onsubmit='return validate()' class='vertical'>
                <input type='text' placeholder='Категория' value='$parent' name='category' required hidden>
                <input type='text' placeholder='Подкатегория' value='$name' name='subcategory' required hidden>
                <textarea class='bigger-text' name='advertisement' placeholder='Текст объявления' rows='10' maxlength='10000' required></textarea>
                <P>Контакты:</P>
                <input type='tel' name='phonenumber' placeholder='Номер телефона' value='$phone' minlength='8'>
                <input type='email' name='email' placeholder='Электронный адрес' value='$email' min='6'>
                <input type='submit' value='Подать'>
                </form>";
        }

}
else{
    echo "<p>No advertisements</p>";
}
?>

</body>
</html>
