<?php
require_once 'header.php';
//require_once 'menu.php';

$error = $user = $password = '';
var_dump($_GET);
if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $password = sanitizeString($_POST['password']);
    if ($user == "" || $password == "")
    $error = 'Not all fields were entered';
    else
    {
        $result = queryMysql("SELECT username, hash FROM users WHERE username = '$user'");
        if ($result->num_rows == 0)
        {
            $error = 'User not found';
        }
        else 
        {
            var_dump($result);
            $hash = $result->fetch_object()->hash;
            if(password_verify($password, $hash))
                {
                    echo "Good!";
                    $_SESSION['user']=$user;
                    $_SESSION['password'] = $password;
                    echo "SESSION user".$_SESSION['user']."Page".$_SESSION['current_page'];
                    header("Location:". $_SESSION['current_page']);
                }
         else{ $error ="Invalid login attempt";}
        }
    }
}
echo <<<_END
<div class="form_wrapper">
    <form method = "post" action= "llogin.php">
        <div class = "form_group">
            <label for = "name" class = "form-label"> Username</label>
            <input type = "text" maxlength = '16' name = 'user' id = "name" value = '$user'>
        </div>
        <div class = "form_group">
            <label for = "password" class = "form-label"> Password</label>
            <input type = "text" maxlength = '16' name = 'password' id = "password"value = '$password'>
        </div>
        <div id= "error">$error</div>
        <p class = "lead">
            <span class ="signup_header">Not a member yet? Please, <a href = "signup.php">sign up</a></span>
        </p>
        <div>
            <input type ="submit" class = "btn btn-primary submit_btn" value = "Login">
        </div>
    </form>
</div>
_END;
?>

