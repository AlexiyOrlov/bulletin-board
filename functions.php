
<?php
require_once "administrative/User.php";
include_once 'administrative/constants.php';
/**
 * Translates checkbox value for usage in SQL statements
 * @param $checkboxvalue
 * @return bool|int
 */
function convertCheckboxState($checkboxvalue)
{
    if($checkboxvalue==null) return 0;
    return true;
}

/**
 * @param mysqli mysqlConnection
 * @param string statement
 * @param bool  $fetchAssociative fetch result as associative arrays?
 * @param bool $stripTags do HTML and PHP tag strip (except br)
 * @return array a numeric array of result rows or null
 */
function executeQuery(mysqli $mysqlConnection,string $statement, bool $fetchAssociative=false, bool $stripTags=false)
{
    if($stripTags)
        $statement=strip_tags($statement,"<br>");
    $result=$mysqlConnection->real_query($statement);
    if($result===false)
    {
        echo $mysqlConnection->error;
        $mysqlConnection->close();
//        echo 1;
        return null;
    }
    else {
        $res=$mysqlConnection->store_result();
        if($res)
        {
            $rows=$res->fetch_all($fetchAssociative ? MYSQLI_ASSOC : MYSQLI_NUM);
            $res->close();
//            echo 2;
            return $rows;
        }
        else {
            echo $mysqlConnection->error;
//            echo 3;
        }
    }
    return null;
}


function isDeviceMobile()
{
    return preg_match('/Mobile|Android|BlackBerry/',$_SERVER['HTTP_USER_AGENT']);
}

function htmlToRawText(string $htmlString)
{
    return trim(strip_tags(htmlspecialchars_decode($htmlString)));
}

function defaultMysqlConnection()
{
    try {
        $mysqlcon = new mysqli(host, user, password, database);
        if ($mysqlcon->connect_error) {
            echo $mysqlcon->connect_errno . "\n";
            $mysqlcon->close();
            return $mysqlcon;
        }
        return $mysqlcon;
    }
    catch (Throwable $e){echo $e->getMessage();}
    return null;
}

function setSessionVariables(string $id, string $email,string $group,string $phone)
{
    $_SESSION[IDENTIFIER]=$id;
    $_SESSION[EMAIL]=$email;
    $_SESSION[GROUP]=$group;
    $_SESSION[TELEPHONE]=$phone;
}

function getUserFromSession(array $session)
{

    if (session_status()==PHP_SESSION_ACTIVE && isset($session[IDENTIFIER])) {
        $currentuser = new \alexiy\User($session[IDENTIFIER], $session[GROUP], $session[EMAIL],$session[TELEPHONE]);
        return $currentuser;
    }
    return null;
}

function message(string $message)
{
    echo "<p>$message</p>";
}

/***
 * @param $type - "sender"
 * @param $subject - mail subject
 * @param $messagebody
 * @param $to - address
 * @return null|string
 */
function sendMail($type,$subject,$messagebody,$to)
{
    $json= json_encode([
        'Messages'=> [
            [
                'From' => [
                    'Email' => "$type@knowbase.org",
                    'Name' => 'Knowbase.org'
                ],
                'To' => [
                    [
                        'Email' => $to
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => $messagebody
            ]
        ]
    ]);
    return shell_exec("curl -s -X POST --user 'b73f51fe67869258f821deecf4e1a1ac:23d8acaf58c13b285f050bd9966ff339' https://api.mailjet.com/v3.1/send -H 'Content-Type: application/json' -d '$json'");
}

function isSuccessful(string $response)
{
    if(strpos($response,"\"Status\":\"success\"")!==false)
        return true;
    else
        return false;
}