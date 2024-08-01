<?php
require_once 'header.php';
require_once 'menu.php';
//$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
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
    $('#error').html('')
}
</script>
_END;
$_SESSION= [];
$error = $user = $password = "";
if(isset($_SESSION['user'])) destroySession();

if (isset($_POST['username']))
{
    $user = sanitizeString($_POST['username']);
    $password = sanitizeString($_POST['password']);
    if ($user ==''|| $password == '')
        $error ="Not all fields were entered";
     else
    {
        $result = queryMysql("SELECT * FROM users WHERE username = '$user'");
        if($result->num_rows)
            $error = "This username is already exists";
         else
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            queryMysql("INSERT INTO users (username, hash) VALUES ('$user', '$hash')");
            $_SESSION['username'] = $user;
            $_SESSION['password'] = $password;
            echo("Account created".$_SESSION['username'].$_SESSION['password']);
            header("Location:".$_SESSION['current_page']);
        }
    }
}
?>

<?php
echo <<<_END
<div class = "row">
    <div class = "form_wrapper">
        <form method ="post" action = 'signup.php'>
            <div class = "form_group">
                <label for = "username" class = "form-label">Username </label>
                <input type = "text" id = "username" name = "username" value = '$user' oninput = "checkUser(this)">
            </div>
            <div id = "used"></div>
            <div class = "form_group">
                <label for = "password"  class = 'form-label'>Password </label>
                <input type = "text" id = "password" name = "password" value = "$password">
            </div>
            <p class = "lead">
                    <span class ="signup_header">Already a member? Please, <a href = "login.php">log in</a></span>
                </p>
            <div id = "error">$error</div>
            <input type = "submit" class = "btn btn-primary submit_btn" value = "Sign up">
        </form>
    </div>
</div>
_END;
?>





















}