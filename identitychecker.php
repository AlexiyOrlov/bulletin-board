
<?php

include_once 'functions.php';
$name=$_GET['username'];
$con=defaultMysqlConnection();
$check="SELECT identifier FROM bulletinboard.users WHERE identifier=$name";
$result=executeQuery($con,$check);
var_dump($result) ;
