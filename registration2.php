<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Статус регистрации</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
include_once 'navigation.php';
$name=$_POST['identifier'];
$email=$_POST['email'];
$rawPassword=$_POST['password'];
$telephone=$_POST['phonenumber'];
$conn=defaultMysqlConnection();

$initializeUsersTable="CREATE TABLE IF NOT EXISTS bulletinboard.users 
(identifier VARCHAR(32) PRIMARY KEY NOT NULL,
  email VARCHAR(256) NOT NULL, 
  groupp VARCHAR(20) DEFAULT 'clients' NOT NULL,
  activated TINYINT(1) DEFAULT 1 NOT NULL,
  password VARCHAR(256) NOT NULL,
  telephone VARCHAR(16) NOT NULL )";
$r=executeQuery($conn,$initializeUsersTable);
$res=executeQuery($conn,"SELECT identifier FROM bulletinboard.users WHERE identifier='$name'",false,true);
if($res)
{
    echo "<p>User name '$name' is reserved</p>";
}
else {
    $hashedpassword = password_hash($rawPassword, PASSWORD_ARGON2I);
    $query = "INSERT INTO bulletinboard.users VALUES ('$name', '$email', '" . defaultGroup . "',1,'$hashedpassword','$telephone')";
    $result = executeQuery($conn, $query);
    if (!$result) {
        echo "<p>Registered user '$name' with email '$email'</p>";
    } else {
        echo $conn->error;
    }
}
?>
</body>
</html>
