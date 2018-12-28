<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Пред-регистрация</title>
    <link rel="stylesheet" href="statics/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
<?php
include_once 'navigation.php';
message("Только зарегистрированные пользователи могут подавать объявления");
?>
<script>

    function validateRegistration() {
        let p1=document.getElementById("password");
        let p2=document.getElementById("repeated password");
        if(p1.value!==p2.value)
        {
            $("#errors").html("Пароли не совпадают");
            return false;
        }

        return true;
    }


</script>
<script src="statics/scripts.js"></script>
<script src="js/jquery-3.3.1.js"></script>

<form class="vertical" action="registration2.php" method="post" onsubmit="return validateRegistration()">

        <input type="text" placeholder="Идентификатор (минимум 8 символов)" name="identifier" minlength="8" required>
        <input type="email" placeholder="Электронный адрес" name="email" pattern="^\S+@\S+\.{1,1}\S+$" required>
        <input type="tel" placeholder="Телефонный номер" name="phonenumber" pattern="[0-9]+" required>
        <input type="password" placeholder="Пароль (минимум 8 символов)" id="password" pattern="\S{8,256}" name="password" required>
        <input type="password" placeholder="Повторенный пароль" id="repeated password" required>
        <input type="submit" value="Зарегистрироваться">

</form>
</body>
</html>
