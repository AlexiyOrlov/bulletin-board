<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Объявления</title>
    <link rel="stylesheet" href="statics/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Сайт бесплатных объявлений города Риги">
</head>
<body>
<?php
include_once "navigation.php";
$connection=defaultMysqlConnection();
executeQuery($connection,"CREATE TABLE IF NOT EXISTS bulletinboard.categories (
	category varchar(32) not null,
	info varchar(32) null,
	constraint categories_category_uindex
		unique (category))");
$getCategories="SELECT category FROM bulletinboard.categories ORDER BY category";
$result=executeQuery($connection,$getCategories);
if($result)
{
    session_start();
    $user=getUserFromSession($_SESSION);
    echo "<h2>Категории объявлений</h2>";
    echo "<div class='horizontal'>";
    foreach ($result as $next)
    {
        $category=$next[0];
        echo "<span class='vertical padded-right bordered bigger-text'>";
        echo "<span class='centered'>$category</span>";
        $getsubcats="SELECT parent, name, description, indexx FROM bulletinboard.subcategories WHERE parent='$category'";
        $arr=executeQuery($connection,$getsubcats);
        if($arr)
        {
//            var_dump($_SERVER['HTTP_USER_AGENT']);
            echo "<p>";
            foreach ($arr as $subcat)
            {
                $parent=$subcat[0];
                $name=$subcat[1];
                $descr=$subcat[2];
                $idx=$subcat[3];

                echo "<div>";
                echo "<a class='subcategory padded-right' href='viewcategory.php?index=$idx&c=$parent'>$name</a>";


                if($user && $user->getGroup()== groupOverseers)
                    echo "<a href='delete1.php?subcat=$idx' onclick='return confirm(\"Подтвердить удаление:\")'>Удалить</a>";
                echo '</div>';
            }
            echo "</p>";
        }
        else{
            echo "<p>Нет подкатегорий</p>";
        }
        if($user) {
            if ($user->getGroup() == groupOverseers)
            {
                echo "<a href='addcategory1.php?parent=$category'>Добавить подкатегорию</a>";
                echo "<a href='deletecategory1.php?categ=$category' onclick='return confirm(\"Подтвердить удаление категории:\")'>Удалить категорию</a>";
            }
            else echo "<a href='requestsubcategory1.php?c=$category'>Запросить подкатегорию</a>";
        }
        echo "</span>";
    }
    echo "</div>";
}
else{
    message("Нет категорий");
}
?>
<p></p>
<script src="js/jquery-3.3.1.js"></script>

</body>
</html>
