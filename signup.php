<?php
require_once 'header.php';
require_once 'menu.php';
echo<<<_END

<script>
function checkUser(username){
    if(username.value ==''){
        $('#used').html ("&nbsp;")
        return
    }

    $.post('checkuser.php',
    {username: username.value},
    function(data){
        $('#used').html(data)
    })
}
</script>
_END;
$_SESSION= [];
$error = $user = $password = "";
if(isset($_SESSION['user'])) destroySession();
var_dump($_SESSION);
if (isset($_POST['username']))
{
    $user = /*sanitizeString(*/$_POST['username']/*)*/;
    $password = /*sanitizeString(*/$_POST['password']/*)*/;
    if ($user ==''|| $password == '')
        $error ="Not all fields were entered";
     else
    {
        $result = queryMysql("SELECT * FROM users WHERE username = '$user'");
        if($result->num_rows)
            $error = "Еhis username is already exists";
         else
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            echo "HASh".$hash. "Name".$user;
            queryMysql("INSERT INTO users (username, hash) VALUES ('$user', '$hash')");
            $_SESSION['username'] = $user;
            $_SESSION['password'] = $password;
            die("Account created".$_SESSION['username'].$_SESSION['password']);
        }
    }
}
echo <<<_END
<form method ="post" action = 'signup.php'>
        <input type = "text" name = "username" value = '$user' onBlur = "checkUser(this)">
        <div id =  "used"></div>
        <div id = "error">$error</div>
        <input type = "text" name = "password" value = "$password">
        <input type = "submit" value = "Sign up">
</form>
_END;
?>




















}