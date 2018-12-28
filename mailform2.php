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
$subject=json_encode($_POST['subject']);
$body=($_POST['message']);
$replymail=($_POST['email']);
$body=json_encode($body."\nFrom ".$replymail);
$json="{
        \"Messages\":[
                {
                        \"From\": {
                                \"Email\": \"contact-form@knowbase.org\",
                                \"Name\": \"Knowbase.org\"
                        },
                        \"To\": [
                                {
                                        \"Email\": \"alexiy.ov@gmail.com\"
                                }
                        ],
                        \"Subject\": \"'$subject'\",
                        \"TextPart\": \"'$body'\"
                }
        ]
    }";
//var_dump($json);
$res=shell_exec("curl -s -X POST --user 'b73f51fe67869258f821deecf4e1a1ac:23d8acaf58c13b285f050bd9966ff339' https://api.mailjet.com/v3.1/send -H 'Content-Type: application/json' -d '$json'");
//var_dump($res);

?>
</body>
</html>
