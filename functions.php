<?php
require_once "login.php";
$connection = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
if ($connection->connect_error)
    echo "Fatal Error".$connection->connect_error;

function createTable ($name, $query){
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table $name is created or already existed";
};

function queryMysql($query){
    global $connection;
    $result = $connection->query($query);
    if (!$result) die ("Fatal error0");
    return $result;
};

function sanitizeString($var){
   global $connection;
   $var = strip_tags($var);
   $var = htmlentities($var);
   if (get_magic_quotes_gpc())
   $var = stripcslashes($var);
   return $connection->real_escape_string($var);
};

function destroySession(){
    if (session_id()!=""| isset($_COOKIE[session_name()]))
        setcookie(session_name(),'',time() - 2592000,'/');
        session_destroy();
        $_SESSION = [];
}
?>