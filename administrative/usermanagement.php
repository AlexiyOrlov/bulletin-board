<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../statics/styles.css">
</head>
<body>
<?php
include_once "../functions.php";
$conn=defaultMysqlConnection();
if($conn)
{
    if(session_start())
    {
        $user=getUserFromSession($_SESSION);
        if($user && $user->getGroup()==groupOverseers)
        {
            $q="SELECT * FROM bulletinboard.users";
            $rows=executeQuery($conn,$q,true);
            if($rows)
            {
                echo "<table><tr><th>Identifier</th><th>Group</th><th>Active</th><th>Email</th><th>Telephone</th></tr>";
                foreach ($rows as $row)
                {
                    $id=$row['identifier'];
                    $group=$row['groupp'];
                    $active=$row['activated'];
                    $mail=$row['email'];
                    $telephone=$row['telephone'];
                    echo "<tr><td>$id</td><td>$group</td><td>$active</td><td>$mail</td><td>$telephone</td></tr>";
                }
                echo "</table>";
            }
        }
    }
}
?>
</body>
</html>
