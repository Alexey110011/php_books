<?php
require_once('header.php');
$error = $user = $password = '';
if (isset($_POST['user']))
{
    $user = /*sanitizeString(*/$_POST['user']/*)*/;
    $password = /*sanitizeString(*/$_POST['password']/*)*/;
    if ($user == "" || $password == "")
    $error = 'Not all fields were entered';
    else
    {
        $result = queryMysql("SELECT username, hash FROM users WHERE username = '$user'");
        //$query_password = queryMysql("SELECT user FROM ")
        if ($result->num_rows == 0)
        {
            $error = 'User not found';
        }
        else 
        {
            var_dump($result);
            $hash = $result->fetch_object()->hash;
            //$hash = $hash1->hash;
            if(password_verify($password, $hash))
                {echo "Good!";
                $_SESSION['user']=$user;
                $_SESSION['password'] = $password;
                header("Location:add.php");
            echo "SESSSION user".$_SESSION['user'];}
         else{ echo "Invalid login attempt";}
        }
    }
}
echo <<<_END
<form method = "post" action= "llogin.php">
<div>
<span class = "error">$error</span>
<label> Username</label>
<input type = "text" maxlength = '16' name = 'user' value = '$user'>
</div>
<div>
<label> Password</label>
<input type = "text" maxlength = '16' name = 'password' value = '$password'>
</div>
<div>
<input type ="submit" value = "Login">
</div>
</form>
_END;
?>

