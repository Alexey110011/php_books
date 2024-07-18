<?php
session_start();
$_SESSION['forename'] ="John";
foreach ($_SESSION as $key=>$value){
echo "$key.$value<br>";
} 
/*if (isset($SERVER['PHP_AUTH_USER'])&&
isset($_SERVE['PHP_AUTH_PW']))
{
echo "User:".htmlspecialharts($_SERVER['PHP_AUTH_USER']);
     "Password:".htmlspeciescharts($_SERVER['PHP_AUTH_PW']);
}
else {
    header('WWW-Authenticate:Basic Realm = "Restricted Area"');
    header("HTTP/1.0 401 Unathourized");
    echo("Please. enter username and passord!");
}*/
/*if (!isset($SERVER['PHP_AUTH_USER'])&&
isset($_SERVE['PHP_AUTH_PW']))
{
    header('WWW-Authenticate:Basic Realm = "this realm"');
    header("HTTP/1.0 401 Unathourized");
    echo("Please. enter username and passord!");
} else {
    echo "Hello". $_SERVER['PHP_AUTH_USER'];
}*/
?>